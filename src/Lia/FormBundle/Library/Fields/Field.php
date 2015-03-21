<?php

namespace Lia\FormBundle\Library\Fields;

//use Lia\Library\Annotation\ReflexionProperty;
use Lia\Library\Bag\CssBag;
use Lia\Library\Exception\Exception;

abstract class Field
    implements FieldInterface, \JsonSerializable
{
    /**
     * @var ConfigBag
     */
    public $config;

    /**
     * @var CssBag
     */
    public $configCss;


    protected static $availableFields = array(
        'string'  => 'Lia\FormBundle\Library\Fields\String',
        'text'    => 'Lia\FormBundle\Library\Fields\String',
        'integer' => 'Lia\FormBundle\Library\Fields\Integer',
    );

    /**
     * @param string $type
     * @throws \Lia\Library\Exception\Exception
     * @return Field
     */
    public static function make($type){
        if(!isset(self::$availableFields[$type])){
            throw new Exception('Type of field [%1s] not registered',
                array($type)
            );
        }
        return new self::$availableFields[$type];
    }

    public function __construct(){
        $this->config    = new ConfigBag();
        $this->configCss = $this->config->get('css');
    }

    public function jsonSerialize(){
        return $this->config->getAll();
    }

    public function getConfig(){
        return $this->config;
    }

    /*
    public function extractAnnotationConfig(ReflexionProperty $property)
    {


        //$this->getConfig()->set($config);
        return $this;
    }*/
}