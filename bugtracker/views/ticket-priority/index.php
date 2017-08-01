<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\bugtracker\models\repositories\TicketPrioritySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Приоритеты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-priority-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить приоритет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'title',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'headerOptions' => ['width' => '100'],
                'template' => '{update}&nbsp;&nbsp;{delete}',
            ],
        ],
    ]);
    ?>
</div>
