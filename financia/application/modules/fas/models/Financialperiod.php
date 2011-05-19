<?php

class Fas_Model_Financialperiod
{
	private $id;
	private $code;
	private $name;
	private $fdate;
	private $tdate;
	private $remarks;
	
	public function __construct($id,$code,$name,$fdate,$tdate,$remarks){
		$this->id	 	= $id;
		$this->code	 	= $code;
		$this->name	 	= $name;
		$this->fdate	= $fdate;
		$this->tdate	= $tdate;
		$this->remarks	= $remarks;
	}
	
	public static function getall(){
		$financialperiod = new Fas_Model_DbTable_Financialperiod();
		$rowset = $financialperiod->fetchAll();
		$xml	= "<?xml version='1.0' encoding='utf-8' ?>";
		$xml	.= "<rows>";
			
		foreach($rowset as $row){
			$xml	.= "<row>";
			$xml	.= "<cell>".$row->id."</cell>";
			$xml	.= "<cell>".$row->code."</cell>";
			$xml	.= "<cell>".$row->name."</cell>";
			$xml	.= "<cell>".$row->fdate."</cell>";
			$xml	.= "<cell>".$row->tdate."</cell>";
			$xml	.= "<cell>".$row->remarks."</cell>";
			$xml	.= "</row>";	
		}
		$xml	.= "</rows>";
		return $xml;
	}
	
	public function add(){
		$fp = new Fas_Model_DbTable_Financialperiod();
		$data  = array(
				"code"=>$this->code,
				"name"=>$this->name,
				"remarks"=>$this->remarks,
				"fdate"=>$this->fdate,
				"tdate"=>$this->tdate
		);
		
		$fp->insert($data);
		
	}
	
	
	public function edit(){
		$fp = new Fas_Model_DbTable_Financialperiod();
		$data  = array(
				"code"=>$this->code,
				"name"=>$this->name,
				"remarks"=>$this->remarks,
				"fdate"=>$this->fdate,
				"tdate"=>$this->tdate
		);
		$fp->update($data," id = " . $this->id);
		
	}

}

