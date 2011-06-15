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
    }

    public function homeAction()
    {
        // action body
    }
    
    public function loginAction() {
    	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        
        $authAdapter->setTableName('user')
            ->setIdentityColumn('user')
            ->setCredentialColumn('passwd');
            //->setCredentialTreatment('SHA1(CONCAT(?,salt))');
       
       $authAdapter->setIdentity($_POST['name']); 
       $authAdapter->setCredential($_POST['password']);
        
       $auth = Zend_Auth::getInstance();
       $result = $auth->authenticate($authAdapter);
       if ($result->isValid()) {
            $user = $authAdapter->getResultRowObject();
            $auth->getStorage()->write($user);
            $this->_helper->redirector('home','index');
       }
       $this->_helper->redirector('index','index');         
    }
}





