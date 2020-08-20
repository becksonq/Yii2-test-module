<?php

use frontend\themes\createx\assets\AppAsset;
use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\themes\createx\modules\fashion_store_v1_hero_slider\models\FashionStoreV1HeroSlider
 * @var $sliderImagesForm \frontend\themes\createx\modules\fashion_store_v1_hero_slider\models\SliderImagesForm
 */

$this->title = $model->hero_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fashion Store V1 Hero Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$bundle = AppAsset::register($this);
?>
<div class="fashion-store-v1-hero-slider-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'hero_name',
            'description:ntext',
            [
                'attribute' => 'status',
                'value'     => function ($model) {
                    switch ($model->status) {
                        case 1:
                            $status = '<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-file-check text-success" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
  <path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z"/>
</svg>';
                            break;
                        case 0:
                            $status = '<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-file-minus text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z"/>
  <path fill-rule="evenodd" d="M5.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
</svg>';
                            break;
                    }
                    return $status;
                },
                'format'    => 'raw',
            ]
        ],
    ]) ?>

    <div id="images">
        <p>
            <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseSlider"
                    aria-expanded="false" aria-controls="collapseSlider">
                Add Slider Images
            </button>
        </p>

        <div class="row">
            <div class="col-md-12">
                <div class="collapse multi-collapse" id="collapseSlider">
                    <div class="row row-cols-1 row-cols-md-3">
                        <?php foreach ($model->sliderImages as $image): ?>
                            <div class="col mb-4">
                                <div class="card" style="width: 18rem;">
                                    <?= Html::a(
                                        Html::img($image->getThumbFileUrl('file', 'sliderImage'),
                                            ['class' => 'card-img-top']),
                                        $image->getUploadedFileUrl('file'),
                                        ['class' => 'thumbnail', 'target' => '_blank']
                                    ) ?>
                                    <div class="card-body text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <?= Html::a('<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 0 1 0 .708L3.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
  <path fill-rule="evenodd" d="M2.5 8a.5.5 0 0 1 .5-.5h10.5a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
</svg>',
                                                [
                                                    \yii\helpers\Url::toRoute([
                                                        'move-image-up',
                                                        'id'      => $model->id,
                                                        'imageId' => $image->id,
                                                    ])
                                                ], [
                                                    'class'       => 'btn btn-default',
                                                    'data-method' => 'post',
                                                ]); ?>
                                            <?= Html::a('<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>',
                                                [
                                                    \yii\helpers\Url::toRoute([
                                                        'delete-image',
                                                        'id'      => $model->id,
                                                        'imageId' => $image->id,
                                                    ])
                                                ], [
                                                    'class' => 'btn btn-default',
                                                    'data'  => [
                                                        'method'  => 'post',
                                                        'confirm' => 'Remove image?',
                                                    ],
                                                ]); ?>
                                            <?= Html::a('<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M10.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L12.793 8l-2.647-2.646a.5.5 0 0 1 0-.708z"/>
  <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5H13a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8z"/>
</svg>',
                                                [
                                                    \yii\helpers\Url::toRoute([
                                                        'move-image-down',
                                                        'id'      => $model->id,
                                                        'imageId' => $image->id,
                                                    ])
                                                ], [
                                                    'class'       => 'btn btn-default',
                                                    'data-method' => 'post',
                                                ]); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php $form = ActiveForm::begin([
                        'enableClientValidation' => false,
                        'options'                => ['enctype' => 'multipart/form-data'],
                    ]); ?>

                    <?= $form->field($sliderImagesForm, 'files[]')->label(false)->widget(FileInput::class, [
                        'options' => [
                            'id'       => 'sliderImages',
                            'accept'   => 'image/*',
                            'multiple' => true,
                        ]
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

    <?= \frontend\themes\createx\modules\fashion_store_v1_hero_slider\widgets\HeroWidget::widget([
        'bundle' => $bundle,
    ]) ?>

</div>
