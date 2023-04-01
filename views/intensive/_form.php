<?php

use app\models\Thematics;
use app\models\Users;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Intensive $model */
/** @var yii\widgets\ActiveForm $form */
/** @var \app\models\Thematics[] $thematics */
/** @var \app\models\Users[] $lectors */

$thematics = Thematics::find()->all();
?>


<div class="intensive-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'img')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitInput('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
