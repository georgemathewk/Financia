<?php

class Fas_Model_Accounthead
{
	private $id;
	private $code;
	private $name;
	private $parent_id;
	private $remarks;
	private static $leafnodes = array();
	private static $xml = "<?xml version='1.0' encoding='utf-8'?>\n";
	
	public function __construct($id,$code,$name,$parent_id,$remarks){
		$this->id = $id;
		$this->code = $code;
		$this->name = $name;
		$this->parent_id = $parent_id;
		$this->remarks = $remarks;
	}

	public static function getall($page,$rows,$idx,$order,$searchField,$seachOper,$searchString){
		self::loadLeafNodes(); // Finding the leaf nodes
		self::$xml .= "<rows>";
		self::$xml .= "<page>1</page>";
		self::$xml .= "<total>1</total>";
		self::$xml .= "<records>1</records>";
		
		self::display_node('', 0);
		self::$xml .= "</rows>";
		
		return self::$xml;			
	}
	
	private static function display_node($parent,$level){
		$et = ">";
		//self::$xml = 
		
		
		if($parent >0) {
      		$wh = 't1.parent_id='.$parent;
   		} else {
      		$wh = 'ISNULL(t1.parent_id)';
   		}
				
		$accounthead = new Fas_Model_DbTable_Accounthead();
		$db = $accounthead->getDefaultAdapter();
		$select = $accounthead->select();
		$select->from(array("t1"=>"accounthead"),array("t1id"=>"id","t1code"=>"code","t1name"=>"name","t1parent_id"=>"parent_id","t1remarks"=>"remarks"));
		$select->joinLeft(array("t2"=>"accounthead"),"t1.parent_id=t2.id");
		$select->where($wh);
		
		
		$stmt = $db->query($select);
		$rowset = $stmt->fetchAll();
		
		//self::$xml .="<test>".$level."</test>";
		
		foreach($rowset as $row){
			self::$xml .= "<row>";         
			self::$xml .= "<cell>". $row['t1id']."</cell>";
			self::$xml .= "<cell>". $row['t1code']."</cell>";
			self::$xml .=  "<cell>". $row['t1name']."</cell>";
			self::$xml .=  "<cell>". $row['code']."</cell>";
			self::$xml .=  "<cell>". $row['t1remarks']."</cell>";
			
			self::$xml .=  "<cell>". $level."</cell>";
			if(!$row['t1parent_id']) 
				$valp = 'NULL'; 
			else 
				$valp = $row['t1parent_id']; 
			self::$xml .=  "<cell><![CDATA[".$valp."]]></cell>";
			
			if(isset(self::$leafnodes[$row['t1id']])){
				if($row['t1id'] == self::$leafnodes[$row['t1id']] ) 
					$leaf='true'; 
				else 
					$leaf = 'false';
			}else{
				$leaf  = 'false';
			}					
			self::$xml .= "<cell>".$leaf."</cell>";
			self::$xml .= "<cell>false</cell>";
			self::$xml .= "</row>";
			
			self::display_node((integer)$row['t1id'],$level+1);
			
		}
		
			
			
		
	}
	
	public function add(){
		
	}
	
	public function edit(){
		
	}
	
	public function delete(){
		
	}
	
	private static function loadLeafNodes(){
		$accounthead = new Fas_Model_DbTable_Accounthead();
		$db = $accounthead->getDefaultAdapter();
		$select = $accounthead->select();
		$select->from(array("t1"=>"accounthead"),array("id"));
		$select->joinLeft(array("t2"=>"accounthead"), 't1.id = t2.parent_id',array('t2.parent_id') );
		$select->where(" t2.parent_id is null ");
		$stmt = $db->query($select);
		$rowset = $stmt->fetchAll();
				
		foreach($rowset as $row){
			self::$leafnodes[$row['id']]=$row['id'];
		}		
		
	}	
}