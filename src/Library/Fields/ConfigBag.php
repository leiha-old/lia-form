<?php

namespace Lia\Bundle\FormBundle\Library\Fields;

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
                'type',
                'length',
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

    public function setName($name){
        return $this->set('name', $name);
    }

    public function getType(){
        return $this->get('type');
    }

    public function setType($name){
        return $this->set('type', $name);
    }

    public function getLength(){
        return $this->get('length');
    }

    public function setLength($name){
        return $this->set('length', $name);
    }
}