<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Intensive $model */

$this->title = 'Update Intensive: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Intensives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="intensive-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
