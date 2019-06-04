<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace aranytoth\Yii2GeneralTranslate\models;

use Yii;
use aranytoth\Yii2GeneralTranslate\models\Language;

/**
 * Description of LangModel
 *
 * @author Tibor
 */
class LangModel extends \yii\db\ActiveRecord{
    
    public static function find() {
        
        
                
                
        
        $query = parent::find();
        
        $modelName = $query->modelClass;
        
        $modelInst = new $modelName();
        
        if (isset($modelInst->getTableSchema()->primaryKey[0])) {
            
            $pk = $modelInst->getTableSchema()->primaryKey[0];
            $query->leftJoin('translate_source', 'translate_source.row_id = '.$pk);
            $query->andWhere(['translate_source.source' => null]);
        }
        
        return $query;
    }
    
    public static function findByLang()
    {
        $query = parent::find();
        
        $modelName = $query->modelClass;
        
        $modelInst = new $modelName();
        
        if (isset($modelInst->getTableSchema()->primaryKey[0])) {
            
            $pk = $modelInst->getTableSchema()->primaryKey[0];
            
            $lang = Yii::$app->language == Language::$defaultLang ? null : Yii::$app->language;
            
            $query->leftJoin('translate_source', 'translate_source.row_id = '.$pk);
            $query->andWhere(['translate_source.lang_id' => $lang]);
        }
        
        return $query;
    }

    public function save($runValidation = true, $attributeNames = null) {
        
        $params = Yii::$app->request->get();
        
        if (parent::save($runValidation, $attributeNames)) {
            if(isset($params['lang'])){
                
                $record = TranslateSource::find()->where(['source' => $params['id'], 'table_name' => get_class($this), 'lang_id' => $params['lang']])->one();
                if (empty($record) && $params['lang'] !== Language::$defaultLang) {
                    $trans = new TranslateSource();
                    $trans->lang_id = $params['lang'];
                    $trans->source = $params['id'];

                    $trans->row_id = $this[$this->getTableSchema()->primaryKey[0]];
                    $trans->table_name = get_class($this);
                    $trans->save();
                }
            }
            return true;
        }
    }
    
    public function getTranslate()
    {
        return $this->hasOne(\aranytoth\Yii2GeneralTranslate\models\TranslateSource::className(), ['source' => $this->tableSchema->primaryKey[0]]);
    }
    
    public function getTranslateRow()
    {
        return $this->hasOne(\aranytoth\Yii2GeneralTranslate\models\TranslateSource::className(), ['row_id' => $this->tableSchema->primaryKey[0]]);
    }
    
}
