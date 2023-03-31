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

    <?= $form->field($model, 'lector_id')->dropDownList($lectors, [
        'id'=>'lectorName',
        'prompt' => [
            'text' => 'Лектор',
            'options' => [
                'value' => '0'
            ]
        ],
    ]) ?>


    <?php
    echo Html::label('Название тематики', 'thematic_id');
    echo Html::checkboxList('thematic_id', null, $thematics, [
        'class' => 'd-flex d-col',
        'data-toggle' => 'buttons',
        'item' => function ($index, $thematic, $name, $checked) {
            return '<label class="' . ($checked ? ' active' : '') . '">' . $thematic->name . '</label>' .
                Html::checkbox($name, $checked, ['value' => $thematic->id, 'class' => 'project-status-btn']) ;
        },
//        'onchange' => "$('#search-form')[0].submit()"
    ]) ?>

    <div class="form-group">
        <?= Html::submitInput('Search') ?>
        <?= Html::resetInput('Reset') ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
