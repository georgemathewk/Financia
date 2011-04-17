<?php

class Fas_CostcenterController extends Zend_Controller_Action
{

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
    }

    public function getallAction()
    {
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
    	
        $costcenter =  Fas_Model_Costcenter::getAll( "xml",$_GET["page"],$_GET["rows"],$_GET["sidx"],$_GET["sord"],$searchField,$searchOper,$searchString);
        $this->view->costcenter = $costcenter;    
        	
    }

    public function addAction()
    {
        // action body
        
    }

    public function editAction()
    {
        // action body
        if($_POST['oper']=="add") {
	    	$costcenter = new Fas_Model_Costcenter(null,$_POST['code'],$_POST['name'],$_POST['remarks']);
	        $costcenter->add();
        }else if($_POST['oper']=="edit"){
        	$costcenter = Fas_Model_Costcenter::getById($_POST['id']);
        	$costcenter->update($_POST['code'],$_POST['name'],$_POST['remarks']);
        }else if($_POST['oper']=="del"){
        	Fas_Model_Costcenter::delete($_POST['id']);
        }
    }
}







