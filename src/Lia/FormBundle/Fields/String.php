<?php

namespace Lia\FormBundle\Fields;

use Lia\KernelBundle\Annotation\ReflexionProperty;

class String
    extends Field
{
    public function extractAnnotationConfig(ReflexionProperty $property){


        //$this->getConfig()->set($config);
        return $this;
    }
}