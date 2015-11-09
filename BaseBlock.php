<?php
namespace olgert\land;
use Yii;

abstract class BaseBlock
{
    const BLOCK_TYPE_FEATURES = 'features';
    const BLOCK_TYPE_CONTACT  = 'contact';

    public $title;
    public $subtitle;

    abstract public function init();

    abstract public function render();

    public static function listBlockTypes( $keys = true )
    {
        $list = [
            self::BLOCK_TYPE_FEATURES => Yii::t('app', 'Features'),
            self::BLOCK_TYPE_FEATURES => Yii::t('app', 'Features'),
        ];

        return $keys ? array_keys($list) : $list;
    }

}