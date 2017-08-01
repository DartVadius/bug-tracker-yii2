<?php

namespace app\modules\bugtracker\controllers;

use yii\web\Controller;
use app\modules\bugtracker\services\bugTrackerService;
use app\modules\bugtracker\models\repositories\Ticket;
use app\modules\bugtracker\forms\messageCabinetForm;
use app\modules\bugtracker\forms\ticketCabinetForm;
use Yii;

/**
 * Description of TicketPublicController
 *
 * @author DartVadius
 */
class TicketPublicController extends Controller {

    public function init() {
        $this->layout = "/main";
    }

    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex() {
        $ticketsModel = new Ticket();
        $tickets = $ticketsModel->find()->where(['user_id' => \yii::$app->user->identity->id])->all();
        $ticketAggregate = [];
        if (!empty($tickets)) {
            foreach ($tickets as $ticket) {
                $ticketAggregate[] = bugTrackerService::setTicketAggregate($ticket);
            }
        }
        return $this->render('index', [
                    'tickets' => $ticketAggregate,
        ]);
    }

    /**
     * Displays a single Ticket model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $ticketModel = new Ticket();
        $model = $ticketModel->findOne($id);
        $form = new messageCabinetForm();
        if (empty($model) || $model->user_id != \yii::$app->user->identity->id) {
            return $this->redirect(['index']);
        }
        return $this->render('view', [
                    'model' => bugTrackerService::setTicketAggregate($model),
                    'modelTicketMessages' => $form,
        ]);
    }

    public function actionCreateMessage($ticket_id) {
        $form = new messageCabinetForm();
        if (Yii::$app->request->isPost && $form->load(Yii::$app->request->post()) && $form->validate() && bugTrackerService::createMessage($ticket_id, $form)) {
            return $this->redirect(['view', 'id' => $ticket_id]);
        }
        return $this->redirect(['index']);
    }
    
    public function actionCreateTicket() {
        $form = new ticketCabinetForm();
        if (Yii::$app->request->isPost && $form->load(Yii::$app->request->post()) && $form->validate() && bugTrackerService::createTicket($form)) {
            return $this->redirect(['index']);
        }
        return $this->render('create-ticket', [
                    'model' => $form,
        ]);
    }

    public function actionSetStatus($val, $ticket_id) {
        bugTrackerService::changeStatus($val, $ticket_id);
        return $this->redirect(['index']);
    }

}
