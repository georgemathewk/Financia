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


}





