<?php

class Fas_FinancialperiodController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
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


}



