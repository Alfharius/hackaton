<?php

use app\models\Thematics;
use app\models\Users;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Intensive $model */
/** @var yii\widgets\ActiveForm $form */
/** @var \app\models\Users[] $lectors */

?>

<div class="w-1270 in-center">
    <div style="text-align: center;padding: 50px 0; background: gray;">
        <p>Лектор</p>
    </div>
    <div class="d-flex jc-sb" style="background: white; padding: 50px;" >
        <div>
            <div style="text-align: left;  color: black; padding: 20px; width: 30%;">gfgfgfgfg</div>
            <div style="  padding: 50px; width: 30%;"></div>
            <div style="text-align: left; color: black; padding: 20px; width: 30%;">rtrtrtrrtrt</div>
            <div style="  padding: 50px; width: 30%;"></div>
        </div>
        <div>
            <div style="  padding: 50px; width: 30%;"></div>
            <div style=" text-align: right; color: black; padding: 20px; width: 30%;">nnbnbnbnb</div>
            <div style="  padding: 50px; width: 30%;"></div>
            <div style="text-align: right; color: black; padding: 20px; width: 30%;">dsdsdsddsdsd</div>
        </div>


    </div>
    <div class="d-flex jc-sb" style="padding: 50px; background: gray;">
        <input type="text" class="chat-text-input" placeholder="Напишите сообщение">
        <input type="button" class="chat-button-input" value="Отправить">
    </div>
</div>