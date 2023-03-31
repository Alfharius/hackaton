<?php

namespace app\controllers;

use app\models\Orders;
use app\models\OrdersProducts;
use app\models\OrdersSearch;
use app\models\Users;
use SebastianBergmann\ObjectReflector\ObjectReflector;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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
     * Lists all Orders models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if ($this->request->isPost) {
            $post = $this->request->post();
            $identity = Users::identity();
            $session = \Yii::$app->session;
            if ($identity->password === $post['password']) {
                $order = new Orders([
                    'user_id' => $identity->id,
                ]);
                $order->save();
                foreach ($session->get('cart') as $id => $count) {
                    $order_product = new OrdersProducts([
                        'product_id' => $id,
                        'order_id' => $order->id,
                        'count' => $count,
                    ]);
                    $order_product->save();
                }
                $session->remove('cart');
                return $this->redirect(['orders/index']);
            } else {
                $session->setFlash('error', 'Incorrect password');
            }
        }
        return $this->redirect(['/products/cart']);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionAccept($id): \yii\web\Response
    {
        $order = Orders::findOne(['id' => $id]);
        $order->status = 'Подтверждённый';
        $order->save(false);
        return $this->redirect(['index']);
    }

    public function actionCancel($id): \yii\web\Response
    {
        $order = Orders::findOne(['id' => $id]);
        $order->note = $this->request->post()['note'];
        $order->status = 'Отменённый';
        $order->save(false);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
