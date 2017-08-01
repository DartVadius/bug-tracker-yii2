<?php

namespace app\modules\bugtracker\models\aggregate;

use app\modules\bugtracker\models\aggregate\FileAggregate;
use app\modules\bugtracker\models\aggregate\MessageAggregate;
use app\modules\bugtracker\interfaces\iTicket;

/**
 * This is the model class for table "ticket".
 *
 *
 * @property iTicket $dto
 * @property MessageAggregate $message
 * @property FileAggregate $file
 */
class TicketAggregate {

    
    public $file = [];
    public $messages = [];
    public $ticket;

    public function __construct(iTicket $ticket) {
        $this->ticket = $ticket;
    }
    
    public function addMessage(Message $message) {
        $this->messages[] = $message;
        return $this;
    }
    
    public function addMessages(array $messages) {
        foreach ($messages as $message) {
            $this->addMessage($message);
        }
        return $this;
    }

    public function getMessages() {
        return $this->messages;
    }
    
    public function addFile(File $file) {
        $this->file[] = $file;
        return $this;
    }
    
    public function addFiles(array $files) {
        foreach ($files as $file) {
            $this->addFile($file);
        }
        return $this;
    }
    
    public function getFiles() {
        return $this->file;
    }

}
