<?php

namespace Lia\FormBundle\Mapping;

/**
 * @Annotation
 */
class Field {

    /** @var string */
    public $name;

    /** @var string */
    public $label;

    /** @var string */
    public $type;

    /** @var integer */
    public $length;

    /** @var string */
    public $className;

}