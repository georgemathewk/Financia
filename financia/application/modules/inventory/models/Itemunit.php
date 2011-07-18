<?php

class Inventory_Model_Itemunit
{
	private $id;
	private $code;
	private $name;
	private $remarks;
	
	public function __construct($id,$code,$name,$remarks) {
		$this->id 		= $id;
		$this->code		= $code;
		$this->name		= $name;
		$this->remarks	= $remarks;
	}
	
	//$type,$page,$limit,$sortBy,$sortDirection,$searchField,$searchOper,$searchString
	public static function getAll($type="xml",$page=1,$limit=10,$sortBy="",$sortDirection="",$searchField="",$searchOper="",$searchString="") {
		
		$itemunit = new Inventory_Model_DbTable_Itemunit();
		
		$all		= $itemunit->fetchAll();
		$total_records	= count($all);
		$offset		= ($page-1)*$limit;
		$total_pages= (int) ($total_records / $limit ) + 1;
		
		switch($searchOper){
			case "eq" : 
				$oper = "=";
				break;
		}		
		
		$db = $itemunit->getDefaultAdapter();		
		$select = $db->select();
		$select->from("itemunit",array("id","code","name","remarks"));
		if($searchField!="")
			$select->where($searchField.$oper."'$searchString'");
		if($sortBy!="")
			$select->order($sortBy . " " . $sortDirection);
		$select->limit($limit,$offset);		
		$stmt = $db->query($select);
		$result = $stmt->fetchAll();
		
		if($type=="xml"){
		
		    $et = ">";
	        $xml	= 	"<?xml version='1.0' encoding='utf-8'?$et\n";
	        $xml	.=	"<rows>";
	        $xml	.=	"<page>$page</page>";
	        $xml	.=	"<total>$total_pages</total>";
	        $xml	.=	"<records>$total_records</records>";
	
	        for($i=0;$i<count($result);$i++) {
	        	$xml	.=	"<row id='".$result[$i]['id']."'>";
	            $xml	.=	"<cell>". $result[$i]['id']."</cell>";
	            $xml	.=	"<cell>". $result[$i]['code']."</cell>";
	            $xml	.=	"<cell>". $result[$i]['name']."</cell>";
	            $xml	.=	"<cell>". $result[$i]['remarks']."</cell>";
	            $xml	.=	"</row>";
	        }	
	        $xml	.=	"</rows>";	
	        return $xml;
		}
	}
	
	public static function getById($id) {
		$itemunit = new Inventory_Model_DbTable_Itemunit();
		$rowset = $itemunit->find($id);
		$row	= $rowset->current();
		
		$itemunit_model = new Inventory_Model_Itemunit($row->id,$row->code,$row->name,$row->remarks);
		return $itemunit_model;		
	}	
	
	public function add() {
		$itemunit = new Inventory_Model_DbTable_Itemunit();
		$itemunit->insert(array("code"=>$this->code,"name"=>$this->name,"remarks"=>$this->remarks));
		
	}
	
	public function update($code,$name,$remarks) {
		$itemunit = new Inventory_Model_DbTable_Itemunit();
		$itemunit->update(array("code"=>$code,"name"=>$name,"remarks"=>$remarks),"id=".$this->id);		
	}
	
	public static function delete($id){
		$itemunit = new Inventory_Model_DbTable_Itemunit();
		$where = "id in (".$id.")";
		$itemunit->delete($where);				
	}


}

