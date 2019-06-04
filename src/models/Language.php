<?php

namespace aranytoth\Yii2GeneralTranslate\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property string $lang_id
 * @property int $parent_id
 * @property string $name
 * @property string $name_ascii
 * @property int $status
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language';
    }
    
    public static $defaultLang = 'en-US';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lang_id', 'name', 'name_ascii'], 'required'],
            [['parent_id', 'status'], 'integer'],
            [['lang_id'], 'string', 'max' => 50],
            [['name', 'name_ascii'], 'string', 'max' => 100],
            [['lang_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lang_id' => 'Lang ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'name_ascii' => 'Name Ascii',
            'status' => 'Status',
        ];
    }
    
    public function getActiveLanguages()
    {
        
        return self::find()->where(['status' => 1])->all();
        
    }
    
    public function defaultLang()
    {
        return $this->defaultLang();
    }
}
