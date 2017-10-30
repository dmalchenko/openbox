<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

/* @var \app\modules\opencase\models\Items $box */
/* @var integer $id */
/* @var integer $type */

?>

<a href="<?= Yii::$app->homeUrl ?>" class="link-return  navigation__link  navigation__link--active">< Вернуться к списку
    коробок</a>
<h2 class="title-h2  title-h2--big  page-box__title">Коробка №<?= $id ?></h2>

<div class="roulette-line">
    <div class="roulette-wrapper__mid">
        <div class="roulette-wrapper__mid-layer">
            <div class="roulette-wrapper__mid-line roulette-wrapper__mid-line_top"></div>
            <div class="roulette-wrapper__mid-line roulette-wrapper__mid-line_bottom"></div>
        </div>
    </div>
    <div class="roulette-wrapper">
        <div class="roulette-wrapper__shadow roulette-wrapper__shadow_left"></div>
        <div class="roulette-wrapper__shadow roulette-wrapper__shadow_right"></div>
        <div class="roulette">
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/10_medium.png" alt="Экшн Камера"
                                   title="Экшн Камера"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/11_medium.png" alt="Смарт Часы (Android)"
                                   title="Смарт Часы (Android)"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/5_medium.png" alt="Беспроводная мышь"
                                   title="Беспроводная мышь"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/usb_smartbuy_4gb_medium.png"
                                   alt="Флешка SmartBuy 4GB" title="Флешка SmartBuy 4GB"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/monokl-medium.png" alt="Подзорная труба"
                                   title="Подзорная труба"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/kruzhka-meshalka-medium.png"
                                   alt="Кружка мешалка" title="Кружка мешалка"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/cigarette_medium.png"
                                   alt="Электронная сигарета" title="Электронная сигарета"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/spinner_medium.png" alt="Спиннер"
                                   title="Спиннер"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/powerbank_medium.png"
                                   alt="Брелок PowerBank 2600 mAh" title="Брелок PowerBank 2600 mAh"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/21_medium.png"
                                   alt="Селфи палка (Монопод)" title="Селфи палка (Монопод)"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/7_medium.png" alt="Fish Eye"
                                   title="Fish Eye"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/lazer-medium.png" alt="Лазерная указка"
                                   title="Лазерная указка"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/6_medium.png" alt="Наушники молния"
                                   title="Наушники молния"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/18_medium.png" alt="MP3 плеер"
                                   title="MP3 плеер"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/android_cable_medium.png"
                                   alt="USB-кабель Android" title="USB-кабель Android"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/jbl_headphone_medium.png" alt="Наушники"
                                   title="Наушники"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/usb_led_medium.png"
                                   alt="USB гибкая лампа" title="USB гибкая лампа"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/9_medium.png" alt="Нож кредитка"
                                   title="Нож кредитка"/></div>
            <div class="item"><img src="http://214010.selcdn.ru/ranbox/items-i/iphone-kabel-medium.png"
                                   alt="USB-кабель iPhone 5,6,7" title="USB-кабель iPhone 5,6,7"/></div>
        </div>
    </div>
</div>

<div class="page-box__wrapper-btn">
    <button id="#openb" class="btn  btn--accent" data-toggle="modal"
            data-target="#modal-demo-0<?= Yii::$app->user->isGuest ? '1' : '3' ?>">Открыть коробку
        за <?= $type ?>
        &#8381;
    </button>
</div>

<div class="page-box__boxes-header">Коробка содержит:</div>

<div class="page-box__wrapper-boxes">
	<?php
	/**
	 * @var \app\modules\opencase\models\Items $item
	 */
	foreach ($box as $item) {
		$s = '<div class="page-box__wrapper-box"><div class="page-box__wrapper-box-name">%s</div><div class="page-box__box">
			<img src="%s" alt="%s"></div></div>';
		echo sprintf($s, $item->title, $item->image, $item->title);
	}
	?>

</div>
<script>
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var open = document.getElementById('#openb');
    var caseType = <?=$type?>;
    open.onclick = function () {
        $.ajax({
            dataType: 'json',
            url: '<?= Url::toRoute(['/opencase/game/run', 'caseType' => $type]) ?>',
            data: {_csrf: csrfToken},
            success: function (data) {
                if (data.code == 200 & data.caseType == caseType & data.id > 0) {
                    $('.main-nav__link-user-balance').html(data.balance + ' &#8381;');
                    $('#modal-img-prize').attr('src', data.img);
                    $('.modal__title-prize').html(data.title);
                } else if (data.code == 402) {
                    $('.modal__title').html(data.msg);
                } else if (data.code != 200) {
                    console.log(data.msg);
                } else {
                    alert('Произошла внутренняя ошибка, попробуйте позже');
                }
                console.log(data);
            }
        });
    };
</script>