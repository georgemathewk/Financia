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
	
	public static function getall($page,$rows,$sidx,$sord,$searchField=null,$searchOper=null,$searchString=null){
		$financialperiod = new Fas_Model_DbTable_Financialperiod();
		$rowset = $financialperiod->fetchAll();
		
		$total_rows = count($rowset);
		$limit	= $rows;
		$total_pages = floor( $total_rows/$rows ) + 1;
		$offset = ($page-1)*$limit;
		
				
		
		
		
		$xml	= "<?xml version='1.0' encoding='utf-8' ?>";
		$xml	.= "<rows>";
		$xml	.= "<page>".$page."</page>";
		$xml	.= "<total>".$total_pages."</total>";
		$xml	.= "<records>".$total_rows."</records>";	
		
				
		switch($searchOper){
			case "eq" : 
				$oper = "=";
				break;
			default : 
				$oper = "";
		}		
		
		$select = $financialperiod->select();
		$select->from('financialperiod',array('id','code','name','fdate','tdate','remarks'));
		if($searchField!=""){
			$where = $searchField.$oper."'$searchString'";
			$select->where($where);
		}
		
		if($sidx!=""){
			$select->order($sidx . " " . $sord);
		}
		
		$select->limit($limit,$offset);
				
		$db = $financialperiod->getDefaultAdapter();
		$stmt = $db->query($select);
		$rowset = $stmt->fetchAll();
				
		foreach($rowset as $row){
			$xml	.= "<row id='".$row['id']."'>";
			$xml	.= "<cell>".$row['id']."</cell>";
			$xml	.= "<cell>".$row['code']."</cell>";
			$xml	.= "<cell>".$row['name']."</cell>";
			$xml	.= "<cell>".$row['fdate']."</cell>";
			$xml	.= "<cell>".$row['tdate']."</cell>";
			$xml	.= "<cell>".$row['remarks']."</cell>";
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
	
	public static function delete($ids){
		$fp = new Fas_Model_DbTable_Financialperiod();
		$fp->delete("id in ( ". $ids . " )");
		
	}
	

}

