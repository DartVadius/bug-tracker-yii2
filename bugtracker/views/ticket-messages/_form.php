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
                'action' => ['ticket-messages/' . (($model->isNewRecord) ? 'create' : 'update?id=' . $model->id)],
    ]);
    ?>

    <?= $form->field($model, 'ticket_id')->hiddenInput(['value' => $model->ticket_id])->label(FALSE) ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(FALSE) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6])->label('Комментарий') ?>

    <?= $form->field($upload, 'imageFile[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Файлы') ?>
    <?php
    if (isset($msg) && $msg !== NULL) {
        echo "<span>$msg</span>";
    }
    ?>

        <?= $form->field($model, 'date')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(FALSE) ?>

    <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Ответить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
