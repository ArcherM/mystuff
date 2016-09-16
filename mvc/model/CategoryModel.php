<?php

class CategoryModel{

	function addCategory($db){
		$db->exec("INSERT INTO categories (name) VALUES ('$name')");
	}

	function addSubCategory($db) {
		$db->exec("INSERT INTO sub_categories (cat_id, name, pass) VALUES ('$cid', '$name', '$pass')");
	}
	
	function delCategory($db){
		
	}
	
	function delSubCategory($db){
		
	}
	
	function getCategoryById($db,$cid) {
		$re = $db->exec("SELECT * FROM categories where id = '$cid'");
		return ($re[0]);
	}
	
	function getSubCategoriesByCatId ($db,$cid) {
		return($db->exec("SELECT * FROM sub_categories where cat_id = '$cid'"));
	}
}
?>