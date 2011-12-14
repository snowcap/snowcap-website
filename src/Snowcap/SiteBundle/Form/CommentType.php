<?php

namespace Snowcap\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'blog.comment.name'))
			->add('email', 'email', array('label' => 'blog.comment.email'))
            ->add('body', 'textarea', array('label' => 'blog.comment.body'))
        ;
    }
	
	public function getName()
	{
		return 'comment';
	}
}