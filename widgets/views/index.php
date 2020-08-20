<?php

use yii\helpers\Html;

/* @var $this \yii\web\View
 * @var $bundle yii\web\AssetBundle
 * @var $model \frontend\themes\createx\modules\fashion_store_v1_hero_slider\models\FashionStoreV1HeroSlider
 */
?>

<!-- Hero slider-->
<section class="cz-carousel cz-controls-lg">
    <div class="cz-carousel-inner"
         data-carousel-options='{"mode": "gallery", "responsive": {"0":{"nav":true, "controls": false},"992":{"nav":false, "controls": true}}}'>
        <?php
        for ($i = 0; $i < 3; $i++): ?>
            <!-- Item-->
            <div class="px-lg-5" style="background-color: <?= $model->slider_items['backgroundColor'][$i] ?>;">
                <div class="d-lg-flex justify-content-between align-items-center pl-lg-4">
                    <?=
                    isset($model->sliderImages[$i]) ?
                    Html::img($model->sliderImages[$i]->getThumbFileUrl('file', 'sliderImage'), [
                        'class' => 'd-block order-lg-2 mr-lg-n5 flex-shrink-0',
                        'alt'   => $model->slider_items['h1'][$i],
                    ]) : null ?>

                    <div class="position-relative mx-auto mr-lg-n5 py-5 px-4 mb-lg-5 order-lg-1"
                         style="max-width: 42rem; z-index: 10;">
                        <div class="pb-lg-5 mb-lg-5 text-center text-lg-left text-lg-nowrap">
                            <h2 class="text-light font-weight-light pb-1 from-left"><?= $model->slider_items['h2'][$i] ?></h2>
                            <h1 class="text-light display-4 from-left delay-1"><?= $model->slider_items['h1'][$i] ?></h1>
                            <p class="font-size-lg text-light pb-3 from-left delay-2"><?= $model->slider_items['p'][$i] ?></p>
                            <?= Html::a(Yii::t('app', 'Перейти к покупкам') . '<i class="czi-arrow-right ml-2 mr-n1"></i>',
                                \yii\helpers\Url::toRoute([$model->slider_items['buttonLink'][$i]]), [
                                    'class' => 'btn btn-primary scale-up delay-4',
                                ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</section>