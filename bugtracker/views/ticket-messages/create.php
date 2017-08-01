<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\repositories\TicketMessages */

$this->title = 'Ответить';
$this->params['breadcrumbs'][] = ['label' => 'Тикет №' . $model->ticket->id, 'url' => ['ticket/view', 'id' => $model->ticket->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-messages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'upload' => $upload,
    ]) ?>

</div>
