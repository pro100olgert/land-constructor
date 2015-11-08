<?php
namespace olgert\land;

use Yii;

class Module extends \yii\base\Module
{
    /**
     * Init module
     */
    public function init()
    {
        parent::init();
        Yii::setAlias('@olgert/land', __DIR__ . '/');
    }

}