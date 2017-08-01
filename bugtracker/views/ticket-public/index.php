<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\bugtracker\models\TicketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тикеты';
$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['/profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-public-index col-md-8 col-md-offset-2">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить тикет', ['create-ticket'], ['class' => 'btn btn-success']) ?>
    </p>
    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
<!--        <col width="90">
        <col width="160">
        <col>
        <col width="100">
        <col width="100">
        <col width="90">
        <col width="90">-->
        <th>№</th>
        <th>Дата</th>
        <th>Заголовок</th>
        <th>Тип</th>
        <th>Приоритет</th>
        <th>Статус</th>
        <th>Действия</th>
        </thead>
        <tbody>
            <?php if (empty($tickets)): ?>
                <tr>Ничего не найдено</tr>
            <?php else: ?>
                <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td><?= $ticket->ticket->id ?></td>
                        <td><?= $ticket->ticket->date_update ?></td>
                        <td><?= $ticket->ticket->getTitle() ?></td>
                        <td><?= $ticket->ticket->getTypeName() ?></td>
                        <td><?= $ticket->ticket->getPriorityName(); ?></td>
                        <td><?= $ticket->ticket->getStatus(); ?></td>
                        <td>
                            <a href="view?id=<?= $ticket->ticket->getTicketId(); ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Подробнее"></span></a>&nbsp;&nbsp;
                                <?=
                                Html::a(($ticket->ticket->getStatus() == 'Открыт') ? '<span class="glyphicon glyphicon-saved" aria-hidden="true" title="Закрыть"></span>' : '<span class="glyphicon glyphicon-open" aria-hidden="true" title="Открыть"></span>', [
                                    'set-status', 'val' => ($ticket->ticket->getStatus() == 'Открыт') ? 1 : 0, 'ticket_id' => $ticket->ticket->getTicketId()
                                ])
                                ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</div>
