<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace aranytoth\Yii2GeneralTranslate\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use aranytoth\Yii2GeneralTranslate\models\Language;
use aranytoth\Yii2GeneralTranslate\models\TranslateSource;



/**
 * Description of LangWidget
 *
 * @author ASUS
 */
class LangWidget extends Widget{
    
    public $model;

    public function init()
    {
        parent::init();
        
    }

    public function run()
    {
        $params = Yii::$app->request->get();
        $langs = Language::getActiveLanguages();
        $content = '';
        foreach ($langs as $lang) {
            
            $source = TranslateSource::getSource($this->model);
            
            if (empty($source)) {
                
                if (!isset($params['id'])) {
                    return false;
                }
                
                $source = $params['id'];
            }
            $translang = TranslateSource::find()->where(['lang_id' => $lang->lang_id, 'source' => $source, 'table_name' => get_class($this->model)])->one();
            $isNew = 'Edit ';
            if (empty($translang)) {
                
                if ($lang->lang_id !== Language::$defaultLang) {
                    $current = $this->model->isNewRecord && isset($params['lang']) && $params['lang'] == $lang->lang_id ? 'active' : '';
                    $isNew = 'Create ';
                    $content .= Html::a($isNew.' '.$lang->lang_id, 'create?id='.($source.'&lang='.$lang->lang_id), ['class' =>'list-group-item list-group-item-action '.$current]);
                } else {
                    $current = empty($this->model->translateRow) && !$this->model->isNewRecord ? 'active' : '';
                    $content .= Html::a($isNew.' '.$lang->lang_id, 'update?id='.$source, ['class' =>'list-group-item list-group-item-action '.$current]);
                }
                
                
            } else {
                $current = $translang->row_id == $this->model[$this->model->tableSchema->primaryKey[0]] ? 'active' : '';
                $content .= Html::a($isNew.' '.$lang->lang_id, 'update?id='.$translang->row_id, ['class' =>'list-group-item list-group-item-action '.$current]);
            }
            
        }
        
        return '<div class="list-group">'.$content.'</div>';
    }
}
