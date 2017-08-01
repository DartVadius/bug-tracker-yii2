<?php

namespace app\modules\bugtracker\services;

use app\modules\bugtracker\interfaces\iMessage;
use app\modules\bugtracker\interfaces\iTicket;
use app\modules\bugtracker\models\aggregate\File;
use app\modules\bugtracker\models\aggregate\Message;
use app\modules\bugtracker\models\aggregate\TicketAggregate;
use app\modules\bugtracker\models\repositories\TicketUpload;
use app\modules\bugtracker\models\repositories\TicketFiles;
use app\modules\bugtracker\models\repositories\TicketMessages;
use app\modules\bugtracker\models\repositories\Ticket;
use app\modules\bugtracker\forms\ticketCabinetForm;
use app\modules\bugtracker\forms\messageCabinetForm;
use yii\web\UploadedFile;
use Yii;

/**
 * Description of bugTrackerService
 *
 * @author DartVadius
 */
class bugTrackerService {

    public static function setTicketFiles(iTicket $ticket) {
        $result = [];
        $files = $ticket->getFiles();
        foreach ($files as $file) {
            $result[] = new File($file);
        }
        return $result;
    }

    public static function setMessageFiles(iMessage $message) {
        $result = [];
        $files = $message->getFiles();
        foreach ($files as $file) {
            $result[] = new File($file);
        }
        return $result;
    }

    public static function setTicketAggregate(iTicket $ticket) {

        $ticketAggregate = new TicketAggregate($ticket);
        $ticketMessages = $ticket->getMessages();
        $messages = [];
        foreach ($ticketMessages as $ticketMessage) {
            $message = new Message($ticketMessage);
            $messageFiles = self::setMessageFiles($ticketMessage);
            $messages[] = $message->addFiles($messageFiles);
        }

        $ticketFiles = self::setTicketFiles($ticket);
        $ticketAggregate->addFiles($ticketFiles);
        $ticketAggregate->addMessages(array_reverse($messages));
        return $ticketAggregate;
    }

    public static function createMessage($ticketId, messageCabinetForm $form) {
        $file = new TicketFiles();
        $messageModel = new TicketMessages();
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $messageModel->ticket_id = $ticketId;
            $messageModel->text = $form->text;
            $messageModel->date = date('Y-m-d H:i:s');
            $messageModel->user_id = \yii::$app->user->id;
            $messageModel->insert();

            $file->message_id = $messageModel->id;
            self::uploadFiles($form, $file);

            $transaction->commit();
            self::sendEmail('Добавлен новый комментарий к тикету № ' . $ticketId);
            return TRUE;
        } catch (Exception $ex) {
            $transaction->rollback();
            return FALSE;
        }
    }

    public static function createTicket(ticketCabinetForm $form) {
        $file = new TicketFiles();
        $ticketModel = new Ticket();
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $ticketModel->user_id = \yii::$app->user->id;
            $ticketModel->title = $form->title;
            $ticketModel->text = $form->text;
            $ticketModel->priority_id = $form->priority_id;
            $ticketModel->type_id = $form->type_id;
            $ticketModel->status = 0;
            $ticketModel->date_create = $ticketModel->date_update = date('Y-m-d H:i:s');
            $ticketModel->insert();

            $file->ticket_id = $ticketModel->id;
            self::uploadFiles($form, $file);

            $transaction->commit();
            self::sendEmail('Пользователь ' . $ticketModel->getAuthorName() . ' добавил новый тикет');
            return TRUE;
        } catch (Exception $ex) {
            $transaction->rollback();
            return FALSE;
        }
    }

    public static function changeStatus($val, $ticket_id) {

        $ticketModel = new Ticket();
        $ticket = $ticketModel->findOne($ticket_id);
        $ticket->status = $val;
        $ticket->update();
        return TRUE;
    }

    private static function sendEmail($message) {
        Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->user->identity->email)
//                ->setTo('vad261275@gmail.com')
                ->setTo(Yii::$app->params['supportEmail'])
                ->setSubject('Багтрекер')
                ->setTextBody($message)
                ->send();
    }

    private static function uploadFiles($form, $file) {
        $upload = new TicketUpload();
        $upload->imageFile = UploadedFile::getInstances($form, 'imageFile');
        $upload->upload($file);
        return TRUE;
    }

}
