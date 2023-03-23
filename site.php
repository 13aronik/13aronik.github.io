<?php

use \Hcode\Page;
use \Hcode\Model\Product;
use \Hcode\Model\Category;
use \Hcode\Model\News;
use \Hcode\Model\newsletter;

$app->get('/', function() {

	$products = Product::listAll();

	$page = new Page();

	$page->setTpl("index", [
		'products'=>Product::checkList($products)
	]);

});

$app->get("/categories/:idcategory", function($idcategory){

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	$category = new Category();

	$category->get((int)$idcategory);
	
	$pagination = $category->getProductsPage($page);

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++){
		array_push($pages, [
			'link'=>'/categories/'.$category->getidcategory().'?page='.$i,
			'page'=>$i
		]);
	}

	$page = new Page();

	$page->setTpl("category", [
		'category'=>$category->getValues(),
		'products'=>$pagination["data"],
		'pages'=>$pages
	]);

});

$app->get("/products/:desurl", function($desurl){
	$product = new Product();

	$product->getFromURL($desurl);

	$page = new Page();

	$page->setTpl("product-detail", [
		'product'=>$product->getValues(),
		'categories'=>$product->getCategories()
	]);
});

$app->get('/contato', function() {

	$page = new Page();

	$page->setTpl("contact-us");

});

$app->get('/sobrenos', function() {

	$page = new Page();

	$page->setTpl("about-us");

});

$app->get("/news", function(){

	$news = News::listAll();

	$page = new Page();

	$page->setTpl("news", [
		'news'=>News::checkList($news)
	]);
});

$app->get("/news/:news_url", function($news_url){
	$news = new News();

	$news->getFromURL($news_url);

	$page = new Page();

	$page->setTpl("news-detail", [
		'news'=>$news->getValues()
	]);
});

$app->get('/categorias', function() {

	$page = new Page();

	$page->setTpl("list-categories");

});

?>