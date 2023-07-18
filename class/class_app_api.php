<?php
//**************************************************************************************************
class AppBack extends App {

	// Роутер API
	public function router($routes, $access) {
		if ( empty($this->routeParts[2]) ) {
			$code = 400;
		}
		else {
			$code = 401;
			foreach ($routes as $route) {
				// $route[0] - часть пути: "load" || "insert" || ...
				// $route[1] - массив с правами доступа: [2,3]
				if ( $route[0] == $this->routeParts[2] ) {
					$code = 402;
					if (
						isset($_REQUEST["cronPassword"]) // Правильность пароля уже проверена в api.php
						||
						in_array($this->getAccess($access), $route[1]) // in_array(2, [2,3])
					) {
						$code = 0;
						call_user_func($this->routeParts[2]);
						break;
					}
					break;
				}
			}
		}
		if ( $code <> 0 ) { $this->response($code); }
	}

	// Точка выхода из API
	public function response($status = 500, $data = null) {
		// header() обязана вызываться до отправки любого вывода
		header("Content-type: text/html; charset=utf-8");
		http_response_code($status);
		switch ( $status ) {
			case 200 : // OK
			case 202 : // Accepted
				exit(json_encode($data, JSON_UNESCAPED_UNICODE));
			case 404 : // Not Found
			case 500 : // Internal Server Error
			default :
				exit($data);
				break;
		}
	}

}

//**************************************************************************************************
