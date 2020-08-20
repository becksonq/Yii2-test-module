<?php

namespace frontend\themes\createx\modules\fashion_store_v1_hero_slider\models;

use Yii;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "{{%fashion_store_v1_slider_images}}".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $file
 * @property int $sort
 *
 * @property FashionStoreV1HeroSlider $fashionStoreV1HeroSlider
 */
class SliderImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%fashion_store_v1_slider_images}}';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            [
                'class'                 => ImageUploadBehavior::class,
                'attribute'             => 'file',
                'createThumbsOnRequest' => true,
                'filePath'              => '@staticRoot/origin/fashion_v1_hero/[[attribute_parent_id]]/[[id]].[[extension]]',
                'fileUrl'               => '@static/origin/fashion_v1_hero/[[attribute_parent_id]]/[[id]].[[extension]]',
                'thumbPath'             => '@staticRoot/cache/fashion_v1_hero/[[attribute_parent_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl'              => '@static/cache/fashion_v1_hero/[[attribute_parent_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs'                => [
                    'sliderImage' => ['width' => 963, 'height' => 700],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'        => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'file'      => Yii::t('app', 'File'),
            'sort'      => Yii::t('app', 'Sort'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFashionStoreV1HeroSlider()
    {
        return $this->hasOne(FashionStoreV1HeroSlider::class, ['id' => 'parent_id']);
    }

    /**
     * @param UploadedFile $file
     * @return SliderImages
     */
    public static function create(UploadedFile $file): self
    {
        $image = new static();
        $image->file = $file;
        return $image;
    }

    /**
     * @param $sort
     */
    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }
}