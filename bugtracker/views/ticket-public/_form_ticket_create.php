<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\bugtracker\models\repositories\TicketTypes;
use app\modules\bugtracker\models\repositories\TicketPriority;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\repositories\Ticket */
/* @var $model app\modules\bugtracker\models\repositories\TicketFiles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(['action' => 'create-ticket','options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php
    $types = TicketTypes::find()->all();
    $type = ArrayHelper::map($types, 'id', 'name');
    $typeParams = [
        'prompt' => 'Выберите тип',
    ];

    $prioritys = TicketPriority::find()->all();
    $priority = ArrayHelper::map($prioritys, 'id', 'title');
    $priorParams = [
        'prompt' => 'Выберите приоритет',
    ];
    ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type_id')->dropDownList($type, $typeParams)->label('Тип') ?>
    
    <?= $form->field($model, 'priority_id')->dropDownList($priority, $priorParams)->label('Приоритет') ?>
    
    <?= $form->field($model, 'imageFile[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Файлы') ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
