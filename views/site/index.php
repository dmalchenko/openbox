<?php
/* @var $this yii\web\View */
/* @var $items \app\modules\opencase\models\CaseItem[] */

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php
$i = 0;

ksort($items);

/**
 * @var $case \app\modules\opencase\models\CaseItem[]
 */
foreach ($items as $id => $case) :
	$i++
	?>
    <div class="box-wrapper"
         onclick="window.location.href ='<?= Url::toRoute(['/site/box', 'id' => $id]) ?>';">
        <div class="box-wrapper__left">
            <div class="box boxColor<?= $id?>">
                <div class="box__header">
                    <div class="box__name">
                        Коробка
                        <div class="box__number">№<?= $i ?></div>
                    </div>
                    <div class="box__price"><?= $id?>&#8381;</div>
                </div>
                <div class="box__surprice">
                    <img src="img/surprice.png" alt="surprice">
                </div>
            </div>
            <a href="<?= Url::toRoute(['/site/box', 'id' => $id]) ?>" class="btn  btn--accent  box__btn">Открыть
                коробку</a>
            <div class="box-wrapper__text">
                Уже выдано
                <span class="box-wrapper__number">184 569 товаров</span>
            </div>
        </div>
        <div class="box-wrapper__right">
            <div class="box-wrapper__right-text">Коробка содержит <?= count($case) ?> товаров</div>
            <div class="box-wrapper__items">
				<?php
				foreach ($case as $item) {
					$s = '<div class="box-wrapper__item"><img src="%s" alt="surpise"></div>';
					if (isset($s, $item->item->image)) {
						echo sprintf($s, $item->item->image);
					}

				}
				?>
            </div>
        </div>
    </div>

	<?php
endforeach;
?>

</div>

<div class="guarantees">
    <div class="container">
        <h2 class="guarantees__title">Наши гарантии</h2>
        <div class="guarantees__wrapper">

            <div class="guarantees__item">
                <div class="guarantees__icon">
                    <img src="img/glasses.png" alt="glasses">
                </div>
                <h3 class="guarantees__subtitle">Полная прозрачность</h3>
                <p class="guarantees__text">
                    У нас вы можете посмотреть все. Кто получил, что получил и когда. Каждый профиль снабжен
                    ссылкой на контакт человека в одной из трех социальных сетей.
                </p>
            </div>

            <div class="guarantees__item">
                <div class="guarantees__icon">
                    <img src="img/money.png" alt="money">
                </div>
                <h3 class="guarantees__subtitle">Гарантия низких цен</h3>
                <p class="guarantees__text">
                    Благодаря крупным оптовым закупкам цены в нашем магазине на все товары одни из самых
                    низких на рынке.
                </p>
            </div>

            <div class="guarantees__item">
                <div class="guarantees__icon">
                    <img src="img/magnifier.png" alt="magnifier">
                </div>
                <h3 class="guarantees__subtitle">Проверенные товары</h3>
                <p class="guarantees__text">
                    Мы выкладываем только проверенные товары от надежных поставщиков. Каждый товар
                    тестируется перед отправкой и снабжается всей сопровождающей документацией.
                </p>
            </div>

        </div>
    </div>
</div>