<?php

use yii\helpers\Html;
use Yii;

/* @var $this yii\web\View */
/* @var $model app\modules\bugtracker\models\repositories\Ticket */


$this->title = 'Редактировать тикет №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Тикеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Тикет №' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="ticket-update">

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