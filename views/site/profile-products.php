<?php

/* @var $this yii\web\View */
/* @var \yii\data\ActiveDataProvider $basketDataProvider */

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

<?= GridView::widget([
	'dataProvider' => $basketDataProvider,
	'options' => [
	        'style' => [
	                'color' => '#fff'
            ]
    ],
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
		'token',
		'items.title',
		'items.image' => [
			'value' => function(\app\modules\opencase\models\Basket $model) {
				return Html::img($model->items->image);
			},
			'format' => 'raw',
			'label' =>  'image'
		],
		'items.cost_real',
		'created_dt' => [
			'value' => function (\app\modules\opencase\models\Basket $model) {
				return $model->created_at;
			},
			'format' => 'datetime',
			'label' =>  'date'
		]
	],
]); ?>

