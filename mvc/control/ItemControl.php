<?php

class ItemControl extends Controller {
	
	function frontPage() {
		$f3 = $this->f3;
		$db = $this->db;
		$cats = new CategoryModel();
		$items = new ItemModel();
		$uid = $f3->get('SESSION.uid');
		$dispNum = 16;
		
		$displayItems = $items->getItemsOfUser($db,$uid,$dispNum); //items to show
		$displayCatIds = $items->getCategoriesOfUserItems($db,$uid); //cat ids to show
		
	//	
	//	print_r ($displayItems);
	/*	print_r ($displayCatIds);*/
		
		$counter = 0;
		foreach ($displayCatIds as $dc) {
			$displayCats[] = $cats->getCategoryById($db,$dc['cat_id']);
			$displayCats[$counter]['sc'] = $cats->getSubCategoriesByCatId($db,$dc['cat_id']);
			$counter++;
		}
		
		foreach ($displayItems as $count => $di) {
			$key = array_search($di['cat_id'], array_column($displayCats, 'id'));
			$subKey =  array_search($di['subcat_id'], array_column($displayCats[$key]['sc'], 'id'));
			
			$displayItems[$count]['cat'] = $displayCats[$key]['name'];	
			$displayItems[$count]['subcat'] = $displayCats[$key]['sc'][$subKey]['name'];	
		
		}
		
		$catNumbers = count($displayCats);
		
		if ($catNumbers  >= 4) {
			while(count($displayCats) >= 4) {
				$excessCats[] = array_pop($displayCats);
			}
		} else {
			$excessCats = null;
		}
		/*
		echo '<pre>';
		print_r($displayCats);
		echo '<br> --';
		print_r($displayItems);
		exit;*/
		$itemCount = count($displayItems) - 1;
		
		if ($excessCats != null) {
			$f3->set('extraCats',$excessCats);
		}
		$f3->set('mainCats',$displayCats);
		$f3->set('items',$displayItems);
		$f3->set('itemCount',$itemCount);
		
		//echo View::instance()->render('template.htm');
		
		//pass display items + displaycats to template
		echo \Template::instance()->render('main.htm');
    }
	
	function itemRender() {
		$f3 = $this->f3;
		$db = $this->db;
		$uid = $f3->get('SESSION.uid');
		$items = new ItemModel();
		$cats = new CategoryModel();
		
		
		$item = $f3->get('PARAMS.item');
		$itemDetail = $items->getOneItem($db,$uid,$item);
		$itemDetail['cat'] = $f3->get('PARAMS.cat');
		$itemDetail['subcat'] = $f3->get('PARAMS.subcat');
			
		
		$displayCatIds = $items->getCategoriesOfUserItems($db,$uid); //cat ids to show
		$counter = 0;
		foreach ($displayCatIds as $dc) {
			$displayCats[] = $cats->getCategoryById($db,$dc['cat_id']);
			$displayCats[$counter]['sc'] = $cats->getSubCategoriesByCatId($db,$dc['cat_id']);
			$counter++;
		}
		$catNumbers = count($displayCats);
		if ($catNumbers  >= 4) {
			while(count($displayCats) >= 4) {
				$excessCats[] = array_pop($displayCats);
			}
		} else {
			$excessCats = null;
		}
		if ($excessCats != null) {
			$f3->set('extraCats',$excessCats);
		}
		$f3->set('mainCats',$displayCats);
		$f3->set('item',$itemDetail);
		
		echo \Template::instance()->render('item.htm');
		
		
		
	}
	
}
