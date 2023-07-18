<?php
//**************************************************************************************************

require_once "config.php";
require_once "class/class_app.php";
require_once "class/class_app_front.php";
$app = new AppFront;
$app->pageTypeID = 1; // page
$app->init();

// Prevent show old pages after browser's Prev button
header("Cache-Control: no-cache, no-store, max-age=0, must-revalidate");
// Версия приложения для загрузки style.css и script.js
$version = date("Y-m-d-H-") . substr(date("i"), 0, 1); // Только десятки минут

//**************************************************************************************************
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
	// Title
	$title = $app->pageName;
?>
    <title><?=$title?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="<?=$app->siteDescription?>">
    <meta name="keywords" content="">
    <meta name="google" value="notranslate">
    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <!-- Google Tag Manager -->
    <!--<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-K929LS4');</script>-->
    <!-- End Google Tag Manager -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" href="libs/custom_bootstrap_5_0_2.min.css">
    <link rel="stylesheet" href="libs/keen-slider.min.css?v=<?=$version?>">
    <link href="libs/dselect.css" rel="stylesheet">
    <link rel="stylesheet" href="libs/intlTelInput.min.css">
    <link rel="stylesheet" href="css/app.css?v=<?=$version?>">
    <link rel="stylesheet" href="css/welcome.css?v=<?=$version?>">
    <style>
            @font-face {
                font-family: 'Open Sans';
                font-display: swap;
                font-style: normal;
                font-weight: 400;
                src: url('../libs/fonts/OpenSans/OpenSans-Regular.woff2') format('woff2');
                src: url('../libs/fonts/OpenSans/OpenSans-Regular.ttf') format('truetype');
            }

            @font-face {
                font-family: 'Open Sans';
                font-display: swap;
                font-style: italic;
                font-weight: 400;
                src: url('../libs/fonts/OpenSans/OpenSans-Italic.woff2') format('woff2');
                src: url('../libs/fonts/OpenSans/OpenSans-Italic.ttf') format('truetype');
            }

            @font-face {
                font-family: 'Open Sans';
                font-display: swap;
                font-style: normal;
                font-weight: 500;
                src: url('../libs/fonts/OpenSans/OpenSans-Medium.woff2') format('woff2');
                src: url('../libs/fonts/OpenSans/OpenSans-Medium.ttf') format('truetype');
            }

            @font-face {
                font-family: 'Open Sans';
                font-display: swap;
                font-style: italic;
                font-weight: 500;
                src: url('../libs/fonts/OpenSans/OpenSans-MediumItalic.woff2') format('woff2');
                src: url('../libs/fonts/OpenSans/OpenSans-MediumItalic.ttf') format('truetype');
            }

            @font-face {
                font-family: 'Open Sans';
                font-display: swap;
                font-style: normal;
                font-weight: 600;
                src: url('../libs/fonts/OpenSans/OpenSans-SemiBold.woff2') format('woff2');
                src: url('../libs/fonts/OpenSans/OpenSans-SemiBold.ttf') format('truetype');
            }

            @font-face {
                font-family: 'Open Sans';
                font-display: swap;
                font-style: italic;
                font-weight: 600;
                src: url('../libs/fonts/OpenSans/OpenSans-SemiBoldItalic.woff2') format('woff2');
                src: url('../libs/fonts/OpenSans/OpenSans-SemiBoldItalic.ttf') format('truetype');
            }

            @font-face {
                font-family: 'Open Sans';
                font-display: swap;
                font-style: normal;
                font-weight: 700;
                src: url('../libs/fonts/OpenSans/OpenSans-Bold.woff2') format('woff2');
                src: url('../libs/fonts/OpenSans/OpenSans-Bold.ttf') format('truetype');
            }

            @font-face {
                font-family: 'Open Sans';
                font-display: swap;
                font-style: italic;
                font-weight: 700;
                src: url('../libs/fonts/OpenSans/OpenSans-BoldItalic.woff2') format('woff2');
                src: url('../libs/fonts/OpenSans/OpenSans-BoldItalic.ttf') format('truetype');
            }

        </style>
    <script>
        //**************************************************************************************************

        var siteName = <?=json_encode($app->siteName, JSON_UNESCAPED_UNICODE)?>;
        var siteNameU = <?=json_encode($app->siteNameU, JSON_UNESCAPED_UNICODE)?>;
        var siteDescription = <?=json_encode($app->siteDescription, JSON_UNESCAPED_UNICODE)?>;
        var pages = <?=json_encode($app->pages, JSON_UNESCAPED_UNICODE)?>;
        var pageIndex = <?=json_encode($app->pageIndex, JSON_UNESCAPED_UNICODE)?>;
        var pageName = <?=json_encode($app->pageName, JSON_UNESCAPED_UNICODE)?>;
        var pageTitle = <?=json_encode($app->pageTitle, JSON_UNESCAPED_UNICODE)?>;
        var authAccount = <?=json_encode($app->authAccount, JSON_UNESCAPED_UNICODE)?>;

        //**************************************************************************************************

    </script>
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<!--<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K929LS4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>-->
<!-- End Google Tag Manager (noscript) -->
<header class="navbar navbar-expand-lg navbar-dark mc-header py-sm-2 px-4 px-sm-42">
        <nav class="container-xxl mc-container-mw flex-nowrap mc-navbar" aria-label="Main navigation">
            <!--Выпадающее меню Бутерброда (десктоп)-->
            <div class="dropdown me-sm-3">
                <a class="d-flex align-items-center nav-link active dropdown-toggle mc-block-rounded mc-navbar-standart-btn mc-navbar-noarrow px-2 px-sm-21 mx-sm-n21 d-none d-lg-block" id="mc-sandwich-navbar-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" aria-label="sometext">
                    <!--Версия кнопки Бутерброда svg-->
                    <div class="mc-animated-sandwich">
                        <svg viewBox="0 0 24 24" id="icon-menu" width="100%" height="100%">
                            <g>
                                <rect height="2" rx="1" width="22" x="1" y="3"></rect>
                                <rect height="2" rx="1" width="22" x="1" y="11"></rect>
                                <rect height="2" rx="1" width="22" x="1" y="19"></rect>
                            </g>
                        </svg>
                    </div>
                    <!--Версия кнопки Бутерброда span-->
                    <!--
                            <div class="mc-animated-sandwich">
                                <span class="mc-block-rounded"></span>
                                <span class="mc-block-rounded"></span>
                                <span class="mc-block-rounded"></span>
                            </div>
-->
                </a>
                <div class="dropdown-menu mt-31" id="mc-dropdown-sandwich">
                    <ul class="mc-navbar-ul">
                        <li>
                            <a href="/courses">
                                <div class="d-flex mc-mobile-sandwich-button-icon">
                                    <img src="images/i-cources.svg" alt="" width="100%">
                                </div>
                                Направления и курсы
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="d-flex mc-mobile-sandwich-button-icon">
                                    <img src="images/i-student.svg" alt="" width="100%">
                                </div>
                                Стать студентом
                            </a>
                        </li>
                        <li>
                            <a href="/prices">
                                <div class="d-flex mc-mobile-sandwich-button-icon">
                                    <img src="images/i-price-card.svg" alt="" width="100%">
                                </div>
                                Цены и оплата
                            </a>
                        </li>
                        <li>
                            <a href="/gift-card">
                                <div class="d-flex mc-mobile-sandwich-button-icon">
                                    <img src="images/i-gift-card.svg" alt="" width="100%">
                                </div>
                                Подарочный сертификат
                            </a>
                        </li>
                        <li>
                            <a href="/contacts">
                                <div class="d-flex mc-mobile-sandwich-button-icon">
                                    <img src="images/i-message.svg" alt="" width="100%">
                                </div>
                                Контакты
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--Меню Бутерброда (триггер) (моб.)-->
            <a class="d-flex align-items-center nav-link active mc-block-rounded mc-navbar-noarrow px-2 px-sm-0 ms-sm-n21 me-sm-3 d-block d-lg-none" id="mc-mobile-sandwich-navbar-link" href="#" role="button" data-bs-toggle="modal" data-bs-target="#mc-mobile-sandwich-modal" aria-label="sometext">
                <svg viewBox="0 0 24 24" id="mc-icon-menu" height="28">
                    <g>
                        <rect height="2" width="28" x="1" y="3"></rect>
                        <rect height="2" width="28" x="1" y="11"></rect>
                        <rect height="2" width="28" x="1" y="19"></rect>
                    </g>
                </svg>
            </a>
            <a class="navbar-brand mx-21 py-2 d-xl-inline" href="/" aria-label="Montessori Center">
                <img class="my-1" src="images/logo-old.svg" alt="test" height="34">
            </a>
            <a class="navbar-brand mx-3 d-none d-inline" href="/" aria-label="Montessori Center">
                <picture>
                    <source class="mb-1" type="image/webp" srcset="images/short-logo-old.webp" height="38" width="30">
                    <img src="images/short-logo-old.png" class="mb-1" alt="" height="38" width="30">
                </picture>
            </a>
            <!--Форма поиска-->
            <form class="flex-grow-1 mx-2 mx-sm-3 mc-hide d-none d-sm-flex">
                <div class="input-group">
                    <input type="search" class="form-control rounded-pill mc-navbar-searchbar" placeholder="Найти курсы..." aria-label="Search">
                    <button class="btn d-flex align-items-center justify-content-center rounded-circle p-0 mc-custom-search-button" type="submit" aria-label="Поиск">
                        <img src="images/i-search.svg" alt="" width="19" height="19">
                    </button>
                </div>
            </form>
            <!--Выпадающее меню Курсов (десктоп)-->
            <div class="dropdown mc-dropdown d-none d-lg-block">
                <a class="d-flex align-items-center navbar-brand dropdown-toggle fs-6 mx-0 px-3 mc-block-rounded mc-navbar-standart-btn  mc-navbar-noarrow align-items-center accent-bld" id="mc-dropdown-courses-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                    <!-- <svg class="mc-courses-toggle" version='1.2' baseProfile='tiny' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 55 37.6' height="16.7" xml:space='preserve'>
                        <g class="mc-courses-stroke">
                            <g>
                                <path d='M7.5,3.3c2.3,0,4.2,1.9,4.2,4.2s-1.9,4.2-4.2,4.2S3.3,9.8,3.3,7.5C3.3,5.2,5.2,3.3,7.5,3.3L7.5,3.3 M7.5,0L7.5,0
			C3.3,0,0,3.3,0,7.5c0,0,0,0,0,0l0,0c0,4.1,3.3,7.5,7.5,7.5l0,0c4.1,0,7.5-3.3,7.5-7.5l0,0C14.9,3.3,11.6,0,7.5,0z' />
                                <path d='M27.5,3.3c2.3,0,4.2,1.9,4.2,4.2s-1.9,4.2-4.2,4.2s-4.2-1.9-4.2-4.2C23.4,5.2,25.2,3.3,27.5,3.3 M27.5,0L27.5,0
			C23.4,0,20,3.3,20,7.5c0,0,0,0,0,0l0,0c0,4.1,3.3,7.5,7.5,7.5l0,0c4.1,0,7.5-3.3,7.5-7.4c0,0,0,0,0,0l0,0C35,3.3,31.7,0,27.5,0
			C27.5,0,27.5,0,27.5,0z' />
                                <path d='M27.5,23.4c2.3,0,4.2,1.9,4.2,4.2s-1.9,4.2-4.2,4.2s-4.2-1.9-4.2-4.2l0,0C23.4,25.2,25.2,23.4,27.5,23.4 M27.5,20.1
			L27.5,20.1c-4.1,0-7.5,3.3-7.5,7.5c0,0,0,0,0,0l0,0c0,4.1,3.3,7.5,7.4,7.5c0,0,0,0,0,0l0,0c4.1,0,7.5-3.3,7.5-7.4c0,0,0,0,0-0.1
			l0,0C35,23.4,31.7,20,27.5,20.1L27.5,20.1L27.5,20.1z' />
                                <path d='M7.5,23.4c2.3,0,4.2,1.9,4.2,4.2s-1.9,4.2-4.2,4.2s-4.2-1.9-4.2-4.2S5.2,23.4,7.5,23.4L7.5,23.4 M7.5,20.1L7.5,20.1
			c-4.1,0-7.5,3.3-7.5,7.5l0,0C0,31.6,3.3,35,7.4,35c0,0,0,0,0,0l0,0c4.1,0,7.5-3.3,7.5-7.5l0,0C14.9,23.4,11.6,20.1,7.5,20.1
			L7.5,20.1z' />
                            </g>
                        </g>

                        <path class="mc-courses-cross" d="M3.3,34.7l-3-3l14.2-14.2L0.3,3.4l3-3l14.2,14.2L31.6,0.4l3,3L20.4,17.5l14.2,14.2l-3,3L17.4,20.5L3.3,34.7z" />

                    </svg> -->
                    <svg class="mc-choose-course me-2" viewBox="0 0 24 24" version="1.1">
                        <defs>
                            <path d="M3,3 L10,3 C10.55,3 11,3.45 11,4 L11,10 C11,10.55 10.55,11 10,11 L3,11 C2.45,11 2,10.55 2,10 L2,4 C2,3.45 2.45,3 3,3 Z M3,13 L10,13 C10.55,13 11,13.45 11,14 L11,20 C11,20.55 10.55,21 10,21 L3,21 C2.45,21 2,20.55 2,20 L2,14 C2,13.45 2.45,13 3,13 Z M14,3 L21,3 C21.55,3 22,3.45 22,4 L22,10 C22,10.55 21.55,11 21,11 L14,11 C13.45,11 13,10.55 13,10 L13,4 C13,3.45 13.45,3 14,3 Z M14,13 L21,13 C21.55,13 22,13.45 22,14 L22,20 C22,20.55 21.55,21 21,21 L14,21 C13.45,21 13,20.55 13,20 L13,14 C13,13.45 13.45,13 14,13 Z M9,9 L9,5 L4,5 L4,9 L9,9 Z M9,19 L9,15 L4,15 L4,19 L9,19 Z M20,9 L20,5 L15,5 L15,9 L20,9 Z M20,19 L20,15 L15,15 L15,19 L20,19 Z" id="path-1"/>
                        </defs>
                        <g id="grid_view_24px" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon id="bounds" fill-opacity="0" fill="#FFFFFF" points="0 0 24 0 24 24 0 24"/>
                            <mask id="mask-2" fill="white">
                                <use xlink:href="#path-1"/>
                            </mask>
                            <use id="icon" fill="#111" fill-rule="nonzero" xlink:href="#path-1"/>
                        </g>
                    </svg>
                    Выбрать курс
                </a>
                <div class="dropdown-menu mt-31 p-0 mc-sandwich-courses" id="mc-dropdown-courses" aria-labelledby="mc-dropdown-courses-link">
                    <div class="d-flex justify-content-between">
                        <ul class="mc-sandwich-courses__menu mc-navbar-ul">
                            <li><a href="#" onclick="showList('mc-sandwich-courses-list-music'); return false;" class="active">Музыкальное искусство</a></li>
                            <li><a href="#" onclick="showList('mc-sandwich-courses-list-art'); return false;">Изобразительное искусство</a></li>
                            <li><a href="#" onclick="showList('mc-sandwich-courses-list-dance'); return false;">Хореография и йога</a></li>
                            <li><a href="#" onclick="showList('mc-sandwich-courses-list-logoped'); return false;">Логопед</a></li>
                            <li><a href="#" onclick="showList('mc-sandwich-courses-list-languages'); return false;">Иностранные языки</a></li>
                            <li><a href="#" onclick="showList('mc-sandwich-courses-list-school'); return false;">Предметы средней школы</a></li>
                        </ul>
                        <div class="mc-sandwich-courses__list-wrapper w-100">
                            <ul id="mc-sandwich-courses-list-music" class="mc-sandwich-courses__list mc-navbar-ul">
                                <li><a href="/piano-lessons">Фортепиано</a></li>
                                <li><a href="#">Вокал</a></li>
                                <li><a href="#">Классическая гитара</a></li>
                                <li><a href="#">Электрогитара</a></li>
                                <li><a href="#">Бас-гитара</a></li>
                                <li><a href="#">Укулеле</a></li>
                                <li><a href="#">Барабаны</a></li>
                                <li><a href="#">Скрипка</a></li>
                                <li><a href="#">Саксофон</a></li>
                                <li><a href="#">Флейта</a></li>
                                <li><a href="#">Блокфлейта</a></li>
                                <li><a href="#">Виолончель</a></li>
                                <li><a href="#">Раннее музыкальное развитие</a></li>
                            </ul>
                            <ul id="mc-sandwich-courses-list-art" class="mc-sandwich-courses__list mc-navbar-ul">
                                <li><a href="#">Живопись</a></li>
                                <li><a href="#">Лепка и скульптура</a></li>
                                <li><a href="#">Мультипликация</a></li>
                                <li><a href="#">Кройка и шитьё</a></li>
                                <li><a href="#">Компьютерная графика</a></li>
                            </ul>
                            <ul id="mc-sandwich-courses-list-dance" class="mc-sandwich-courses__list mc-navbar-ul">
                                <li><a href="#">Балет</a></li>
                                <li><a href="#">Современные танцы</a></li>
                                <li><a href="#">Йога</a></li>
                            </ul>
                            <ul id="mc-sandwich-courses-list-logoped" class="mc-sandwich-courses__list mc-navbar-ul">
                                <li><a href="#">Уроки логопеда</a></li>
                            </ul>
                            <ul id="mc-sandwich-courses-list-languages" class="mc-sandwich-courses__list mc-navbar-ul">
                                <li><a href="#">Английский язык</a></li>
                                <li><a href="#">Русский язык</a></li>
                                <li><a href="#">Украинский язык</a></li>
                                <li><a href="#">Японский язык</a></li>
                                <li><a href="#">Немецкий язык</a></li>
                                <li><a href="#">Испанский язык</a></li>
                            </ul>
                            <ul id="mc-sandwich-courses-list-school" class="mc-sandwich-courses__list mc-navbar-ul">
                                <li><a href="#">Подготовка к школе</a></li>
                                <li><a href="#">Математика</a></li>
                                <li><a href="#">Алгебра</a></li>
                                <li><a href="#">Геометрия</a></li>
                                <li><a href="#">Химия</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--Кнопка-триггер модального окна Пробного урока-->
            <button type="button" class="btn align-items-center fs-6 px-3 ms-lg-3 mc-block-rounded mc-navbar-standart-btn mc-test-lesson-btn d-none d-sm-flex accent-bld" aria-expanded="false" data-bs-toggle="modal" data-bs-target="#mc-test-lesson-modal" aria-label="Пробный урок">
                <img class="me-2" src="images/i-play.svg" alt="" width="20" height="20">
                Пробный урок
            </button>
            <!--Выпадающее меню Контактов (десктоп)-->
            <div class="dropdown d-none d-sm-block ms-lg-3">
                <div class="collapse navbar-collapse" id="mc-phone-navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="collapse d-flex align-items-center navbar-brand fs-6 mc-block-rounded mc-navbar-standart-btn dropdown-toggle mc-navbar-noarrow mx-0 px-3 accent-bld" id="mc-phone-navbar-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                <img src="images/i-contact.svg" alt="" width="23" height="17">
                                Контакты</a>
                            <div class="dropdown-menu dropdown-menu-end mt-31 p-0" id="mc-dropdown-phones">
                                <div class="mc-contacts-section__item">
                                    <div class="mc-contacts-section__item-inner">
                                        <p class="mc-contacts-section__item-inner-heading">Свяжитесь с нами</p>
                                        <div class="mc-contacts-section__item-inner-messenger">
                                            <a href="#" title="Telegram">
                                                <img src="images/i-tg.svg" alt="" width="45" height="45">
                                            </a>
                                            <a href="#" title="Viber">
                                                <img src="images/i-viber.svg" alt="" width="45" height="45">
                                            </a>
                                            <a href="#" title="WhatsApp">
                                                <img src="images/i-whatsapp.svg" alt="" width="45" height="45">
                                            </a>
                                            <a href="#" title="Facebook Messenger">
                                                <img src="images/i-facebook.svg" alt="" width="45" height="45">
                                            </a>
                                        </div>
                                        <div class="mc-contacts-section__item-inner-data">
                                            <div>
                                                <span>+1 (210) 756-7188</span>
                                                <span class="d-none d-sm-block">США</span>
                                                <span class="d-sm-none">US</span>
                                            </div>
                                            <div>
                                                <span>+44 (204) 577-16-47</span>
                                                <span class="d-none d-sm-block">Великобритания</span>
                                                <span class="d-sm-none">GB</span>
                                            </div>
                                            <div>
                                                <span>+972 (33) 760-3334</span>
                                                <span class="d-none d-sm-block">Израиль</span>
                                                <span class="d-sm-none">IL</span>
                                            </div>
                                            <div>
                                                <span>+380 (50) 775-33-53</span>
                                                <span class="d-none d-sm-block">Украина</span>
                                                <span class="d-sm-none">UA</span>
                                            </div>
                                        </div>
                                        <div class="mc-contacts-section__item-inner-mail">
                                            <a class="mc-dotted-link mc-hover-color" href="mailto:&quot;Монтессори центр&quot;<info@interschool.online>">info@interschool.online</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!--Селект языка-->
            <div class="form-group d-none d-md-block ms-lg-3" id="mc-nav-lang">
                <select class="form-select form-control mc-select-naked mc-navbar-grey-dselect mc-block-rounded mc-select-header-lang px-3" id="mc-select-header-lang">
                    <option data-inner="EN" value="EN" selected></option>
                    <option data-inner="ES" value="ES"></option>
                    <option data-inner="RU" value="RU"></option>
                    <option data-inner="UA" value="UA"></option>
                </select>
            </div>
        </nav>
    </header>
    <!--МОДАЛЬНОЕ ОКНО БУТЕРБРОДА - (МОБ.)-->
        <div class="modal mc-smart-back-modal fade mc-mobile-modal mc-mobile-modal-left" id="mc-mobile-sandwich-modal" tabindex="-1" aria-labelledby="mc-mobile-sandwich-modal-label" aria-hidden="true" role="dialog">
            <div class="modal-dialog m-0">
                <div class="modal-content mc-mobile-modal-content">
                    <div class="modal-body mc-mobile-wrapper">
                        <div class="d-flex flex-column justify-content-between">
                            <div>
                                <!--Кнопка закрыть-->
                                <div class="mc-mobile-burger-logo mc-border-bottom-grey d-flex justify-content-between align-items-center">
                                    <div class="w-100 text-center py-3">
                                        <img class="my-1" src="images/logo-old.svg" alt="test" height="34">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                    </div>
                                </div>
                                <!--Курсы-->
                                <div class="mc-mobile-sandwich-buttons">
                                    <a href="#mc-mobile-courses-modal" data-bs-toggle="modal" role="button">
                                        <div class="d-flex mc-mobile-sandwich-button-icon">
                                            <img src="images/i-cources.svg" alt="" width="100%">
                                        </div>
                                        <span class="bld m-0">Выбрать курс</span>
                                    </a>
                                    <a href="/become-a-student">
                                        <div class="d-flex mc-mobile-sandwich-button-icon">
                                            <img src="images/i-student.svg" alt="" width="100%">
                                        </div>
                                        <span class="bld m-0">Стать студентом</span>
                                    </a>
                                    <a href="/prices">
                                        <div class="d-flex mc-mobile-sandwich-button-icon">
                                            <img src="images/i-price-card.svg" alt="" width="100%">
                                        </div>
                                        <span class="bld m-0">Цены и оплата</span>
                                    </a>
                                    <a href="/gift-card">
                                        <div class="d-flex mc-mobile-sandwich-button-icon">
                                            <img src="images/i-gift-card.svg" alt="" width="100%">
                                        </div>
                                        <span class="bld m-0">Подарочный сертификат</span>
                                    </a>
                                    <a href="/contacts">
                                        <div class="d-flex mc-mobile-sandwich-button-icon">
                                            <img src="images/i-message.svg" alt="" width="100%">
                                        </div>
                                        <span class="bld m-0">Контакты</span>
                                    </a>
                                </div>
                                <!--Языки-->
                                <div class="mc-mobile-sandwich-item mc-mobile-burger-lang mc-form-mobile-sandwich d-flex align-items-center">
                                    <span class="me-21 bld fs-6">Язык:</span>
                                    <div class="form-group mc-price-section__selection-form">
                                        <select class="form-select form-control" id="mc-select-mobile-lang">
                                            <option data-inner="EN" value="EN" selected></option>
                                            <option data-inner="ES" value="ES"></option>
                                            <option data-inner="RU" value="RU"></option>
                                            <option data-inner="UA" value="UA"></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--Мессенджеры-->
                            <div class="mc-mobile-sandwich-messenger">
                                <h6 class="bld text-center fs-6 m-0 pb-31">Свяжитесь с нами</h6>
                                <div class="d-flex justify-content-evenly align-items-start">
                                    <a href="#" title="Telegram">
                                        <!--Телеграм-->
                                        <img src="images/i-tg-mobile.svg" alt="">
                                    </a>
                                    <a href="#">
                                        <!--Вайбер-->
                                        <img src="images/i-viber-mobile.svg" alt="">
                                    </a>
                                    <a href="#">
                                        <!--ВотсАпп-->
                                        <img src="images/i-whatsapp-mobile.svg" alt="">
                                    </a>
                                    <a href="/openings">
                                        <!--Фейсбук-мессенджер-->
                                        <img src="images/i-facebook-mobile.svg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="mc-mobile-sandwich-pay">
                                <div class="mc-mobile-pay__buttons">
                                    <a href="#mc-test-lesson-modal" data-bs-toggle="modal" role="button">Пробный урок $6</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--МОДАЛЬНОЕ ОКНО КУРСОВ - (МОБ.)-->
        <div class="modal mc-smart-back-modal fade mc-mobile-modal mc-mobile-modal-left" id="mc-mobile-courses-modal" tabindex="-1" aria-labelledby="mc-mobile-courses-modal-label" aria-hidden="true">
            <div class="modal-dialog m-0">
                <div class="modal-content mc-mobile-modal-content">
                    <div class="modal-body">
                        <div class="row ps-42 pe-41">
                            <div class="col-10 py-4">
                                <span class="bld text-uppercase">Выбрать курс</span>
                            </div>
                            <div class="col-2 d-flex align-items-center justify-content-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="accordion accordion-flush mc-unstyled-url-list mc-mobile-accordion mc-mobile-sandwich-accordion-primary mc-mobile-sandwich-accordion-modal" id="mc-mobile-courses-main-accordion">
                                    <div class="accordion-item mc-mobile-sandwich-item">
                                        <h2 class="accordion-header" id="mc-mobile-courses-musical">
                                            <button class="accordion-button collapsed py-31 px-42 bld" type="button" data-bs-toggle="collapse" data-bs-target="#mc-mobile-courses-musical-collapse" aria-expanded="false" aria-controls="mc-mobile-courses-musical-collapse" aria-label="Музыкальное искусство">
                                                Музыкальное искусство
                                            </button>
                                        </h2>
                                        <div id="mc-mobile-courses-musical-collapse" class="accordion-collapse collapse" aria-labelledby="mc-mobile-courses-musical" data-bs-parent="#mc-mobile-courses-main-accordion">
                                            <div class="accordion-body py-0 px-42 bld">
                                                <ul class="list-unstyled m-0 mc-mobile-sandwich-list mc-unstyled-url-list">
                                                    <a href="/piano-lessons">
                                                        <li class="bld my-3">Фортепиано</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Вокал</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Классическая гитара</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Электрогитара</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Бас-гитара</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Укулеле</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Барабаны</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Скрипка</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Саксофон</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Флейта</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Блокфлейта</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Виолончель</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Раннее музыкальное развитие</li>
                                                    </a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item mc-mobile-sandwich-item">
                                        <h2 class="accordion-header" id="mc-mobile-courses-art">
                                            <button class="accordion-button collapsed py-31 px-42 bld" type="button" data-bs-toggle="collapse" data-bs-target="#mc-mobile-courses-art-collapse" aria-expanded="false" aria-controls="mc-mobile-courses-art-collapse" aria-label="Изобразительное искусство">
                                                Изобразительное искусство
                                            </button>
                                        </h2>
                                        <div id="mc-mobile-courses-art-collapse" class="accordion-collapse collapse" aria-labelledby="mc-mobile-courses-art" data-bs-parent="#mc-mobile-courses-main-accordion">
                                            <div class="accordion-body py-0 px-42 bld">
                                                <ul class="list-unstyled m-0 mc-mobile-sandwich-list mc-unstyled-url-list">
                                                    <a href="#">
                                                        <li class="bld my-3">Живопись</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Лепка и скульптура</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Мультипликация</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Кройка и шитьё</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Компьютерная графика</li>
                                                    </a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item mc-mobile-sandwich-item">
                                        <h2 class="accordion-header" id="mc-mobile-courses-dance">
                                            <button class="accordion-button collapsed py-31 px-42 bld" type="button" data-bs-toggle="collapse" data-bs-target="#mc-mobile-courses-dance-collapse" aria-expanded="false" aria-controls="mc-mobile-courses-dance-collapse" aria-label="Школа танцев">
                                                Хореография и йога
                                            </button>
                                        </h2>
                                        <div id="mc-mobile-courses-dance-collapse" class="accordion-collapse collapse" aria-labelledby="mc-mobile-courses-dance" data-bs-parent="#mc-mobile-courses-main-accordion">
                                            <div class="accordion-body py-0 px-42 bld">
                                                <ul class="list-unstyled m-0 mc-mobile-sandwich-list mc-unstyled-url-list">
                                                    <a href="#">
                                                        <li class="bld my-3">Балет</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Современные танцы</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Йога</li>
                                                    </a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item mc-mobile-sandwich-item">
                                        <h2 class="accordion-header" id="mc-mobile-courses-logoped">
                                            <button class="accordion-button collapsed py-31 px-42 bld" type="button" data-bs-toggle="collapse" data-bs-target="#mc-mobile-courses-logoped-collapse" aria-expanded="false" aria-controls="mc-mobile-courses-logoped-collapse" aria-label="Логопед">
                                                Логопед
                                            </button>
                                        </h2>
                                        <div id="mc-mobile-courses-logoped-collapse" class="accordion-collapse collapse" aria-labelledby="mc-mobile-courses-logoped" data-bs-parent="#mc-mobile-courses-main-accordion">
                                            <div class="accordion-body py-0 px-42 bld">
                                                <ul class="list-unstyled m-0 mc-mobile-sandwich-list mc-unstyled-url-list">
                                                    <a href="#">
                                                        <li class="bld my-3">Уроки логопеда</li>
                                                    </a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item mc-mobile-sandwich-item">
                                        <h2 class="accordion-header" id="mc-mobile-courses-lang">
                                            <button class="accordion-button collapsed py-31 px-42 bld" type="button" data-bs-toggle="collapse" data-bs-target="#mc-mobile-courses-lang-collapse" aria-expanded="false" aria-controls="mc-mobile-courses-lang-collapse" aria-label="Иностранные языки">
                                                Иностранные языки
                                            </button>
                                        </h2>
                                        <div id="mc-mobile-courses-lang-collapse" class="accordion-collapse collapse" aria-labelledby="mc-mobile-courses-lang" data-bs-parent="#mc-mobile-courses-main-accordion">
                                            <div class="accordion-body py-0 px-42 bld">
                                                <ul class="list-unstyled m-0 mc-mobile-sandwich-list mc-unstyled-url-list">
                                                    <a href="#">
                                                        <li class="bld my-3">Английский язык</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Русский язык</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Украинский язык</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Японский язык</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Немецкий язык</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Испанский язык</li>
                                                    </a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item mc-mobile-sandwich-item">
                                        <h2 class="accordion-header" id="mc-mobile-courses-preschool">
                                            <button class="accordion-button collapsed py-31 px-42 bld" type="button" data-bs-toggle="collapse" data-bs-target="#mc-mobile-courses-preschool-collapse" aria-expanded="false" aria-controls="mc-mobile-courses-preschool-collapse" aria-label="Предметы средней школы">
                                                Предметы средней школы
                                            </button>
                                        </h2>
                                        <div id="mc-mobile-courses-preschool-collapse" class="accordion-collapse collapse" aria-labelledby="mc-mobile-courses-preschool" data-bs-parent="#mc-mobile-courses-main-accordion">
                                            <div class="accordion-body py-0 px-42 bld">
                                                <ul class="list-unstyled m-0 mc-mobile-sandwich-list mc-unstyled-url-list">
                                                    <a href="#">
                                                        <li class="bld my-3">Подготовка к школе</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Математика</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Алгебра</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Геометрия</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="bld my-3">Химия</li>
                                                    </a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--МОДАЛЬНОЕ ОКНО ПРОБНОГО УРОКА (УНИВЕРСАЛ.)-->
        <div class="modal mc-smart-back-modal mc-smart-viewport-modal fade" id="mc-test-lesson-modal" tabindex="-1" aria-labelledby="mc-test-lesson-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mc-modal-dialog-m-auto modal-md mx-auto">
                <div class="modal-content">
                    <div class="modal-body d-flex flex-column">
                        <div class="row flex-grow-0">
                            <div class="col-12 d-flex justify-content-end pt-3 px-3">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                            </div>
                        </div>
                        <div class="row flex-grow-0 mt-4 mt-sm-0">
                            <div class="col-12 pb-41 pb-sm-42">
                                <h1 class="bld text-center">Заказать пробный урок</h1>
                            </div>
                        </div>
                        <div class="row flex-grow-1 mb-auto">
                            <div class="col-12 px-42 d-flex justify-content-center pb-43">
                                <form class="d-flex flex-column justify-content-between flex-grow-1">
                                    <!--Имя-->
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control" id="mc-test-lesson-modal-name" placeholder=" ">
                                            <label>Имя</label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12 d-flex mc-complex-form-group">
                                            <select onchange="telcodeChange(this)" class="form-select form-control mc-complex-dselect mc-complex-dselect-left mc-complex-dselect-telcode" id="mc-test-lesson-modal-telcode">
                                                <option title="Российская Федерация" value="7" data-inner="<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 9 6'><rect fill='#fff' width='9' height='3'/><rect fill='#d52b1e' y='3' width='9' height='3'/><rect fill='#0039a6' y='2' width='9' height='2'/></svg><p class='m-0 pe-21 flex-grow-1'>Российская Федерация</p><p class='m-0 ps-5'>+7</p>"></option>
                                                <option title="Тринидад и Тобаго" selected value="1 868" data-inner="<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 18'><rect fill='#da1a35' width='30' height='18'/><polygon fill='#FFF' points='0,0 20.824734,18 30,18 9.175266,0'/><polygon points='1.52921,0 22.353945,18 28.470789,18 7.646055,0'/></svg><p class='m-0 pe-21 flex-grow-1'>Тринидад и Тобаго</p><p class='m-0 ps-5'>+1 868</p>">
                                                </option>
                                                <option title="Корейская Народно-Демократическая Республика" value="850" data-inner="<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 72 36'>
                                                        <rect fill='#024FA2' width='72' height='36' />
                                                        <rect fill='#fff' y='6' width='72' height='24' />
                                                        <rect fill='#ED1C27' y='7' width='72' height='22' />
                                                        <circle fill='#fff' cx='24' cy='18' r='8' />
                                                        <g id='star' transform='translate(24,18) scale(7.75)' fill='#ED1C27'>
                                                            <g id='cone'>
                                                                <polygon id='triangle' points='0,0 0,1 .5,1' transform='translate(0,-1) rotate(18)' />
                                                                <use xlink:href='#triangle' transform='scale(-1,1)' id='use12' />
                                                            </g>
                                                            <use xlink:href='#cone' transform='rotate(72)' id='use14' />
                                                            <use xlink:href='#cone' transform='rotate(-72)' id='use16' />
                                                            <use xlink:href='#cone' transform='rotate(144)' id='use18' />
                                                            <use xlink:href='#cone' transform='rotate(-144)' id='use20' />
                                                        </g>
                                                        </svg>
                                                        <p class='m-0 pe-21 flex-grow-1'>Корейская Народно-Демократическая Республика</p>
                                                        <p class='m-0 ps-5'>+850</p>">
                                                </option>
                                                <option title="Франция" value="33" data-inner="<svg xmlns='ttp://www.w3.org/2000/svg' viewBox='0 0 19 12'>
                                                            <rect width='19' height='12' fill='#EC1920' />
                                                            <rect width='12' height='12' fill='#FFFFFF' />
                                                            <rect width='6' height='12' fill='#051440' />
                                                        </svg>
                                                        <p class='m-0 pe-21 flex-grow-1'>Франция</p>
                                                        <p class='m-0 ps-5'>+33</p>">
                                                </option>
                                                <option title="Швейцария" value="41" data-inner="<svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 32 32' xml:space='preserve'><path fill='#DA291C' d='M0,0v32h32V0H0z M26,19h-7v7h-6v-7H6v-6h7V6h6v7h7V19z'/></svg>
                                                        <p class='m-0 pe-21 flex-grow-1'>Швейцария</p>
                                                        <p class='m-0 ps-5'>+41</p>">
                                                </option>
                                                <option title="Катар" value="974" data-inner="<svg xmlns=' http://www.w3.org/2000/svg' viewBox='0 0 75 18' preserveAspectRatio='none'>
                                                            <path d='M0,0H75V18H0' fill='#8a1538' />
                                                            <path d='M22,18H0V0H22l6,1-6,1 6,1-6,1 6,1-6,1 6,1-6,1 6,1-6,1 6,1-6,1 6,1-6,1 6,1-6,1 6,1z' fill='#fff' />
                                                            </svg>
                                                            <p class='m-0 pe-21 flex-grow-1'>Катар</p>
                                                            <p class='m-0 ps-5'>+974</p>">
                                                </option>
                                            </select>
                                            <input oninput="telcodeUpdate(this)" type="tel" pattern="^[+()]*[0-9][- +()0-9]*$" class="form-control" id="mc-test-lesson-modal-tel">
                                            <label>Номер телефона</label>
                                        </div>
                                    </div>
                                    <!--Электропочта-->
                                    <div class="form-row">
                                        <div class="form-group mc-form-error">
                                            <input type="email" class="form-control" id="mc-test-lesson-modal-email" placeholder=" ">
                                            <label>Email</label>
                                            <div class="mc-form-message">
                                                <div class="exclamation">!</div>
                                                Пожалуйста, введите действительный электронный адрес
                                            </div>
                                        </div>
                                    </div>
                                    <!--Направление-->
                                    <!-- <div class="form-row">
                                    <div class="form-group col-12">
                                        <select class="form-select form-control" id="mc-test-lesson-modal-school" data-dselect-direction="dropup">
                                            <option value="" data-inner="Выберите направление"></option>
                                            <option value="1" data-inner="Музыка"></option>
                                            <option value="2" data-inner="Изобразительное искусство"></option>
                                            <option value="3" data-inner="Танцы"></option>
                                            <option value="4" data-inner="Йога"></option>
                                            <option value="4" data-inner="Логопед"></option>
                                            <option value="5" data-inner="Иностранные языки"></option>
                                            <option value="6" data-inner="Предметы средней школы"></option>
                                        </select>
                                    </div>
                                </div> -->
                                    <div class="mc-floating__label-select">
                                        <select>
                                            <option value=""></option>
                                            <option value="Музыкальное искусство">Музыкальное искусство</option>
                                            <option value="Изобразительное искусство">Изобразительное искусство</option>
                                            <option value="Хореография и йога">Хореография и йога</option>
                                            <option value="Логопед">Логопед</option>
                                            <option value="Иностранные языки">Иностранные языки</option>
                                            <option value="Предметы средней школы">Предметы средней школы</option>
                                        </select>
                                        <label>Направление</label>
                                    </div>
                                    <!--Предмет-->
                                    <!-- <div class="form-row">
                                    <div class="form-group col-12">
                                        <select class="form-select form-control" id="mc-test-lesson-modal-course" data-dselect-direction="dropup">
                                            <option value="" data-inner="Выберите курс"></option>
                                            <option value="1" data-inner="Фортепиано"></option>
                                            <option value="2" data-inner="Вокал"></option>
                                            <option value="3" data-inner="Классическая гитара"></option>
                                            <option value="4" data-inner="Электрогитара"></option>
                                            <option value="5" data-inner="Бас-гитара"></option>
                                            <option value="6" data-inner="Укулеле"></option>
                                            <option value="7" data-inner="Барабаны"></option>
                                            <option value="8" data-inner="Скрипка"></option>
                                            <option value="9" data-inner="Саксофон"></option>
                                            <option value="10" data-inner="Флейта"></option>
                                            <option value="11" data-inner="Блокфлейта"></option>
                                            <option value="12" data-inner="Виолончель"></option>
                                            <option value="13" data-inner="Раннее музыкальное развитие"></option>

                                        </select>
                                    </div>
                                </div> -->
                                    <div class="mc-floating__label-select">
                                        <select>
                                            <option value=""></option>
                                            <option value="Фортепиано">Фортепиано</option>
                                            <option value="Вокал">Вокал</option>
                                            <option value="Классическая гитара">Классическая гитара</option>
                                            <option value="Электрогитара">Электрогитара</option>
                                            <option value="Бас-гитара">Бас-гитара</option>
                                            <option value="Укулеле">Укулеле</option>
                                            <option value="Барабаны">Барабаны</option>
                                            <option value="Скрипка">Скрипка</option>
                                            <option value="Саксофон">Саксофон</option>
                                            <option value="Флейта">Флейта</option>
                                            <option value="Блокфлейта">Блокфлейта</option>
                                            <option value="Виолончель">Виолончель</option>
                                            <option value="Раннее музыкальное развитие">Раннее музыкальное развитие</option>
                                        </select>
                                        <label>Курс</label>
                                    </div>
                                    <!--Кнопка "Отправить"-->
                                    <div class="form-row py-1">
                                        <div class="col-12 d-flex justify-content-center">
                                            <a href="#mc-captcha-modal" class="btn mc-main-btn bld" data-bs-toggle="modal" role="button">Отправить</a>
                                            <!-- <button type="submit" class="btn mc-main-btn bld" aria-label="Отправить">Отправить</button> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--МОДАЛЬНОЕ ОКНО КАПЧИ-->
        <div class="modal mc-smart-back-modal fade" id="mc-captcha-modal" tabindex="-1" aria-labelledby="mc-captcha-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mc-modal-dialog-m-auto modal-md mx-auto">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="mc-captcha-modal__top">
                            <span class="mc-captcha-modal__top-title">Подтверждение действия</span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                        </div>
                        <div class="mc-captcha-modal__middle">
                            <img class="mc-captcha" src="images/captcha.jpg" alt="" width="304" height="75">
                        </div>
                        <div class="mc-captcha-modal__bottom">
                            <a href="#mc-send-error-modal" class="btn mc-main-btn mc-captcha-modal__bottom-btn" data-bs-toggle="modal" role="button">Отмена</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--МОДАЛЬНОЕ ОКНО ОШИБКИ СЕРВЕРА-->
        <div class="modal mc-smart-back-modal fade" id="mc-send-error-modal" tabindex="-1" aria-labelledby="mc-send-error-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mc-modal-dialog-m-auto modal-md mx-auto">
                <div class="modal-content">
                    <div class="modal-body d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <div class="mc-modal-triangle">
                                <img src="images/i-sign-2.svg" alt="">
                            </div>
                            <div class="mc-modal-text">
                                <div class="xbld">Ошибка отправки формы</div>
                                <div class="mc-modal-text__wrapper">Извините, наш сервер не отвечает</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="#mc-send-continue-modal" class="btn mc-main-btn bld" data-bs-toggle="modal" role="button">ОК</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--МОДАЛЬНОЕ ОКНО ОШИБКИ СЕРВЕРА-->
        <div class="modal mc-smart-back-modal fade" id="mc-send-continue-modal" tabindex="-1" aria-labelledby="mc-send-continue-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mc-modal-dialog-m-auto modal-md mx-auto">
                <div class="modal-content">
                    <div class="modal-body d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <div class="mc-modal-triangle">
                                <img src="images/i-sign-1.svg" alt="">
                            </div>
                            <div class="mc-modal-text">
                                <div class="xbld">Форма успешно отправлена</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="#" class="btn mc-main-btn bld">ОК</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
	$filePHP = "php/" . $app->pageName . ".php";
	if ( file_exists($filePHP) ) { include $filePHP; }
?>
<footer class="py-4 mt-3 mc-footer px-4 px-sm-42">
        <!--Футер-десктоп, планшет-->
        <div class="container-xxl mc-container-mw d-none d-lg-block">
            <div class="row mb-0 flex-grow-1">
                <!--Информация-->
                <div class="col-3 col-xl-2 pt-2">
                    <div>
                        <span class="d-block bld mb-3 text-uppercase">Студенту</span>
                        <ul class="list-unstyled mc-nav-col">
                            <li><a href="/courses">Направления и курсы</a></li>
                            <li><a href="#">Стать студентом</a></li>
                            <li><a href="/prices">Цены и оплата</a></li>
                            <li><a href="/gift-card">Подарочный сертификат</a></li>
                            <li><a href="/contacts">Контакты</a></li>
                        </ul>

                    </div>
                </div>
                <!--Главные-->
                <div class="col-3 col-xl-4 d-flex justify-content-xl-center pt-2">
                    <div>
                        <span class="d-block bld mb-3 text-uppercase">Монтессори Центр</span>
                        <ul class="list-unstyled mc-nav-col">
                            <li><a href="/about-us">О нас</a></li>
                            <li><a href="/about-maria-montessori">О Марии Монтессори</a></li>
                            <li><a href="/news">Новости</a></li>
                            <li><a href="/blog">Блог</a></li>
                            <li><a href="/reviews">Отзывы</a></li>
                            <li><a href="/stories">Успешные истории</a></li>
                        </ul>
                    </div>
                </div>
                <!--Договоры-->
                <div class="col-3 col-xl-4 d-flex justify-content-center pt-2">
                    <div>
                        <span class="d-block bld mb-3 text-uppercase">Договоры</span>
                        <ul class="list-unstyled mc-nav-col">
                            <li><a href="/offer">Публичная оферта</a></li>
                            <li><a href="/privacy">Политика конфиденциальности</a></li>
                            <li><a href="/terms">Условия предоставления услуг</a></li>
                            <li><a href="/garanty">Гарантия возврата денег</a></li>
                            <li><a href="/complaints">Порядок обработки жалоб</a></li>
                        </ul>
                    </div>
                </div>
                <!--Курсы-->
                <div class="col-3 col-xl-2 d-flex justify-content-end pt-2">
                    <div>
                        <span class="d-block bld mb-3 text-uppercase">Педагогу</span>
                        <ul class="list-unstyled mc-nav-col">
                            <li><a href="#">Стать членом команды</a></li>
                            <li><a href="/openings">Вакансии</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 d-none d-xl-flex flex-column align-items-center justify-content-center pt-2">
                    <!--Соцсети-->
                    <ul class="list-unstyled d-flex">
                        <li class="mb-2 pe-3">
                            <a href="#" aria-label="sometext">
                                <svg version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve" class="mc-smedia-button mc-smedia-ytb my-0 mx-0" width="28">
                                    <path class="mc-ytb-path-0" fill="none" stroke="#161616" d="M13.9,11.8l-2.7-1.3c-0.2-0.1-0.4,0-0.4,0.3v2.4c0,0.3,0.2,0.4,0.4,0.3l2.7-1.3
	C14.2,12.1,14.2,11.9,13.9,11.8z M12,0.5C5.6,0.5,0.5,5.6,0.5,12c0,6.4,5.2,11.5,11.5,11.5c6.4,0,11.5-5.2,11.5-11.5
	C23.5,5.6,18.4,0.5,12,0.5z M12,16.7c-5.9,0-6-0.5-6-4.7c0-4.1,0.1-4.7,6-4.7c5.9,0,6,0.5,6,4.7C18,16.1,17.9,16.7,12,16.7z" />
                                    <path class="mc-ytb-path-1" fill="#FF0200" d="M13.9,11.8l-2.7-1.3c-0.2-0.1-0.4,0-0.4,0.3v2.4c0,0.3,0.2,0.4,0.4,0.3l2.7-1.3
	C14.2,12.1,14.2,11.9,13.9,11.8z M12,0.5C5.6,0.5,0.5,5.6,0.5,12c0,6.4,5.2,11.5,11.5,11.5c6.4,0,11.5-5.2,11.5-11.5
	C23.5,5.6,18.4,0.5,12,0.5z M12,16.7c-5.9,0-6-0.5-6-4.7c0-4.1,0.1-4.7,6-4.7c5.9,0,6,0.5,6,4.7C18,16.1,17.9,16.7,12,16.7z" />
                                </svg>
                            </a>
                        </li>
                        <li class="mb-2 pe-3">
                            <a href="#" aria-label="sometext">
                                <svg version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 25 25" xml:space="preserve" class="mc-smedia-button mc-smedia-fb my-0 mx-0" width="28">
                                    <path class="mc-fb-path-0" fill="none" stroke="#161616" d="M15,12l-0.1,0 M14.9,12v-1.7c0-0.4,0.1-0.7,0.3-1c0.2-0.2,0.3-0.3,0.5-0.3
	c0.2-0.1,0.4-0.1,0.6-0.1h2V5l-0.4-0.1h-0.2L17,4.8c-0.6-0.1-1.3-0.1-1.9-0.1c-0.7,0-1.3,0.1-2,0.3c-0.6,0.2-1.2,0.6-1.7,1
	c-0.5,0.5-0.8,1.1-1.1,1.8c-0.2,0.7-0.3,1.4-0.3,2V12h-3v4.5h3l-0.1,7.2c-2.1-0.5-4.2-1.6-5.7-3.1c-1.5-1.5-2.6-3.5-3-5.6
	c-0.5-2.1-0.3-4.3,0.4-6.3c0.7-2,2-3.8,3.7-5.2c1.7-1.3,3.7-2.2,5.9-2.4c2.1-0.2,4.3,0.1,6.3,1.1c1.9,0.9,3.6,2.4,4.7,4.2
	c1.1,1.8,1.8,3.9,1.8,6.1c0,2.6-0.9,5.2-2.6,7.2c-1.7,2-4,3.5-6.5,4v-7.3h2.7l0.1-0.4l0.6-4H14.9z" />
                                    <path class="mc-fb-path-1" fill="#3A589F" d="M15,12l-0.1,0 M14.9,12v-1.7c0-0.4,0.1-0.7,0.3-1c0.2-0.2,0.3-0.3,0.5-0.3c0.2-0.1,0.4-0.1,0.6-0.1h2V5
	l-0.4-0.1h-0.2L17,4.8c-0.6-0.1-1.3-0.1-1.9-0.1c-0.7,0-1.3,0.1-2,0.3c-0.6,0.2-1.2,0.6-1.7,1c-0.5,0.5-0.8,1.1-1.1,1.8
	c-0.2,0.7-0.3,1.4-0.3,2V12h-3v4.5h3l-0.1,7.2c-2.1-0.5-4.2-1.6-5.7-3.1c-1.5-1.5-2.6-3.5-3-5.6c-0.5-2.1-0.3-4.3,0.4-6.3
	c0.7-2,2-3.8,3.7-5.2c1.7-1.3,3.7-2.2,5.9-2.4c2.1-0.2,4.3,0.1,6.3,1.1c1.9,0.9,3.6,2.4,4.7,4.2c1.1,1.8,1.8,3.9,1.8,6.1
	c0,2.6-0.9,5.2-2.6,7.2c-1.7,2-4,3.5-6.5,4v-7.3h2.7l0.1-0.4l0.6-4H14.9z" />
                                </svg>
                            </a>
                        </li>
                        <li class="mb-2 pe-3">
                            <a href="#" aria-label="sometext">
                                <svg version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 125.9 125.9" xml:space="preserve" class="mc-smedia-button mc-smedia-inst my-0 mx-0" width="28">
                                    <path class="mc-inst-path-0" fill="none" stroke="#161616" stroke-width="5.2501" d="M123.3,62.9c0,33.6-26.8,60.4-60.4,60.4S2.5,96.5,2.5,62.9
	S29.3,2.5,62.9,2.5S123.3,29.3,123.3,62.9z" />
                                    <g class="mc-inst-path-0">
                                        <path fill="#161616" d="M81.8,40.9c-2.1,0-3.7,2.1-3.7,3.7s2.1,3.7,3.7,3.7c2.1,0,3.7-2.1,3.7-3.7S83.9,40.9,81.8,40.9z" />
                                        <path fill="#161616" d="M77.6,27.8H48.2c-11.6,0-20.5,8.9-20.5,20.5v29.4c0,11.6,9.5,20.5,20.5,20.5h29.4
		c11.6,0,20.5-9.5,20.5-20.5V48.2C98.1,36.7,89.2,27.8,77.6,27.8z M92.9,48.2l-0.5,29.4l0,0c0,8.4-6.8,15.2-15.2,15.2H48.2
		C39.8,92.9,33,86,33,77.6V48.2C33,39.8,39.8,33,48.2,33h29.4C86,33,92.9,39.8,92.9,48.2z" />
                                        <path fill="#161616" d="M63.5,45.1h-0.5c-10,0-17.9,8.4-17.9,17.9s8.4,17.9,17.9,17.9h0.5c9.5,0,17.3-7.9,17.3-17.9
		S72.9,45.1,63.5,45.1z M62.9,50.9c6.3,0,12.1,5.3,12.1,12.1C75,69.2,69.8,75,62.9,75c-6.3,0-12.1-5.3-12.1-12.1
		C50.9,56.6,56.6,50.9,62.9,50.9z" />
                                    </g>
                                    <image class="mc-inst-path-1" width="274" height="274" xlink:href="images/2F08560A4E08E3.png" transform="matrix(0.48 0 0 0.48 -2.8342 -2.8342)">
                                    </image>
                                    <g class="mc-inst-path-1">
                                        <path fill="#FFFFFF" d="M81.8,40.9c-2.1,0-3.7,2.1-3.7,3.7s2.1,3.7,3.7,3.7c2.1,0,3.7-2.1,3.7-3.7S83.9,40.9,81.8,40.9z" />
                                        <path fill="#FFFFFF" d="M77.6,27.8H48.2c-11.6,0-20.5,8.9-20.5,20.5v29.4c0,11.6,9.5,20.5,20.5,20.5h29.4
		c11.6,0,20.5-9.5,20.5-20.5V48.2C98.1,36.7,89.2,27.8,77.6,27.8z M92.9,48.2l-0.5,29.4l0,0c0,8.4-6.8,15.2-15.2,15.2H48.2
		C39.8,92.9,33,86,33,77.6V48.2C33,39.8,39.8,33,48.2,33h29.4C86,33,92.9,39.8,92.9,48.2z" />
                                        <path fill="#FFFFFF" d="M63.5,45.1h-0.5c-10,0-17.9,8.4-17.9,17.9s8.4,17.9,17.9,17.9h0.5c9.5,0,17.3-7.9,17.3-17.9
		S72.9,45.1,63.5,45.1z M62.9,50.9c6.3,0,12.1,5.3,12.1,12.1C75,69.2,69.8,75,62.9,75c-6.3,0-12.1-5.3-12.1-12.1
		C50.9,56.6,56.6,50.9,62.9,50.9z" />
                                    </g>
                                </svg>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" aria-label="sometext">
                                <svg version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve" class="mc-smedia-button mc-smedia-tg my-0 mx-0" width="28">
                                    <path class="mc-tg-path-0" fill="none" stroke="#161616" d="M0.5,12C0.5,5.6,5.6,0.5,12,0.5c6.4,0,11.5,5.1,11.5,11.5c0,6.4-5.1,11.5-11.5,11.5
	C5.6,23.5,0.5,18.4,0.5,12z" />
                                    <path class="mc-tg-path-0" fill="none" stroke="#161616" d="M15.7,17.7c0,0-0.3,0.7-1.2,0.4l-4.9-3.8l-1.8-0.9l-3-1c0,0-0.5-0.2-0.5-0.5
	c0-0.4,0.5-0.6,0.5-0.6l12-4.7c0,0,1-0.4,1,0.3L15.7,17.7z" />
                                    <path class="mc-tg-path-0" fill="none" stroke="#161616" d="M9.6,14.3l5.7-5.2c0.2-0.2,0.2-0.3,0.2-0.3c0-0.3-0.4,0-0.4,0l-7.3,4.6c0,0,0.9,3,1.1,3.6
	c0.2,0.6,0.3,0.6,0.3,0.6c0.2,0.1,0.3,0,0.3,0l2-1.8L9.6,14.3z" />
                                    <path class="mc-tg-path-1" fill="#059BE5" d="M0.5,12C0.5,5.6,5.6,0.5,12,0.5S23.5,5.6,23.5,12S18.4,23.5,12,23.5S0.5,18.4,0.5,12z" />
                                    <path class="mc-tg-path-1" fill="#FFFFFF" d="M16.8,6.6l-12,4.7c0,0-0.5,0.2-0.5,0.6c0,0.3,0.5,0.5,0.5,0.5l3,1l7.3-4.6c0,0,0.4-0.3,0.4,0
	c0,0,0,0.1-0.2,0.3l-5.7,5.2l0,0c0,0-0.5,2-0.6,2.6c0,0.2-0.1,0.4,0,0.6c0.1,0.1,0.2,0.2,0.4,0.1c0.2-0.1,0.4-0.3,0.5-0.4
	c0.4-0.3,0.7-0.7,1.1-1c0,0,0.3-0.3,0.5-0.4l3,2.3c0.9,0.3,1.2-0.4,1.2-0.4l2.1-10.8C17.8,6.2,16.8,6.6,16.8,6.6z" />
                                    <path class="mc-tg-path-1" fill="#059BE5" d="M11.5,15.8" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <!---Копирайт-->
                    <ul class="list-unstyled small mc-half-transparent-text mb-0">
                        <li class="mc-copyright">Montessori Center International Online School © 2011 - $$$$</li>
                    </ul>
                </div>
            </div>
            <!--Копирайт - планшет-->
            <div class="row">
                <div class="col-12 d-block d-xl-none text-center mc-half-transparent-text mc-copyright">Montessori Center International Online School © 2011 - $$$$</div>
            </div>
        </div>
        <!--Футер-моб.-->
        <div class="d-flex flex-column d-lg-none">
            <!-- <div class="row">
            <div class="col-12 px-2">
                <picture>
                    <source class="mb-3" type="image/webp" srcset="images/logo-old.webp" height="39" width="184">
                    <img class="mb-3" src="images/logo-old.png" alt="" height="39" width="184">
                </picture>
            </div>
        </div> -->
            <div class="row">
                <div class="col-12">
                    <div class="accordion accordion-flush mc-unstyled-url-list mc-mobile-accordion mc-mobile-accordion-footer" id="mc-mobile-footer-main-accordion">
                        <!--Аккордеон - информация-->
                        <div class="accordion-item mc-mobile-footer-item pb-2">
                            <h1 class="accordion-header" id="mc-mobile-footer-center">
                                <button class="accordion-button collapsed pt-3 pb-2 px-2 bld" type="button" data-bs-toggle="collapse" data-bs-target="#mc-mobile-footer-center-collapse" aria-expanded="false" aria-controls="mc-mobile-footer-center-collapse" aria-label="Информация">
                                    Студенту
                                </button>
                            </h1>
                            <div id="mc-mobile-footer-center-collapse" class="accordion-collapse collapse" aria-labelledby="mc-mobile-footer-center" data-bs-parent="#mc-mobile-footer-main-accordion">
                                <div class="accordion-body py-0 px-2 bld">
                                    <ul class="list-unstyled m-0 mc-mobile-sandwich-list mc-unstyled-url-list">
                                        <a href="/courses">
                                            <li class="bld my-3">Направления и курсы</li>
                                        </a>
                                        <a href="#">
                                            <li class="bld my-3">Стать студентом</li>
                                        </a>
                                        <a href="/prices">
                                            <li class="bld my-3">Цены и оплата</li>
                                        </a>
                                        <a href="/gift-card">
                                            <li class="bld my-3">Подарочный сертификат</li>
                                        </a>
                                        <a href="/contacts">
                                            <li class="bld my-3">Контакты</li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--Аккордеон - главная-->
                        <div class="accordion-item mc-mobile-footer-item pb-2">
                            <h1 class="accordion-header" id="mc-mobile-footer-montecenter">
                                <button class="accordion-button collapsed pt-3 pb-2 px-2 bld" type="button" data-bs-toggle="collapse" data-bs-target="#mc-mobile-footer-montecenter-collapse" aria-expanded="false" aria-controls="mc-mobile-footer-montecenter-collapse" aria-label="Информация">
                                    Монтессори центр
                                </button>
                            </h1>
                            <div id="mc-mobile-footer-montecenter-collapse" class="accordion-collapse collapse" aria-labelledby="mc-mobile-footer-montecenter" data-bs-parent="#mc-mobile-footer-main-accordion">
                                <div class="accordion-body py-0 px-2 bld">
                                    <ul class="list-unstyled m-0 mc-mobile-sandwich-list mc-unstyled-url-list">
                                        <a href="/about-us">
                                            <li class="bld my-3">О нас</li>
                                        </a>
                                        <a href="/about-maria-montessori">
                                            <li class="bld my-3">О Марии Монтессори</li>
                                        </a>
                                        <a href="/news">
                                            <li class="bld my-3">Новости</li>
                                        </a>
                                        <a href="/blog">
                                            <li class="bld my-3">Блог</li>
                                        </a>
                                        <a href="/reviews">
                                            <li class="bld my-3">Отзывы</li>
                                        </a>
                                        <a href="/stories">
                                            <li class="bld my-3">Успешные истории</li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--Аккордеон - Договоры-->
                        <div class="accordion-item mc-mobile-footer-item pb-2">
                            <h1 class="accordion-header" id="mc-mobile-footer-treaties">
                                <button class="accordion-button collapsed pt-3 pb-2 px-2 bld" type="button" data-bs-toggle="collapse" data-bs-target="#mc-mobile-footer-treaties-collapse" aria-expanded="false" aria-controls="mc-mobile-footer-treaties-collapse" aria-label="Договоры">
                                    Договоры
                                </button>
                            </h1>
                            <div id="mc-mobile-footer-treaties-collapse" class="accordion-collapse collapse" aria-labelledby="mc-mobile-footer-treaties" data-bs-parent="#mc-mobile-footer-main-accordion">
                                <div class="accordion-body py-0 px-2 bld">
                                    <ul class="list-unstyled m-0 mc-mobile-sandwich-list mc-unstyled-url-list">
                                        <a href="/offer">
                                            <li class="bld my-3">Публичная оферта</li>
                                        </a>
                                        <a href="/privacy">
                                            <li class="bld my-3">Политика конфиденциальности</li>
                                        </a>
                                        <a href="/terms">
                                            <li class="bld my-3">Условия предоставления услуг</li>
                                        </a>
                                        <a href="/garanty">
                                            <li class="bld my-3">Гарантия возврата денег</li>
                                        </a>
                                        <a href="/complaints">
                                            <li class="bld my-3">Порядок обработки жалоб</li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--Аккордеон - Курсы-->
                        <div class="accordion-item mc-mobile-footer-item pb-2">
                            <h1 class="accordion-header" id="mc-mobile-footer-coursers">
                                <button class="accordion-button collapsed pt-3 pb-2 px-2 bld" type="button" data-bs-toggle="collapse" data-bs-target="#mc-mobile-footer-coursers-collapse" aria-expanded="false" aria-controls="mc-mobile-footer-coursers-collapse" aria-label="Договоры">
                                    Педагогу
                                </button>
                            </h1>
                            <div id="mc-mobile-footer-coursers-collapse" class="accordion-collapse collapse" aria-labelledby="mc-mobile-footer-coursers" data-bs-parent="#mc-mobile-footer-main-accordion">
                                <div class="accordion-body py-0 px-2 bld">
                                    <ul class="list-unstyled m-0 mc-mobile-sandwich-list mc-unstyled-url-list">
                                        <a href="#">
                                            <li class="bld my-3">Стать членом команды</li>
                                        </a>
                                        <a href="/openings">
                                            <li class="bld my-3">Вакансии</li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Соцсети-->
            <div class="row">
                <div class="col-12 px-2 pt-4 pb-3">
                    <ul class="list-unstyled d-flex mb-0">
                        <li class="mb-2 pe-3">
                            <a href="#" aria-label="sometext">
                                <img class="mc-footer-mobile-social-img" src="images/i-yt-footer.svg" alt="" width="28" height="28">
                            </a>
                        </li>
                        <li class="mb-2 pe-3">
                            <a href="#" aria-label="sometext">
                                <img class="mc-footer-mobile-social-img" src="images/i-facebook-footer.svg" width="28" height="28" alt="">
                            </a>
                        </li>
                        <li class="mb-2 pe-3">
                            <a href="#" aria-label="sometext">
                                <img class="mc-footer-mobile-social-img" src="images/i-instagram-footer.png" width="28" height="28" alt="">
                            </a>
                        </li>
                        <li class="mb-2 pe-3">
                            <a href="#" aria-label="sometext">
                                <img class="mc-footer-mobile-social-img" src="images/i-tg-footer.svg" alt="" width="28" height="28">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--Копирайт-->
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled small mc-half-transparent-text text-center mb-0">
                        <li class="mb-2 mc-copyright">MCIOS © 2011 - $$$$</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <button type="button" class="d-none d-sm-block btn position-fixed rounded-circle" onclick="topFunction()" id="mc-top-btn" title="" aria-label="Прокрутка страницы вверх"></button>
    <!--<script src="js/app.js?v=<?=$version?>"></script>-->
    <script src="libs/jquery.min.js?v=<?=$version?>"></script>
    <script src="libs/resizeSencor.js?v=<?=$version?>"></script>
    <script src="libs/sticky-sidebar.js?v=<?=$version?>"></script>
    <script defer src="libs/bootstrap.bundle.min.js?v=<?=$version?>"></script>
    <script src="libs/keen-slider.min.js?v=<?=$version?>"></script>
    <script src="js/swiper-course.js?v=<?=$version?>"></script>
    <script src="libs/dselect.js?v=<?=$version?>"></script>
    <script src="libs/intlTelInput.min.js"></script>
    <script>
        //Показываем страницу после загрузки шрифтов
        document.fonts.ready.then(() => {
            document.getElementsByTagName("body")[0].style.visibility = "visible";
        });

    </script>
    <script>
        //Задаём фиксированную высоту выбранным модальным окнам (где есть поля ввода), чтобы открытие клавиатуры не уменьшало viewport на некоторых мобильных браузерах и не сдивгало элементы внутри/
        const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
        const vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
        var heightWidth380 = document.querySelectorAll('.mc-smart-viewport-modal');
        heightWidth380.forEach(function(element) {
            document.querySelector('style').textContent += "@media (max-width: 380px) { #" + element.getAttribute("id") + " .modal-content {height: " + (parseInt(vh) + 240).toString() + "px !important; padding: 120px 0; margin-top: -120px;}}"
        });

    </script>
    <script>
        //Плавный скролл для ссылок внутри страниц
        var scrollSmoothly = document.querySelectorAll('.mc-smooth-scroll');
        scrollSmoothly.forEach(function(btn) {
            btn.addEventListener('click', function() {
                let scrollToElement = btn.getAttribute('data-mc-scroll-to')
                const yOffset = -100;
                let element = document.querySelector(scrollToElement);
                let y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
                window.scrollTo({
                    top: y,
                    behavior: 'smooth'
                });
            });
        });

    </script>
    <script>
        //Бутстрап-тултипы
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

    </script>
    <script>
        //Кнопка прокрутки страницы вверх
        let topbutton = document.getElementById("mc-top-btn");

        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 700 || document.documentElement.scrollTop > 700) {
                topbutton.style.opacity = "0.35";
                topbutton.style.visibility = "visible";
            } else {
                topbutton.style.opacity = "0";
                topbutton.style.visibility = "hidden";
            }
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

    </script>
    <script>
        //Инициализация селектов хеадера-футера, библиотека d-select
        dselect(document.querySelector('#mc-select-header-lang'))
        dselect(document.querySelector('#mc-select-mobile-lang'))
        dselect(document.querySelector('#mc-test-lesson-modal-telcode'), {
            maxHeight: '312px'
        })
        // dselect(document.querySelector('#mc-test-lesson-modal-school'), {
        //     maxHeight: '318px'
        // })
        // dselect(document.querySelector('#mc-test-lesson-modal-course'), {
        //     maxHeight: '400px'
        // })

    </script>
    <script>
        //Комплексный скрипт обслуживания селекта телефонных кодов Пробного урока

        //Функция на выбор нового телефонного кода (вводим телефонный код в поле ввода номера)
        function telcodeChange(element) {
            var telcodeInput = element.nextElementSibling.nextElementSibling;
            var newSelectedTelecode = element.options[element.selectedIndex].value
            if (newSelectedTelecode != 'notfound') {
                telcodeInput.value = '+' + newSelectedTelecode;
            }
            telcodeInput.focus();
        }

        window.addEventListener("load", function autoUpdateTelcode() {
            var allComplexSelectBoxes = document.querySelectorAll('.mc-complex-form-group');
            allComplexSelectBoxes.forEach(function(complex) {
                //Автоматическое установление телефонного кода в поле ввода, при загрузке страницы
                let select = complex.querySelector('select');
                let input = complex.querySelector('input');
                input.value = "+" + select.value;

                //Не даём возможность поставить курсор внутри телефонного кода или перед ним (запрет на редактирование)
                input.addEventListener("mouseup", function(e) {
                    if (((this.selectionEnd - 0) * (this.selectionEnd - select.value.length)) <= 0) {
                        this.setSelectionRange(select.value.length + 1, select.value.length + 1);
                        this.focus();
                    };
                });

                //Блокируем нажатия кнопок "влево" и "вверх" для переноса каретки назад или в начало строки телефонного кода (запрет на редактирование)
                input.addEventListener('keydown', function(e) {
                    if (e.keyCode == 37) {
                        if (((this.selectionEnd - 0) * (this.selectionEnd - select.value.length - 1)) <= 0) {
                            e.preventDefault();
                        };
                    };
                    if (e.keyCode == 38) {
                        e.preventDefault();
                    };
                });
            });
        });

        function telcodeUpdate(element) {
            //Общий запрет на редактирование телефонного кода (функционально запрещает backspace)
            var siblingSelectBox = element.previousElementSibling.previousElementSibling
            if (!element.value.startsWith("+" + siblingSelectBox.value)) {
                element.value = "+" + siblingSelectBox.value + element.value.slice(siblingSelectBox.value.length);
                element.setSelectionRange(siblingSelectBox.value.length + 1, siblingSelectBox.value.length + 1);
                element.focus();
            };

        }
        window.addEventListener("load", function telcodeSVGStroke() {
            //Добавляем всем svg-флагам чудо-рамочку внутри тега svg.
            var teldodeSVGs = document.querySelectorAll(".mc-complex-dselect-telcode option");
            teldodeSVGs.forEach(function(teldodeSVG) {
                let telcodeOptionInner = teldodeSVG.getAttribute("data-inner");
                let svgViewportWidth = telcodeOptionInner.split("viewBox='")[1].split("'")[0].split(" ")[2]
                let svgViewportHeight = telcodeOptionInner.split("viewBox='")[1].split("'")[0].split(" ")[3]
                teldodeSVG.setAttribute("data-inner", telcodeOptionInner.split("</svg>")[0] + "<rect style='stroke-width: " + Number(svgViewportHeight) / 20 + "px' class='mc-telcode-svg-stroke' fill='none' width='" + svgViewportWidth + "' height='" + svgViewportHeight + "'/>" + "</svg>" + telcodeOptionInner.split("</svg>")[1])
            });
            var activeTeldodeSVG = document.querySelector(".mc-complex-dselect-telcode button svg");
            var activeSVGViewportWidth = activeTeldodeSVG.getAttribute("viewBox").split(" ")[2]
            var activeSVGViewportHeight = activeTeldodeSVG.getAttribute("viewBox").split(" ")[3]
            activeTeldodeSVG.innerHTML += "<rect style='stroke-width: " + Number(activeSVGViewportHeight) / 20 + "px' class='mc-telcode-svg-stroke' fill='none' width='" + activeSVGViewportWidth + "' height='" + activeSVGViewportHeight + "'/>"
        });

    </script>
    <script>
        //Доп. функционал выпадающим окнам бутстрапа - возможность их триггера дистанционно, включая изнутри другого вып. окна
        window.addEventListener("load", function remoteDropdowns() {
            var dropdownRemoteToggles = document.querySelectorAll('a[data-trigger-dropdown="true"]')

            dropdownRemoteToggles.forEach(function(dropdownTog) {
                dropdownTog.addEventListener("click", function(e) {
                    let dropdownToToggle = document.querySelector(dropdownTog.getAttribute("data-dropdown-toggle-id"));
                    e.stopPropagation();
                    dropdownToToggle.click();
                });
            });
        });

    </script>
    <script>
        window.addEventListener("load", function dselectFocus() {
            //Добавляем необходимые классы селектам d-select, для простой стилизации
            var dSelectWrappers = document.querySelectorAll(".dselect-wrapper");
            dSelectWrappers.forEach(function(dSelectWrapper) {
                dSelectWrapper.firstElementChild.addEventListener("shown.bs.dropdown", function(e) {
                    dSelectWrapper.classList.add("active");
                });
                dSelectWrapper.firstElementChild.addEventListener("hidden.bs.dropdown", function(e) {
                    if (!dSelectWrapper.classList.contains("mc-complex-dselect")) {
                        dSelectWrapper.classList.remove("active");
                    } else {
                        if (!dSelectWrapper.nextElementSibling.classList.contains("focused")) {
                            dSelectWrapper.classList.remove("active");
                        };
                    };
                });
                dSelectWrapper.previousElementSibling.addEventListener("change", function(e) {
                    let newActiveDSelectOption = dSelectWrapper.querySelector(".dropdown-item.active")
                    dSelectWrapper.firstElementChild.title = newActiveDSelectOption.title;
                });
            });
            //Классы для комплексных селектов
            var dSelectComplexWrappers = document.querySelectorAll(".mc-complex-dselect");
            dSelectComplexWrappers.forEach(function(dSelectComplexWrapper) {
                dSelectComplexWrapper.nextElementSibling.addEventListener("focus", function(e) {
                    dSelectComplexWrapper.classList.add("active");
                    dSelectComplexWrapper.nextElementSibling.classList.add("focused");
                });
                dSelectComplexWrapper.nextElementSibling.addEventListener("blur", function(e) {
                    dSelectComplexWrapper.classList.remove("active");
                    dSelectComplexWrapper.nextElementSibling.classList.remove("focused");
                });
            });
            //Классы для селекта языков хеадера (инд. подход)
            var dSelectNavbarDropdowns = document.querySelectorAll(".mc-navbar-grey-dselect");
            dSelectNavbarDropdowns.forEach(function(dSelectNavbarDropdown) {
                dSelectNavbarDropdown.addEventListener("mouseover", function(e) {
                    if (event.currentTarget == event.target || event.currentTarget.firstElementChild == event.target) {
                        dSelectNavbarDropdown.classList.add("mc-navbar-grey-hover-dselect");
                    }

                });
                dSelectNavbarDropdown.addEventListener("mouseout", function(e) {
                    if (event.currentTarget == event.target || event.currentTarget.firstElementChild == event.target) {
                        dSelectNavbarDropdown.classList.remove("mc-navbar-grey-hover-dselect");
                    }

                });
            });
        });

    </script>
    <script>
        //Скрипт для логирования открытий-закрытий модальных окон, чтобы их можно было бы закрыть кнопкой Back, особенно на мобильных устройствах (удобство пользователя). Иначе кнопка Back отправляет на пред. страницу или вовсе закрывает браузер.
        var $ = jQuery.noConflict();
        var $modal = $('.mc-smart-back-modal');
        var $log = $("#log");

        function log(msg) {
            $log.append("<p>" + msg + " / History.state=" + JSON.stringify(window.history.state) + ", size=" + window.history.length + "</p>");
        };

        function historyListener(event, modalw) {
            log("History pop");
            $modal.modal('hide');
        }

        log("Ready!");

        $modal.each(function(index) {
            $(this).on('shown.bs.modal', function(event) {
                log("Modal visible");

                $(this).attr('aria-hidden', false);
                window.history.pushState($(this).attr("id"), "Modal title", document.location);
                log("Pushed state");

                window.addEventListener('popstate', historyListener, false);

                setTimeout(function() {
                    $(this).focus();
                    $('#debug').text(document.activeElement.id);
                    log("Focus on " + document.activeElement.id);
                }, 1);
            });
        });

        $modal.each(function(index) {
            $(this).on('hidden.bs.modal', function(event) {
                log("Modal hidden");

                $(this).attr('aria-hidden', true);

                if (window.history.state === $(this).attr("id")) {
                    history.go(-1);
                    log("Poped state");
                }

                window.removeEventListener('popstate', historyListener);
            });
        });

    </script>
    <script>
        //Выставление актуального года в копирайтах)
        var copyrightElements = document.querySelectorAll(".mc-copyright")
        copyrightElements.forEach(function(copyrightElement) {
            copyrightElement.innerHTML = copyrightElement.innerHTML.replace("$$$$", new Date().getFullYear());
        })

    </script>
    <script>
            //Если контент открываемого аккордеона не влазит в экран, инициируется скролл, до момента, пока нижняя грань контента аккордеона не состыкуется с нижней гранью экрана пользователя (scrollIntoView(false))
            var accordionElements = document.querySelectorAll('.accordion-collapse')
            accordionElements.forEach(function(accordionElement) {

                parentPadding = parseFloat(window.getComputedStyle(accordionElement.parentElement).getPropertyValue('padding-bottom').replace('px', ''));
                parentMargin = parseFloat(window.getComputedStyle(accordionElement.parentElement).getPropertyValue('margin-bottom').replace('px', ''));
                selfPadding = parseFloat(window.getComputedStyle(accordionElement.parentElement).getPropertyValue('padding-bottom').replace('px', ''));
                selfMargin = parseFloat(window.getComputedStyle(accordionElement.parentElement).getPropertyValue('margin-bottom').replace('px', ''));
                fullOffset = parentPadding + parentMargin + selfPadding + selfMargin;
                accordionElement.style.cssText += "scroll-margin: "+fullOffset+"px"

                accordionElement.addEventListener('shown.bs.collapse', function(e) {
                    let accordionButton = accordionElement.previousElementSibling.firstElementChild;
                    let bottomSpace = window.innerHeight - (accordionElement.getBoundingClientRect().top + accordionElement.getBoundingClientRect().height)
                    if (bottomSpace < 0) {
                        if (window.innerHeight < accordionElement.offsetHeight) {
                            accordionButton.scrollIntoView({
                                behavior: 'smooth'
                            });
                        } else {
                            accordionElement.scrollIntoView(false, {
                                behavior: 'smooth'
                            });
                        };
                    };
                });
            });

        </script>
        <script>
            // Переключение пунктов меню
            function showList(listId) {
                // Скрываем все списки
                var lists = document.getElementsByClassName('mc-sandwich-courses__list');
                for (var i = 0; i < lists.length; i++) {
                    lists[i].style.display = 'none';
                }

                // Удаляем класс "active" у всех кнопок
                var buttons = document.getElementsByTagName('a');
                for (var i = 0; i < buttons.length; i++) {
                    buttons[i].classList.remove('active');
                }

                // Отображаем выбранный список
                var selectedList = document.getElementById(listId);
                if (selectedList) {
                    selectedList.style.display = 'flex';
                }

                // Добавляем класс "active" к нажатой кнопке
                var selectedButton = document.querySelector('a[href="#"][onclick="showList(\'' + listId + '\'); return false;"]');
                if (selectedButton) {
                    selectedButton.classList.add('active');
                }
            }
        </script>
        <script>
            var x, i, j, l, ll, selElmnt, a, b, c;
            /*look for any elements with the class "mc-floating__label-select":*/
            x = document.getElementsByClassName("mc-floating__label-select");
            l = x.length;
            for (i = 0; i < l; i++) {
                selElmnt = x[i].getElementsByTagName("select")[0];
                ll = selElmnt.length;
                /*for each element, create a new DIV that will act as the selected item:*/
                a = document.createElement("DIV");
                a.setAttribute("class", "select-selected");
                a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
                x[i].appendChild(a);
                /*for each element, create a new DIV that will contain the option list:*/
                b = document.createElement("DIV");
                b.setAttribute("class", "select-items select-hide");
                for (j = 1; j < ll; j++) {
                    /*for each option in the original select element,
                    create a new DIV that will act as an option item:*/
                    c = document.createElement("DIV");
                    c.innerHTML = selElmnt.options[j].innerHTML;
                    c.addEventListener("click", function (e) {
                        /*when an item is clicked, update the original select box,
                        and the selected item:*/
                        var y, i, k, s, h, sl, yl;
                        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                        sl = s.length;
                        h = this.parentNode.previousSibling;
                        for (i = 0; i < sl; i++) {
                            if (s.options[i].innerHTML == this.innerHTML) {
                                s.selectedIndex = i;
                                h.innerHTML = this.innerHTML;
                                y = this.parentNode.getElementsByClassName("same-as-selected");
                                yl = y.length;
                                for (k = 0; k < yl; k++) {
                                    y[k].removeAttribute("class");
                                }
                                this.setAttribute("class", "same-as-selected");
                                s.classList.add("mc-selected");
                                break;
                            }
                        }
                        h.click();
                    });
                    b.appendChild(c);
                }
                x[i].appendChild(b);
                a.addEventListener("click", function (e) {
                    /*when the select box is clicked, close any other select boxes,
                    and open/close the current select box:*/
                    e.stopPropagation();
                    closeAllSelect(this);
                    this.nextSibling.classList.toggle("select-hide");
                    this.classList.toggle("select-arrow-active");
                });
            }
            function closeAllSelect(elmnt) {
                /*a function that will close all select boxes in the document,
                except the current select box:*/
                var test, x, y, i, xl, yl, arrNo = [];
                test = document.getElementsByClassName("mc-floating__label-select");
                x = document.getElementsByClassName("select-items");
                y = document.getElementsByClassName("select-selected");
                xl = x.length;
                yl = y.length;
                for (i = 0; i < yl; i++) {
                    if (elmnt == y[i]) {
                        arrNo.push(i)
                    } else {
                        y[i].classList.remove("select-arrow-active");
                    }
                }
                for (i = 0; i < xl; i++) {
                    if (arrNo.indexOf(i)) {
                        x[i].classList.add("select-hide");
                    }
                }
            }
            /*if the user clicks anywhere outside the select box,
            then close all select boxes:*/
            document.addEventListener("click", closeAllSelect);
        </script>
        <script>
            var input = document.querySelector("#phonecode");
            window.intlTelInput(input, {
                utilsScript: "libs/utils.js"
            });
        </script>
        <script>
            var modalElement = document.getElementById('mc-mobile-courses-modal');
            var accordionElement = document.getElementById('mc-mobile-courses-main-accordion');

            // Обработчик события закрытия аккордеона
            accordionElement.addEventListener('hidden.bs.collapse', function (event) {
              // Прокручиваем модальное окно к верху
              modalElement.scrollTop = 0;
            });
          </script>
        <?php
        	// Подключение JS страниц
        	$fileJS = "js/" . $app->pageName . ".js";
        	if ( file_exists($fileJS) ) {
        ?>
            <script src="/<?=$fileJS?>?v=<?=$version?>"></script>
            <?php
        	}
        ?>
</body>

</html>
