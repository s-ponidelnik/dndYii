<?php

namespace backend\controllers;

use common\models\Map;
use Yii;
use \common\models\MapMarkers;
use backend\models\MapMarkersSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MapMarkersController implements the CRUD actions for MapMarkers model.
 */
class Map_markersController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all MapMarkers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MapMarkersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MapMarkers model.
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

    public function actionGet($id)
    {
        $markers = MapMarkers::find()->where(['map_id' => $id])->all();
        $data = [];
        /** @var MapMarkers $marker */
        foreach ($markers as $marker) {
            $m_id = $marker->id;
            if (strlen($m_id) == 1)
                $m_id = '1' . $m_id;
            if (strlen($m_id) == 2)
                $m_id = '1' . $m_id;
            if (strlen($m_id) == 3)
                $m_id = $m_id . $m_id;

            $data[$m_id] = [
                'id' => $marker->id,
                'posX' => $marker->pos_x,
                'posY' => $marker->pos_y,
                'type' => $marker->typeName,
                'name' => $marker->name,
                'info' => $marker->description
            ];
            if (!is_null($marker->sub_map_id))
                $data[$m_id]['subMapId'] = $marker->sub_map_id;
        }
        Yii::$app->response->content = json_encode($data);
        Yii::$app->response->send();
    }

    /**
     * Sub Creates a new MapMarkers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSub_create()
    {
        $model = new MapMarkers();
        if ($model->load(Yii::$app->request->post())) {
            if (empty($model->sub_map_id))
                $model->sub_map_id = null;
            if ($model->save()) {
                $this->redirect(Url::to(['map/view', 'id' => $model->map_id]));
            }
        }
        var_dump($model->sub_map_id);
        var_dump($model->getErrors());
    }

    /**
     * Creates a new MapMarkers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MapMarkers();
        if ($model->load(Yii::$app->request->post())) {
            if (empty($model->sub_map_id))
                $model->sub_map_id = null;
            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new MapMarkers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate_from_map()
    {
        $model = new MapMarkers();
        if ($model->load(Yii::$app->request->post())) {
            if (empty($model->sub_map_id))
                $model->sub_map_id = null;
            if ($model->save())
                return $this->redirect(Url::to(['map/view', 'id' => $model->map_id, '#' => $model->id]));
        }
        $post = Yii::$app->request->post('MapMarkers', []);
        if (!isset($post['map_id'])) {
            var_dump($model->getErrors());
        }
        if (!isset($post['pos_x']))
            $post['pos_x'] = null;
        if (!isset($post['pos_y']))
            $post['pos_y'] = null;

        return $this->redirect(Url::to(['map/view', 'id' => $post['map_id'], '#' => 'x=' . $post['pos_x'] . '&y=' . $post['pos_y']]));
    }

    /**
     * Updates an existing MapMarkers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (empty($model->sub_map_id))
                $model->sub_map_id = null;
            if ($model->save())
                return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete_marker($id)
    {
        if (MapMarkers::deleteAll(['id' => $id])>0){
            Yii::$app->response->setStatusCode(200);
        }else{
            Yii::$app->response->setStatusCode(400);
        }
    }

    public function actionUpdate_pos($id, $pos_x, $pos_y)
    {
        $model = $this->findModel($id);
        if (is_object($model)) {
            $model->pos_x = $pos_x;
            $model->pos_y = $pos_y;
            if ($model->save()) {
                Yii::$app->response->setStatusCode(200);
            } else {
                Yii::$app->response->setStatusCode(400);
            }
        } else {
            Yii::$app->response->setStatusCode(404);
        }
    }

    /**
     * Deletes an existing MapMarkers model.
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
     * Finds the MapMarkers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MapMarkers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MapMarkers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
