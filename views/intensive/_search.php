<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\IntensiveSearch $model */
/** @var yii\widgets\ActiveForm $form */
/** @var \app\models\Thematics[] $thematics */
/** @var \app\models\Users[] $lectors */?>

<div class="intensive-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?php
    echo Html::label('Лектор', 'lectorName');
    echo Html::dropDownList('lectorName',null, $lectors, [
            'id'=>'lectorName',
            'prompt' => [
            'text' => 'Лектор',
            'options' => [
                'value' => '0'
            ]
        ],
    ]) ?>

    <?= Html::radioList('thematic_id', null, $thematics, [
        'class' => 'btn-group',
        'data-toggle' => 'buttons',
        'item' => function ($index, $thematic, $name, $checked) {
            return '<label class="btn btn-primary' . ($checked ? ' active' : '') . '">' .
                Html::radio($name, $checked, ['value' => $thematic->id, 'class' => 'project-status-btn']) . $thematic->name . '</label>';
        },
//        'onchange' => "$('#search-form')[0].submit()"
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
