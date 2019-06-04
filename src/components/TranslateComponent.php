<?php

namespace aranytoth\Yii2GeneralTranslate\components;

use Yii;
use common\models\Language;
use common\models\TranslateSource;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TranslateComponent
 *
 * @author ASUS
 */
class TranslateComponent extends \yii\base\Component{
    
   
    public function createTranslateRecord($model, $params)
    {
        
        if(isset($params['lang'])){
            $record = TranslateSource::find()->where(['source' => $params['id'], 'table_name' => get_class($model), 'lang_id' => $params['lang']])->one();
            if (empty($record) && $params['lang'] !== Language::$defaultLang) {
                $trans = new TranslateSource();
                $trans->lang_id = $params['lang'];
                $trans->source = $params['id'];
                $trans->row_id = $model[$model->tableSchema->primaryKey[0]];
                $trans->table_name = get_class($model);
                $trans->save();
                
            }
        }
    }
    
}
