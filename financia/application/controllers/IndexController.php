<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here*/
    }

    public function indexAction()
    {
        // action body
        $this->_helper->layout()->disableLayout();
        
        if(Zend_Auth::getInstance()->hasIdentity()) { // Checks , whether already logged in or not
              $this->_redirect("index/home");                           
        }   
    }

    public function homeAction()
    {
        // action body   
        //$this->_helper->layout()->disableLayout();
    	
       	$defaultNamespace = new Zend_Session_Namespace('Default');
        
        if($defaultNamespace->sid!=Zend_Session::getId()){
        	$this->_forward("index","index","");        	
        }		
    }

    public function loginAction()
    {
    	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        
        $authAdapter->setTableName('user')
            ->setIdentityColumn('user')
            ->setCredentialColumn('passwd');
            //->setCredentialTreatment('SHA1(CONCAT(?,salt))');
            
       if( empty($_POST['name']) || empty($_POST['password']) ) 
       		$this->_helper->redirector('index','index');   
       
       $authAdapter->setIdentity($_POST['name']); 
       $authAdapter->setCredential($_POST['password']);
        
       $auth = Zend_Auth::getInstance();
       $result = $auth->authenticate($authAdapter);
       if ($result->isValid()) {
       		$defaultNamespace = new Zend_Session_Namespace('Default');
            $user = $authAdapter->getResultRowObject();
            $auth->getStorage()->write($user);
            $defaultNamespace->sid = Zend_Session::getId();
            $this->_helper->redirector('home','index');
       }
       $this->_helper->redirector('index','index');         
    }

    public function logoutAction()
    {
        // action body
        $defaultNamespace = new Zend_Session_Namespace('Default');
        $defaultNamespace->sid = "";
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index','index');
        
    }

    public function changepasswordAction()
    {
        // action body
    }

    public function homecontentAction()
    {
        // action body
        $this->_helper->layout()->disableLayout();
    }


}





