<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

/* @var integer $id */
/* @var integer $type */
/* @var array $case */

$box = [];
foreach ($case as $c) {
    $box[] = $c->item;
}

?>

<a href="<?= Yii::$app->homeUrl ?>" class="link-return  navigation__link  navigation__link--active">< Вернуться к списку
    коробок</a>
<h2 class="title-h2  title-h2--big  page-box__title">Коробка №<?= $id ?></h2>

<div class="roulette-line">
    <div class="roulette-wrapper__mid">
        <div class="roulette-wrapper__mid-layer">
            <div class="roulette-wrapper__mid-line roulette-wrapper__mid-line_top"></div>
            <div class="roulette-wrapper__mid-line roulette-wrapper__mid-line_bottom"></div>
        </div>
    </div>
    <div class="roulette-wrapper">
        <div class="roulette-wrapper__shadow roulette-wrapper__shadow_left"></div>
        <div class="roulette-wrapper__shadow roulette-wrapper__shadow_right"></div>
        <div class="roulette">
			<?php
			$itemHtml = <<<HTML
 <div class="item" data-id="%s"><img src="%s" title="%s"/></div>
HTML;
			/**
			 * @var \app\modules\opencase\models\Items $item
			 */
			foreach ($box as $item) {
				echo sprintf($itemHtml, $item->id, $item->image, $item->title);
			}
			/**
			 * @var \app\modules\opencase\models\Items $item
			 */
			foreach ($box as $item) {
				echo sprintf($itemHtml, $item->id, $item->image, $item->title);
			}
			/**
			 * @var \app\modules\opencase\models\Items $item
			 */
			foreach ($box as $item) {
				echo sprintf($itemHtml, $item->id, $item->image, $item->title);
			}
			/**
			 * @var \app\modules\opencase\models\Items $item
			 */
			foreach ($box as $item) {
				echo sprintf($itemHtml, $item->id, $item->image, $item->title);
			}
			/**
			 * @var \app\modules\opencase\models\Items $item
			 */
			foreach ($box as $item) {
				echo sprintf($itemHtml, $item->id, $item->image, $item->title);
			}
			/**
			 * @var \app\modules\opencase\models\Items $item
			 */
			foreach ($box as $item) {
				echo sprintf($itemHtml, $item->id, $item->image, $item->title);
			}
			/**
			 * @var \app\modules\opencase\models\Items $item
			 */
			foreach ($box as $item) {
				echo sprintf($itemHtml, $item->id, $item->image, $item->title);
			}
			/**
			 * @var \app\modules\opencase\models\Items $item
			 */
			foreach ($box as $item) {
				echo sprintf($itemHtml, $item->id, $item->image, $item->title);
			}
			/**
			 * @var \app\modules\opencase\models\Items $item
			 */
			foreach ($box as $item) {
				echo sprintf($itemHtml, $item->id, $item->image, $item->title);
			}
			/**
			 * @var \app\modules\opencase\models\Items $item
			 */
			foreach ($box as $item) {
				echo sprintf($itemHtml, $item->id, $item->image, $item->title);
			}

			?>
        </div>
    </div>
</div>

<div class="page-box__wrapper-btn">
    <button id="#openb" class="btn  btn--accent" data-k="1"
            data-target="#modal-demo-0<?= Yii::$app->user->isGuest ? '1' : '3' ?>">Открыть коробку
        за <?= $type ?>
        &#8381;
    </button>
</div>

<div class="page-box__boxes-header">Коробка содержит:</div>

<div class="page-box__wrapper-boxes">
	<?php
	/**
	 * @var \app\modules\opencase\models\Items $item
	 */
	foreach ($box as $item) {
		$s = '<div class="page-box__wrapper-box"><div class="page-box__wrapper-box-name">%s</div><div class="page-box__box">
			<img src="%s" alt="%s"></div></div>';
		echo sprintf($s, $item->title, $item->image, $item->title);
	}
	?>

</div>
<script>
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var open = document.getElementById('#openb');
    var rouletteItem = document.querySelectorAll('.item');
    var roulette = $('.roulette');
    var caseType = <?=$type?>;


    $('#cb').on('click', function () {
        for (var i = 0; i < rouletteItem.length; i++) {
//            console.log(rouletteItem[i].style.transform);
            rouletteItem[i].style.transform = 'translateX(0px)';
        }
    });

    open.onclick = function () {
        var k = this.getAttribute('data-k');
        if (k == 1) {
            k = 8;
        } else {
            k = 1;
        }
        this.setAttribute('data-k', k);

        if (this.getAttribute('data-target') == "#modal-demo-01") {
            $('#modal-demo-01').modal('show');
            return;
        }

        $.ajax({
            dataType: 'json',
            url: '<?= Url::toRoute(['/opencase/game/run', 'caseType' => $type]) ?>',
            data: {_csrf: csrfToken},
            success: function (data) {
                if (data.code == 200 & data.caseType == caseType & data.id > 0) {

                    for (var i = (rouletteItem.length / 10) * k ; i < rouletteItem.length; i++) {
                        var r = rouletteItem[i].getAttribute('data-id');
                        if (data.id == r) {
                            break;
                        }
                    }
                    var s = (i - 3) * -150;s
//                    console.log(Math.floor(rouletteItem.length / k), i, k);
                    for (var i = 0; i < rouletteItem.length; i++) {
                        rouletteItem[i].style.transform = 'translateX(' + s + 'px)';
                    }
                    setTimeout(function () {
                        $('#modal-demo-04').modal('show');
                    }, 3500);

                    $('.main-nav__link-user-balance').html(data.balance + ' &#8381;');
                    $('#modal-img-prize').attr('src', data.img);
                    $('.modal__title-prize').html(data.title);
                    var bsell = $('.modal__btn--mr');
                    bsell.html('Продать за ' + data.cost_sell + ' &#8381;');
                    bsell.attr('data-sell', data.cost_sell);
                    bsell.attr('data-bid', data.bid);
                    bsell.attr('data-id', data.id);
                } else if (data.code == 402) {
                    $('#modal-demo-04').modal('show');
                    $('.modal__title').html(data.msg);
                } else if (data.code != 200) {
                    console.log(data.msg);
                } else {
                    alert('Произошла внутренняя ошибка, попробуйте позже');
                }
                console.log(data);
            }
        });
    };
</script>