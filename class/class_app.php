<?php
//**************************************************************************************************

class App {

    // $_SERVER["SERVER_PROTOCOL"] // "HTTP/1.1"
    // $_SERVER["HTTP_HOST"] // "localhost:12080"
    public $siteName = SITE_NAME; // Имя сайта
    public $siteNameU = ""; // Имя сайта без спецсимволов
    public $siteUrl = SITE_URL; // Url сайта
    public $siteDescription = SITE_DESCRIPTION; // Описание сайта
    public $siteBucket = SITE_BUCKET; // Корзина сайта
	public $siteLogo = ""; // Url логотипа сайта
    public $siteProjectID = SITE_PROJECT_ID; // ID из таблицы `projects`
    public $pageTypeID = 0; // ID типа страницы (page, api)
    public $pages = []; // Массив страниц сайта
    public $routeParts = []; // Массив частей маршрута без домена и без GET-параметров
    public $pageIndex = -1; // Индекс текущей страницы
    public $pageName = ""; // Имя текущей страницы
    public $pageTitle = ""; // Наименование текущей страницы
    public $pdo = null; // Объект PDO
    public $authAccount = null; // Авторизованный Account
    public $authToken = ""; // Токен
    public $today = ""; // Сегодня

    // Конструктор класса
    function __construct() {
        // Создаётся объект PDO
        $this->pdo = $this->createPDO(DB_HOST, DB_NAME, DB_CHAR, DB_USER, DB_PASS);
    }

    // Создаётся объект PDO
    public function createPDO($db_host, $db_name, $db_char, $db_user, $db_pass) {
        $dsn = "mysql:unix_socket=" . $db_host . ";dbname=" . $db_name . ";charset=" . $db_char;
        $opt  = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => TRUE,
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+00:00'",
			// Будет выполнять преобразование типов данных Integer -> String
            PDO::ATTR_STRINGIFY_FETCHES  => TRUE,
			// Необходимо для PDO::ATTR_STRINGIFY_FETCHES
            //PDO::ATTR_EMULATE_PREPARES   => FALSE,
        );
        try {
            return new PDO($dsn, $db_user, $db_pass, $opt);
        }
        catch (PDOException $e) {
            http_response_code(500);
            die($e->getMessage());
        }
    }

    // Инициализируется класс после первичного определения его свойств
    public function init() {
        // Имя сайта без спецсимволов
        $this->siteNameU = preg_replace("/[-:\s]/", "_", $this->siteName);
		// Url логотипа сайта
		$this->siteLogo = $this->siteUrl . "/images/logo_menu.png"; // Белый на прозрачном не будет отображаться в постах на других сайтах
		// Загрузка массива страниц (page, api)
		$sql = "
			SELECT Project_Page_Name AS name,
				Project_Page_Title AS title,
				Project_Page_Note AS note
			FROM project_pages
			WHERE Project_Page_Status = 'L'
				AND Project_Page_Project_ID = ?
				AND Project_Page_Type_ID = ?
			ORDER BY Project_Page_Order
		";
		$params = [ SITE_PROJECT_ID, $this->pageTypeID ];
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($params);
		$this->pages = $stmt->fetchAll();
        // Определяется массив частей маршрута
        $this->routeParts = $this->parseURI();
        // Определяется индекс текущей страницы
        $this->pageIndex = $this->determinePage();
		if ( $this->pageIndex > -1 ) {
			// Определяется имя текущей страницы
			$this->pageName = $this->pages[$this->pageIndex]["name"];
			// Определяется наименование текущей страницы
			$this->pageTitle = $this->pages[$this->pageIndex]["title"];
		}
		// Заменяется стандарный обработчик ошибок
		$value = substr($_SERVER["HTTP_HOST"], 0, 9) == "localhost" ? 1 : 0; // "localhost:14080"
		ini_set("display_errors", $value);
		ini_set("display_startup_errors", $value);
		register_shutdown_function([$this, "shutdownHandler"]);
		// Проверяется авторизация Account'а
        $this->authAccount = $this->authCheck();
		// Сегодня
		$this->today = date("Y-m-d");
    }

    // Определяется массив частей маршрута
    public function parseURI() {
        // Разборка URI
        $uri = explode("?",trim(strtolower($_SERVER['REQUEST_URI']),"/\\"));
        return explode("/",trim($uri[0],"/"));
    }

    // Определяется индекс текущей страницы
    public function determinePage() {
        $pageName = ""; // Имя текущей страницы
        // При использовании в API пропускается часть "api"
        if ( $this->routeParts[0] == "api" && $this->routeParts[1] ) { $pageName = $this->routeParts[1]; }
        else { $pageName = $this->routeParts[0]; }
        // Определяет 0 страницу текущей, если маршрут пустой
        if ( $pageName == "" ) {
            return 0;
        }
        // Перебор всех возможных страниц сайта
        $i = 0;
        foreach ( $this->pages as $p ) {
            if ( $pageName == $p["name"] ) {
                return $i;
            }
            $i++;
        }
        // Определяет последнюю страницу текущей, если страница не найдена
        // Определяет -1 страницу текущей, если массив pages пустой
        return count($this->pages)-1;
    }

    // Проверяется авторизация Account'а
    public function authCheck() {
		global $frontController;

		// Account
		$account = [
			"email"=>"", // Здесь может быть не школьный аккаунт
			"emailID"=>"0",
			"personID"=>"0",
			"personCountryID"=>"",
			"personFirstName"=>"",
			"personMiddleName"=>"",
			"personLastName"=>"",
			"personName"=>"",
			"personNameLanguageID"=>"",
			"personWalletID"=>"0",
			"personIsCoworker"=>"0", // Даёт пользователю права доступа
			"message"=>"",
			"logID"=>"", // ID записи в `log` с сообщением об ошибке авторизации
			"timezoneID"=>"0",
			"timezoneName"=>"",
			"timezoneCountryID"=>"",
			"timezoneCountry"=>"",
			"timezoneOffset"=>"",
			"timezoneAbbreviation"=>"",
		];

		// Загрузка токена
		$cookiesName = $this->siteNameU . "_token";
		if ( isset($_COOKIE[$cookiesName]) ) {
			$sql = "
				SELECT *
				FROM tokens
					INNER JOIN emails ON Token_Email_ID = Email_ID
				WHERE Token_Status = 'L'
					AND Token_Value = ?
					AND Email_Status = 'L'
				LIMIT 1
			";
			$params = [ $_COOKIE[$cookiesName] ];
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute($params);
			if ( $row = $stmt->fetch() ) {
				$email = $row["Email_Address"];
				$this->authToken = $row["Token_Value"];
			}
			else {
				$email = "";
			}
		}
		else {
			$email = "";
		}

		// Тестовая авторизация для LOCALHOST
		if ( $frontController["server"] == "Local" ) {
			$email = "aleksandr.ilyin@montessori.ua";
		}

		// Если нет авторизации
		if (empty($email)) {
			$account["message"] = "Необходима авторизация с помощью аккаунта Google";
																																
			return $account;
		}

		//
		$account["email"] = $email;

		// Если не школьная авторизация
		$domain = explode("@", $email)[1];
		$sql = "
			SELECT 1
			FROM gwe_domains
			WHERE domainName = ?
		";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute([ $domain ]);
		$row = $stmt->fetch();
		if ( empty($row) ) {
			$account["message"] = "Необходима авторизация с помощью аккаунта школы";
																													 
			return $account;
		}

		// Поиск Email и User в CRM
		$sql = "
			SELECT *
			FROM emails
				INNER JOIN emails_relations ON Email_ID = Email_Relation_Email_ID
				INNER JOIN users ON Email_Relation_User_ID = User_ID
			WHERE Email_Address = :Email_Address
				AND Email_Relation_Login = 1
				/* AND Email_Status = 'L' */
				/* AND Email_Relation_Status = 'L' */
				AND User_Status = 'L'
			LIMIT 1
		";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute([ "Email_Address"=>$email ]);
		$row = $stmt->fetch();
		if ( $row ) {
			$account["emailID"] = $row["Email_ID"];
			$account["personID"] = $row["Email_Relation_User_ID"];
			$account["personCountryID"] = $row["User_Country_ID"];
			$account["personWalletID"] = $row["User_Wallet_ID"];
			$account["personIsCoworker"] = $row["User_Is_Coworker"];
		}
		else {
			$account["message"] = "Email не найден в CRM школы";
			$account["logID"] = $this->log("", 0, "auth", json_encode($account, JSON_UNESCAPED_UNICODE), $account["message"]);
			return $account;
		}

		// Проверка checkbox'а сотрудник
		if ( empty($account["personIsCoworker"]) ) {
			$account["message"] = "Физлицо не является сотрудником";
			$account["logID"] = $this->log("", 0, "auth", json_encode($account, JSON_UNESCAPED_UNICODE), $account["message"]);
			return $account;
		}

		// Поиск ФИО физлица в CRM
		$sql = "
			SELECT * FROM user_names WHERE User_Names_User_ID = :User_Names_User_ID AND User_Names_Primary = 1
			UNION ALL
			SELECT * FROM user_names WHERE User_Names_User_ID = :User_Names_User_ID AND User_Names_Language_ID = ( SELECT User_Languages_Language_ID FROM user_languages WHERE User_Languages_User_ID = :User_Names_User_ID AND User_Languages_Primary = 1 LIMIT 1 )
			UNION ALL
			SELECT * FROM user_names WHERE User_Names_User_ID = :User_Names_User_ID AND User_Names_Language_ID = 2 
			UNION ALL
			SELECT * FROM user_names WHERE User_Names_User_ID = :User_Names_User_ID AND User_Names_Language_ID = 3
			UNION ALL
			SELECT * FROM user_names WHERE User_Names_User_ID = :User_Names_User_ID
			LIMIT 1
		";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute([ "User_Names_User_ID"=>$account["personID"] ]);
		$row = $stmt->fetch();
		if ( $row ) {
			$account["personFirstName"] = $row["User_Names_First_Name"];
			$account["personMiddleName"] = $row["User_Names_Middle_Name"];
			$account["personLastName"] = $row["User_Names_Last_Name"];
			$account["personName"] = trim($row["User_Names_First_Name"] . " " . $row["User_Names_Middle_Name"] . " " . $row["User_Names_Last_Name"]);
			$account["personNameLanguageID"] = $row["User_Names_Language_ID"];
		}
		else {
			$account["message"] = "Имя не найдено в CRM";
			$account["logID"] = $this->log("", 0, "auth", json_encode($account, JSON_UNESCAPED_UNICODE), $account["message"]);
			return $account;
		}

		// Timezone физлица на текущую дату
		$sql = "
			SELECT Timezone_ID, Timezone_Name, Timezone_Country_ID,
				Country_Name_Tr,
				User_Ref_Timezones_Relation_Date_From
			FROM user_ref_timezones_relations
				LEFT JOIN ref_timezones ON User_Ref_Timezones_Relation_Timezone_ID = Timezone_ID
				LEFT JOIN ref_countries ON Timezone_Country_ID = Country_ID
			WHERE User_Ref_Timezones_Relation_User_ID = :User_Ref_Timezones_Relation_User_ID
				AND User_Ref_Timezones_Relation_Date_From <= UTC_TIMESTAMP()
				AND User_Ref_Timezones_Relation_Status = 'L'
			ORDER BY User_Ref_Timezones_Relation_Date_From DESC
			LIMIT 1
		";
		$stmt = $this->pdo->prepare($sql);
		$params = [ "User_Ref_Timezones_Relation_User_ID" => $account["personID"] ];
		$stmt->execute($params);
		$row = $stmt->fetch();
		if ($row) {
			$account["timezoneID"] = $row["Timezone_ID"];
			$account["timezoneName"] = $row["Timezone_Name"];
			$account["timezoneCountryID"] = $row["Timezone_Country_ID"];
			$account["timezoneCountry"] = $row["Country_Name_Tr"];
		}

		// Offset физлица на текущую дату
		$sql = "
			SELECT *
			FROM ref_timeoffsets
			WHERE TimeOffset_Timezone_ID = :TimeOffset_Timezone_ID
				AND (
					UNIX_TIMESTAMP() BETWEEN TimeOffset_Start AND TimeOffset_End 
					OR
					UNIX_TIMESTAMP() > TimeOffset_Start AND ISNULL(TimeOffset_End)
				)
			LIMIT 1
		";
		$stmt = $this->pdo->prepare($sql);
		$params = [ "TimeOffset_Timezone_ID" => $account["timezoneID"] ];
		$stmt->execute($params);
		$row = $stmt->fetch();
		if ($row) {
			$account["timezoneOffset"] = $row["TimeOffset_GmtOffset"];
			$account["timezoneAbbreviation"] = $row["TimeOffset_Abbreviation"];
		}

		return $account;
    }

	// Запись в log
	public function	log($tableName, $tableID, $action, $raw, $note) {
		$sql = "
			INSERT INTO logs
			SET
				Log_Project_ID = ?, /* this-project */
				Log_DateTime = UTC_TIMESTAMP(),
				Log_User_Email = ?,
				Log_User_ID = ?,
				Log_Table_Name = ?,
				Log_Table_ID = ?,
				Log_Action = ?,
				Log_Note = ?,
				Log_RAW = ?
		";
		$params = [
			$this->siteProjectID,
			$this->authAccount["email"],
			$this->authAccount["personID"] == "0" ? null : $this->authAccount["personID"], /* т.к. есть relation на таблицу `users` */
			$tableName,
			$tableID,
			$action,
			mb_substr($note, 0, 255),
			mb_substr($raw, 0, 65000), // ~64kb
		];
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($params);
	}

	// Заменяется стандарный обработчик ошибок
	public function shutdownHandler() {
		$error = error_get_last();
		if ($error) {
			$sql = "
				INSERT INTO errors
				SET
					Error_Project_ID = ?, /* this-project */
					Error_DateTime = UTC_TIMESTAMP(),
					Error_User_Email = ?,
					Error_User_ID = ?,
					Error_Type = ?,
					Error_Message = ?,
					Error_File = ?,
					Error_Line = ?,
					Error_Debug = ?
			";
			$params = [
				$this->siteProjectID,
				$this->authAccount["email"],
				$this->authAccount["personID"] == "0" ? null : $this->authAccount["personID"], /* т.к. есть relation на таблицу `users` */
				$error["type"],
				$error["message"],
				$error["file"],
				$error["line"],
				print_r(debug_backtrace(), true)
			];
			// Если записать ошибку в БД невозможно, то записываем в системный Log
			if ($this->pdo) {
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute($params);
			}
			else {
				//error_log("shutdownHandler: " . print_r($params, true));
				syslog(LOG_ERR, $error["message"]);
			}
		}
	}

	// Получение переменной из `variables`
	public function varGet($varName) {
		$sql = "
			SELECT *
			FROM variables
			WHERE Variable_Name = ?
		";
		$params = [ $varName ];
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($params);
		$row = $stmt->fetch();
		if ($row) return $row["Variable_Value"];
		else return null;
	}

    // Проверка Email
    public function checkEmail($Email) {
        $patternEmail = '/^([A-Za-z0-9_\.-]+)@([A-Za-z0-9_\.-]+)\.([A-Za-z\.]{2,6})$/';
        return preg_match($patternEmail, $Email);
    }

    // Проверка алфавита
    public function checkAlphabet($lang, $string) {
		switch ( $lang ) {
			case "2" : $regexp = "/[^АаБбВвГгҐґДдЕеЄєЖжЗзИиІіЇїЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЬьЮюЯя\s\'\-\.]/u"; break; // UK
			case "3" : $regexp = "/[^АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя\s\'\-\.]/u"; break; // RU
			case "4" : $regexp = "/[^A-Za-z\s\'\-\.]/u"; break; // EN
			default : $regexp = null; break;
		}
		// Символы не из диаппазона
		if ( $regexp ) {
			preg_match_all($regexp, $string, $matches);
			if ( $matches ) {
				return implode("", $matches[0]);
			}
		}
		return "";
    }

	// Фильтрация строки, введённой пользователем
	// Test: <span> ыыы QQQ.QQQ 1.5 </span> "“”‘ʼ″`´’′     &quot;🐥🐥🐥&quot; ааа.ббб
	public function stringFilterName($lang, $string) {
		// удаление тегов HTML
		$string = str_replace("<", "", $string);
		$string = str_replace(">", "", $string);

		// htmlspecialchars_decode() - преобразование специальных HTML-сущностей(&quot; и т.п.) обратно в соответствующие символы
		$string = htmlspecialchars_decode($string, ENT_QUOTES);
		$string = str_replace("&nbsp;", " ", $string);
		$string = str_replace("&mdash;", "-", $string);
		$string = str_replace("&ndash;", "-", $string);

		// trim() - удаление пробелов в начале и в конце строки
		$string = trim($string);
		// замена нескольких пробелов на 1 пробел
		$string = preg_replace("~\s+~u", " ", $string);

		// замена неправильных апострофов
		$string = preg_replace("~[\"“”‘ʼ″`´’′]~u", "'", $string);
		// замена нескольких апострофов на 1 апостроф
		$string = preg_replace("~'+~u", "'", $string);

		// замена нескольких дефисов на 1 дефис
		$string = preg_replace("~\-+~u", "-", $string);
		// пробелы слева и справа тире удаляются
		$string = preg_replace("~\s*\-\s*~u", "-", $string);

		// замена нескольких точек на 1 точку
		$string = preg_replace("~\.+~u", ".", $string);

		// подмена букв: латинские на кириллицу и наоборот
		$letterLat = ["C","c","O","o","P","p","A","a","E","e","T","I","i","H","K","k","X","x","B","M"];
		$letterCyr = ["С","с","О","о","Р","р","А","а","Е","е","Т","І","і","Н","К","к","Х","х","В","М"];
		switch ( $lang ) {
			case "2" : // UK
			case "3" : // RU
				$string = str_replace($letterLat, $letterCyr, $string);
				break;
			case "4" : // EN
				$string = str_replace($letterCyr, $letterLat, $string);
				break;
			default : 
				break;
		}

		// 1-е слово: 1-я буква в заглавную, остальные в строчную
		// Остальные слова: 1-ю букву не меняем, со 2-й буквы в строчную
		$strings = explode(" ", $string);
		for ( $i=0; $i<count($strings); $i++ ) {
			if ( $i == 0 ) {
				$strings[$i] = mb_strtoupper(mb_substr($strings[$i], 0, 1, "UTF-8"), "UTF-8") . mb_strtolower(mb_substr($strings[$i], 1, null, "UTF-8"), "UTF-8");
			}
			else {
				$strings[$i] = mb_substr($strings[$i], 0, 1, "UTF-8") . mb_strtolower(mb_substr($strings[$i], 1, null, "UTF-8"), "UTF-8");
			}
		}
		$string = implode(" ", $strings);

		// удаление 3-х и 4-х байтовых символов
		//$utf_3_4_filter = "~([\xE0-\xEF][\x80-\xBF]{2}|[\xF0-\xF7][\x80-\xBF]{3})~"; // Модификатор "u" не ставить, т.к. RegExp работает с байтами, а не с UTF-символами
		//$string = preg_replace($utf_3_4_filter, "", $string);

		//
		return $string;
	}

    // Проверка даты
    public function checkDate($Date) {
        return strtotime($Date) !== false;
    }

	// Преобразование ГГГГ-ММ-ДД -> ДД.ММ.ГГГГ
	public function dateDMY($date) {
		return $date ? substr($date, 8, 2) . "." . substr($date, 5, 2) . "." . substr($date, 0, 4) : "";
	}

	// Преобразование ГГГГ-ММ-ДД ЧЧ:ММ:СС -> ДД.ММ.ГГГГ ЧЧ:ММ:СС
	public function dateDMYHIS($dateTime) {
		return $dateTime ? substr($dateTime, 8, 2) . "." . substr($dateTime, 5, 2) . "." . substr($dateTime, 0, 4) . " " . substr($dateTime, 11, 8) : "";
	}

	// Преобразование секунд в HH:MM
	public function secondsToHHMM($seconds) {
		if (intval($seconds)>0) $sign = "+";
		elseif (intval($seconds)<0) $sign = "-";
		else $sign = "";
		$HHMM = $sign . sprintf("%02d:%02d", (abs($seconds)/3600),(abs($seconds)/60%60));
		return $HHMM;
	}

	// Получение значения элемента массива с проверкой существования ключа
	public function array_key_value($array, $key, $value = "") {
		return array_key_exists($key, $array) ? $array[$key] : $value;
	}

	// dd.mm.yyyy hh:mm -> dow, dd mmmmmm yyyy, hh:mm
	public function dateDMYHM($date) {
		if (empty($date) || $date=="-") return "-";
		$d = substr($date, 0, 2);
		$m = substr($date, 3, 2);
		$y = substr($date, 6, 4);
		$dow = date("w", strtotime($y . "-" . $m . "-" . $d) );
		$daysOfWeek = ["Вс","Пн","Вт","Ср","Чт","Пт","Сб"];
		$time = substr($date, 11, 5);
		$monthes = ["","января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря"];
		$dmyhm = $daysOfWeek[$dow] . ", " . $d . " " . $monthes[(int)$m] . " " . $y;
		if ($time) {
			$dmyhm .= ", " . $time;
		}
		return trim($dmyhm);
	}

	// Определение длины месяца в днях с учетом високостных лет.
	//
	// Год является високосным, если год делится на 4 без остатка.
	// Год не является високосным, если он полностью делится и на 4, и на 100.
	// Год является високосным, если он делится и на 4, и на 100, и на 400.
	//
	// January == 1
	// $mL = $app->monthLong(1996, 1);
	public function monthLong($y, $m) {
		$y = intval($y);
		$m = intval($m);
		if ( $m == 2 ) { return $y%4 || ( !($y%100) && $y%400 ) ? 28 : 29; }
		else { return $m==4 || $m==6 || $m==9 || $m==11 ? 30 : 31; }
	}

	// Замена, при необходимости, NULL на значение по умолчанию
	public function nvl(&$var, $default = "") {
		return isset($var) ? $var : $default;
	}

} /* class App */

//**************************************************************************************************
