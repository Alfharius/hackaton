<?php

use app\models\Intensive;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\IntensiveSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \app\models\Thematics[] $thematics */
/** @var \app\models\Users[] $lectors */

$this->title = 'Intensives';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intensive-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Intensive', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', [
        'model' => $searchModel,
        'thematics' => $thematics,
        'lectors' => $lectors
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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

    <?php Pjax::end(); ?>

</div>
