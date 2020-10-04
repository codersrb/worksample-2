<?php

namespace app\controllers;

use app\models\LeadImages;
use Yii;
use app\models\Leads;
use app\models\Contacts;
use app\models\LeadSearch;
use app\models\LeadMeasurements;
use app\models\LeadDesign;
use app\models\LeadDesignRevisions;
use app\models\LeadDelivery;
use app\models\ContactContractorInfo;
use app\models\ProjectCompletion;
use app\models\ContactTags;
use app\models\LeadNotes;
use app\models\LeadReminders;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LeadsController implements the CRUD actions for Leads model.
 */
class LeadsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all Leads models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Leads model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Leads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Leads();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->pkLeadID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Leads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelContact = Contacts::findOne($model->fkContactID);
        $modelProjectCompletion = ProjectCompletion::find()->where(['fkContactID' => $model->fkContactID])->one();
        $modelContactContractorInfo = ContactContractorInfo::find()->where(['fkContactID' => $model->fkContactID])->one();


        if(Yii::$app->request->isPost) {

            $transaction = Yii::$app->db->beginTransaction();

            try {

                $model->load(Yii::$app->request->post());
                $modelContact->load(Yii::$app->request->post());
                $modelProjectCompletion->load(Yii::$app->request->post());
                $modelContactContractorInfo->load(Yii::$app->request->post());

                if($model->save() && $modelContact->save() && $modelProjectCompletion->save() && $modelContactContractorInfo->save()) {

                    $tags = Yii::$app->request->post()['Contacts']['contactTags'];

                    if(is_array($tags) and count($tags) > 0) {
                        foreach($tags as $eachTag) {
                            ContactTags::findOrAdd($eachTag, $id);
                        }
                    }

                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Lead Added Successfully');
                    return $this->redirect(['index']);
                } else {
                    throw new \Exception(current($model->getFirstErrors()));
                }



            } catch(\Exception $e) {
                print_r($e->getMessage(). ' ' . $e->getTraceAsString());
                $transaction->rollBack();
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelContact' => $modelContact,
            'modelProjectCompletion' => $modelProjectCompletion,
            'modelContactContractorInfo' => $modelContactContractorInfo
        ]);
    }


    /**
     * Creates a new LeadMeasurements model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionMeasurements($id)
    {

        $model = LeadMeasurements::find()->where(['fkLeadID' => $id])->one();

        if(!$model) {
            $model = new LeadMeasurements();
        }

        $model->fkLeadID = $id;

        $leadModel = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->upload(
            [
                'lmMeasurementSketchFiles' => ['saveTo' => 'lmMeasurementSketch', 'alias' => 'Sketch'],
                'lmMeasurementBeforePhotosFiles' => ['saveTo' => 'lmMeasurementBeforePhotos', 'alias' => 'BeforePhotos']
            ])) {
            return $this->redirect(['measurements', 'id' => $model->fkLeadID]);
        }
        return $this->render('measurements', [
            'model' => $model,
            'leadModel' => $leadModel
        ]);
    }

    /**
     * Creates a new LeadDesign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDesign($id)
    {

        try
        {
            $model = LeadDesign::find()->where(['fkLeadID' => $id])->one();

            if(!$model) {
                $model = new LeadDesign();
            } else {
                $model->revisions = LeadDesignRevisions::find()->where(['fkLeadDesignID' => $model->pkLeadDesignID])->asArray()->all();
            }

            $model->fkLeadID = $id;

            $leadModel = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->upload(
                    [
                        'ldDesign2D3DFiles' => ['saveTo' => 'ldDesign2D3D', 'alias' => '2D3D'],
                    ]))
            {
                $revisions = Yii::$app->request->post()['LeadDesign']['revisions'];

                if(count($revisions) > 0) {
                    foreach($revisions as $revision) {

                        if(!empty($revision['pkLeadDesignRevisionID'])) {
                            $ldr = LeadDesignRevisions::findOne($revision['pkLeadDesignRevisionID']);
                        } else {
                            $ldr = new LeadDesignRevisions;
                            $ldr->fkLeadDesignID = $model->pkLeadDesignID;
                        }

                        $ldr->ldrApproved = $revision['ldrApproved'];
                        $ldr->ldrModificationRequest = $revision['ldrModificationRequest'];
                        $ldr->ldrEmailedToCustomer = $revision['ldrEmailedToCustomer'];

                        if(!$ldr->save()) {
                            throw new \Exception(current($ldr->getFirstError()));
                        }
                    }
                }

                return $this->redirect(['design', 'id' => $model->fkLeadID]);
            } else {
                throw new \Exception(current($model->getFirstErrors()));
            }

        } catch(\Exception $ex) {
            print_r($ex->getMessage());
//            Yii::$app->session->setFlash('error', $ex->getMessage());
        }


        return $this->render('design', [
            'model' => $model,
            'leadModel' => $leadModel,
        ]);
    }

    /**
     * Creates a new LeadDelivery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDelivery($id)
    {

        try
        {
            $model = LeadDelivery::find()->where(['fkLeadID' => $id])->one();

            if(!$model) {
                $model = new LeadDelivery();
            }

            $model->fkLeadID = $id;
            $leadModel = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['delivery', 'id' => $model->fkLeadID]);
            } else {
                throw new \Exception(current($model->getFirstErrors()));
            }

        } catch(\Exception $ex) {
            print_r($ex->getMessage());
        }


        return $this->render('delivery', [
            'model' => $model,
            'leadModel' => $leadModel,
        ]);
    }



    /**
     * Creates a new LeadImages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPhotos($id, $type = null)
    {
        $model = new LeadImages();
        $leadModel = $this->findModel($id);

        $leadImagesColumns = null;
        $leadImages = null;

        if($type) {
            $leadImages = LeadImages::find()
                ->where(['fkLeadID' => $leadModel->pkLeadID])
                ->andWhere(['leadImageType' => $type])
                ->orderBy(['leadImageType' => SORT_ASC])
                ->all();
        }



        return $this->render('photos', [
            'model' => $model,
            'leadModel' => $leadModel,
            'leadImages' => $leadImages
        ]);
    }


    public function actionUploadPhotos($id)
    {
        $model = new LeadImages();
        $model->fkLeadID = $id;

        if ($model->upload(
            [
                'leadImageNameFiles' => ['saveTo' => 'LeadImageName', 'alias' => Yii::$app->request->post('LeadImages')['leadImageType']]
            ])) {
        }
        return $this->redirect(['photos', 'id' => $id]);
    }


    /**
     * Creates a new LeadNotes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNotes($id)
    {
        try
        {
            $model = new LeadNotes();
            $model->fkUserID = Yii::$app->user->identity->pkUserID;

            $model->fkLeadID = $id;
            $model->leadNoteAddedFrom = 'Notes';
            $leadModel = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['notes', 'id' => $model->fkLeadID]);
            } else {
                throw new \Exception(current($model->getFirstErrors()));
            }

        } catch(\Exception $ex) {
            print_r($ex->getMessage());
        }


        return $this->render('notes', [
            'model' => $model,
            'leadModel' => $leadModel,
        ]);
    }



    /**
     * Creates a new LeadReminder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionReminder($id)
    {
        try
        {
            $model = new LeadReminders();

            $model->fkLeadID = $id;
            $model->fkUserID = Yii::$app->user->identity->pkUserID;
            $leadModel = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['reminder', 'id' => $model->fkLeadID]);
            } else {
                throw new \Exception(current($model->getFirstErrors()));
            }

        } catch(\Exception $ex) {
            print_r($ex->getMessage());
        }


        return $this->render('reminder', [
            'model' => $model,
            'leadModel' => $leadModel,
        ]);
    }


    public function actionAddNotes()
    {
        try
        {
            $model = new LeadNotes();
            $model->fkUserID = Yii::$app->user->identity->pkUserID;
            $model->fkLeadID = Yii::$app->request->post()['fkLeadID'];
            $model->leadNoteAddedFrom = Yii::$app->request->post()['leadNoteAddedFrom'];
            $model->leadNoteText = Yii::$app->request->post()['leadNoteText'];
            $model->fkUserID = Yii::$app->user->identity->pkUserID;



            if ($model->save()) {
                $data = ['status' => 'OK', 'message' => 'Note added successfully!'];
            } else {
                throw new \Exception(current($model->getFirstErrors()));
            }

        } catch(\Exception $ex) {
            $data = ['status' => 'Error', 'message' => $ex->getMessage()];
        }

        return $this->asJson($data);
    }

    /**
     * Deletes an existing Leads model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Leads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Leads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Leads::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
