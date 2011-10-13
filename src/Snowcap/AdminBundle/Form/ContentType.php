<?php

namespace Snowcap\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ContentType extends AbstractType
{
    /**
     * @var string
     */
    protected $type;
    /**
     * @var array
     */
    protected $fieldMappings;
    /**
     * Class constructor
     *
     * @param string $type
     * @param array $fieldMappings
     */
    public function __construct($type, $fieldMappings)
    {
        $this->type = $type;
        $this->fieldMappings = $fieldMappings;
    }
    /**
     * Implements \Symfony\Component\Form\AbstractType::buildForm()
     *
     * @param \Symfony\Component\Form\FormBuilder $builder
     * @param array $options
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        foreach($this->fieldMappings as $field){
            $fieldParams = array();
            if(isset($field['id']) && $field['id'] === true) {

            }
            else{
                switch($field['type']){
                    case 'datetime':
                        $type = 'datetime';
                        $fieldParams['input'] = 'datetime';
                        $fieldParams['widget'] = 'single_text';
                        break;
                    case 'text':
                        $type = 'textarea';
                        break;
                    default:
                        $type = 'text';
                        break;
                }
                $builder->add($field['fieldName'], $type, $fieldParams);
            }
        }
    }
	/**
     * Implements \Symfony\Component\Form\AbstractType::getName()
     *
     * @return string
     */
	public function getName()
	{
		return $this->type;
	}
}