<?php
namespace Apps\Form;

use Zend\Form\Form;
use \Zend\Form\Element;

class AppsSearchForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('apps');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('method', 'post');


	
        $localgovt = new Element\Text('localgovt');
        $localgovt->setLabel('Local Govt. Area:')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'Enter Choice LGA');
        

        $mainsubject = new Element\Text('mainsubject');
        $mainsubject->setLabel('Subject of Teacher:')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'Enter the subject');
        



        $submit = new Element\Submit('submit');
        $submit->setValue('Search')
                ->setAttribute('class', 'btn btn-primary');


        $this->add($localgovt);
	$this->add($mainsubject);
	
        $this->add($submit);

    }
}


    
