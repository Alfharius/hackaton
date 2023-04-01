<?php

use app\models\IntensiveRegisterForm;
use app\models\Thematics;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Intensive $model */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="info-intensiv w-1270 in-center container">

    <h1><?= Html::encode($this->title) ?></h1>

    <img src="uploads/<?=$model->img?>" alt="">
    <p>Тематики интенсива: <?php
        foreach ($model->intensivesThematics as $key => $thematic) {
            if (!array_key_exists($key+1, $model->intensivesThematics)) {
                echo Thematics::findOne($thematic->thematic_id)->name;
            } else {
                echo Thematics::findOne($thematic->thematic_id)->name.', ';
            }
        }?></p>
    <p>Лектор: <?= $model->lector->name.' '.$model->lector->surname.' '.$model->lector->patronymic?></p>

    <p>План интенсива:</p>
    <p class="plan">10.00 — 10.30. Регистрация участников семинара</p>
    <p class="plan">10.30 — 10.45. Организационные вопросы.</p>
    <p class="plan">10.45 — 13.00. Что-то...</p>
    <p class="plan">13.00 — 14.00. Перерыв</p>
    <p class="plan">14.00 — 15.30. Что-то...</p>
    <p class="plan">15.30 — 17.00. Конец</p>
    <p class="descript"><?= $model->description?></p>
    <a href="#" class="js-open-modal" data-modal="1"><input type="button" value="Записаться на интенсив"></a>
    <div class="modal mt-180" data-modal="1">
        <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/>
        </svg>
        <div class="intensive-form">

            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
            ]);
                $model = new IntensiveRegisterForm();
            ?>

            <?= $form->field($model, 'phone')->textInput() ?>

            <?= $form->field($model, 'email')->input('email') ?>

            <?= $form->field($model, 'institution')->textInput() ?>

            <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
    <div class="overlay js-overlay-modal"></div>
    <script src="/js/modal-windows.js"></script>

</div>
