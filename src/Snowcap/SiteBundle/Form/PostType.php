<?php

namespace Snowcap\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PostType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
			->add('slug')
            ->add('body')
            ->add('published_at', 'datetime', array(
				'input' => 'datetime',
				'widget' => 'single_text',
			));
    }
	
	public function getName()
	{
		return 'post';
	}
}