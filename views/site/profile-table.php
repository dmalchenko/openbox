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
		<a href="<?= Url::toRoute(['/site/profile-products']) ?>" class="navigation__link">Мои товары</a>
		<a href="<?= Url::toRoute(['/site/profile-table']) ?>" class="navigation__link navigation__link--active">Мои доставки</a>
	</div>
</div>

<h2 class="page-profile-products__title">Корзина доставки</h2>

<div class="page-profile-table">
	<div class="page-profile-table__tr">
		<div class="page-profile-table__th">Товары</div>
		<div class="page-profile-table__th">Адрес</div>
		<div class="page-profile-table__th">Статус</div>
		<div class="page-profile-table__th">Трекинг-код</div>
		<div class="page-profile-table__th">Дата оформления</div>
	</div>
</div>