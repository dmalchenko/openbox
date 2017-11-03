<?php

/* @var $this yii\web\View */
/* @var \app\modules\opencase\models\Basket[] $basketDataProvider */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$user = \app\models\User::getCurrentUser();
?>

<div class="page-profile__top-wrapper">
	<div class="page-profile__wrapper-balance">
		<div class="page-profile__balance">
			Баланс:
			<span class="page-profile__balance-number"><?= $user->money?> &#8381;</span>
		</div>
		<div class="btn  page-profile__balance-btn">Пополнить</div>
	</div>

	<div class="navigation  page-profile__navigation">
		<a href="<?= Url::toRoute(['/site/profile']) ?>" class="navigation__link">Профиль</a>
		<a href="<?= Url::toRoute(['/site/profile-products']) ?>" class="navigation__link  navigation__link--active">Мои товары</a>
		<a href="<?= Url::toRoute(['/site/profile-table']) ?>" class="navigation__link">Мои доставки</a>
        <a href="<?= Url::toRoute(['/site/profile-partner']) ?>" class="navigation__link">Партнёрская программа</a>
    </div>
</div>

<h2 class="page-profile-products__title">Корзина доставки</h2>

<div class="page-profile-products__box-wrapper">
    <div class="page-profile-products__box">
        <span class="close  page-profile-products__box-close" aria-label="Закрыть"><span></span></span>
        <img src="img/surprice.png" alt="product">
    </div>
    <div class="page-profile-products__box">
        <span class="close  page-profile-products__box-close" aria-label="Закрыть"><span></span></span>
        <img src="img/surprice.png" alt="product">
    </div>
    <div class="page-profile-products__box">
        <span class="close  page-profile-products__box-close" aria-label="Закрыть"><span></span></span>
        <img src="img/surprice.png" alt="product">
    </div>
    <div class="page-profile-products__box">
        <span class="close  page-profile-products__box-close" aria-label="Закрыть"><span></span></span>
        <img src="img/surprice.png" alt="product">
    </div>
    <div class="page-profile-products__box">
        <span class="close  page-profile-products__box-close" aria-label="Закрыть"><span></span></span>
        <img src="img/surprice.png" alt="product">
    </div>
</div>

<div class="page-profile-products__wrapper-btn">
    <a href="#" class="btn  btn--accent  page-profile-products__btn" onclick="delivery()">Заказать доставку за 300 &#8381;</a>
</div>

<h2 class="page-profile-products__title">Мои товары</h2>
<div class="page-profile-products__box-wrapper">
    <?php
    $boxTemplate = <<< HTML
    <div class="page-profile-products__box">
        <button class="page-profile-products__box-buy">
            <svg width="20" height="20">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="img/sprite-svg.svg#cart"></use>
            </svg>
        </button>
        <button class="page-profile-products__box-sell">&#8381;</button>
        <img src="%s" alt="product">
    </div>
HTML;

    foreach ($basketDataProvider as $box) {
        echo sprintf($boxTemplate, $box->items->image);
    }
    ?>

</div>
<script>
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    function delivery() {
        // var items = $('#code-val').val();
        var items = [1,2,3];
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: "<?= Url::toRoute(['/opencase/user/delivery']) ?>",
            data: {_csrf: csrfToken, items: items},
            success: function (data) {
                if (data.code == 200) {
                    alert('Заявка на доставку создана');
                    window.location.href = "<?= Url::toRoute(['/site/profile-table'])?>";
                } else if (data.code != 200) {
                    console.log(data.msg);
                    alert(data.msg);
                } else {
                    alert('Произошла внутренняя ошибка, попробуйте позже');
                }
                console.log(data);
            }
        });
    }
</script>
