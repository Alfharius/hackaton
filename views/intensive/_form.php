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
$lectors = ArrayHelper::map(Users::find()->select(['id', 'name'])->where(['type' => Users::TYPE_LECTOR])->asArray()->all(),  'id', 'name');
?>


<div class="intensive-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'img')->fileInput() ?>

    <?php
    echo Html::label('Лектор', 'lectorName');
    echo $form->field($model, 'lector_id')->dropDownList($lectors, [
        'id'=>'lectorName',
        'prompt' => [
            'text' => 'Лектор',
            'options' => [
                'value' => '0'
            ]
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
