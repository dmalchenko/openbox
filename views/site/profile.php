<?php
/* @var $this yii\web\View */
/* @var User $user */
/* @var integer $cntBox */
/* @var integer $cntSum */
/* @var \app\modules\opencase\models\DeliveryAddress $address */
/* @var boolean $partnerSet */
/* @var integer $code */

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="page-profile__top-wrapper">
    <div class="page-profile__wrapper-balance">
        <div class="page-profile__balance">
            Баланс:
            <span class="page-profile__balance-number"><?= $user->money ?> &#8381;</span>
        </div>
        <div class="btn  page-profile__balance-btn" data-toggle="modal"
             data-target="#modal-demo-02">Пополнить
        </div>
    </div>
    <div class="navigation  page-profile__navigation">
        <a href="<?= Url::toRoute(['/site/profile']) ?>" class="navigation__link  navigation__link--active">Профиль</a>
        <a href="<?= Url::toRoute(['/site/profile-products']) ?>" class="navigation__link">Мои товары</a>
        <a href="<?= Url::toRoute(['/site/profile-table']) ?>" class="navigation__link">Мои доставки</a>
        <a href="<?= Url::toRoute(['/site/profile-partner']) ?>" class="navigation__link">Партнёрская программа</a>
    </div>
</div>

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

<div class="page-profile__dark-card-wrapper">
	<?php
	$partnerInput = <<< HTML
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
HTML;

	$partnerNoInput = <<< HTML
        <div class="page-profile__dark-card">
            <div class="page-profile__dark-card-header">Вы уже ввели партнерский код</span></div>
        </div>
HTML;

	echo ($partnerSet) ? $partnerNoInput : $partnerInput;
	?>

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

<div class="page-profile__dark-card  page-profile__dark-card-delivery">
    <div class="page-profile__dark-card-title">Анкета для доставки товаров</div>
	<?php $form = ActiveForm::begin(['class' => 'page-profile__form-delivery']); ?>

    <div class="page-profile__form-row">
        <label class="field-text  field-text-delivery">
            <span class="field-text__name">Фамилия Имя Отчество</span>
            <span class="field-text__input-wrap">
                <?= $form->field($address, 'name')->textInput(['class' => 'field-text__input']) ?>
            </span>
        </label>

        <label class="field-text  field-text-delivery">
            <span class="field-text__name">Улица</span>
            <span class="field-text__input-wrap">
                <?= $form->field($address, 'street')->textInput(['class' => 'field-text__input']) ?>
            </span>
        </label>
    </div>

    <div class="page-profile__form-row">
        <label class="field-text  field-text-delivery">
            <span class="field-text__name">Страна</span>
            <span class="field-text__input-wrap">
                <?= $form->field($address, 'country')->textInput(['class' => 'field-text__input']) ?>
            </span>
        </label>

        <label class="field-text  field-text-delivery">
            <span class="field-text__name">Дом, корпус, строение</span>
            <span class="field-text__input-wrap">
                <?= $form->field($address, 'home')->textInput(['class' => 'field-text__input']) ?>
            </span>
        </label>
    </div>

    <div class="page-profile__form-row">
        <label class="field-text  field-text-delivery">
            <span class="field-text__name">Город</span>
            <span class="field-text__input-wrap">
                <?= $form->field($address, 'city')->textInput(['class' => 'field-text__input']) ?>
            </span>
        </label>

        <label class="field-text  field-text-delivery">
            <span class="field-text__name">Квартира / офис</span>
            <span class="field-text__input-wrap">
                <?= $form->field($address, 'room')->textInput(['class' => 'field-text__input']) ?>
            </span>
        </label>
    </div>

    <div class="page-profile__form-row">
        <label class="field-text  field-text-delivery">
            <span class="field-text__name">Индекс</span>
            <span class="field-text__input-wrap">
				<?= $form->field($address, 'index')->textInput(['class' => 'field-text__input']) ?>
            </span>
        </label>
        <br>
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'style' => ['margin-top' => '50px']]) ?>
    </div>
	<?php ActiveForm::end(); ?>
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