<?php


namespace frontend\themes\createx\modules\fashion_store_v1_hero_slider\models;


use yii\base\Model;
use yii\web\UploadedFile;

class SliderImagesForm extends Model
{
    /** @var UploadedFile[] */
    public $files;

    public function rules(): array
    {
        return [
            ['files', 'each', 'rule' => ['image']],
            /*[
                ['files'],
                'image',
                'skipOnEmpty' => false,
                'extensions'  => 'png, jpg, jpeg',
                'maxFiles'    => 3
            ],*/
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->files = UploadedFile::getInstances($this, 'files');
            return true;
        }

        return false;
    }
}