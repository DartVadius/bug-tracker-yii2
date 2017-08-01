<?php

namespace app\modules\bugtracker\models\aggregate;

use app\modules\bugtracker\interfaces\iMessage;
use app\modules\bugtracker\models\aggregate\FileAggregate;

/**
 * Description of messages
 *
 * @author DartVadius
 */
class Message {

    private $message;
    private $files = [];

    public function __construct(iMessage $message) {
        $this->message = $message;
    }
    
    public function getText() {
        return $this->message->getText();
    }

    public function getTicketId() {
        return $this->message->getTicketId();
    }

    public function getAuthorName() {
        return $this->message->getAuthorName();
    }
    
    public function getDate() {
        return $this->message->getDate();
    }
    
    public function addFile(File $file) {
        $this->files[] = $file;
        return $this;
    }
    
    public function addFiles(array $files) {
        foreach ($files as $file) {
            $this->addFile($file);
        }
        return $this;
    }
    
    public function getFiles() {
        return $this->files;
    }

}
