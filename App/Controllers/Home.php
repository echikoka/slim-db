<?php
/**
* 
*/
namespace App\Controllers;
class Home extends Controller
{
	
	 public function getFunder(){
        $data=$this->db->table("source_fund_tb")->get();
        var_dump($data);
	 }
}
?>