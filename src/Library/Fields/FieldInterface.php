<?php

namespace Lia\Bundle\FormBundle\Library\Fields;

use Lia\Library\Annotation\ReflexionProperty;

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