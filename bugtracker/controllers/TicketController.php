<?php

namespace app\modules\bugtracker\controllers;

use Yii;
use app\modules\bugtracker\models\repositories\Ticket;
use app\modules\bugtracker\models\repositories\TicketSearch;
use app\modules\bugtracker\models\repositories\TicketFiles;
use app\modules\bugtracker\models\repositories\TicketUpload;
use app\modules\bugtracker\models\repositories\TicketMessages;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends BehaviorsController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TicketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ticket model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $modelTicketMessages = new TicketMessages();
        $modelTicketMessages->ticket_id = $id;
        $upload = new TicketUpload();

        $model = $this->findModel($id);
        $message = $model->ticketMessages;
        $dataProviderMessages = new ActiveDataProvider(['query' => $model->getTicketMessages()->with('ticketFiles')]);
        return $this->render('view', [
                    'model' => $model,
                    'message' => $message,
                    'dataProviderMessages' => $dataProviderMessages,
                    'modelTicketMessages' => $modelTicketMessages,
                    'upload' => $upload,
        ]);
    }

    /**
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Ticket();
        $file = new TicketFiles();
        $upload = new TicketUpload();

        if (Yii::$app->request->isPost) {
            $upload->imageFile = UploadedFile::getInstances($upload, 'imageFile');
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $file->ticket_id = $model->id;
                $upload->upload($file);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
                    'model' => $model,
                    'upload' => $upload,
        ]);
    }

    /**
     * Updates an existing Ticket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $msg = NULL;
        $model = $this->findModel($id);
//        print_r($model->getTypeName());
//        die;
        $file = new TicketFiles();
        $upload = new TicketUpload();
        if (Yii::$app->request->isPost) {
            $upload->imageFile = UploadedFile::getInstances($upload, 'imageFile');
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $file->ticket_id = $model->id;
                $msg = $upload->upload($file);
                if (empty($msg) || $msg === TRUE) {
                    return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing Ticket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
