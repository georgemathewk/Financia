<?php

class Inventory_Bootstrap extends Zend_Application_Module_Bootstrap
{
	protected function _initAutoload() {
	
		$autoloader = new Zend_Application_Module_Autoloader(array( 'namespace' => 'Inventory_','basePath'  => dirname(__FILE__) . '/modules/inventory') ) ;

	}
		
}