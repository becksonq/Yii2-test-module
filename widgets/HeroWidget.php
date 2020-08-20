<?php


namespace frontend\themes\createx\modules\fashion_store_v1_hero_slider\widgets;


use frontend\themes\createx\assets\AppAsset;
use frontend\themes\createx\modules\fashion_store_v1_hero_slider\models\FashionStoreV1HeroSlider;
use yii\base\Widget;

/**
 * Class HeroWidget
 * @package frontend\themes\createx\modules\fashion_store_v1_hero_slider\widgets
 *
 * @example
 * <?= \frontend\themes\createx\modules\fashion_store_v1_hero_slider\widgets\HeroWidget::widget(['bundle' => $bundle,]) ?>
 */
class HeroWidget extends Widget
{
    /** @var $bundle AppAsset */
    public $bundle;
    /** @var FashionStoreV1HeroSlider $model
     * @todo возможность передать модель извне
     */
    public $model;

    public function run()
    {
        return $this->render('index', [
            'bundle' => $this->bundle,
            'model'  => FashionStoreV1HeroSlider::find()->where(['status' => FashionStoreV1HeroSlider::STATUS_ACTIVE])->one(),
        ]);
    }
}
