<?php

namespace Snowcap\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
			->add('email', 'email')
            ->add('body')
        ;
    }
	
	public function getName()
	{
		return 'comment';
	}
}