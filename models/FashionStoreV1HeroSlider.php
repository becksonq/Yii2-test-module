<?php

namespace frontend\themes\createx\modules\fashion_store_v1_hero_slider\models;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use shop\exceptions\NotFoundException;
use Yii;
use yii\base\DynamicModel;
use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%fashion_store_v1_hero}}".
 *
 * @property int $id
 * @property string $hero_name
 * @property string|null $description
 * @property string|array $slider_items
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property SliderImages[] $sliderImages
 */
class FashionStoreV1HeroSlider extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /** @var string */
    public $backgroundColor;
    /** @var string */
    public $imageAlt;
    /** @var string */
    public $h2;
    /** @var string */
    public $h1;
    /** @var string */
    public $p;
    /** @var string */
    public $buttonLink;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%fashion_store_v1_hero}}';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            [
                'class'     => SaveRelationsBehavior::className(),
                'relations' => [
                    'sliderImages',
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
            [['hero_name',], 'required'],
            [['description',], 'string'],
            [['slider_items',], 'safe'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['hero_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('app', 'ID'),
            'hero_name'    => Yii::t('app', 'Hero Name'),
            'description'  => Yii::t('app', 'Description'),
            'slider_items' => Yii::t('app', 'Slider Items'),
            'status'       => Yii::t('app', 'Status'),
            'created_at'   => Yii::t('app', 'Created At'),
            'updated_at'   => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            if (Yii::$app->request->getBodyParam('DynamicModel') !== null) {
                $this->slider_items = Json::encode(Yii::$app->request->getBodyParam('DynamicModel'));
            } else {
                $array = [];
                foreach ($this->slider_items as $key => $item) {
                    $array[$key] = implode('|', $item);
                }
                $this->slider_items = Json::encode($array);
            }
            return true;
        }
        return false;
    }

    /**
     * Переводим в массив после извлечения из базы
     */
    public function afterFind()
    {
        $this->slider_items = Json::decode($this->slider_items);
        $array = [];
        if (is_array($this->slider_items)) {
            foreach ($this->slider_items as $key => $item) {
                $array[$key] = explode('|', $item);
            }
            $this->slider_items = $array;
        }
        parent::afterFind();
    }

    /**
     * @param null $params
     * @return DynamicModel
     */
    public function createModel($params = null): DynamicModel
    {
        $model = new DynamicModel([
            'backgroundColor' => $params['backgroundColor'] !== null
                ? implode('|', $params['backgroundColor']) : $this->backgroundColor,
            'h2'              => $params['h2'] !== null ? implode('|', $params['h2']) : $this->h2,
            'h1'              => $params['h1'] !== null ? implode('|', $params['h1']) : $this->h1,
            'p'               => $params['p'] !== null ? implode('|', $params['p']) : $this->p,
            'buttonLink'      => $params['buttonLink'] !== null ? implode('|',
                $params['buttonLink']) : $this->buttonLink,
        ]);
        $model->addRule(['image', 'imageAlt', 'h2', 'h1', 'p', 'buttonLink',], 'string');

        return $model;
    }

    /**
     * @param $id
     * @param SliderImagesForm $form
     * @throws \yii\base\InvalidConfigException
     */
    public function addSliderImages($id, SliderImagesForm $form): void
    {
        $model = self::findOne($id);
        if ($form->files !== null) {
            foreach ($form->files as $file) {
                $model->addNewImages($file);
            }
            if (!$model->save()) {
                d($model->getErrors());
                die;
            }
        } else {
            throw new NotFoundException('No images loaded.');
        }
    }

    /**
     * @param UploadedFile $file
     * @param $attribute
     * @param $model
     * @throws \yii\base\InvalidConfigException
     */
    public function addNewImages(UploadedFile $file)
    {
        $images = $this->sliderImages;
        $model = new SliderImages();
        $images[] = $model::create($file);
        $imagesArray = $this->updateImages($images);
        $this->sliderImages = $imagesArray;
    }

    /**
     * @param $id
     * @param $imageId
     */
    public function removeImage($id, $imageId): void
    {
        $model = self::findOne($id);
        $images = $model->sliderImages;
        foreach ($images as $key => $image) {
            if ($image->isIdEqualTo($imageId)) {
                unset($images[$key]);
                $imagesArray = $this->updateImages($images);
            }
        }

        foreach ($imagesArray as $i => $image) {
            if ($image->isIdEqualTo($imageId)) {
                unset($images[$i]);
                $imagesArray = $this->updateImages($images);
            }
        }

        $model->sliderImages = $imagesArray;
        $model->save();
    }

    /**
     * @param $id
     * @param $imageId
     */
    public function moveImageUp($id, $imageId): void
    {
        $model = self::findOne($id);
        $images = $model->sliderImages;
        foreach ($images as $i => $image) {
            if ($image->isIdEqualTo($imageId)) {
                if ($prev = $images[$i - 1] ?? null) {
                    $images[$i - 1] = $image;
                    $images[$i] = $prev;
                    $imagesArray = $this->updateImages($images);
                }
            }
        }
        $model->sliderImages = $imagesArray;
        $model->save();
    }

    /**
     * @param $id
     * @param $imageId
     */
    public function moveImageDown($id, $imageId): void
    {
        $model = self::findOne($id);
        $images = $model->sliderImages;
        foreach ($images as $i => $image) {
            if ($image->isIdEqualTo($imageId)) {
                if ($next = $images[$i + 1] ?? null) {
                    $images[$i] = $next;
                    $images[$i + 1] = $image;
                    $imagesArray = $this->updateImages($images);
                }
            }
        }
        $model->sliderImages = $imagesArray;
        $model->save();
    }

    /**
     * @param array $images
     * @return array
     */
    private function updateImages(array $images): array
    {
        foreach ($images as $key => $image) {
            $image->setSort($key);
        }
        return $images;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSliderImages()
    {
        return $this->hasMany(SliderImages::class, ['parent_id' => 'id'])->orderBy('sort');
    }

    /**
     * @return array
     */
    public function testData(): array
    {
        return [
            [
                'image'      => '/img/home/hero-slider/01.jpg',
                'h2'         => 'Has just arrived!',
                'h1'         => 'Huge Summer Collection',
                'p'          => 'Swimwear, Tops, Shorts, Sunglasses &amp; much more...',
                'buttonLink' => 'shop-grid-ls.html',
            ],
            [
                'image'      => '/img/home/hero-slider/02.jpg',
                'h2'         => 'Hurry up! Limited time offer.',
                'h1'         => 'Women Sportswear Sale',
                'p'          => 'Sneakers, Keds, Sweatshirts, Hoodies &amp; much more...',
                'buttonLink' => 'shop-grid-ls.html',
            ],
            [
                'image'      => '/img/home/hero-slider/03.jpg',
                'h2'         => 'Complete your look with',
                'h1'         => 'New Men\'s Accessories',
                'p'          => 'Hats &amp; Caps, Sunglasses, Bags &amp; much more...',
                'buttonLink' => 'shop-grid-ls.html',
            ],
        ];
    }
}
