<?php

namespace Lia\Bundle\FormBundle\Library\Fields;

use Lia\Library\Annotation\ReflexionProperty;

class String
    extends Field
{
    public function extractAnnotationConfig(ReflexionProperty $property){


        //$this->getConfig()->set($config);
        return $this;
    }
}