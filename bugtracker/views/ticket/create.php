<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\repositories\Ticket */

$this->title = 'Добавить тикет';
$this->params['breadcrumbs'][] = ['label' => 'Тикеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'upload' => $upload,
    ]) ?>

</div>
