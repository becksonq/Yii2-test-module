<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\themes\createx\modules\fashion_store_v1_hero_slider\models\FashionStoreV1HeroSlider
 * @var $dynamicModel \yii\base\DynamicModel
 */

$this->title = Yii::t('app', 'Update Fashion Store V1 Hero Slider: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fashion Store V1 Hero Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="fashion-store-v1-hero-slider-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dynamicModel' => $dynamicModel,
    ]) ?>

</div>
