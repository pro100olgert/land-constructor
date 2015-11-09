<?php
namespace olgert\land;

use Exception;
use Yii;

/**
 * Class Constructor
 * @package olgert\land
 *
 * @property BaseBlock[] $blocks
 */
class Constructor
{
    const TEMPLATE_DEFAULT = 'default';

    public $template;
    public $blocks;
    public $settings;

    public function __construct( $jsonFile, $template = self::TEMPLATE_DEFAULT )
    {
        $json = file_get_contents($jsonFile);

        $this->template = in_array($template, self::listTemplateTypes()) ? $template : self::TEMPLATE_DEFAULT;
        $blocksConfig   = (array)json_decode($json, true);

        foreach( $blocksConfig as $config )
        {
            try
            {
                if( empty($config['type']) )
                    throw new Exception("Wrong block type: '{$config['type']}'");

                switch( $config['type'] )
                {
                    case BaseBlock::BLOCK_TYPE_CONTACT:
                        $this->blocks[] = new BlockContact($config);
                        break;
                    case BaseBlock::BLOCK_TYPE_FEATURES:
                        $this->blocks[] = new BlockFeatures($config);
                        break;
                    default:
                        throw new Exception("Wrong block type: '{$config['type']}'");
                }
            } catch( Exception $e )
            {
                // Block init was failed
                var_dump($e->getMessage());
                continue;
            }
        }
    }

    public function render()
    {
        $content = file_get_contents($this->getTemplatePath());

        $blockContent = '';
        foreach( $this->blocks as $block )
        {
            $blockContent .= $block->render();
        }

        $content = str_replace('~{content}~', $blockContent, $content);

        return $content;
    }

    public function getTemplatePath()
    {
        return dirname(__FILE__) . '/templates/' . $this->template . '/';
    }

    public static function listTemplateTypes( $keys = true )
    {
        $list = [
            self::TEMPLATE_DEFAULT => Yii::t('app', 'Default'),
        ];

        return $keys ? array_keys($list) : $list;
    }
}