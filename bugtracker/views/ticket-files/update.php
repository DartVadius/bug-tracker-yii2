<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\repositories\TicketFiles */

$this->title = 'Update Ticket Files: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ticket Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ticket-files-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
