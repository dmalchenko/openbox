<?php
/* @var $this yii\web\View */

use app\models\User;
use app\modules\opencase\models\FreeCaseParam;
use yii\helpers\ArrayHelper;

/* @var integer $id */
/* @var integer $type */
/* @var array $case */
/* @var string $url */
/* @var integer $lastOpen */
/* @var integer $checkPay */

$box = [];
foreach ($case as $c) {
    $box[] = $c->item;
}
?>
<style>
    .free_rules {
        font-size: 15px;
        color: white;
    }

    .free_rules a {
        font-size: 15px;
        color: yellow;
    }

    .free-block {
        width: 50%;
        margin: auto;
    }
</style>
<a href="<?= Yii::$app->homeUrl ?>" class="link-return  navigation__link  navigation__link--active">< Вернуться к списку
    коробок</a>
<h2 class="title-h2  title-h2--big  page-box__title"><?= ($type == 0) ? 'Free box' : 'Коробка №' . $id ?></h2>

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

<?php

$freeBoxRules = <<<HTML
    <div class="page-box__boxes-header">
            <h5 style="color: white">Условия открытия:</h5>
    </div>

    <div class="free-block">
        <ul class="free_rules">
            <li>
                Авторизоваться через Вконтакте. %s
            </li>
            <li>
                Коробку можно открыть раз в 24 часа. %s
            </li>
            <li>
                Поделиться записью записью
                <a href="%s" target="_blank">%s</a>.
                ВНИМАНИЕ! Будьте внимательны, необходимо делать репост именно этой записи(нельзя делать
                репост репоста). Также Ваша стена должна быть открытой. %s
            </li>
            <li>
                    Вступить в группу <a href="https://vk.com/public40771573" target="_blank">VseBox</a> %s
            </li>
        </ul>
    </div>
HTML;
$user = User::getCurrentUser();

$opened = $lastOpen ? "(Вы открывали эту коробку " . date("d.m.Y H:i:s", ($lastOpen + 3600 * 3)) . ")" : '(выполнено)';
$loginvk = !Yii::$app->user->isGuest ? '(выполнено)' : '';
if ($user && $user->token && $type == 0) {
    $vk_user_id = ArrayHelper::getValue(explode('-', $user->token), '1');
    $freeCaseParam = FreeCaseParam::findOne(['id' => 1]);
    $eauth = Yii::$app->eauth->getIdentity('vkontakte');
    $isGroupMember = $eauth->isGroupMember($freeCaseParam->groupId, $vk_user_id) ? '(выполнено)' : '';
    $haveRepost = $eauth->haveRepost($freeCaseParam->groupId, $freeCaseParam->postId, $vk_user_id) ? '(выполнено)' : '';
    echo sprintf($freeBoxRules, $loginvk, $opened, $url, $url, $haveRepost, $isGroupMember);
} else if ($type == 0) {
    $haveRepost = $isGroupMember = '';
    echo sprintf($freeBoxRules, $loginvk, $opened, $url, $url, $haveRepost, $isGroupMember);
}
?>
<div class="page-box__wrapper-btn">
    <button id="#openb" class="btn  btn--accent" data-k="1"
            data-pay="<?= $checkPay?>"
            data-target="#modal-demo-0<?= Yii::$app->user->isGuest ? '1' : '3' ?>">
        Открыть коробку за <?= $type ?>&#8381;
    </button>
</div>

<div class="page-box__boxes-header">Коробка содержит:</div>

<div class="page-box__wrapper-boxes  box-4">
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

        if (this.getAttribute('data-pay') == 0) {
            $('#modal-demo-06').modal('show');
            return;
        }

        $.ajax({
            dataType: 'json',
            type: 'post',
            cache: false,
//            url: '<?//= Url::toRoute(['/opencase/game/run', 'caseType' => $type, 'a' => 1]) ?>//',
            url: "/opencase/game/run?caseType=<?= $type?>",
            data: {_csrf: csrfToken},
            success: function (data) {
                if (data.code == 200 & data.caseType == caseType & data.id > 0) {

                    for (var i = (rouletteItem.length / 10) * k; i < rouletteItem.length; i++) {
                        var r = rouletteItem[i].getAttribute('data-id');
                        if (data.id == r) {
                            break;
                        }
                    }
                    var s = (i - 3) * -150;
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
                    $('#modal-demo-03').modal('show');
                    $('#close-modal-3').one('click', function () {
                        $('#modal-demo-02').modal('show');
                    })
                } else if (data.code == 403) {
                    $('#free-case-error').html(data.msg);
                    $('#modal-demo-07').modal('show');
                    return;
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