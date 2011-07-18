<?php

class Inventory_ItemunitController extends Zend_Controller_Action
{

    public function preDispatch()
    {
		
	    $defaultNamespace = new Zend_Session_Namespace('Default');
        
        if($defaultNamespace->sid!=Zend_Session::getId()){
        	$this->_forward("index","index","");        	
        }	
		
    }

    public function init()
    {
        /* Initialize action controller here */
    	$contextSwitch = $this->_helper->getHelper('contextSwitch');
        $contextSwitch->addActionContext('getall', 'xml')
        	             ->initContext();
    }

    public function indexAction()
    {
        // action body
        $this->_helper->layout()->disableLayout();    	
    }

    public function getallAction()
    {
        // action body
        // action body
  		if(isset($_GET['searchField']))
        	$searchField = $_GET['searchField'];
        else
        	$searchField = "";
        	
        if(isset($_GET['searchOper']))
        	$searchOper = $_GET['searchOper'];
        else
        	$searchOper = "";	
        	
        if(isset($_GET['searchString']))
        	$searchString = $_GET['searchString'];
        else
        	$searchString = "";	        
    	
        $itemunit =  Inventory_Model_Itemunit::getAll( "xml",$_GET["page"],$_GET["rows"],$_GET["sidx"],$_GET["sord"],$searchField,$searchOper,$searchString);
        $this->view->itemunit = $itemunit;    
    }

    public function editAction()
    {
        // action body
        if($_POST['oper']=="add") {
	    	$itemunit = new Inventory_Model_Itemunit(null,$_POST['code'],$_POST['name'],$_POST['remarks']);
	        $itemunit->add();
        }else if($_POST['oper']=="edit"){
        	$itemunit = Inventory_Model_Itemunit::getById($_POST['id']);
        	$itemunit->update($_POST['code'],$_POST['name'],$_POST['remarks']);
        }else if($_POST['oper']=="del"){
        	Inventory_Model_Itemunit::delete($_POST['id']);
        }
    }


}





