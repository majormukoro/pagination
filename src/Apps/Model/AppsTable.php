<?php
namespace Apps\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;

class AppsTable extends AbstractTableGateway 
{
    protected $table = 'apps';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Apps());

        $this->initialize();
    }

    public function fetchAll(Select $select = null) {
        if (null === $select)
            $select = new Select();
        $select->from($this->table);
        $resultSet = $this->selectWith($select);
        $resultSet->buffer();
        return $resultSet;
    }


    public function getApps($id) {
        $id = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveApps(Apps $formdata)
    {
        $data = array(
            'firstname' => $formdata->firstname,
            'othername' => $formdata->othername,
            'surname' => $formdata->surname,
            'sex' => $formdata->sex,
            'age' => $formdata->age,
            'localgovt' => $formdata->localgovt,
            'mainsubject' => $formdata->mainsubject,
            'stateoforigin' => $formdata->stateoforigin,
            'nationality' => $formdata->nationality,
            'religion' => $formdata->religion,
            'qualification' => $formdata->qualification,
            'address' => $formdata->address,
            'phonenumber' => $formdata->phonenumber,
            'passport' => $formdata->passport,
		
        );

        $id = (int)$formdata->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getApps($id)) {
                $this->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteApps($id)
    {
        $this->delete(array('id' => $id));
    }
}
            
