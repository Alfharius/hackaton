<?php

use app\models\Thematics;
use app\models\Users;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Intensive $model */
/** @var app\models\Chats $chat */
/** @var \app\models\Users[] $lectors */

?>

<div class="w-1270 in-center">
    <div style="text-align: center;padding: 50px 0; background: gray;">
        <p><?php
            $user = Yii::$app->user->identity;
            if ($user->isAdmin()) {
                echo $chat->user->name.' '.$chat->user->surname.' '.$chat->user->patronymic;
            } else {
                echo $model->lector->name.' '.$model->lector->surname.' '.$model->lector->patronymic;
            }
            ?></p>
    </div>
    <div class="d-flex jc-sb" style='background: white; padding: 50px; flex-direction: column'>


        <?php
            foreach ($chat->messages as $message) {
                if ($message->user_id != $user->id)
                    echo '<div style="color: black; float: left; margin-right: auto">'.$message->text.'</div>';
                else
                    echo '<div style="color: black; float: right; margin-left: auto">'.$message->text.'</div>';
            }
        ?>

    </div>
    <div class="d-flex jc-sb" style="padding: 50px; background: gray;">
        <div class="intensive-form">

            <?php $form = ActiveForm::begin([
                'id' => 'register-form',
                'action' => '/index.php?r=intensive%2Fsend&uid=' . $user->id.'&cid='.$chat->id.'&iid='.$model->id,
                'fieldConfig' => [
                    'errorOptions' => ['class' => 'col-lg-7 validate-error'],
                ],
            ]);
            $formModel = new \app\models\MessageForm();
            ?>

            <?= $form->field($formModel, 'text')->textInput() ?>

            <div class="form-group">
                <?= Html::submitInput('Отправить') ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>