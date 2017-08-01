<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\repositories\TicketMessages */

$this->title = 'Сообщение №' . $model->id . ' (тикет №' . $model->ticket_id . ')';
$this->params['breadcrumbs'][] = ['label' => 'Тикет №' . $model->ticket_id, 'url' => ['ticket/view', 'id' => $model->ticket_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-messages-view">

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
            'id',
            'ticket_id',
            'text:ntext',
            'date',
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
        ],
    ])
    ?>

</div>
