<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\repositories\Ticket */

$this->title = 'Тикет №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Тикеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'title',
            'text:ntext',
            [
                'attribute' => 'user_id',
                'label' => 'Автор сообщения',
                'value' => function ($model) {
                    $user = new User();
                    $author = $user->findOne($model->user_id);
                    return (!empty($author->username)) ? $author->username : $author->email;
                }
            ],
            [
                'attribute' => 'type_id',
                'label' => 'Тип',
                'value' => $model->type->name,
            ],
            [
                'attribute' => 'priority_id',
                'label' => 'Приоритет',
                'value' => $model->priority->title,
            ],
            [
                'label' => 'Файлы',
                'value' => function ($model) {
                    $files = $model->ticketFiles;
                    if (empty($files)) {
                        return FALSE;
                    }
                    $responce = NULL;
                    foreach ($files as $file) {
                        $responce .= "<a href='/uploads/$file->file_name'><img src='/uploads/$file->file_name' width='150'></a>";
                    }
                    return $responce;
                },
                'format' => 'raw'
            ],
            'status:boolean',
            'date_update',
            'date_create',
        ],
    ])
    ?>

    <h3>Соообщения</h3>
    <?=
    GridView::widget([
        'dataProvider' => $dataProviderMessages,
        'columns' => [
            [
                'attribute' => 'date',
                'label' => 'Дата',
                'value' => 'date',
                'headerOptions' => ['width' => '150'],
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Автор сообщения',
                'value' => function ($model) {
                    $user = new User();
                    $author = $user->findOne($model->user_id);
                    return (!empty($author->username)) ? $author->username : $author->email;
                },
                'headerOptions' => ['width' => '150'],
            ],
//            'id',
//            'ticket_id',
            'text:ntext',
            [
                'label' => 'Файлы',
                'value' => function ($dataProviderMessages) {

                    $files = $dataProviderMessages->ticketFiles;
                    if (empty($files)) {
                        return FALSE;
                    }
                    $responce = NULL;
                    foreach ($files as $file) {
                        $responce .= "<a href='/uploads/$file->file_name'>$file->file_name</a> ";
                    }
                    return $responce;
                },
                'format' => 'raw',
                'headerOptions' => ['width' => '150'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'ticket-messages',
                'header' => 'Действия',
                'headerOptions' => ['width' => '100'],
                'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}',
            ],
        ],
    ]);
    ?>
    <?= $this->render('/ticket-messages/_form', [
        'model' => $modelTicketMessages,
        'upload' => $upload,
    ]) ?>

</div>
