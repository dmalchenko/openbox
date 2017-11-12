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
            <span class="page-profile__balance-number"><?= $user->money ?> &#8381;</span>
        </div>
        <div class="btn  page-profile__balance-btn">Пополнить</div>
    </div>

    <div class="navigation  page-profile__navigation">
        <a href="<?= Url::toRoute(['/site/profile']) ?>" class="navigation__link">Профиль</a>
        <a href="<?= Url::toRoute(['/site/profile-products']) ?>" class="navigation__link  navigation__link--active">Мои
            товары</a>
        <a href="<?= Url::toRoute(['/site/profile-table']) ?>" class="navigation__link">Мои доставки</a>
        <a href="<?= Url::toRoute(['/site/profile-partner']) ?>" class="navigation__link">Партнёрская программа</a>
    </div>
</div>

<h2 class="page-profile-products__title">Корзина доставки</h2>

<div class="page-profile-products__box-wrapper js-product-delivery-wrapper">
    <div class="page-profile-products__box js-product-delivery-box">
        <button class="close  page-profile-products__box-close js-btn-product-del" aria-label="Закрыть"><span></span>
        </button>
        <img class="js-product-delivery-img" src="img/surprice.png" alt="product">
    </div>
    <div class="page-profile-products__box js-product-delivery-box">
        <button class="close  page-profile-products__box-close js-btn-product-del" aria-label="Закрыть"><span></span>
        </button>
        <img class="js-product-delivery-img" src="img/surprice.png" alt="product">
    </div>
    <div class="page-profile-products__box js-product-delivery-box">
        <button class="close  page-profile-products__box-close js-btn-product-del" aria-label="Закрыть"><span></span>
        </button>
        <img class="js-product-delivery-img" src="img/surprice.png" alt="product">
    </div>
    <div class="page-profile-products__box js-product-delivery-box">
        <button class="close  page-profile-products__box-close js-btn-product-del" aria-label="Закрыть"><span></span>
        </button>
        <img class="js-product-delivery-img" src="img/surprice.png" alt="product">
    </div>
    <div class="page-profile-products__box js-product-delivery-box">
        <button class="close  page-profile-products__box-close js-btn-product-del" aria-label="Закрыть"><span></span>
        </button>
        <img class="js-product-delivery-img" src="img/surprice.png" alt="product">
    </div>
</div>

<div class="page-profile-products__wrapper-btn">
    <a href="#" class="btn  btn--accent  page-profile-products__btn" onclick="delivery()">Заказать доставку за 300
        &#8381;</a>
</div>

<h2 class="page-profile-products__title">Мои товары</h2>
<div class="page-profile-products__box-wrapper js-product-wrapper">
	<?php
	$boxTemplate = <<< HTML
    <div class="page-profile-products__box js-product-box">
        <button class="page-profile-products__box-buy js-btn-product-buy">
            <svg width="20" height="20">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="img/sprite-svg.svg#cart"></use>
            </svg>
        </button>
        <button class="page-profile-products__box-sell js-btn-product-sell" data-bid="%s" data-id="%s" data-sell="%s">&#8381;</button>
        <img class="js-product-img" src="%s" alt="product">
    </div>
HTML;

	foreach ($basketDataProvider as $box) {
		echo sprintf($boxTemplate, $box->id, $box->items->id, $box->items->cost_sell, $box->items->image);
	}
	?>

</div>
<script>
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    function delivery() {
        // var items = $('#code-val').val();
        var items = [1, 2, 3];
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
    $('.js-product-wrapper').on('click', '.js-btn-product-sell', function (e) {
        var sellConfirmation = confirm('Вы уверены, что хотите продать товар за ' + $(this).data('sell') + 'руб?');
        if (sellConfirmation) {
            $.ajax({
                dataType: 'json',
                url: '<?= Url::toRoute(['/site/sell']) ?>',
                data: {_csrf: csrfToken, bid: $(this).data('bid'), id: $(this).data('id')},
                success: function (data) {
                    console.log(data);
                    $('.page-profile__balance-number').html(data.balance + ' &#8381;');
                },
                fail: function () {
                    console.log('err');
                }
            });

            $(e.target).parents('.js-product-box').hide();
        }
    });
    $('.js-product-wrapper').on('click', '.js-btn-product-buy', function (e) {
        var $currentProduct = $(e.target).parents('.js-product-box');
        var isEmptySlot = $('.js-product-delivery-box').not('.page-profile-products__box--active').length;
        if (isEmptySlot) {
            var $emptySlot = $($('.js-product-delivery-box').not('.page-profile-products__box--active')[0]);
            var $emptySlotImg = $emptySlot.find('.js-product-delivery-img');
            var $currentProductImg = $currentProduct.find('.js-product-img');
            $emptySlotImg.prop('src', $currentProductImg.prop('src'));
            $emptySlot.addClass('page-profile-products__box--active');
            $currentProduct.find('.js-product-img').prop('src', '');
            $currentProduct.hide();
        } else {
            alert('Корзина полна');
        }
    });
    $('.js-product-delivery-wrapper').on('click', '.js-btn-product-del', function (e) {
        var $currentProduct = $(e.target).parents('.js-product-delivery-box');
        var $emptySlot = $($('.js-product-box').not(':visible')[0]);
        var $emptySlotImg = $emptySlot.find('.js-product-img');
        var $currentProductImg = $currentProduct.find('.js-product-delivery-img');
        $emptySlotImg.prop('src', $currentProductImg.prop('src'));
        $emptySlot.show();
        $currentProduct.find('.js-product-delivery-img').prop('src', 'img/surprice.png');
        $currentProduct.removeClass('page-profile-products__box--active');
    });
</script>
