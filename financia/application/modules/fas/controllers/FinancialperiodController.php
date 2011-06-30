<?php

class Fas_FinancialperiodController extends Zend_Controller_Action
{

	public function preDispatch(){		
	    $defaultNamespace = new Zend_Session_Namespace('Default');        
        if($defaultNamespace->sid!=Zend_Session::getId()){
        	$this->_forward("index","index","");        	
        }		
	}
	
	
    public function init()
    {
        /* Initialize action controller here*/
    	$context = $this->_helper->getHelper('contextSwitch');
    	$context->addActionContext('getall','xml');
    	$context->initContext();
    }

    public function indexAction()
    {
        // action body
                $this->_helper->layout()->disableLayout();
    	
    }

    public function getallAction()
    {
        // action body
        
    	if(isset($_GET['_search'])){
    		if($_GET['_search']=='true'){
    			$searchField = $_GET['searchField'];
    			$searchOper = $_GET['searchOper'];
    			$searchString = $_GET['searchString'];
    		}else {
    			$searchField = "";
    			$searchOper = "" ;
    			$searchString = "";
    		}
    	}
    	
        $financialperiods = Fas_Model_Financialperiod::getall($_GET['page'],$_GET['rows'],$_GET['sidx'],$_GET['sord'],$searchField,$searchOper,$searchString);
        $this->view->financialperiods = $financialperiods;
    }

    public function editAction()
    {
        // action body
        if(isset($_POST['oper'])){
        	if($_POST['oper']=='add'){
        		$fp = new Fas_Model_Financialperiod(null,$_POST['code'],$_POST['name'],$_POST['fdate'],$_POST['tdate'],$_POST['remarks']);
        		$fp->add();
        	}else if($_POST['oper']=='edit'){
        		$fp = new Fas_Model_Financialperiod($_POST['id'],$_POST['code'],$_POST['name'],$_POST['fdate'],$_POST['tdate'],$_POST['remarks']);
        		$fp->edit();
        	}else if ($_POST['oper']=='del'){
        		Fas_Model_Financialperiod::delete($_POST['id']);
        	}
        }
    }


}


