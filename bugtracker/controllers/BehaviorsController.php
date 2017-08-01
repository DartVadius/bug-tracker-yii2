<?php

namespace app\modules\bugtracker\controllers;

use Yii;
use yii\web\Controller;

class BehaviorsController extends Controller {

    public function init() {
        parent::init();
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->status != 20) {
            Yii::$app->getSession()->setFlash('error', 'У вас нет доступа в админ панель');
            return $this->goHome();
        }
    }

}
