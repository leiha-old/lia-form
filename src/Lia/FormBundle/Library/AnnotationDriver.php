<?php

namespace Lia\FormBundle\Library;

use Lia\Library\Annotation\Driver;

class AnnotationDriver extends Driver
{
    protected $annotationsClass = array(
        'Lia\FormBundle\Library\Mapping\Field',
        'Doctrine\ORM\Mapping\Column'
    );


    public function convert($originalObject, $annotationsClass=null)
    {
        return parent::convert($originalObject
            , $annotationsClass ? $annotationsClass : $this->annotationsClass
        );
    }
} 