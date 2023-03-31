<?php

namespace app\controllers;

use app\models\Products;
use app\models\ProductsSearch;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors(): array
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
     * Lists all Products models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Products::find(),
            ]),
        ]);
    }

    /**
     * @param null $error
     * @return string
     */
    public function actionCatalog($error = null): string
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $sort = new Sort([
            'attributes' => [
                'name',
                'year',
                'price',
            ]
        ]);
        $dataProvider->query->addOrderBy($sort->orders);
        return $this->render('catalog', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sort' => $sort,
            'catalogError' => $error,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new Products();

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
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
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
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return string
     */
    public function actionCart($error = null): string
    {
        $models = Products::find();
        $array_keys = array_keys(\Yii::$app->session->get('cart', []));
        if (count($array_keys)) {
            foreach ($array_keys as $id) {
                $id = explode('.', $id)[1];
                $models->orWhere(['id' => $id]);
            }
            $models = $models->all();
        } else $models = null;

        return $this->render('cart', [
            'models' => $models,
            'cartError' => $error,
        ]);
    }

    public function actionAdd($id, $from): string
    {
        if ($this->request->isPost) {
            $session = \Yii::$app->session;
            $cart = $session->get('cart', []);
            $pid = 'p.'.$id;
            if (isset($cart[$pid])) {
                $product = Products::findOne(['id' => $id]);
                if ($cart[$pid] < $product->count) {
                    $cart[$pid]++;
                } else {
                    $error = 'Yamete kudasay';
                }
            } else {
                $cart[$pid] = 1;
            }
            $session->set('cart', $cart);
        }

        switch ($from) {
            case 'catalog':
            {
                return $this->actionCatalog($error ?? null);
            }
            case 'cart':
            {
                return $this->actionCart($error ?? null);
            }
            case 'view':
            {
                return $this->render('view');
            }
            default:
            {
                return false;
            }
        }
    }

    /**
     * @param $id
     * @return string|Response
     */
    public function actionRemove($id)
    {
        if ($this->request->isPost) {
            $session = \Yii::$app->session;
            $cart = $session->get('cart', []);
            $pid = 'p.'.$id;
            if (isset($cart[$pid]) && $cart[$pid] > 0) {
                $cart[$pid]--;
                if ($cart[$pid] === 0) {
                    unset($cart[$pid]);
                    $session->set('cart', $cart);
                    return $this->redirect(['cart']);
                }
                $session->set('cart', $cart);
            }
        }
        return $this->actionCart();
    }
}
