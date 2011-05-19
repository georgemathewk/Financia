<?php

class Fas_FinancialperiodController extends Zend_Controller_Action
{

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
    }

    public function getallAction()
    {
        // action body
        $financialperiods = Fas_Model_Financialperiod::getall();
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
        	}
        }
    }


}


