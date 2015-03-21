<?php

namespace Lia\Bundle\FormBundle\Library;

use Lia\Bundle\FormBundle\Library\Fields\Field;
use Lia\Bundle\FormBundle\Library\Fields\FieldInterface;
use Lia\Library\Annotation\ReflectionObject;
use Lia\Library\Annotation\ReflexionProperty;
use Lia\Library\Bag\CssBag;

use Lia\Library\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class Form {

    /**
     * @var ConfigBag
     */
    public $config;

    /**
     * @var CssBag
     */
    public $configCss;

    /**
     * @var Field[]
     */
    protected $fields = array();

    public function __construct(){
        $this->config    = new ConfigBag();
        $this->configCss = $this->config->get('css');
    }

    public function __toString(){
        return $this->getAll('json');
    }

    public function isSent(Request $request){
        if(!$request->isMethod($this->config->getMethod())
            || !$request->request->has($this->config->getName())
        ){
            return false;
        };

        $values = $request->request->get($this->config->getName());

        return true;
    }

    public function isValid(){

    }

    /**
     * Returns all values
     *
     * @param string $type Must be equals to : [ array|json ]
     *
     * @return array|string
     */
    public function getAll($type='array') {
        $values = $this->config->getAll();
        foreach($this->fields as $field){
            $values['fields'][$field->config->getName()] = $field->config->getAll();
        }

        switch($type){
            case 'json' :
                return json_encode($values);
                break;
            default:
                return $values;
                break;
        }
    }

    public function build(){

        $fields = '';
        foreach($this->fields as $field){
            $fields .= '.addField("'.$field->config->getType()
                .'", "'.$field->config->getName()
                .'", ' .$field->config->getAll('json').')'
            ;
        }

        return '<script type="text/javascript">
            Form.register("'.$this->config->getName().'",'.$this->config->getAll('json').')
            '.$fields.'
            .render();
            </script>
            ';
    }

    /**
     * @param string $className
     * @return $this
     */
    public function extractAnnotationConfig($className){
        $reflectionClass = new ReflectionObject($className);

        // Check Fields configuration by reflexion in class [$className]
        $properties = $reflectionClass->getProperties();
        foreach($properties as $name => $property){
            if($fieldObject = $this->checkPropertyForFieldAnnotationsConfig($name, $property, $className)){
                $this->fields[$name] = $fieldObject;
            }
        }
        return $this;
    }

    /**
     * Search a field configuration in class with annotations
     *
     * @param string $name                  Property Name
     * @param ReflexionProperty $property   Property Reflexion Object
     * @throws \Lia\Library\Exception\Exception
     * @return void|FieldInterface
     */
    protected function checkPropertyForFieldAnnotationsConfig($name, ReflexionProperty $property){

        // if Property haven't a Field annotation do nothing !
        if(!$config = $property->getAnnotation('Lia\Bundle\FormBundle\Library\Mapping\Field')){
            return;
        }

        // Check for Doctrine Column annotation (can to complete a field config)
        if($column = $property->getAnnotation('Doctrine\ORM\Mapping\Column')){
            // Check for name
            if(empty($config['name'])){
                $config['name'] = $name = !empty($column['name']) ? $column['name'] : $name;
            }

            // Check for length
            if(empty($config['length']) && !empty($column['length'])){
                $config['length'] = $column['length'];
            }

            // Check for type
            if(empty($config['type'])){
                if(!empty($column['type'])){
                    $config['type'] = $column['type'];
                } else {
                    throw new Exception('Missing type of field for [%1s] in entity [%2s]',
                        array($name, $property->getClassName())
                    );
                }
            }
        }

        // Check for label
        if(empty($config['label'])){
            $config['label'] = $config['name'];
        }

        // Check for className
        if(empty($config['className'])){
            // Check in registered Field
            $fieldObject = Field::make($config['type']);
        } else {
            /* @var Field $fieldObject */
            $fieldObject = new $config['className']();
            if(!$fieldObject instanceof Field){
                throw new Exception('Class [%1s] must extends'
                    .' [Lia\Bundle\FormBundle\Library\Fields\Field] in [%2s]',
                    array($config['className'], $property->getClassName())
                );
            }
        }

        // Set the primary configuration
        $fieldObject->getConfig()->set($config);

        // Executes the specific treatment of FieldClass for find others annotations
        $fieldObject->extractAnnotationConfig($property);

        return $fieldObject;
    }
}