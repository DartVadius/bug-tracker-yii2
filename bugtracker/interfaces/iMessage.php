<?php

namespace app\modules\bugtracker\interfaces;

/**
 *
 * @author vad
 */
interface iMessage {

    public function getAuthorName();

    public function getText();

    public function getTicketId();

    public function getFiles();
    
    public function getDate();
}
