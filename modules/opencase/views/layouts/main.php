<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	<?php
	$cases = \app\modules\opencase\models\CaseType::getCases();
	$casesMenu[] = ['label' => 'Типы кейсов', 'url' => ['/opencase/case-type/index']];
	foreach ($cases as $case) {
		$casesMenu[] = ['label' => "Кейс {$case->type}", 'url' => ['/opencase/case-item/index', 'type' => $case->type]];
	}

	NavBar::begin([
		'brandLabel' => 'Vse box',
		'brandUrl' => Url::toRoute(['/opencase/item/index', 'type' => 100]),
		'options' => [
			'class' => 'navbar-inverse navbar-fixed-top',
		],
	]);
	echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'items' => [
			['label' => 'Кейсы', 'options' => ['id' => 'down_history'], 'items' => $casesMenu],
			['label' => 'Предметы', 'url' => ['/opencase/item/list']],
			['label' => 'Персональные подкрутки', 'url' => ['/opencase/gameconfig/index']],
			['label' => 'Пользователи', 'url' => ['/opencase/user/index']],
			['label' => 'Доставка', 'url' => ['/opencase/delivery/index']],

		],
	]);
	NavBar::end();
	?>

    <div class="container">
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= $content ?>
    </div>
</div>

<a href="//www.free-kassa.com/"><img src="//www.free-kassa.ru/img/fk_btn/9.png"></a>
<footer class="footer">
    <div class="container">
        <p class="pull-left">2017@VseBox</p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
