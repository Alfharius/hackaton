<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search">
    <?php $form = ActiveForm::begin([
        'id' => 'search-form',
        'fieldConfig' => [
            'template' => "{label}{input}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
        ],
        'action' => ['catalog'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]);
    $categories = \yii\helpers\ArrayHelper::map(\app\models\Categories::find()->all(), 'id', 'name');
    echo $form->field($model, 'category')->dropdownList($categories, [
        'prompt' => [
            'text' => 'Все',
            'options' => [
                'value' => '0'
            ]
        ],
        'onchange' => "$('#search-form')[0].submit()"
    ])
    ?>
    <?php ActiveForm::end(); ?>
</div>
