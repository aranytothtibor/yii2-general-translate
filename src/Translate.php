<?php

namespace aranytoth\Yii2GeneralTranslate;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\base\BootstrapInterface;
use yii\base\Application;

/**
 * Description of Translate
 *
 * @author ASUS
 */
class Translate implements BootstrapInterface{
    
    public function bootstrap($app)
    {
        echo 'zezeze';
        $app->getUrlManager()->addRules([
            'aranytoth/translate' => 'site/test'
        ], false);
    }
    
   
    public function Initial()
    {
        echo 'hellllo';
    }
    
    
    
}
