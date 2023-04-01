<?php

namespace app\controllers;

use app\models\Forms;
use app\models\Intensive;
use app\models\IntensiveRegisterForm;
use app\models\IntensiveSearch;
use app\models\Thematics;
use app\models\Users;
use app\models\UsersFormsIntensives;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\User;

/**
 * IntensiveController implements the CRUD actions for Intensive model.
 */
class IntensiveController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Intensive models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new IntensiveSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $thematics = Thematics::find()->all();
        $lectors = ArrayHelper::map(Users::find()->select(['id', 'name'])->where(['type' => Users::TYPE_LECTOR])->asArray()->all(), 'id', 'name');
        return $this->render('index',
            compact('searchModel', 'dataProvider',
                'thematics', 'lectors'));
    }

    public function actionMy(): string
    {
        $searchModel = new IntensiveSearch();
        $dataProvider = $searchModel->searchByUser(\Yii::$app->session->id, $this->request->queryParams);

        $thematics = Thematics::find()->all();
        $lectors = ArrayHelper::map(Users::find()->select(['id', 'name'])->where(['type' => Users::TYPE_LECTOR])->asArray()->all(), 'id', 'name');
        return $this->render('index',
            compact('searchModel', 'dataProvider',
                'thematics', 'lectors'));
    }

    /**
     * Displays a single Intensive model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Intensive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Intensive();

        $model->lector_id = \Yii::$app->user->identity->id;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->upload()) {
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Intensive model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Intensive model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id): \yii\web\Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionRegister($id)
    {
        $model = $this->findModel($id);
        if (empty($model)) {
            return $this->redirect(['index']);
        }

        $registrationForm = new IntensiveRegisterForm();

        if ($this->request->isPost) {
            if ($registrationForm->load($this->request->post())) {
                $json = json_encode([
                    "phone" => $registrationForm->phone,
                    "email" => $registrationForm->email,
                    "institution" => $registrationForm->institution,
                    "about" => $registrationForm->about,
                ]);
                $formModel = new Forms([
                    "name" => $model->name,
                    "fields" => $json,
                ]);
                if ($formModel->save()) {
                    $formModel->refresh();
                    $ufi = new UsersFormsIntensives([
                        'user_id' => \Yii::$app->user->id,
                        'form_id' => $formModel->id,
                        'intensive_id' => $id,
                    ]);
                    if ($ufi->save()) {
                        return $this->redirect(['view', 'id' => $id]);
                    }

                }
            }
        }

        return $this->render('reg_form', [
            'model' => $registrationForm,
        ]);
    }

    /**
     * Finds the Intensive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Intensive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Intensive::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
