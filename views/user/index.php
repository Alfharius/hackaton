<?php

use app\models\Intensive;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'IntensIF | '.Yii::$app->user->identity->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1>Мои интенсивы</h1>

    <div class="d-flex f-w-wrap jc-sa">

        <a href="" class="intensiv-block">
            <img src="../images/img.png" alt="">
            <p class="date">дата и время</p>
            <h5>Заг1</h5>
            <p class="descript">Description</p>
        </a>


    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'lector_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Intensive $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>
