<?php
// module/Apps/src/Apps/Controller/AppsController.php:
namespace Apps\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Apps\Model\Apps;
use Apps\Form\AppsForm;
use Apps\Form\AppsSearchForm;
use Zend\Db\Sql\Select;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator as paginatorIterator;

class AppsController extends AbstractActionController
{
    protected $appsTable;

    public function getAppsTable()
    {
        if (!$this->appsTable) {
            $sm               = $this->getServiceLocator();
            $this->appsTable = $sm->get('Apps\Model\AppsTable');
        }
        return $this->appsTable;
    }
	
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function getAlbum($id) {
        $id = (int) $id;
            $rowset = $this->tableGateway->select(array('id' => $id));
            $row = $rowset->current();
            if (!$row) {
            throw new \Exception("Could not find row $id");
            }
            return $row; 
        
    }
    
   public function searchAction()
    {

        $request = $this->getRequest();

        $url = 'home';

        if ($request->isPost()) {
            $formdata    = (array) $request->getPost();
            $search_data = array();
            foreach ($formdata as $key => $value) {
                if ($key != 'submit') {
                    if (!empty($value)) {
                        $search_data[$key] = $value;
                    }
                }
            }
            if (!empty($search_data)) {
                $search_by = json_encode($search_data);
                $url .= '/search_by/' . $search_by;
            }
        }
        $this->redirect()->toUrl($url);
    }
    
    // Add content to this method:
    
    public function indexAction()
    {
        return $this->redirect()->toRoute('apps', array(
                        'controller' => 'apps',
                        'action' =>  'home'
                    ));
    }
    public function homeAction() {
        $searchform = new AppsSearchForm();
        $searchform->get('submit')->setValue('Search for Tutor');

        $select = new Select();

        $order_by = $this->params()->fromRoute('order_by') ?
                $this->params()->fromRoute('order_by') : 'id';
        $order = $this->params()->fromRoute('order') ?
                $this->params()->fromRoute('order') : Select::ORDER_ASCENDING;
        $page = $this->params()->fromRoute('page') ? (int) $this->params()->fromRoute('page') : 1;
        $select->order($order_by . ' ' . $order);
        $search_by = $this->params()->fromRoute('search_by') ?
                $this->params()->fromRoute('search_by') : '';


        $where    = new \Zend\Db\Sql\Where();
        $formdata = array();
        if (!empty($search_by)) {
            $formdata = (array) json_decode($search_by);
            if (!empty($formdata['localgovt'])) {
                $where->addPredicate(
                        new \Zend\Db\Sql\Predicate\Like('localgovt', '%' . $formdata['localgovt'] . '%')
                );
            }
            if (!empty($formdata['mainsubject'])) {
                $where->addPredicate(
                        new \Zend\Db\Sql\Predicate\Like('mainsubject', '%' . $formdata['mainsubject'] . '%')
                );
            }
            
        }
        if (!empty($where)) {
            $select->where($where);
        }


        $apps = $this->getAppsTable()->fetchAll($select);
        $totalRecord  = $apps->count();
        $itemsPerPage = 5;

        $apps->current();
        $paginator = new Paginator(new paginatorIterator($apps));
        $paginator->setCurrentPageNumber($page)
                ->setItemCountPerPage($itemsPerPage)
                ->setPageRange(7);

        $searchform->setData($formdata);

        return new ViewModel(array(
            'search_by'  => $search_by,
            'order_by'   => $order_by,
            'order'      => $order,
            'page'       => $page,
            'paginator'  => $paginator,
            'pageAction' => 'apps',
            'form'       => $searchform,
            'totalRecord' => $totalRecord
        ));


    }
    public function addAction()
    {
        $form = new AppsForm();
        $form->get('submit')->setValue('Create');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $apps = new Apps();
            $form->setInputFilter($apps->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $apps->exchangeArray($form->getData());
                $this->getAppsTable()->saveApps($apps);

                // Redirect to list of appss
                return $this->redirect()->toRoute('apps');
            }
        }
        return array('form' => $form);
    }

    // Add content to this method:
    public function detailsAction()
    {
        //edit this
         $id = $this->params()->fromRoute('id', null);
        if ( ! $id ) {
            throw new \Exception('No tutor id given.');
        }
        $apps = $this->getServiceLocator()->get('apps')->init($id)->fetch();
        
        return new ViewModel(array('apps' => $apps));
        
    }
}
