<?php

/* @var $this yii\web\View */
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
	</div>
</div>

<h2 class="page-profile-products__title">Корзина доставки</h2>

<div class="page-profile-products__box-wrapper">
	<div class="page-profile-products__box">
		<img src="img/surprice.png" alt="product">
	</div>
	<div class="page-profile-products__box">
		<img src="img/surprice.png" alt="product">
	</div>
	<div class="page-profile-products__box">
		<img src="img/surprice.png" alt="product">
	</div>
	<div class="page-profile-products__box">
		<img src="img/surprice.png" alt="product">
	</div>
	<div class="page-profile-products__box">
		<img src="img/surprice.png" alt="product">
	</div>
</div>

<div class="page-profile-products__wrapper-btn">
	<a href="#" class="btn  btn--accent  page-profile-products__btn">Заказать доставку за 300 &#8381;</a>
</div>
</div>