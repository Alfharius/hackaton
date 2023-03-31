<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Intensive $model */

$this->title = 'Create Intensive';
$this->params['breadcrumbs'][] = ['label' => 'Intensives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intensive-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
