<?php

namespace Lia\Bundle\FormBundle\Library;

use Lia\Library\Bag\Bag;
use Lia\Library\Bag\CssBag;

class ConfigBag
    extends Bag
{
    /**
     * @var CssBag
     */
    public $css;

    public function __construct(){
        parent::__construct(array(
                'name',
                'action',
                'method',
                'protocol',
                'css' => array(
                    'classBag' => 'Lia\Library\Bag\CssBag'
                )
            )
        );
        $this->css = $this->get('css');
    }

    public function getAll($type = 'array'){
        $config = parent::getAll($type);
        $config['css'] = (object)$this->css->getAll($type);
        return $config;
    }

    public function getName(){
        return $this->get('name');
    }

    public function getAction($default=''){
        return $this->get('action', $default);
    }

    public function getMethod($default=''){
        return $this->get('method', $default);
    }

    public function getProtocol($default=''){
        return $this->get('protocol', $default);
    }

    public function setName($name){
        return $this->set('name', $name);
    }

    public function setAction($action){
        return $this->set('action', $action);
    }

    public function setMethod($method){
        return $this->set('method', $method);
    }

    public function setProtocol($protocol){
        return $this->set('protocol', $protocol);
    }


}