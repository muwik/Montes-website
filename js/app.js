
//**************************************************************************************************
//**************************************************************************************************
// Функции JS
//**************************************************************************************************
//**************************************************************************************************

//**************************************************************************************************
// Авторизация с помощью социальных сетей
//**************************************************************************************************

function authSocial(authProvider) {
	var scr = {};
	scr.window = {};
	scr.window.screen = {};
	scr.document = {};
	scr.document.documentElement = {};
	// Размеры экрана
	scr.window.screen.width = window.screen.width;
	scr.window.screen.height = window.screen.height;
	scr.window.screen.availWidth = window.screen.availWidth;
	scr.window.screen.availHeight = window.screen.availHeight;
	// Размеры окна
	scr.window.outerWidth = window.outerWidth;
	scr.window.outerHeight = window.outerHeight;
	scr.window.innerWidth = window.innerWidth;
	scr.window.innerHeight = window.innerHeight;
	scr.document.documentElement.clientWidth = document.documentElement.clientWidth;
	scr.document.documentElement.clientHeight = document.documentElement.clientHeight;
	// Размеры веб-страницы
	scr.document.documentElement.scrollWidth = document.documentElement.scrollWidth;
	scr.document.documentElement.scrollHeight = document.documentElement.scrollHeight;

	// Авторизация
	var url = "/api/auth/" + authProvider;
	url += "?do=auth";
	url += "&scr=" + encodeURIComponent(JSON.stringify(scr));
	location.href = url;
}

//**************************************************************************************************

