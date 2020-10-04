<?php

namespace app\controllers;

use Yii;
use app\models\Contacts;
use app\models\ContactPersons;
use app\models\ContactsSearch;
use app\models\ProjectCompletion;
use app\models\ContactContractorInfo;
use app\models\User;
use app\models\Tags;
use app\models\Leads;
use app\models\ContactTags;
use app\models\ContactReferral;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\AccessRule;

/**
 * ContactsController implements the CRUD actions for Contacts model.
 */
class ContactsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'actions' => ['create', 'index', 'view', 'get-address-by-id', 'update', 'delete'],
                        'allow' => true,
                        'roles' =>
                            [
                                User::ROLE_ADMIN
                            ],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Contacts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contacts model.
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
     * Creates a new Contacts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contacts();
        $modelProjectCompletion = new ProjectCompletion();
        $modelContactContractorInfo = new ContactContractorInfo();

        $model->contactContractor = 'No';
        $model->contactReferral = 'No';
        //$model->contactBillingAddressType = 'Contact';
        $model->contactCountry = 'United States';
        $model->contactBillingCountry = 'United States';
        $model->contactPropertyCountry = 'United States';
        $modelContactContractorInfo->selectionType = 'Rok';


        if(Yii::$app->request->isPost) {

            $transaction = Yii::$app->db->beginTransaction();

            try {

                $model->load(Yii::$app->request->post());
                $modelProjectCompletion->load(Yii::$app->request->post());
                $modelContactContractorInfo->load(Yii::$app->request->post());


                if($model->save()) {

                    $primaryContacts = Yii::$app->request->post()['Contacts']['primaryContact'];
                    $secondaryContact = Yii::$app->request->post()['Contacts']['secondaryContact'];
                    $tags = Yii::$app->request->post()['Contacts']['contactTags'];

                    if(is_array($tags) and count($tags) > 0) {
                        foreach($tags as $eachTag) {
                            ContactTags::findOrAdd($eachTag, $model->pkContactID);
                        }
                    }

                    if(is_array($primaryContacts) && count($primaryContacts) > 0) {
                        foreach($primaryContacts as $eachContact) {

                            if($eachContact['fullName'] != '' && $eachContact['phoneNumber'] != '' && $eachContact['Email'] != '') {
                                $tmpPerson = new ContactPersons;
                                $tmpPerson->fkContactID = $model->pkContactID;
                                $tmpPerson->contactPersonFullName = $eachContact['fullName'];
                                $tmpPerson->contactPersonPhone = $eachContact['phoneNumber'];
                                $tmpPerson->contactPersonEmail = $eachContact['Email'];
                                $tmpPerson->fkContactPersonID = $model->fkContactPersonID;
                                $tmpPerson->contactPersonType = 'Primary';
                                if(!$tmpPerson->save()) {
                                    throw new \Exception(current($tmpPerson->getFirstErrors()));
                                }
                            }
                        }
                    }

                    if(is_array($secondaryContact) && count($secondaryContact) > 0) {
                        foreach ($secondaryContact as $eachContact) {
                            if($eachContact['fullName'] != '' && $eachContact['phoneNumber'] != '' && $eachContact['Email'] != '') {
                                    $tmpPerson = new ContactPersons;
                                $tmpPerson->fkContactID = $model->pkContactID;
                                $tmpPerson->contactPersonFullName = $eachContact['fullName'];
                                $tmpPerson->contactPersonPhone = $eachContact['phoneNumber'];
                                $tmpPerson->contactPersonEmail = $eachContact['Email'];
                                $tmpPerson->fkContactPersonID = NULL;
                                $tmpPerson->contactPersonType = 'Secondary';
                                if (!$tmpPerson->save()) {
                                    throw new \Exception(current($tmpPerson->getFirstErrors()));
                                }
                            }
                        }
                    }


                    $modelProjectCompletion->fkContactID = $model->pkContactID;
                    if(!$modelProjectCompletion->save()) {
                        throw new \Exception(current($modelProjectCompletion->getFirstErrors()));
                    }

                    $modelContactContractorInfo->fkContactID = $model->pkContactID;
                    if(!$modelContactContractorInfo->save()) {
                        throw new \Exception(current($modelContactContractorInfo->getFirstErrors()));
                    }


                    $lead = new Leads;
                    $lead->fkContactID = $model->pkContactID;
                    $lead->save();


                    $referral = new ContactReferral;
                    $referral->fkContactID = $model->pkContactID;
                    $referral->fkReferredBy = $model->referrerID;
                    $referral->save();

                    $transaction->commit();


                    Yii::$app->session->setFlash('success', 'Contact Added Successfully');

                    return $this->redirect(['index']);

                } else {
                    throw new \Exception(current($model->getFirstErrors()));
                }

            } catch(\Exception $e) {
                print_r($e->getMessage(). ' ' . $e->getTraceAsString());
                $transaction->rollBack();
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelProjectCompletion' => $modelProjectCompletion,
            'modelContactContractorInfo' => $modelContactContractorInfo
        ]);
    }

    /**
     * Updates an existing Contacts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelProjectCompletion = ProjectCompletion::find()->where(['fkContactID' => $id])->one();
        $modelContactContractorInfo = ContactContractorInfo::find()->where(['fkContactID' => $id])->one();

        if(Yii::$app->request->isPost) {

            $transaction = Yii::$app->db->beginTransaction();

            try {

                $model->load(Yii::$app->request->post());
                $modelProjectCompletion->load(Yii::$app->request->post());
                $modelContactContractorInfo->load(Yii::$app->request->post());

                if($model->save()) {

                    $primaryContacts = Yii::$app->request->post()['Contacts']['primaryContact'];
                    $secondaryContact = Yii::$app->request->post()['Contacts']['secondaryContact'];
                    $tags = Yii::$app->request->post()['Contacts']['contactTags'];

                    if(is_array($tags) and count($tags) > 0) {
                        foreach($tags as $eachTag) {
                            ContactTags::findOrAdd($eachTag, $model->pkContactID);
                        }
                    }


                    ContactPersons::deleteAll(['fkContactID' => $id]);

                    if(is_array($primaryContacts) && count($primaryContacts) > 0) {
                        foreach($primaryContacts as $eachContact) {

                            if($eachContact['fullName'] != '' && $eachContact['phoneNumber'] != '' && $eachContact['Email'] != '') {
                                $tmpPerson = new ContactPersons;
                                $tmpPerson->fkContactID = $model->pkContactID;
                                $tmpPerson->contactPersonFullName = $eachContact['fullName'];
                                $tmpPerson->contactPersonPhone = $eachContact['phoneNumber'];
                                $tmpPerson->contactPersonEmail = $eachContact['Email'];
                                $tmpPerson->fkContactPersonID = $model->fkContactPersonID;
                                $tmpPerson->contactPersonType = 'Primary';
                                if(!$tmpPerson->save()) {
                                    throw new \Exception(current($tmpPerson->getFirstErrors()));
                                }
                            }
                        }
                    }

                    if(is_array($secondaryContact) && count($secondaryContact) > 0) {
                        foreach ($secondaryContact as $eachContact) {
                            if($eachContact['fullName'] != '' && $eachContact['phoneNumber'] != '' && $eachContact['Email'] != '') {

                                $tmpPerson = new ContactPersons;
                                $tmpPerson->fkContactID = $model->pkContactID;
                                $tmpPerson->contactPersonFullName = $eachContact['fullName'];
                                $tmpPerson->contactPersonPhone = $eachContact['phoneNumber'];
                                $tmpPerson->contactPersonEmail = $eachContact['Email'];
                                $tmpPerson->fkContactPersonID = NULL;
                                $tmpPerson->contactPersonType = 'Secondary';
                                if (!$tmpPerson->save()) {
                                    throw new \Exception(current($tmpPerson->getFirstErrors()));
                                }
                            }
                        }
                    }


                    $modelProjectCompletion->fkContactID = $model->pkContactID;
                    if(!$modelProjectCompletion->save()) {
                        throw new \Exception(current($modelProjectCompletion->getFirstErrors()));
                    }

                    $modelContactContractorInfo->fkContactID = $model->pkContactID;
                    if(!$modelContactContractorInfo->save()) {
                        throw new \Exception(current($modelContactContractorInfo->getFirstErrors()));
                    }


                    /** @var $referral  Save referral ID */
                    $referral = ContactReferral::find()->where(['fkContactID' => $id])->one();
                    if(!$referral) {
                        $referral = new ContactReferral();
                        $referral->fkContactID = $id;
                    }
                    $referral->fkReferredBy = $model->referrerID;
                    $referral->save();



                    $transaction->commit();


                    Yii::$app->session->setFlash('success', 'Contact Updated Successfully');

                    return $this->redirect(['update', 'id' => $id]);

                } else {
                    throw new \Exception(current($model->getFirstErrors()));
                }

            } catch(\Exception $e) {
                echo '<pre>';
                print_r($e->getMessage(). ' ' . $e->getTraceAsString());
                $transaction->rollBack();
            }
        } else {

            $model->primaryContact = $model->getContactPersons()->select([
                'fullName' => 'contactPersonFullName',
                'phoneNumber' => 'contactPersonPhone',
                'Email' => 'contactPersonEmail',
                'pkContactPersonID'
            ])->where(['contactPersonType' => 'Primary'])->asArray()->all();


            $model->secondaryContact = $model->getContactPersons()->select([
                'fullName' => 'contactPersonFullName',
                'phoneNumber' => 'contactPersonPhone',
                'Email' => 'contactPersonEmail',
                'pkContactPersonID'
            ])->where(['contactPersonType' => 'Secondary'])->asArray()->all();

            $model->referrerID = $model->getContactReferrals()->select('fkReferredBy')->joinWith('fkReferredBy0.contactPersons')->indexBy('fkReferredBy')->column();

        }

        return $this->render('update', [
            'model' => $model,
            'modelProjectCompletion' => $modelProjectCompletion,
            'modelContactContractorInfo' => $modelContactContractorInfo
        ]);
    }

    /**
     * Deletes an existing Contacts model.
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
     * @param $id
     * @return \yii\web\Response
     */
    public function actionGetAddressById($id)
    {
        $address = Contacts::find()
            ->select(['contactAddress', 'contactAddress2', 'contactCity', 'contactState', 'contactZip', 'contactCountry'])
            ->where(['pkContactID' => $id])
            ->one();

        if($address) {
            $data = ['status' => 'OK', 'data' => $address->attributes];
        } else {
            $data = ['status' => 'FAILED', 'message' => 'No data available'];
        }

        return $this->asJson($data);
    }

    /**
     * Finds the Contacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
