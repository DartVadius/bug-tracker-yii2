<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\repositories\TicketFiles */

$this->title = 'Create Ticket Files';
$this->params['breadcrumbs'][] = ['label' => 'Ticket Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-files-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
