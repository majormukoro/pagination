<?php

namespace Apps\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Apps
{
    public $firstname;
    public $othername;
    public $surname;
    public $sex;
    public $age;
    public $localgovt;
    public $mainsubject;
    public $stateoforigin;
    public $nationality;
    public $religion;
    public $qualification;
    public $address;
    public $phonenumber;
    public $passport;
	
    protected $inputFilter;  
    
    // <-- Add this variable
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }
    public function getFirstname()
    {
        return $this->firstname;
    }
    public function setFirstname($firstname)
    {
        $this->firstname = (int) $firstname;
        return $this;
    }
    public function exchangeArray($data)
    {
        $this->id               = (isset($data['id'])) ? $data['id'] : null;
        $this->firstname        = (isset($data['firstname'])) ? $data['firstname'] : null;
        $this->othername        = (isset($data['othername'])) ? $data['othername'] : null;
        $this->surname          = (isset($data['surname'])) ? $data['surname'] : null;
        $this->sex              = (isset($data['sex'])) ? $data['sex'] : null;
        $this->age              = (isset($data['age'])) ? $data['age'] : null;
	$this->localgovt        = (isset($data['localgovt'])) ? $data['localgovt'] : null;
	$this->mainsubject      = (isset($data['mainsubject'])) ? $data['mainsubject'] : null;
        $this->stateoforigin    = (isset($data['stateoforigin'])) ? $data['stateoforigin'] : null;
        $this->nationality      = (isset($data['nationality'])) ? $data['nationality'] : null;
        $this->religion         = (isset($data['religion'])) ? $data['religion'] : null;
        $this->qualification    = (isset($data['qualification'])) ? $data['qualification'] : null;
        $this->address          = (isset($data['address'])) ? $data['address'] : null;
        $this->phonenumber      = (isset($data['phonenumber'])) ? $data['phonenumber'] : null;
        $this->passport         = (isset($data['passport'])) ? $data['passport'] : null;
	
    }
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }


    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name'     => 'id',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'Int'),
                        ),
            )));

            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'localgovt',
                        'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'mainsubject',
                        'required' => true,
            )));
            

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
