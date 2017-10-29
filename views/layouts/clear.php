<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\User;
use yii\helpers\Url;

$user = User::getCurrentUser();
?>

<!DOCTYPE html>
<html class="no-js  page" lang="ru">

<head>
    <meta charset="utf-8">
    <title>Box</title>
    <meta name="description" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="format-detection" content="telephone=no">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet" media="screen">

    <script>
        // Маркер работающего javascript
        document.documentElement.className = document.documentElement.className.replace('no-js', 'js');
        document.addEventListener('DOMContentLoaded', function () {
            if (window.isMobile !== undefined) {
                // console.log(isMobile);
                if (isMobile.any) {
                    var rootClasses = ' is-mobile';
                    for (key in isMobile) {
                        if (typeof isMobile[key] === 'boolean' && isMobile[key] && key !== 'any') rootClasses += ' is-mobile--' + key;
                        if (typeof isMobile[key] === 'object' && key !== 'other') {
                            for (type in isMobile[key]) {
                                if (isMobile[key][type]) rootClasses += ' is-mobile--' + key + '-' + type;
                            }
                        }
                    }
                    document.documentElement.className += rootClasses;
                }
            }
            else {
                console.log('Классы для мобильных не добавлены: в сборке отсутствует isMobile.js');
            }
        });

    </script>
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?150"></script>

    <link rel="icon" href="img/favicon.ico" type="image/x-icon">


</head>

<body>

<div class="page__inner">

    <div class="page__content">

        <header class="page-header" role="banner">
            <div class="container">
                <div class="page-header__wrapper">
                    <a href="index.html" class="logo  page-header__logo">
                        <img src="img/logo.png" alt="Box">
                        Box
                    </a>

                    <div class="page-header__counter">
                        <div class="page-header__counter-block">
                            <div class="page-header__users">
                                <div class="page-header__users-number">940 000</div>
                                <div class="page-header__users-text">Пользователей</div>
                            </div>
                        </div>

                        <div class="page-header__counter-block  page-header__counter-block_ml">
                            <div class="page-header__users">
                                <div class="page-header__users-number">4564135</div>
                                <div class="page-header__users-text">Открыто коробок</div>
                            </div>
                        </div>
                    </div>

                    <nav id="main-nav" class="main-nav" role="navigation">
                        <div id="main-nav-toggler" class="main-nav__toggler  burger"><span></span></div>
                        <ul class="main-nav__list">
                            <li class="main-nav__item">
                                <a href="index.html" class="main-nav__link  main-nav__link--active">
                                    Коробки
                                </a>
                            </li>
                            <li class="main-nav__item">
                                <a href="shop.html" class="main-nav__link">
                                    Магазин
                                </a>
                            </li>
                            <li class="main-nav__item">
                                <a href="delivery.html" class="main-nav__link">
                                    Доставка
                                </a>
                            </li>
                            <li class="main-nav__item">
                                <a href="testimonials.html" class="main-nav__link">
                                    Отзывы
                                </a>
                            </li>
                            <li class="main-nav__item">
                                <a href="<?= Url::toRoute(['/site/help']) ?>" class="main-nav__link">
                                    Помощь
                                </a>
                            </li>
							<?php
							if (Yii::$app->user->isGuest) {
								?>

                                <li class="main-nav__item  main-nav__item_ml">
                                    <button class="btn  main-nav__btn" data-toggle="modal" data-target="#modal-demo-01">
                                        Вход
                                    </button>
                                </li>
                                <li class="main-nav__item">
                                    <button class="btn  main-nav__btn" data-toggle="modal" data-target="#modal-demo-01">
                                        Регистрация
                                    </button>
                                </li>

								<?php
							} else {
								?>
                                <li class="main-nav__item  main-nav__item_ml  main-nav__item-user">
                                    <a href="<?= Url::toRoute(['/profile/index']) ?>"
                                       class="main-nav__link  main-nav__link--mt0">
                                        <img src="<?= $user->getAvatar() ?>" alt="ava">
                                    </a>
                                    <div class="main-nav__link-user-wrapper">
                                        <a href="<?= Url::toRoute(['/profile/index']) ?>"
                                           class="main-nav__link-user-name">Мой профиль</a>
                                        <div class="main-nav__link-balance-wrapper">
                                            <div class="main-nav__link-user-balance"><?= $user->money ?> &#8381;</div>
                                            <button class="btn  main-nav__btn  main-nav__btn-balance"
                                                    data-toggle="modal"
                                                    data-target="#modal-demo-01">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </li>
								<?php
							} ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main role="main">

            <div class="owl-carousel" id="owl-carousel-demo">
                <div>
                    <img src="http://214010.selcdn.ru/ranbox/items-i/21_medium.png" alt="surpise"
                         class="owl-carousel__prize">
                    <img src="http://214010.selcdn.ru/ranbox/users/vk_350174184_medium.jpg" alt="person"
                         class="owl-carousel__person">
                </div>
                <div>
                    <img src="http://214010.selcdn.ru/ranbox/items-i/usb_led_medium.png" alt="surpise"
                         class="owl-carousel__prize">
                    <img src="http://214010.selcdn.ru/ranbox/users/vk_350174184_medium.jpg" alt="person"
                         class="owl-carousel__person">
                </div>
                <div>
                    <img src="http://214010.selcdn.ru/ranbox/items-i/45_medium.png" alt="surpise"
                         class="owl-carousel__prize">
                    <img src="http://214010.selcdn.ru/ranbox/users/vk_350174184_medium.jpg" alt="person"
                         class="owl-carousel__person">
                </div>
                <div>
                    <img src="http://214010.selcdn.ru/ranbox/items-i/usb_led_medium.png" alt="surpise"
                         class="owl-carousel__prize">
                    <img src="http://214010.selcdn.ru/ranbox/users/vk_350174184_medium.jpg" alt="person"
                         class="owl-carousel__person">
                </div>
                <div>
                    <img src="http://214010.selcdn.ru/ranbox/items-i/21_medium.png" alt="surpise"
                         class="owl-carousel__prize">
                    <img src="http://214010.selcdn.ru/ranbox/users/vk_350174184_medium.jpg" alt="person"
                         class="owl-carousel__person">
                </div>
                <div>
                    <img src="http://214010.selcdn.ru/ranbox/items-i/powerbank_medium.png" alt="surpise"
                         class="owl-carousel__prize">
                    <img src="http://214010.selcdn.ru/ranbox/users/vk_350174184_medium.jpg" alt="person"
                         class="owl-carousel__person">
                </div>
                <div>
                    <img src="http://214010.selcdn.ru/ranbox/items-i/21_medium.png" alt="surpise"
                         class="owl-carousel__prize">
                    <img src="http://214010.selcdn.ru/ranbox/users/vk_350174184_medium.jpg" alt="person"
                         class="owl-carousel__person">
                </div>
                <div>
                    <img src="http://214010.selcdn.ru/ranbox/items-i/6_medium.png" alt="surpise"
                         class="owl-carousel__prize">
                    <img src="http://214010.selcdn.ru/ranbox/users/vk_350174184_medium.jpg" alt="person"
                         class="owl-carousel__person">
                </div>
                <div>
                    <img src="http://214010.selcdn.ru/ranbox/items-i/21_medium.png" alt="surpise"
                         class="owl-carousel__prize">
                    <img src="http://214010.selcdn.ru/ranbox/users/vk_350174184_medium.jpg" alt="person"
                         class="owl-carousel__person">
                </div>
                <div>
                    <img src="http://214010.selcdn.ru/ranbox/items-i/6_medium.png" alt="surpise"
                         class="owl-carousel__prize">
                    <img src="http://214010.selcdn.ru/ranbox/users/vk_350174184_medium.jpg" alt="person"
                         class="owl-carousel__person">
                </div>
            </div>

			<?= $content ?>

        </main>
    </div>

    <div class="page__footer-wrapper">

        <footer class="page-footer" role="contentinfo">
            <div class="container">
                <div class="page-footer__wrapper">
                    <div class="page-footer__left">
                        <div class="pay-system">
                            <h3 class="pay-system__title">Мы принимаем</h3>
                            <div class="pay-system__wrapper">
                                <div class="pay-system__item">
                                    <img src="img/master.png" alt="MasterCard" title="MasterCard">
                                </div>
                                <div class="pay-system__item">
                                    <img src="img/visa.png" alt="Visa" title="Visa">
                                </div>
                                <div class="pay-system__item">
                                    <img src="img/yandex.png" alt="Яндекс.Деньги" title="Яндекс.Деньги">
                                </div>
                                <div class="pay-system__item">
                                    <img src="img/qiwi.png" alt="Qiwi" title="Qiwi">
                                </div>
                                <div class="pay-system__item">
                                    <img src="img/mts.png" alt="МТС" title="МТС">
                                </div>
                                <div class="pay-system__item">
                                    <img src="img/bee.png" alt="Beeline" title="Beeline">
                                </div>
                            </div>
                        </div>
                        <div class="page-footer__copyright">Copyright 2017</div>
                        <div class="page-footer__confidential">Авторизируясь на сайте вы принимаете
                            <a href="#" class="page-footer__link">пользовательское соглашение</a>
                        </div>
                        <a href="#" class="page-footer__link">Политика конфиденциальности</a>
                    </div>
                    <div class="page-footer__right">
                        <div class="page-footer__vk" id="vk_groups"></div>
                    </div>
                </div>
            </div>


            <div id="modal-demo-01" class="modal" tabindex="-1" role="dialog">
                <div class="modal__dialog" role="document">
                    <div class="modal__content">
                        <div class="modal__header">
                            <span class="close  modal__close" data-dismiss="modal"
                                  aria-label="Закрыть"><span></span></span>
                            <div class="modal__title">Выберите любимую социальную сеть</div>
                        </div>
                        <div class="modal__wrapper">
                            <a href="<?= Url::toRoute(['/site/login-social', 'service' => 'vkontakte']) ?>"
                               class="modal__link">
                                <img src="img/vk.png" alt="Вконтакте">
                            </a>
                            <a href="<?= Url::toRoute(['/site/login-social', 'service' => 'facebook']) ?>"
                               class="modal__link">
                                <img src="img/fb.png" alt="Facebook">
                            </a>
                            <a href="<?= Url::toRoute(['/site/login-social', 'service' => 'odnoklassniki']) ?>"
                               class="modal__link">
                                <img src="img/ok.png" alt="Odnoklassniki">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </footer>

    </div>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.3.1.1.min.js"><\/script>')</script>
<script type="text/javascript">
    VK.Widgets.Group("vk_groups", {mode: 3}, 20003922);
</script>
<script src="js/script.min.js"></script>

</body>
</html>
