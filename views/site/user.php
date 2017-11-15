<?php
/* @var $this yii\web\View */
/* @var User $user */
/* @var integer $cntBox */
/* @var integer $cntSum */

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>


<div class="page-profile__person-wrapper">
	<div class="page-profile__person">
		<img src="<?= $user->getAvatar() ?>" alt="person" class="page-profile__person-photo">
		<div class="page-profile__person-text">
			<div class="page-profile__person-name"><?= $user->name ?></div>
			<a href="<?= Url::toRoute(['/site/logout']) ?>" class="page-profile__person-out">Выйти</a>
		</div>
	</div>

	<div class="page-profile__box-wrapper">
		<div class="page-profile__box">
			<div class="page-profile__box-icon">
				<svg width="70" height="70">
					<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="img/sprite-svg.svg#box"></use>
				</svg>
			</div>
			<div class="page-profile__box-text">Открыто коробок <span><?= $cntBox ?></span></div>
			<div class="page-profile__box-text">На сумму <span><?= $cntSum ?> &#8381;</span></div>
		</div>
	</div>
</div>
