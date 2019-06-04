<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace aranytoth\Yii2GeneralTranslate;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Application;

/**
 * Description of Bootstrap
 *
 * @author ASUS
 */
class Bootstrap implements BootstrapInterface{
    
    public function bootstrap($app)
    {   
        if (!$app->hasModule('translate') && basename(Yii::getAlias('@app')) !== 'frontend') {
            $app->setModule('translate', 'aranytoth\Yii2GeneralTranslate\Module');
        }
        
        $app->set('TranslateComponent','aranytoth\Yii2GeneralTranslate\components\TranslateComponent');
        
    }
}
