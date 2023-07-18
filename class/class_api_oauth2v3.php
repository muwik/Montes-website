<?php
//****************************************************************************************************
//
// Получение Токена для доступа к API Google Apps
//
// oAuth2 v3
//
// Инструкция Using OAuth 2.0 for Server to Server Applications
// https://developers.google.com/identity/protocols/OAuth2ServiceAccount
//
//****************************************************************************************************
//
// Необходимо включить доступ в Admin console >>> Security >>> Show more >>> Advanced settings >>> Manage API client access
// и для других включённых API тоже ( возможен только одноразовый ввод через запятую )
// Update 2022:
// https://admin.google.com/
// Admin console >>> Security >>> Access and data control >>> API Controls >>> Domain-wide Delegation
// Массив $scopes см. ниже
//
//****************************************************************************************************

// Текущий действующий Токен
// include 'class/class_api_oauth2v3.php';
// $oAPI_OAuth2v3 = new API_OAuth2v3;
// $accessToken2v3 = $oAPI_OAuth2v3->GetToken();

//****************************************************************************************************

// Class API_OAuth2v3
// include "class/class_api_oauth2v3.php";

// Экземпляр Класса
// $oAPI_OAuth2v3 = new API_OAuth2v3;

// Текущий действующий Токен
// $accessToken2v3 = $oAPI_OAuth2v3->GetToken();

// Остаточное время жизни действующего Токена
// $timeExp2v3 = $oAPI_OAuth2v3->GetExpiresIn();

// Новый Токен
// $newToken2v3 = $oAPI_OAuth2v3->GetNewToken();

//****************************************************************************************************

class API_OAuth2v3 {

// Фейковый Юзер, от имени которого приложение получает права доступа
// Нельзя выносить этого пользователя в группу без 2-ной аутентификации
public $Behalf_User_Email = 'api.oauth@montessori.ua';

// Из Google Developers Console из раздела Service Account ( из приложения monte-crm!!! )
const SERVICE_ACCOUNT_EMAIL_ADDRESS = 'monte-crm@appspot.gserviceaccount.com';

// Ключ подписи ( из приложения monte-crm!!! )
// Из Google Developers Console из раздела Service Account
// Получен из JSON key. Заменены \n и \u003d.
// Кнопки генерации ключа есть только у собственника домена

const SERVICE_ACCOUNT_SIGNKEY = <<<EOD
-----BEGIN PRIVATE KEY-----
MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCZsjIxsa/tsYLI
rMx3lsfxMAoOj/u+jF9yN4rYEElBc63kZruNBTGbwF5D/rtU+GcjvuFsLk0JOHQH
XadgnUdMb6UyVQvarCQaNEOiA9vNmiMTNcl5FJ2EJr1Uj5Slnp4ovJu9i6Tmi1gN
yPU+C+dN6z1GNQLE7Gy0IjfGEOPoqFPnPKGRth+DZ/vGOQ0ykka8zuiDOFLEA6LI
cpwpimtARYMd+7pLuk7DaUK+to+FLztNZFRw0vynAodYtjIUOqmhqsdPxNEtmC5Q
nP1eNJ8vuTqEtJIR1UnX6DQ+Waaj2bOtmVjnKuslgwHdl75GrVblFRu1ed0pZW7N
gvgDPedfAgMBAAECggEACQCBZRy5p6vac6N/VE/OBSfhpumy/n2dR4TOSoplqAI9
AKAtwvw3ZB53xvbABSGJdPQEov/xPiWC0j2fhI6hsu3lGJYXnCax9KD0ByS/toKd
JE5lrwRQl4FnXHEObUblj5BAdPEdZu1pamFHT+uFkDBDhf2r3FnWohRQ/PZXSvSd
vPUPzxoJdL5RGEz60n0ANbWfZkDdKCgx+fIDbENs4qk3u949oFSbsbK8SxaFIr42
nOrc3V3JbOzdPHrGUDqdWvWrcWmMe2o7qESzy/nj3oDJkKvCeGmggQjzFY5gR2E7
qeEl3QmzHnItdtrMtYZEbXnsM7jTmpRYnteTlaaVFQKBgQDHI4e8ywkzhhRZ4lNM
YbsJMWpTUDqIYOmBe+81VQhxXI3gIM5ac0q1MLZAOMnLyvQVAdO9CUPzeJ07QC3v
Nn6XJ3/elo8xKoWuNzD1rPIYHmrsc4XGyJaIqQb0Z/JGqIGoZqsSuqicuhFpESOV
pCw2MWgrvuvQa+cp7qEyT8a4hQKBgQDFlO9di7IvzB9jsQGFwvJ4nsc/VzAdwGpA
opS3nCEPytWFo3GigATj0KDNpch4A4DJURoXzlr+/xdbJTyLoK6pTD99gmwFHt5o
lwwODLdquvYzBqgy4btGhkAcn5XFTeihhzwwODWZZ+wvHzOpoVa/ag6Hvv947AxP
qYxG77YXkwKBgGvn3M14V2wL40sxUGG7M1Yv6KVse8saeG0pct07Tm/e7yHbpPVu
M7UqyBbUrsQ3HTuk2c89Dg0H9mr8w+czaDUPukIq4zyJBhb44Ra+uBBJqzalAoBM
gQVcUeBt0uJmvJs7xsdHTcZfLL/6AYY8h5h1/TR3J+CwF3qpS7+vasbhAoGAc5W8
LgpiFCoilsxe6qRv+nZQc1KLGGyO+/7gZ0VT5gwvuz0xZfHkam2LFKMOUn8iISNr
009p1lDelfiDod8/LlUns0HP9XLog2ERsUppJmv3SUR0s0dwqkIxUU1ebY01MQGP
CVpoqLSt66ciLvLub44Yr/rhMxlL3nJ+WKU07jcCgYAhgRLsx6KieHvFtvxCS40Y
NqjDqNJNxyu7M4MBkTAJ56Tz5hGeHXfws3/ez8E1a2OtK8YcT8Gbc94ep0fu/RE6
y7TsR6PBMn9ZBNerlSwr4LANDu6eerwcaZNYKVw1JGkznCaRzasZoQXlubSmluBP
upZnDUSsd+2SUhKNu9YIaQ==
-----END PRIVATE KEY-----
EOD;

//****************************************************************************************************
// Текущий действующий Токен
// ( проверяет существующий или создаёт новый )
// Возвращает Токен, выделенный из JSON-ответа сервера
//****************************************************************************************************

public function GetToken() {

     if ( empty( $_SESSION['AppToken2v3'] ) ) {
         $timeExp = 0;
     }
     else {
         // Остаточное время жизни действующего Токена
         $timeExp = self::GetExpiresIn();
     }

     // Если < минуты ИЛИ его вообще нет, то запрашиваем новый Токен 
     if ( $timeExp < 60 ) {

         // Новый Токен
         $newToken = self::GetNewToken();
         $_SESSION['AppToken2v3'] = $newToken;
         return $newToken;
     }
     // Если Токен уже есть и его срок не истёк
     else {
         return $_SESSION['AppToken2v3'];
     }
}

//****************************************************************************************************
// Запрос нового Токена
// Возвращает Токен, выделенный из JSON-ответа сервера
//****************************************************************************************************

public function GetNewToken() {

	///// Заголовок

	$JWT_header = '{"alg":"RS256","typ":"JWT"}';

	///// Набор требований
	$JWT_claim_set = [];

	// Email address of the "client_id" ( from "Service Account" )
	$JWT_claim_set["iss"] = self::SERVICE_ACCOUNT_EMAIL_ADDRESS;

	// Области доступа
	$scopes = [

		// Scopes для gmail_api
		"https://mail.google.com/",
		"https://www.googleapis.com/auth/gmail.modify",
		"https://www.googleapis.com/auth/gmail.readonly",

		// Global scope for access to audit user accounts 
		"https://apps-apis.google.com/a/feeds/compliance/audit/",

		// Scopes для групп пользователей
		"https://www.googleapis.com/auth/admin.directory.group",
		"https://www.googleapis.com/auth/admin.directory.group.readonly",

		// Scopes для пользователей + cloud-platform нужен для Cloud SQL Admin API
		"https://www.googleapis.com/auth/cloud-platform",
		"https://www.googleapis.com/auth/admin.directory.user",

		// Scopes для календарей
		"https://www.googleapis.com/auth/admin.directory.resource.calendar",

		// Scopes для доменов
		"https://www.googleapis.com/auth/admin.directory.domain",

		// Scopes для "organizational units"
		"https://www.googleapis.com/auth/admin.directory.orgunit",

		// Scopes для Cloud Storage JSON API
		"https://www.googleapis.com/auth/devstorage.full_control",

		// Scopes для Google Drive API
		"https://www.googleapis.com/auth/drive",

	];
	// Области доступа (через пробел)
	$JWT_claim_set["scope"] = implode(" ", $scopes);

	// Token
	$JWT_claim_set["aud"] = "https://www.googleapis.com/oauth2/v3/token";

	// Время окончания действия
	$utcExp = time() + 60*60;
	$JWT_claim_set["exp"] = $utcExp;

	// Время начала действия
	$utcIat = time();
	$JWT_claim_set["iat"] = $utcIat;

	// От имени и по поручению
	$JWT_claim_set["sub"] = $this->Behalf_User_Email;

	$JWT_claim_set = json_encode($JWT_claim_set, JSON_UNESCAPED_UNICODE);

	///// Сигнатура

	// Подписываемые данные
	$signData = base64_encode( $JWT_header ) . '.' . base64_encode( $JWT_claim_set );

	// Сюда будет возвращён результат
	$JWT_signature = "";

	// Ключ подписи
	$signKey = self::SERVICE_ACCOUNT_SIGNKEY;

	// Алгоритм подписи
	$signAlgo = "SHA256";

	// Подписывание
	openssl_sign( $signData, $JWT_signature, $signKey, $signAlgo );

	///// Кодирование
	$JWT_base64 = base64_encode( $JWT_header ) . '.' . base64_encode( $JWT_claim_set ) . '.' . base64_encode( $JWT_signature );

	///// POST Запрос Токена
	$url = 'https://www.googleapis.com/oauth2/v3/token';

	// массив для переменных, которые будут переданы в строке с запросом
	$paramsArray = array(
		'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
		'assertion' => $JWT_base64
	); 
	// преобразуем массив в URL-кодированную строку
	$vars = http_build_query( $paramsArray );
	// создаем параметры контекста
	$options = array(
					'http' => array(  
						'method'  => 'POST',  // метод передачи данных
						'header'  => 'Content-type: application/x-www-form-urlencoded',  // заголовок 
						'content' => $vars,  // переменные
					)  
	);
	$context  = stream_context_create( $options );  // создаём контекст потока
	$txtResponse = file_get_contents( $url, false, $context );  //отправляем запрос

	// Декодирование ответа - получение Токена
	$JWT_array = json_decode( $txtResponse, true );
	$pAccessToken = $JWT_array["access_token"];

	return $pAccessToken;
}

//****************************************************************************************************
// Запрос остатка времени жизни Токена
// Возвращает Время(сек), выделенное из JSON-ответа сервера
//****************************************************************************************************

public function GetExpiresIn() {

     $txtRequest = "https://www.googleapis.com/oauth2/v3/tokeninfo?access_token=" . urlencode( $_SESSION['AppToken2v3'] );
     $txtResponse = file_get_contents( $txtRequest );

     // Декодирование ответа
     $JWT_array = json_decode( $txtResponse, true );
     $pExpiresIn = $JWT_array["expires_in"];

     return $pExpiresIn;
}

//****************************************************************************************************

}

//****************************************************************************************************
?>