<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\repositories\TicketPriority */

$this->title = 'Добавить приоритет';
$this->params['breadcrumbs'][] = ['label' => 'Приоритеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-priority-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
