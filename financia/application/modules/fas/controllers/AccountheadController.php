<?php

class Fas_AccountheadController extends Zend_Controller_Action
{

	public function preDispatch(){
		
	    $defaultNamespace = new Zend_Session_Namespace('Default');        
        if($defaultNamespace->sid!=Zend_Session::getId()){
        	$this->_forward("index","index","");        	
        }	
		
	}
	
	
	
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
        $this->_helper->layout()->disableLayout();
    	
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
        if($_POST['oper']=='add'){
        	$accounthead = new Fas_Model_Accounthead(null,$_POST['code'],$_POST['name'],$_POST['parent_id'],$_POST['remarks']);
        	$accounthead->add();
        }else   if($_POST['oper']=='edit'){
        	$accounthead = new Fas_Model_Accounthead($_POST['id'],$_POST['code'],$_POST['name'],$_POST['parent_id'],$_POST['remarks']);
        	$accounthead->edit();
        }
    else   if($_POST['oper']=='del'){
        	Fas_Model_Accounthead::delete($_POST['id']);
        }
    }

    public function parentAction()
    {
    	$this->_helper->layout()->disableLayout();
        // action body
        $select = Fas_Model_Accounthead::getParents();
        $this->view->select = $select;
    }


}







