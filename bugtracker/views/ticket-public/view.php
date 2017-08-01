<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\aggregate\TicketAggregate */

$this->title = 'Тикет №' . $model->ticket->getTicketId();
$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['/profile']];
$this->params['breadcrumbs'][] = ['label' => 'Тикеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-public-view col-md-6 col-md-offset-3">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?=
        Html::a(($model->ticket->getStatus() == 'Открыт') ? 'Закрыть' : 'Открыть', [
            'set-status', 'val' => ($model->ticket->getStatus() == 'Открыт') ? 1 : 0, 'ticket_id' => $model->ticket->getTicketId()
                ], [
            'class' => 'btn btn-primary'
        ])
        ?>
    </p>
    <p>
        <span class="small badge badge-info">Тип: <?= $model->ticket->getTypeName() ?></span>
        <span class="small badge badge-info">Приоритет: <?= $model->ticket->getPriorityName() ?></span>
        <span class="small badge badge-info">Статус: <?= $model->ticket->getStatus() ?></span>
    </p>
    <p class="small"><?= $model->ticket->getDate() ?></p>
    <p><?= $model->ticket->getText() ?></p>
<?php if (!empty($model->ticket->getFiles())): ?>
        <p style="text-align: right">
        <?php foreach ($model->ticket->getFiles() as $file): ?>
                <a href="<?= $file->getPath() ?>"><img src="<?= $file->getPath() ?>" width="150" target="_blank"></a>
            <?php endforeach; ?>
        </p>

<?php endif; ?>
</div>  
<div class="ticket-public-view col-md-6 col-md-offset-3">
 <?=
    $this->render('/ticket-public/_form_message_create', [
        'model' => $modelTicketMessages,
        'ticket_id' => $model->ticket->id,
    ])
    ?>
<?php if (!empty($model->messages)): ?>
        <h3>Комментарии</h3>
        <?php foreach ($model->getMessages() as $message): ?>
            <div class="list-group">
                <p class="list-group-item active">
                    <span class="small"><?= $message->getDate(); ?></span>
                    <span class="small"><?= $message->getAuthorName(); ?></span>
                </p>
                <p class="list-group-item">
        <?= $message->getText() ?>
                </p>
                    <?php if (!empty($message->getFiles())): ?>
                    <p class="list-group-item" style="text-align: right">
                    <?php foreach ($message->getFiles() as $file): ?>
                            <a href="<?= $file->getPath() ?>"><img src="<?= $file->getPath() ?>" width="150" target="_blank"></a>
                        <?php endforeach; ?>
                    </p>    
                    <?php endif; ?>
            </div>
            <?php endforeach; ?>
    <?php endif; ?>

   

</div>