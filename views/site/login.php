<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php \yii\widgets\Pjax::begin([
        'formSelector' => '#login-form',
    ]) ?>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 validate-error'],
        ],
    ]); ?>

    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
    <br>
    <div>
        <label for="password"  class="password">Придумайте пароль</label><br>
        <div class="password">
            <input type="password" id="password-input" name="LoginForm[password]" required>
            <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
        </div>
    </div>
    <br>
    <?= Html::submitInput('Логин', ['name' => 'login-button']) ?>

    <?php ActiveForm::end(); ?>
    <?php \yii\widgets\Pjax::end() ?>
