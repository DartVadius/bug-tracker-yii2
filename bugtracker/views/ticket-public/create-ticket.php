<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\aggregate\TicketAggregate */

$this->title = 'Добавить тикет';
$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['/profile']];
$this->params['breadcrumbs'][] = ['label' => 'Тикеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-public-view col-md-6 col-md-offset-3">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('/ticket-public/_form_ticket_create', [
        'model' => $model,
    ])
    ?>

</div>