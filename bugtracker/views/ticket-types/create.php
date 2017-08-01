<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\repositories\TicketTypes */

$this->title = 'Типы тикетов';
$this->params['breadcrumbs'][] = ['label' => 'Типы тикетов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
