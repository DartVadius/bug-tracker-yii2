<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use app\modules\bugtracker\models\repositories\TicketTypes;
use app\modules\bugtracker\models\repositories\TicketPriority;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\bugtracker\models\TicketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тикеты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить тикет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-hover table-condensed',
        ],
        'columns' => [
            [
                'attribute' => 'id',
                'label' => '№ тикета',
                'value' => 'id',
                'options' => ['width' => '100'],
            ],
            [
                'attribute' => 'date_create',
                'label' => 'Дата создания',
                'value' => 'date_create',
                'options' => ['width' => '150'],
            ],
            'title',
            [
                'attribute' => 'user_id',
                'label' => 'Автор сообщения',
                'value' => function ($model) {
                    $user = new User();
                    $author = $user->findOne($model->user_id);
                    return (!empty($author->username)) ? $author->username : $author->email;
                },
                'options' => ['width' => '100'],
            ],
            [
                'attribute' => 'type_id',
                'label' => 'Тип',
                'value' => 'type.name',
                'filter' => TicketTypes::find()->select(['name', 'id'])->indexBy('id')->column(),
                'options' => ['width' => '100'],
            ],
            [
                'attribute' => 'priority_id',
                'label' => 'Приоритет',
                'value' => 'priority.title',
                'filter' => TicketPriority::find()->select(['title', 'id'])->indexBy('id')->column(),
                'options' => ['width' => '100'],
            ],
//            'type_id',
//            'priority_id',
//            'date_update',
            'status:boolean',
            // 'file',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'headerOptions' => ['width' => '100'],
                'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}',
            ],
        ],
    ]);
    ?>
</div>
