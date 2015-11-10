<?php
namespace olgert\land;

use Yii;
use yii\base\Model;

class ModelBlock extends Model
{
    const BLOCK_TYPE_FEATURES = 'features';
    const BLOCK_TYPE_CONTACT  = 'contact';

    const BASE_PATH = 'blocks/';

    static $templates = [
        self::BLOCK_TYPE_FEATURES => self::BLOCK_TYPE_FEATURES . '.php',
        self::BLOCK_TYPE_CONTACT  => self::BLOCK_TYPE_CONTACT . '.php',
    ];

    public $title;
    public $subtitle;
    public $type;

    public function render() { }

    public function getTemplatePath()
    {
        return self::BASE_PATH.self::$templates[$this->type];
    }

    public static function listBlockTypes( $keys = true )
    {
        $list = [
            self::BLOCK_TYPE_FEATURES => Yii::t('app', 'Features'),
            self::BLOCK_TYPE_CONTACT  => Yii::t('app', 'Features'),
        ];

        return $keys ? array_keys($list) : $list;
    }


}