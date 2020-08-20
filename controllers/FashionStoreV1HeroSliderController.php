<?php

namespace frontend\themes\createx\modules\fashion_store_v1_hero_slider\controllers;

use frontend\themes\createx\modules\fashion_store_v1_hero_slider\models\SliderImagesForm;
use Yii;
use frontend\themes\createx\modules\fashion_store_v1_hero_slider\models\FashionStoreV1HeroSlider;
use frontend\themes\createx\modules\fashion_store_v1_hero_slider\models\FashionStoreV1HeroSliderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FashionStoreV1HeroSliderController implements the CRUD actions for FashionStoreV1HeroSlider model.
 */
class FashionStoreV1HeroSliderController extends Controller
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
     * Lists all FashionStoreV1HeroSlider models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FashionStoreV1HeroSliderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FashionStoreV1HeroSlider model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $sliderImagesForm = new SliderImagesForm();

        if ($sliderImagesForm->load(Yii::$app->request->post()) && $sliderImagesForm->validate()) {
            try {
                $model->addSliderImages($model->id, $sliderImagesForm);
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('view', [
            'model' => $model,
            'sliderImagesForm' => $sliderImagesForm,
        ]);
    }

    /**
     * Creates a new FashionStoreV1HeroSlider model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FashionStoreV1HeroSlider();
        $dynamicModel = $model->createModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'dynamicModel' => $dynamicModel,
        ]);
    }

    /**
     * Updates an existing FashionStoreV1HeroSlider model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dynamicModel = $model->createModel($model->slider_items);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'dynamicModel' => $dynamicModel,
        ]);
    }

    /**
     * @param integer $id
     * @param $imageId
     * @return mixed
     */
    public function actionDeleteImage($id, $imageId)
    {
        $model = new FashionStoreV1HeroSlider();
        try {
            $model->removeImage($id, $imageId);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id, '#' => 'images']);
    }

    /**
     * @param integer $id
     * @param $imageId
     * @return mixed
     */
    public function actionMoveImageUp($id, $imageId)
    {
        $model = new FashionStoreV1HeroSlider();
        $model->moveImageUp($id, $imageId);
        return $this->redirect(['view', 'id' => $id, '#' => 'images']);
    }

    /**
     * @param integer $id
     * @param $imageId
     * @return mixed
     */
    public function actionMoveImageDown($id, $imageId)
    {
        $model = new FashionStoreV1HeroSlider();
        $model->moveImageDown($id, $imageId);
        return $this->redirect(['view', 'id' => $id, '#' => 'images']);
    }


    /**
     * Deletes an existing FashionStoreV1HeroSlider model.
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
     * Finds the FashionStoreV1HeroSlider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FashionStoreV1HeroSlider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FashionStoreV1HeroSlider::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
