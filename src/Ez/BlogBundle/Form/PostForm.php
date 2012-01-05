<?php
namespace Ez\BlogBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\TextArea;
use Symfony\Component\Form\HiddenField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PostForm extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
			->add('title', 'text', array('required' => true))
			->add('content', 'textarea', array('required' => true));
    }
	
	public function getName(){ 
		return 'test';
	}
	
}