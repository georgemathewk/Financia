<?php

class Fas_AccountheadController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	$contextSwitch = $this->_helper->getHelper('contextSwitch');
    	$contextSwitch->addActionContext('getall','xml');
    	$contextSwitch->initContext();
    }

    public function indexAction()
    {
        // action body
    }

    public function getallAction()
    {
        // action body
        
    	if(isset($_REQUEST['nodeid']))    	
        	$node = (integer)$_REQUEST["nodeid"];
        else 
        	$node ="";
        
        if(isset($_REQUEST['n_level']))       	
			$n_lvl = (integer)$_REQUEST["n_level"];
		else 
			$n_lvl = "";
    	
        $this->view->xml = Fas_Model_Accounthead::getall(1, 10, "", "asc", null, null, null);
        
    }

    public function editAction()
    {
        // action body
    }

    public function parentAction()
    {
    	$this->_helper->layout()->disableLayout();
        // action body
        $select = Fas_Model_Accounthead::getParents();
        $this->view->select = $select;
    }


}







