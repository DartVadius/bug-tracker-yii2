<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\bugtracker\models\repositories\TicketFilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ticket Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-files-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ticket Files', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ticket_id',
            'message_id',
            'file_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
