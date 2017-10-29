<?php
/* @var $this yii\web\View */
/* @var $case100 \app\modules\opencase\models\Items */
/* @var $case250 \app\modules\opencase\models\Items */
/* @var $case500 \app\modules\opencase\models\Items */
/* @var $case1000 \app\modules\opencase\models\Items */

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

?>

    <div class="box-wrapper">
        <div class="box-wrapper__left">
            <div class="box">
                <div class="box__header">
                    <div class="box__name">
                        Коробка
                        <div class="box__number">№1</div>
                    </div>
                    <div class="box__price">100&#8381;</div>
                </div>
                <div class="box__surprice">
                    <img src="img/surprice.png" alt="surprice">
                </div>
            </div>
            <a href="<?= Url::toRoute(['/site/box', 'id' => 1]) ?>" class="btn  btn--accent  box__btn">Открыть коробку</a>
            <div class="box-wrapper__text">
                Уже выдано
                <span class="box-wrapper__number">184 569 товаров</span>
            </div>
        </div>
        <div class="box-wrapper__right">
            <div class="box-wrapper__right-text">Коробка содержит <?= count($case100) ?> товаров</div>
            <div class="box-wrapper__items">
                <?php
                foreach ($case100 as $item) {
                    $s = '<div class="box-wrapper__item"><img src="%s" alt="surpise"></div>';
                    echo sprintf($s, $item->image);
                }
                ?>
            </div>
        </div>
    </div>

    <div class="box-wrapper">
        <div class="box-wrapper__left">
            <div class="box">
                <div class="box__header">
                    <div class="box__name">
                        Коробка
                        <div class="box__number">№2</div>
                    </div>
                    <div class="box__price">250&#8381;</div>
                </div>
                <div class="box__surprice">
                    <img src="img/surprice.png" alt="surprice">
                </div>
            </div>
            <a href="<?= Url::toRoute(['/site/box', 'id' => 2]) ?>" class="btn  btn--accent  box__btn">Открыть коробку</a>
            <div class="box-wrapper__text">
                Уже выдано
                <span class="box-wrapper__number">184 569 товаров</span>
            </div>
        </div>
        <div class="box-wrapper__right">
            <div class="box-wrapper__right-text">Коробка содержит <?= count($case250) ?> товаров</div>
            <div class="box-wrapper__items">
                <?php
                foreach ($case250 as $item) {
                    $s = '<div class="box-wrapper__item"><img src="%s" alt="surpise"></div>';
                    echo sprintf($s, $item->image);
                }
                ?>
            </div>
        </div>
    </div>

    <div class="box-wrapper">
        <div class="box-wrapper__left">
            <div class="box">
                <div class="box__header">
                    <div class="box__name">
                        Коробка
                        <div class="box__number">№3</div>
                    </div>
                    <div class="box__price">500&#8381;</div>
                </div>
                <div class="box__surprice">
                    <img src="img/surprice.png" alt="surprice">
                </div>
            </div>
            <a href="<?= Url::toRoute(['/site/box', 'id' => 3]) ?>" class="btn  btn--accent  box__btn">Открыть коробку</a>
            <div class="box-wrapper__text">
                Уже выдано
                <span class="box-wrapper__number">184 569 товаров</span>
            </div>
        </div>
        <div class="box-wrapper__right">
            <div class="box-wrapper__right-text">Коробка содержит <?= count($case500) ?> товаров</div>
            <div class="box-wrapper__items">
                <?php
                foreach ($case500 as $item) {
                    $s = '<div class="box-wrapper__item"><img src="%s" alt="surpise"></div>';
                    echo sprintf($s, $item->image);
                }
                ?>
            </div>
        </div>
    </div>

    <div class="box-wrapper">
        <div class="box-wrapper__left">
            <div class="box">
                <div class="box__header">
                    <div class="box__name">
                        Коробка
                        <div class="box__number">№4</div>
                    </div>
                    <div class="box__price">1000&#8381;</div>
                </div>
                <div class="box__surprice">
                    <img src="img/surprice.png" alt="surprice">
                </div>
            </div>
            <a href="<?= Url::toRoute(['/site/box', 'id' => 4]) ?>" class="btn  btn--accent  box__btn">Открыть коробку</a>
            <div class="box-wrapper__text">
                Уже выдано
                <span class="box-wrapper__number">184 569 товаров</span>
            </div>
        </div>
        <div class="box-wrapper__right">
            <div class="box-wrapper__right-text">Коробка содержит <?= count($case500) ?> товаров</div>
            <div class="box-wrapper__items">
                <?php
                foreach ($case1000 as $item) {
                    $s = '<div class="box-wrapper__item"><img src="%s" alt="surpise"></div>';
                    echo sprintf($s, $item->image);
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="guarantees">
    <div class="container">
        <h2 class="guarantees__title">Наши гарантии</h2>
        <div class="guarantees__wrapper">

            <div class="guarantees__item">
                <div class="guarantees__icon">
                    <img src="img/glasses.png" alt="glasses">
                </div>
                <h3 class="guarantees__subtitle">Полная прозрачность</h3>
                <p class="guarantees__text">
                    У нас вы можете посмотреть все. Кто получил, что получил и когда. Каждый профиль снабжен
                    ссылкой на контакт человека в одной из трех социальных сетей.
                </p>
            </div>

            <div class="guarantees__item">
                <div class="guarantees__icon">
                    <img src="img/money.png" alt="money">
                </div>
                <h3 class="guarantees__subtitle">Гарантия низких цен</h3>
                <p class="guarantees__text">
                    Благодаря крупным оптовым закупкам цены в нашем магазине на все товары одни из самых
                    низких на рынке.
                </p>
            </div>

            <div class="guarantees__item">
                <div class="guarantees__icon">
                    <img src="img/magnifier.png" alt="magnifier">
                </div>
                <h3 class="guarantees__subtitle">Проверенные товары</h3>
                <p class="guarantees__text">
                    Мы выкладываем только проверенные товары от надежных поставщиков. Каждый товар
                    тестируется перед отправкой и снабжается всей сопровождающей документацией.
                </p>
            </div>

        </div>
    </div>
</div>
