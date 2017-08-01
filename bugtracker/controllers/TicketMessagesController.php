<?php

namespace app\modules\bugtracker\controllers;

use Yii;
use app\modules\bugtracker\models\repositories\TicketMessages;
use app\modules\bugtracker\models\repositories\TicketMessagesSearch;
use app\modules\bugtracker\models\repositories\TicketFiles;
use app\modules\bugtracker\models\repositories\TicketUpload;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TicketMessagesController implements the CRUD actions for TicketMessages model.
 */
class TicketMessagesController extends BehaviorsController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST', 'GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all TicketMessages models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TicketMessagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TicketMessages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TicketMessages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($ticket_id = NULL) {
        $model = new TicketMessages();
        $model->ticket_id = $ticket_id;
        $file = new TicketFiles();
        $upload = new TicketUpload();

        if (Yii::$app->request->isPost) {
            $upload->imageFile = UploadedFile::getInstances($upload, 'imageFile');
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $file->message_id = $model->id;
                $upload->upload($file);
                return $this->redirect(['ticket/view', 'id' => $model->ticket_id]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'upload' => $upload,
            ]);
        }
    }

    /**
     * Updates an existing TicketMessages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {

        $msg = NULL;
        $model = $this->findModel($id);
        $file = new TicketFiles();
        $upload = new TicketUpload();
        if (Yii::$app->request->isPost) {
            $upload->imageFile = UploadedFile::getInstances($upload, 'imageFile');
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $file->message_id = $model->id;
                $msg = $upload->upload($file);
                if (empty($msg) || $msg === TRUE) {
                   return $this->redirect(['ticket/view', 'id' => $model->ticket_id]);
                }
            }
        }
        return $this->render('update', [
                    'model' => $model,
                    'upload' => $upload,
                    'files' => $model->ticketFiles,
                    'msg' => $msg,
        ]);
    }

    /**
     * Deletes an existing TicketMessages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
//        print_r($id);
//        die;        
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['ticket/view', 'id' => $model->ticket_id]);
    }

    /**
     * Finds the TicketMessages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TicketMessages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TicketMessages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
