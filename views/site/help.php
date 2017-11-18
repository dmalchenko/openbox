<?php

/* @var $this yii\web\View */
?>

<a href="<?= Yii::$app->homeUrl?>" class="link-return  navigation__link  navigation__link--active">
    < Вернуться к списку коробок
</a>
<h2 class="title-h2  title-h2--big  page-delivery__title">Вопросы и ответы</h2>
<div class="page-delivery__wrapper">
    <div class="page-delivery__wrapper-left">
        <h3 class="page-delivery__subtitle">Часто задаваемые вопросы</h3>
        <div class="page-delivery__faq-block">
            <div class="page-delivery__faq-block-header">Куда нужно ввести промокод?</div>
            <div class="page-delivery__faq-block-list">
                Промокод вводится на <a href="profile">странице вашего профиля</a> в форму
                партнерского кода.
            </div>
        </div>

        <div class="page-delivery__faq-block">
            <div class="page-delivery__faq-block-header">Можно ввести несколько промокодов?</div>
            <div class="page-delivery__faq-block-list">
                Нет. Можно ввести и активировать только 1 промокод.
            </div>
        </div>

        <div class="page-delivery__faq-block">
            <div class="page-delivery__faq-block-header">Что дает промокод?</div>
            <div class="page-delivery__faq-block-list">
                Все промокоды зачисляют на баланс 50 рублей, которые вы можете использовать для открытия
                коробок.
            </div>
        </div>

        <h3 class="page-delivery__subtitle">Открытие коробок</h3>

        <div class="page-delivery__faq-block">
            <div class="page-delivery__faq-block-header">Как это работает?</div>
            <div class="page-delivery__faq-block-list">
                На сайте расположено 4 коробки-сюрпризов. Открывая коробку вы получаете один из
                предметов, который можете заказать с доставкой на дом или продать. Стоимость открытия
                коробки всегда одинаковая, независимо от того, какой вам выпал предмет. Таким образом,
                вы можете получить дорогие и интересные товары по очень низким ценам.
            </div>
        </div>

        <div class="page-delivery__faq-block">
            <div class="page-delivery__faq-block-header">Мне точно выпадет какой-то товар?</div>
            <div class="page-delivery__faq-block-list">
                Открывая коробку мы гарантируем, что вы точно получите один из товаров. Открытие коробки
                в RanBox аналогично киндер-сюрпризу, вы всегда получаете свой сюрприз.
            </div>
        </div>

        <div class="page-delivery__faq-block">
            <div class="page-delivery__faq-block-header">Как открыть коробку и получить товар?</div>
            <ul class="page-delivery__faq-block-list">
                <li>Пройдите простую регистрацию на сайте.</li>
                <li>Пополните баланс на сумму, необходимую для открытия коробки.</li>
                <li>Перейдите на страницу открытия коробки и нажмите кнопку «Открыть коробку».</li>
                <li>С вашего баланса на сайте будет автоматически списана стоимость открытия коробки.
                </li>
                <li>Подождите пока лента с товарами остановится и определится товар, который выпал
                    именно вам!
                </li>
                <li>Решите, что хотите сделать с товаром - продать или заказать доставку.</li>
            </ul>
        </div>

        <div class="page-delivery__faq-block">
            <div class="page-delivery__faq-block-header">Каким образом выпадает товар?</div>
            <div class="page-delivery__faq-block-list">
                Определение товара происходит случайным образом. Никто заранее не знает когда выпадет
                тот или иной товар.
            </div>
        </div>

        <div class="page-delivery__faq-block">
            <div class="page-delivery__faq-block-header">Можно вернуть ненужный товар и еще раз открыть
                коробку?
            </div>
            <div class="page-delivery__faq-block-list">
                Да! После открытия коробки, если вам выпал товар, который у вас уже есть или просто вам
                не нужен - вы можете его вернуть нажав кнопку “Продать” на странице коробки или в
                разделе “Мои товары” на странице вашего профиля. Стоимость продажи зависит от ценности
                товара и может быть как больше, так и меньше стоимости открытия коробки.
            </div>
        </div>

        <div class="page-delivery__faq-block">
            <div class="page-delivery__faq-block-header">Как заказать доставку товаров?</div>
            <div class="page-delivery__faq-block-list">
                Подробную информацию об условиях и порядке получения товаров вы можете прочитать в на
                странице <a href="delivery">Доставка и оплата</a>
            </div>
        </div>

        <div class="page-delivery__faq-block">
            <div class="page-delivery__faq-block-header">Статусы посылки в истории заказов:</div>
            <ol class="page-delivery__faq-block-list">
                <li>"Ожидает подтверждения" - ваш заказ на доставку будет подтвержден отделом доставки в
                    течение 24 часов
                </li>
                <li>"В работе" - посылку собирают в отделе доставки</li>
                <li>"Готовится к отправке" - посылка находится в сортировочном центре Почты России и
                    будет отправлена в порядке очереди в течение 14 дней;
                </li>
                <li>"Отправлено" - посылка отправлена, справа от статуса написан трек-номер для
                    отслеживания на сайте Почты России. Для жителей РФ общий срок доставки с момента
                    заказа не превышает 30 дней.
                </li>
            </ol>
        </div>
    </div>
</div>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?150"></script>

<!-- VK Widget -->
<div id="vk_community_messages"></div>
<script type="text/javascript">
    VK.Widgets.CommunityMessages("vk_community_messages", 40771317, {expandTimeout: "10000",tooltipButtonText: "Есть вопрос?"});
</script>