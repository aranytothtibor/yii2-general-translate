<?php

namespace aranytoth\Yii2GeneralTranslate\models;

use Yii;
use aranytoth\Yii2GeneralTranslate\components\TranslateComponent;

/**
 * This is the model class for table "translate_source".
 *
 * @property string $lang_id
 * @property string $table_name
 * @property int $row_id
 */
class TranslateSource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'translate_source';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lang_id', 'table_name', 'row_id', 'source'], 'required'],
            [['row_id', 'source'], 'integer'],
            [['lang_id'], 'string', 'max' => 50],
            [['table_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    
    public function attributeLabels()
    {
        return [
            'lang_id' => 'Lang ID',
            'table_name' => 'Table Name',
            'row_id' => 'Row ID',
            'source' => 'Szülő'
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    
    public function getSource($model)
    {
        //var_dump($model);
        $row = self::find()->where(['row_id' => $model[$model->tableSchema->primaryKey[0]], 'table_name'=> get_class($model)])->one();
        
        return (!empty($row) ? $row->source : $model->id);
        
    }
    
    /*public static function find() {
        $query = parent::find();
        if (get_class() !== 'aranytoth\Yii2GeneralTranslate\models\TranslateSource') {
            $query->leftJoin('translate_source', 'translate_source.row_id = category.id');
            $query->andWhere(['translate_source.source' => null]);
        }
        
        return $query;
    }*/
    
    public function afterSave($insert, $changedAttributes) {
        
        
        TranslateComponent::createTranslateRecord($this, Yii::$app->request->get());
        
        parent::afterSave($insert, $changedAttributes);
    }
    
    public function getTranslate()
    {
        return $this->hasOne(\common\models\TranslateSource::className(), ['source' => $this->tableSchema->primaryKey[0]]);
    }
    
    public function getTranslateRow()
    {
        return $this->hasOne(\common\models\TranslateSource::className(), ['row_id' => $this->tableSchema->primaryKey[0]]);
    }
    
}
