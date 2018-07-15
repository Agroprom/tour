<?php

namespace app\controllers;

use Yii;
use app\models\Transfers;
use app\models\TransfersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\UserSearch;


/**
 * TransfersController implements the CRUD actions for Transfers model.
 */
class TransfersController extends Controller
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
     * Lists all Transfers models.
     * @return mixed
     */
    public function actionIndex($username)
    {
        if ($username != Yii::$app->user->identity->username) {
            return $this->goHome();
        }
        $searchModel = new TransfersSearch();
        $dataProvider = $searchModel->search($username, Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transfers model.
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
     * Creates a new Transfers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @property User $to
     * @property UserSearch $from
     */
    public function actionCreate()
    {
        $model = new Transfers();

        if ($model->load(Yii::$app->request->post()) ) {                      
            $model->from = Yii::$app->user->identity->username;                                    
            $from = UserSearch::findByUsername($model->from);
            $to = User::findByUsername($model->to);
            
            if(!$from->transfer($to, $model->amount)) {
                return $this->redirect('create');
            }
                                 
//            User::updateAll(['balance' => new Expression('balance +' . $model->amount)], 'username ="' . $model->to . '"');
//            User::updateAll(['balance' => new Expression('balance -' . $model->amount)], 'username ="' . $model->from . '"');
            return $this->redirect(['index', 'username' => $model->from]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Transfers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->date]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Transfers model.
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
     * Finds the Transfers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transfers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transfers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
