<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="/assets/img/super-gonka.jpg" />
    <!--=== Favicon ===-->
    <link rel="SHORTCUT ICON" type="image/png" href="/assets/img/favicon.png">

    <title>Super-Gonka | {!TITLE!}</title>

    <!--=== Bootstrap CSS ===-->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!--=== Slicknav CSS ===-->
    <link href="/assets/css/plugins/slicknav.min.css" rel="stylesheet">
    <!--=== Magnific Popup CSS ===-->
    <link href="/assets/css/plugins/magnific-popup.css" rel="stylesheet">
    <!--=== Owl Carousel CSS ===-->
    <link href="/assets/css/plugins/owl.carousel.min.css" rel="stylesheet">
    <!--=== Gijgo CSS ===-->
    <link href="/assets/css/plugins/gijgo.css" rel="stylesheet">
    <!--=== FontAwesome CSS ===-->
    <link href="/assets/css/font-awesome.css" rel="stylesheet">
    <!--=== Theme Reset CSS ===-->
    <link href="/assets/css/reset.css" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="/assets/style/style.css" rel="stylesheet">
    <!--=== Responsive CSS ===-->
    <link href="/assets/css/responsive.css" rel="stylesheet">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>





<body>

    <!--== Header Area Start ==-->
    <header id="header-area" class="fixed-top">
        <!--== Header Top Start ==-->
        <div id="header-top" class="d-none d-xl-block">
            <div class="container">
                <div class="row">
                    <!--== Social Icons Start ==-->
                    <div class="col-lg-12 text-right">
                        <div class="header-social-icons">
                            <a href="https://vk.com/" target="_blank"><i class="fa fa-vk"></i></a>
                        </div>
                    </div>
                    <!--== Social Icons End ==-->
                </div>
            </div>
        </div>
        <!--== Header Top End ==-->

        <!--== Header Bottom Start ==-->
        <div id="header-bottom">
            <div class="container">
                <div class="row">
                    <!--== Logo Start ==-->
                    <div class="col-lg-4">
                        <a href="/" class="logo">
                            <img src="/assets/img/super-gonka.svg" alt="Super-Gonka">
                        </a>
                    </div>
                    <!--== Logo End ==-->

                    <!--== Main Menu Start ==-->
                    <div class="col-lg-8 d-none d-xl-block">
                        <nav class="mainmenu align_right">
                            <ul>
                                <li><a href="/">Главная</a></li>
                                <li><a href="#"><span class="fa fa-align-center fa-lg"></span></a>
                                    <ul>
                                        <li><a href="/help.html">Помощь</a></li>
                                        <li><a href="/rules.html">Правила</a></li>
                                    </ul>
                                </li>
                                <li><a href="/about.html">F.A.Q</a></li>
                                <li><a href="/payments">Статистика</a></li>
                                <li><a href="/competition">Конкурсы</a></li>
                                <li><a href="/contacts.html">Контакты</a></li>
									<?php if(isset($_SESSION["user"])){?>
								                                <li><a href="/account.html"><span class="fa fa-unlock-alt fa-lg"></span>&nbsp;Кабинет</a></li>
																	<?php } else { ?>
                                                                <li><a href="/login.html"><span class="fa fa-key fa-lg"></span>&nbsp;Войти</a></li>
																<?php } ?>
                                                            </ul>
                        </nav>
                    </div>
                    <!--== Main Menu End ==-->
                </div>
            </div>
        </div>
        <!--== Header Bottom End ==-->
    </header>