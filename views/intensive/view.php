<?php

use app\models\IntensiveRegisterForm;
use app\models\Thematics;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Intensive $model */
/** @var app\models\Schedule $schedules */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="info-intensiv w-1270 in-center container">

    <h1><?= Html::encode($this->title) ?></h1>

    <img src="uploads/<?= $model->img ?>" alt="">
    <p>Тематики интенсива: <?php
        foreach ($model->intensivesThematics as $key => $thematic) {
            if (!array_key_exists($key + 1, $model->intensivesThematics)) {
                echo Thematics::findOne($thematic->thematic_id)->name;
            } else {
                echo Thematics::findOne($thematic->thematic_id)->name . ', ';
            }
        } ?></p>
    <p>Лектор: <?= $model->lector->name . ' ' . $model->lector->surname . ' ' . $model->lector->patronymic ?></p>

    <p>План интенсива:</p>
    <?php $user = Yii::$app->user->identity;

    foreach ($model->schedules as $schedule) { ?>
        <p class="plan"><?= $schedule->getStartTime() ?> — <?= $schedule->getEndTime() ?>. <?= $schedule->name ?></p>
        <?php
        echo Html::a('&times;', ['intensives/remove-schedule', 'id' => $model->id, 'schedule_id' => $schedule->id]);
    } ?>
    <p class="descript"><?= $model->description ?></p>
    <?php
    echo Html::a('Добавить пункт плана', ['intensives/add-schedule', 'id' => $model->id]);
    if (!is_null($user) &&
        !\app\models\UsersFormsIntensives::find()->where(['intensive_id' => $model->id])->andWhere(['user_id' => $user->id])->exists() &&
        !Yii::$app->user->identity->isAdmin()) {
        ?>
        <a href="#" class="js-open-modal" data-modal="1"><input type="button" value="Записаться на интенсив"></a>
        <div class="modal mt-180" data-modal="1">
            <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/>
            </svg>
            <div class="intensive-form">

                <?php $form = ActiveForm::begin([
                    'id' => 'register-form',
                    'layout' => 'horizontal',
                    'action' => '/index.php?r=intensive%2Fregister&id=' . $model->id,
                    'fieldConfig' => [
                        'errorOptions' => ['class' => 'col-lg-7 validate-error'],
                    ],
                ]);
                $model = new IntensiveRegisterForm();
                ?>

                <?= $form->field($model, 'phone')->textInput() ?>

                <?= $form->field($model, 'email')->input('email') ?>

                <?= $form->field($model, 'institution')->textInput() ?>

                <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

                <div class="form-group">
                    <?= Html::submitInput('Отправить') ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div>
        <div class="overlay js-overlay-modal"></div>
    <?php } ?>
</div>
