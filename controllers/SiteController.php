<?php

namespace app\controllers;

use app\models\News;
use app\models\ProductsSearch;
use app\models\RegisterForm;
use app\models\Users;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $news = News::find()->all();
        return $this->render('index', [
            'news' => $news
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new RegisterForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $data = $form->attributes;
            $user = new Users([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Yii::$app->getSecurity()->generatePasswordHash($data['password']),
            ]);
            if ($user->save()) {
                return $this->redirect(['login']);
            }
        }
        return $this->render('register', [
            'model' => $form,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionWhere()
    {
        return $this->render('where');
    }

    public function sendEmail($to, $subject, $message = "")
    {
        // отправка мыла
    }

    function generateImage($color, $text) {
        $image = imagecreatetruecolor(512, 512); // create a new image with dimensions 512x512
        $bg_color = imagecolorallocate($image, $color[0], $color[1], $color[2]); // set the background color
        imagefill($image, 0, 0, $bg_color); // fill the image with the background color

        $text_color = imagecolorallocate($image, 255, 255, 255); // set the text color to white
        $font_size = 48; // set the font size
        $font_path = 'arial.ttf'; // set the font path
        $text_box = imagettfbbox($font_size, 0, $font_path, $text); // get the bounding box of the text
        $text_width = abs($text_box[2] - $text_box[0]); // get the width of the text

        // center the text horizontally and vertically
        $x = (512 - $text_width) / 2;
        $y = (512 + $font_size) / 2;

        imagettftext($image, $font_size, 0, $x, $y, $text_color, $font_path, $text); // add the text to the image

        header('Content-Type: image/png'); // set the content type to PNG
        imagepng($image); // output the image as PNG

        imagedestroy($image); // free up memory
    }
}
