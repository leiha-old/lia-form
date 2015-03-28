<?php

namespace Lia\FormBundle\Fields;

use Lia\KernelBundle\Annotation\ReflexionProperty;

interface FieldInterface
{
    /**
     * @return ConfigBag
     */
    public function getConfig();

    /**
     * @param ReflexionProperty $property
     * @return $this
     */
    public function extractAnnotationConfig(ReflexionProperty $property);


}