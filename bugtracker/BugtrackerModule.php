<?php

namespace app\modules\bugtracker;

class BugtrackerModule extends \yii\base\Module {

    public $controllerNamespace = 'app\modules\bugtracker\controllers';
    public $layout = '@app/modules/admin/views/layouts/base';

    public function init() {
        $this->params['max_files'] = 3;
        $this->params['path_to_files'] = 'uploads';
        $this->params['email'] = \Yii::$app->params['supportEmail'];
        parent::init();
    }

}
