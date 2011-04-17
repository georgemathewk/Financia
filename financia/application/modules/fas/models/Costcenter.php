<?php

class Fas_Model_Costcenter
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
		$costcenter = new Fas_Model_DbTable_Costcenter();
		
		$all		= $costcenter->fetchAll();
		$total_records	= count($all);
		$offset		= ($page-1)*$limit;
		$total_pages= (int) ($total_records / $limit ) + 1;
		
		switch($searchOper){
			case "eq" : 
				$oper = "=";
				break;
		}		
		
		$db = $costcenter->getDefaultAdapter();		
		$select = $db->select();
		$select->from("costcenter",array("id","code","name","remarks"));
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
		$costcenter = new Fas_Model_DbTable_Costcenter();
		$rowset = $costcenter->find($id);
		$row	= $rowset->current();
		
		$costcenter_model = new Fas_Model_Costcenter($row->id,$row->code,$row->name,$row->remarks);
		return $costcenter_model;		
	}	
	
	public function add() {
		$costcenter = new Fas_Model_DbTable_Costcenter();
		$costcenter->insert(array("code"=>$this->code,"name"=>$this->name,"remarks"=>$this->remarks));
		
	}
	
	public function update($code,$name,$remarks) {
		$costcenter = new Fas_Model_DbTable_Costcenter();
		$costcenter->update(array("code"=>$code,"name"=>$name,"remarks"=>$remarks),"id=".$this->id);		
	}
	
	public static function delete($id){
		$costcenter = new Fas_Model_DbTable_Costcenter();
		$where = "id in (".$id.")";
		$costcenter->delete($where);				
	}
}

