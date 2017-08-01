<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\repositories\TicketMessages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-messages-form">

    <?php
    $form = ActiveForm::begin([
                'action' => ['ticket-public/create-message', 'ticket_id' => $ticket_id],
    ]);
    ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'imageFile[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Файлы') ?>
    

    <div class="form-group">
        <?= Html::submitButton('Ответить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
