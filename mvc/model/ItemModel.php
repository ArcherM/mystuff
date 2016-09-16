<?php

class ItemModel{

	function getOneItem($db,$uid,$name){
		$re = $db->exec("SELECT * FROM items WHERE user_id = '$uid' AND name = '$name'");
		return($re[0]);
	}

	function saveItem($db){
		
	}
	
	function editItem($db) {
		
	}
	
	function getItemsOfUser($db,$uid,$number) {
		return($db->exec("SELECT * FROM items WHERE user_id = '$uid' LIMIT $number"));
	}
	
	function addItemTags ($db) {
		
	}
	
	function getItemTags ($db) {
		
	}
	
	function getItemImages ($db) {
		
	}
	
	function getItemPrimaryImage ($db) {
		
	}
	function getCategoriesOfUserItems ($db, $uid) {
		return($db->exec("SELECT * FROM items WHERE user_id = '$uid' GROUP BY cat_id"));
	}
}
?>