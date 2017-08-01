<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\repositories\TicketMessages */

$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Тикет №' . $model->ticket->id, 'url' => ['ticket/view', 'id' => $model->ticket->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-messages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'upload' => $upload,
        'msg' => $msg,
    ])
    ?>
    <?php if (!empty($files)): ?>
        <?php foreach ($files as $file): ?>
            <img src="/uploads/<?= $file->file_name ?>" width="150">
            <a href="../ticket-files/delete?id=<?= $file->id ?>"><span class="glyphicon glyphicon-remove-sign" style="vertical-align: top" id="<?= $file->id ?>"></span></a>
            
        <?php endforeach; ?>
    <?php endif; ?>

</div>
