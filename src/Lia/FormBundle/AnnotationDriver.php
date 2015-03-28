<?php

namespace Lia\FormBundle\Library;

use Lia\KernelBundle\Annotation\Driver;

class AnnotationDriver extends Driver
{
    protected $annotationsClass = array(
        'Lia\FormBundle\Mapping\Field',
        'Doctrine\ORM\Mapping\Column'
    );


    public function convert($originalObject, $annotationsClass=null)
    {
        return parent::convert($originalObject
            , $annotationsClass ? $annotationsClass : $this->annotationsClass
        );
    }
} 