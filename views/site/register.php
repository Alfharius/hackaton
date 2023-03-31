<?php

use app\models\RegisterForm;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model RegisterForm */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Регистрация';
?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php \yii\widgets\Pjax::begin([
        'formSelector' => '#register-form',
    ]) ?>
    <?php $form = ActiveForm::begin([
        'id' => 'register-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 validate-error'],
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


    <div>
        <label for="password"  class="password">Придумайте пароль</label><br>
        <div class="password">
            <input type="password" id="password-input" name="RegisterForm[password]" required>
            <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
        </div>
    </div>

    <div>
        <label for="password_confirm" class="password">Повторите пароль</label><br>
        <div class="password">
            <input type="password" id="password-input-2" name="RegisterForm[password_repeat]" required>
            <a href="#" class="password-control-2" onclick="return show_hide_password_2(this);"></a>
        </div>
    </div>


    <?= $form->field($model, 'checkbox')->checkbox(['maxlength' => true]) ?>

    <?= Html::submitInput('Зарегестрироваться', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
    <?php \yii\widgets\Pjax::end() ?>
