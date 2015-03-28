<?php

namespace Lia\FormBundle\Fields;

use Lia\KernelBundle\Annotation\ReflexionProperty;

class Integer
    extends Field
{

    public function extractAnnotationConfig(ReflexionProperty $property){


        //$this->getConfig()->set($config);
        return $this;
    }
}