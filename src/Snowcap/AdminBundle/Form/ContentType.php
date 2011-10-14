<?php

namespace Snowcap\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Snowcap\AdminBundle\Admin\Content as ContentAdmin;

class ContentType extends AbstractType
{
    /**
     * @var string
     */
    protected $type;
    /**
     * @var \Snowcap\AdminBundle\Admin
     */
    protected $admin;
    /**
     * Class constructor
     *
     * @param string $type
     * @param array $fieldMappings
     */
    public function __construct($type, ContentAdmin $admin)
    {
        $this->type = $type;
        $this->admin = $admin;
    }
    /**
     * Implements \Symfony\Component\Form\AbstractType::buildForm()
     *
     * @param \Symfony\Component\Form\FormBuilder $builder
     * @param array $options
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        foreach($this->admin->getFormFields() as $fieldName => $fieldParams){
            $defaultFieldParams = array(
                'type' => 'text',
                'options' => array(),
            );
            $fieldParams = array_merge($defaultFieldParams, $fieldParams);
            $builder->add($fieldName, $fieldParams['type'], $fieldParams['options']);
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