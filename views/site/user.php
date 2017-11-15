<?php
/* @var $this yii\web\View */
/* @var User $user */
/* @var array $items */
/* @var integer $cntBox */
/* @var integer $cntSum */

use app\models\User;
use yii\helpers\Url;

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

<h2 class="page-profile-products__title">Открытые коробки</h2>
<div class="page-profile-products__box-wrapper js-product-wrapper box-4">
	<?php
	$boxTemplate = <<< HTML
    <div class="page-profile-products__box js-product-box">
        <img class="js-product-img" src="%s" alt="product">
    </div>
HTML;

	foreach ($items as $box) {
		echo sprintf($boxTemplate, $box->item->image);
	}
	?>

</div>