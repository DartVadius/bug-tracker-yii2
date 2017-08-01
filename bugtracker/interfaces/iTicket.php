<?php

namespace app\modules\bugtracker\interfaces;

/**
 *
 * @author vad
 */
interface iTicket {

    public function getAuthorName();

    public function getText();

    public function getTypeName();

    public function getPriorityName();

    public function getStatus();

    public function getMessages();

    public function getFiles();
    
    public function getTicketId();
    
    public function getAuthorId();
    
    public function getDate();
}
