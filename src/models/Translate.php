<?php

namespace aranytoth\Yii2GeneralTranslate\models;

use Yii;
use aranytoth\Yii2GeneralTranslate\components\TranslateComponent;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TranslateModel
 *
 * @author aranytoth
 */
class Translate extends \yii\db\ActiveRecord{
    
    
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
