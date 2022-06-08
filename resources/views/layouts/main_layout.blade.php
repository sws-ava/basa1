<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="index">
    <link rel="icon" href="/images/favi_.png?ver=1.0.2" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/admin/plugins/select2/css/select2.css">

    <link rel="stylesheet" type="text/css" href="https://mreq.github.io/slick-lightbox/dist/slick-lightbox.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css">
    <link rel="stylesheet" type="text/css"
        href="https://mreq.github.io/slick-lightbox/gh-pages/bower_components/slick-carousel/slick/slick-theme.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;500&family=Roboto&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/template.css">
    <link rel="stylesheet" href="/css/company_page.css">
    <title> @yield('title') - 7/89</title>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(
                k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(53896621, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/53896621" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
</head>

<body>
    <div class="wrapper">
        <div class="mobileMenuHolder">
            <div class="mobileMenu">
                <div class="closeMobileMenu offcanvas-toggler">
                    <div class="togglerHolder"></div>
                </div>
                <div class="menuItems">
                    <div class="" id="accordionFlushExample">
                        <div class="accItem">
                            <div class="headLinkHolder" id="flush-headingOne">
                                <a class="subMenuMainLink" href="https://www.789.ru/association.html"> Об Ассоциации</a>
                                <div class="accOpen collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='#fff'>
                                        <path fill-rule='evenodd'
                                            d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z' />
                                    </svg>
                                </div>

                            </div>
                            <div id="flush-collapseOne" class="collapse" aria-labelledby="flush-headingOne"
                                data-bs-parent="#accordionFlushExample">
                                <div class="">
                                    <a class="subMenuLink" href="https://www.789.ru/association/goals.html"> Цели
                                        Ассоциации</a>
                                    <a class="subMenuLink" href="https://www.789.ru/association/management.html">
                                        Управление в
                                        Ассоциации</a>
                                    <a class="subMenuLink" href="https://www.789.ru/association/kak-vstupit.html">
                                        Как вступить</a>
                                    <a class="subMenuLink"
                                        href="https://www.789.ru/association/preimushchestva-chlenstva.html">
                                        Преимущества членства</a>
                                </div>
                            </div>
                        </div>
                        <div class="accItem">
                            <div class="headLinkHolder" id="flush-heading2">
                                <a class="subMenuMainLink" href="https://www.789.ru/members.html"> Участники</a>
                                <div class="accOpen collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse2" aria-expanded="false"
                                    aria-controls="flush-collapse2">
                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='#fff'>
                                        <path fill-rule='evenodd'
                                            d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z' />
                                    </svg>
                                </div>

                            </div>
                            <div id="flush-collapse2" class="collapse" aria-labelledby="flush-heading2"
                                data-bs-parent="#accordionFlushExample">
                                <div class="">
                                    <a class="subMenuLink" href="https://www.789.ru/members.html">
                                        Компании-участники</a>
                                    <a class="subMenuLink" href="https://www.789.ru/members/persons.html"> Ассоциация
                                        в лицах</a>
                                </div>
                            </div>
                        </div>
                        <div class="accItem">
                            <div class="headLinkHolder" id="flush-heading3">
                                <a class="subMenuMainLink" href="https://www.789.ru/projects.html"> Проекты</a>
                                <div class="accOpen collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse3" aria-expanded="false"
                                    aria-controls="flush-collapse3">
                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='#fff'>
                                        <path fill-rule='evenodd'
                                            d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z' />
                                    </svg>
                                </div>

                            </div>
                            <div id="flush-collapse3" class="collapse" aria-labelledby="flush-heading3"
                                data-bs-parent="#accordionFlushExample">
                                <div class="">
                                    <a class="subMenuLink" href="https://www.789.ru/projects/rik.html"> Рейтинг
                                        исследовательских
                                        компаний</a>
                                    <a class="subMenuLink" href="https://www.789.ru/projects/research-expo.html">
                                        Research Expo</a>
                                    <a class="subMenuLink"
                                        href="https://www.789.ru/projects/spisok-kompanij-vysokogo-riska.html">
                                        Список компаний высокого риска</a>
                                    <a class="subMenuLink" href="https://www.789.ru/projects/cati-centers.html">
                                        Конкурс интервьюеров
                                        CATI-центров</a>
                                    <a class="subMenuLink" href="https://www.789.ru/projects/uslugi-audita.html">
                                        Услуги аудита</a>
                                    <a class="subMenuLink" href="https://www.789.ru/projects/pricetables.html"> Цены
                                        на
                                        исследования</a>
                                    <a class="subMenuLink" href="http://kubok.789.ru"> Кубок 789</a>
                                </div>
                            </div>
                        </div>
                        <div class="accItem">
                            <div class="headLinkHolder">
                                <a class="subMenuMainLink" href="https://www.789.ru/training.html"> Обучение</a>
                            </div>
                        </div>
                        <div class="accItem">
                            <div class="headLinkHolder" id="flush-heading4">
                                <a class="subMenuMainLink" href="https://www.789.ru/magazine.html"> Журнал</a>
                                <div class="accOpen collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse4" aria-expanded="false"
                                    aria-controls="flush-collapse4">
                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='#fff'>
                                        <path fill-rule='evenodd'
                                            d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z' />
                                    </svg>
                                </div>

                            </div>
                            <div id="flush-collapse4" class="collapse" aria-labelledby="flush-heading4"
                                data-bs-parent="#accordionFlushExample">
                                <div class="">
                                    <a class="subMenuLink"
                                        href="https://www.789.ru/magazine/novosti-assocziaczii.html"> Новости
                                        Ассоциации</a>
                                    <a class="subMenuLink" href="https://www.789.ru/magazine/kompanii-i-licza.html">
                                        Экспертное
                                        мнение</a>
                                    <a class="subMenuLink" href="https://www.789.ru/magazine/eto-interesno.html"> Это
                                        интересно</a>
                                    </li>
                                </div>
                            </div>
                        </div>
                        <div class="accItem">
                            <div class="headLinkHolder">
                                <a class="subMenuMainLink" href="https://www.789.ru/news.html"> Архив</a>
                            </div>
                        </div>
                        <div class="accItem">
                            <div class="headLinkHolder">
                                <a class="subMenuMainLink" href="https://www.789.ru/bdik.html"> Атлас</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <header id="sp-header" class="menu-fixed-out">
            <div class="container">
                <div class="row menuHolder" style="position: relative;">
                    <div id="sp-logo" class="col-9 col-xs-6 col-md-3">
                        <div class="sp-column">
                            <h1 class="logo">
                                <a href="/">
                                    <img style="width: 100%; height: auto;" src="/images/logo.png" alt=""
                                        class="logo">
                                </a>
                            </h1>
                        </div>
                    </div>
                    <div id="sp-menu" class="col-3 col-xs-6 col-md-9">
                        <div class="sp-column   h100">
                            <div class="sp-megamenu-wrapper h100">
                                <ul class="sp-megamenu-parent menu-fade d-none d-xl-block">
                                    <!-- <li class="sp-menu-item">
                                    <a href="https://www.789.ru/"><img src="/images/home.png" alt="Главная"></a>
                                </li> -->
                                    <li class="sp-menu-item sp-has-child current-item "><a
                                            href="https://www.789.ru/association.html">Об
                                            Ассоциации</a>
                                        <div class="sp-dropdown sp-dropdown-main sp-menu-right" style="width: 360px;">
                                            <div class="sp-dropdown-inner">
                                                <ul class="sp-dropdown-items">
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/association/goals.html">Цели
                                                            Ассоциации</a></li>
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/association/management.html">Управление
                                                            в
                                                            Ассоциации</a></li>
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/association/kak-vstupit.html">Как
                                                            вступить</a></li>
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/association/preimushchestva-chlenstva.html">Преимущества
                                                            членства</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="sp-menu-item sp-has-child"><a
                                            href="https://www.789.ru/members.html">Участники</a>
                                        <div class="sp-dropdown sp-dropdown-main sp-menu-right" style="width: 360px;">
                                            <div class="sp-dropdown-inner">
                                                <ul class="sp-dropdown-items">
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/members.html">Компании-участники</a>
                                                    </li>
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/members/persons.html">Ассоциация в
                                                            лицах</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="sp-menu-item sp-has-child"><a
                                            href="https://www.789.ru/projects.html">Проекты</a>
                                        <div class="sp-dropdown sp-dropdown-main sp-menu-right" style="width: 360px;">
                                            <div class="sp-dropdown-inner">
                                                <ul class="sp-dropdown-items">
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/projects/rik.html">Рейтинг
                                                            исследовательских компаний</a></li>
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/projects/research-expo.html">Research
                                                            Expo</a></li>
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/projects/spisok-kompanij-vysokogo-riska.html">Список
                                                            компаний высокого риска</a></li>
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/projects/cati-centers.html">Конкурс
                                                            интервьюеров
                                                            CATI-центров</a></li>
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/projects/uslugi-audita.html">Услуги
                                                            аудита</a></li>
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/projects/pricetables.html">Цены
                                                            на исследования</a></li>
                                                    <li class="sp-menu-item"><a href="http://kubok.789.ru">Кубок
                                                            789</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="sp-menu-item"><a href="https://www.789.ru/training.html">Обучение</a>
                                    </li>
                                    <li class="sp-menu-item sp-has-child"><a
                                            href="https://www.789.ru/magazine.html">Журнал</a>
                                        <div class="sp-dropdown sp-dropdown-main sp-menu-right" style="width: 360px;">
                                            <div class="sp-dropdown-inner">
                                                <ul class="sp-dropdown-items">
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/magazine/novosti-assocziaczii.html">Новости
                                                            Ассоциации</a></li>
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/magazine/kompanii-i-licza.html">Экспертное
                                                            мнение</a>
                                                    </li>
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/magazine/eto-interesno.html">Это
                                                            интересно</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="sp-menu-item"><a href="https://www.789.ru/news.html">Архив</a></li>
                                    <style>
                                        .sp-has-child.last .sp-dropdown.sp-dropdown-main.sp-menu-right {
                                            right: 0;
                                            left: auto;
                                        }

                                    </style>
                                    <li class="sp-menu-item sp-has-child last active"><a href="#">Атлас</a>
                                        <div class="sp-dropdown sp-dropdown-main sp-menu-right d-none"
                                            style="width: 360px;">
                                            <div class="sp-dropdown-inner">
                                                <ul class="sp-dropdown-items">
                                                    <li class="sp-menu-item"><a href="https://www.789.ru/">Поиск
                                                            компании</a></li>
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/company">Компания</a></li>
                                                    <li class="sp-menu-item"><a href="https://www.789.ru/about">О
                                                            компании 789</a></li>
                                                    <li class="sp-menu-item"><a
                                                            href="https://www.789.ru/badges">Значки</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                                <a class="offcanvas-toggler" href="#">
                                    <img src="/images/burgerImg.svg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header> --}}




        <section class="content">
            @yield('content')
        </section>


        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        © 2020 Ассоциация исследовательских компаний «Группа 7/89». Все права защищены.
                    </div>
                </div>
            </div>
        </footer>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.offcanvas-toggler').click(function() {
                $('.mobileMenuHolder').toggleClass('active')
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.searchOpen').click(function() {
                $('.searchTabsHolder').toggleClass('active')
            })
        });
    </script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    <script src="/js/search.js"></script>


    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
    <script src="https://mreq.github.io/slick-lightbox/dist/slick-lightbox.js" type="text/javascript" charset="utf-8">
    </script>
    <script type="text/javascript">
        $(document).on('ready', function() {



            // $(".center").slick({
            //     dots: false,
            //     infinite: false,
            //     centerMode: false,
            //     slidesToShow: 3,
            //     slidesToScroll: 1,
            //     mobileFirst: true,
            //     responsive: [{
            //             breakpoint: 1200,
            //             settings: {
            //                 arrows: false,
            //                 slidesToShow: 3
            //             }
            //         }, {
            //             breakpoint: 768,
            //             settings: {
            //                 arrows: false,
            //                 slidesToShow: 2
            //             }
            //         },
            //         {
            //             breakpoint: 480,
            //             settings: {
            //                 arrows: false,
            //                 slidesToShow: 1
            //             }
            //         }
            //     ]
            // });

            // $(".presa").slick({
            //     dots: false,
            //     infinite: false,
            //     centerMode: false,
            //     slidesToShow: 4,
            //     slidesToScroll: 1,
            //     // mobileFirst: true
            //     responsive: [{
            //             breakpoint: 1200,
            //             settings: {
            //                 arrows: false,
            //                 slidesToShow: 3
            //             }
            //         }, {
            //             breakpoint: 768,
            //             settings: {
            //                 arrows: false,
            //                 slidesToShow: 2
            //             }
            //         },
            //         {
            //             breakpoint: 480,
            //             settings: {
            //                 arrows: false,
            //                 slidesToShow: 1
            //             }
            //         }
            //     ]
            // });

            $('.center').slickLightbox({
                slick: {
                    itemSelector: 'a',
                    navigateByKeyboard: true,
                    dots: false,
                    infinite: false,
                    centerMode: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    mobileFirst: true,
                },
                caption: function(element, info) {
                    return $(element).find('img').attr('title');
                }
            });

        });
    </script>

    <!-- Select2 -->
    <script src="/admin/plugins/select2/js/select2.full.min.js"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            // Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>

    <!-- Select2 -->
</body>

</html>
