<?php

namespace Snowcap\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Snowcap\AdminBundle\Admin\Content as ContentAdmin;

/**
 * Base Form type for admin content management
 * 
 */
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
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
	public function getName()
	{
		return $this->type;
	}
}