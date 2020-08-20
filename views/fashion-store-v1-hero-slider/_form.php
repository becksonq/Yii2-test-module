<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View
 * @var $model frontend\themes\createx\modules\fashion_store_v1_hero_slider\models\FashionStoreV1HeroSlider
 * @var $form yii\widgets\ActiveForm
 * @var $dynamicModel \yii\base\DynamicModel
 */
?>

<div class="fashion-store-v1-hero-slider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hero_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <p class="text-info">Данные для баннеров вносятся через вертикальную черту</p>
    <?= $form->field($dynamicModel, "backgroundColor")->textarea(['rows' => 2, 'placeholder' => '#3aafd2 | #3aafd2 | #3aafd2']) ?>
    <?= $form->field($dynamicModel, "h2")->textarea(['rows' => 2]) ?>
    <?= $form->field($dynamicModel, "h1")->textarea(['rows' => 2]) ?>
    <?= $form->field($dynamicModel, "p")->textarea(['rows' => 2]) ?>
    <?= $form->field($dynamicModel, "buttonLink")->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        0 => 'No',
        1 => 'Yes',
    ]) ?>

    <!--    --><? //= $form->field($model, 'created_at')->textInput() ?>

    <!--    --><? //= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save ' . '<svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
</svg>'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
