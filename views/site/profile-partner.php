<?php

/* @var $this yii\web\View */
/* @var boolean $partnerSet */
/* @var integer $code */
/* @var \app\modules\opencase\models\PromoLog $promos */

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
        <a href="<?= Url::toRoute(['/site/profile-products']) ?>" class="navigation__link">Мои товары</a>
        <a href="<?= Url::toRoute(['/site/profile-table']) ?>" class="navigation__link">Мои доставки</a>
        <a href="<?= Url::toRoute(['/site/profile-partner']) ?>" class="navigation__link navigation__link--active">Партнёрская
            программа</a>
    </div>
</div>

<div class="page-profile__dark-card-wrapper">
    <div class="page-profile__dark-card">
        <div class="page-profile__dark-card-header">У вас есть <span>партнерский код?</span></div>
        <div class="page-profile__dark-card-text">Введите код и получите 50&#8381; на счёт прямо сейчас!</div>
        <!--<form action="/" class="page-profile__form" name="partner-code">-->
        <label class="field-text">
                      <span class="field-text__input-wrap">
                        <input class="field-text__input" type="text" id="code-val">
                        <input class="field-text__btn" type="button" name="send" value="OK" id="btn-code">
                      </span>
        </label>
        <!--</form>-->
    </div>
    <div class="page-profile__dark-card">
        <div class="page-profile__dark-card-header">Приглашайте друзей и
            <span>зарабатывайте 5% от всех пополнений</span></div>
        <div class="page-profile__dark-card-text">Отправьте свой уникальный код друзьям, и получайте по 5% от каждого
            пополнения баланса другом!
        </div>
        <form action="a.php" class="page-profile__form" name="partner-invite">
            <label class="field-text">
                  <span class="field-text__input-wrap">
                    <input class="field-text__input  page-profile__field-invite" value="<?= $code?>">
                  </span>
            </label>
        </form>
    </div>
</div>
<div class="page-profile-table" style="
    width: 70%;
    margin: auto;
    background-color: #141a21;
    padding: 22px;
    border-radius: 10px;
    margin-top: 40px;
">
    <div class="page-profile-table__tr" style="margin-top: 5px">
        <div class="page-profile-table__th">За кого бонус</div>
        <div class="page-profile-table__th">За промокод</div>
        <div class="page-profile-table__th">Зачисленно</div>
        <div class="page-profile-table__th">Дата</div>
    </div>
	<?php
	$template = <<< HTML
    <div class="page-profile-table__tr" style="color: #dddddd">
        <div class="page-profile-table__td">%s</div>
        <div class="page-profile-table__td">%s</div>
        <div class="page-profile-table__td">%s руб.</div>
        <div class="page-profile-table__td">%s</div>
    </div>
HTML;

	foreach ($promos as $promo) {
		$msg = sprintf($template, $promo->partner, $promo->promocode, $promo->bonus, date("Y-m-d H:i:s", $promo->created_at));
		echo $msg;
	}

	?>
</div>

<script>
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $('#btn-code').click(function() {
        var code = $('#code-val').val();
        $.ajax({
            dataType: 'json',
            url: '<?= Url::toRoute(['/site/promo']) ?>',
            data: {_csrf: csrfToken, code:code},
            success: function (data) {
                if (data.code == 200) {
                    alert('Код активирован');
                    location.reload();
                } else if (data.code != 200) {
                    console.log(data.msg);
                    alert(data.msg);
                } else {
                    alert('Произошла внутренняя ошибка, попробуйте позже');
                }
                console.log(data);
            }
        });
    });
</script>