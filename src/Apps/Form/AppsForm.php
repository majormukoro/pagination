<?php
namespace Apps\Form;

use Zend\Form\Form;
use \Zend\Form\Element;

class AppsForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('apps');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('method', 'post');

        
        $id = new Element\Hidden('id');
        $id->setAttribute('class', 'primarykey');
        
        $firstname = new Element\Text('firstname');
        $firstname->setLabel('First Name: ')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'First Name');
        
        $othername = new Element\Text('othername');
        $othername->setLabel('Othername: ')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'Othername');
        
        $surname = new Element\Text('surname');
        $surname->setLabel('Surname: ')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'Surname');
        
        $sex = new Element\Text('sex');
        $sex->setLabel('Sex: ')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'Sex');
        
        $age = new Element\Text('age');
        $age->setLabel('Age: ')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'Age');
        
        $religion = new Element\Text('religion');
        $religion->setLabel('Religion: ')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'Religion');
        
	
        $localgovt = new Element\Text('localgovt');
        $localgovt->setLabel('Local Govt. Area: ')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'LGA to search');
        
        $stateoforigin = new Element\Text('stateoforigin');
        $stateoforigin->setLabel('State: ')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'State');
        
        $nationality = new Element\Text('nationality');
        $nationality->setLabel('Nationality: ')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'State');

        $mainsubject = new Element\Text('mainsubject');
        $mainsubject->setLabel('Subject of Teacher: ')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'Subject of teacher');
        
        $qualification = new Element\Text('qualification');
        $qualification->setLabel('Qualification: ')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'Qualification');  
        
        $address = new Element\Text('address');
        $address->setLabel('Residential Address: ')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'Residential Address');
        
        $phonenumber = new Element\Text('phonenumber');
        $phonenumber->setLabel('Phone Number: ')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'Phone Number');
        
        $submit = new Element\Submit('submit');
        $submit->setValue('Submit')
                ->setAttribute('class', 'btn btn-primary');

        $this->add($id);
        $this->add($firstname);
        $this->add($othername);
        $this->add($surname);
        $this->add($sex);
        $this->add($age);
        $this->add($religion);
        $this->add($localgovt);
        $this->add($stateoforigin);
        $this->add($nationality);
	$this->add($mainsubject);
        $this->add($qualification);
        $this->add($address);
        $this->add($phonenumber);
        $this->add($submit);

    }
}


    
