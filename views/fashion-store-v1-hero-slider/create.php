<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\themes\createx\modules\fashion_store_v1_hero_slider\models\FashionStoreV1HeroSlider
 * @var $dynamicModel \yii\base\DynamicModel
 */

$this->title = Yii::t('app', 'Create Fashion Store V1 Hero Slider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fashion Store V1 Hero Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fashion-store-v1-hero-slider-create">

    <?= $this->render('_form', [
        'model' => $model,
        'dynamicModel' => $dynamicModel,
    ]) ?>

</div>
