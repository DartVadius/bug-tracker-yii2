<?php

namespace app\modules\bugtracker\models;
use app\modules\bugtracker\BugtrackerModule;

/**
 * Description of TicketBase
 *
 * @author DartVadius
 */
class TicketBase extends \yii\base\Model {
    protected $module;
    public function __construct($config = array()) {
        parent::__construct($config);
        $this->module = BugtrackerModule::getInstance()->params;
    }
}
