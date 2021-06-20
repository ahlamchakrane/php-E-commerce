<?php
$pdo = new PDO("mysql:host=localhost;dbname=boutique", 'root', '');
$content = file_get_contents('data.json');
$fileData = json_decode($content);


$stmCategories = $pdo->prepare('INSERT INTO categories VALUES(:id, :name)');
$stmProduct = $pdo->prepare('INSERT INTO products VALUES(:sku, :name, :type, :price, :upc, :shipping, :description, :manufacturer, :model, :url, :image)');



$stmProduct_Categories = $pdo->prepare('INSERT INTO productcategories (product,category) VALUES (:product,:category)');

$insetedCategories = array();
foreach($fileData as $product) {

	
	$stmProduct->bindParam(':sku', $product->sku);
	$stmProduct->bindParam(':name', $product->name);
	$stmProduct->bindParam(':type', $product->type);
	$stmProduct->bindParam(':price', $product->price);
	$stmProduct->bindParam(':upc', $product->upc);
	$stmProduct->bindParam(':shipping', $product->shipping);
    $stmProduct->bindParam(':description', $product->description);
	$stmProduct->bindParam(':manufacturer', $product->manufacturer);
	$stmProduct->bindParam(':model', $product->model);
	$stmProduct->bindParam(':url', $product->url);
	$stmProduct->bindParam(':image', $product->image);
	
	$stmProduct->execute();

	foreach($product->category as $category) {
	

		if(!in_array($category->id, $insetedCategories)) {
			$stmCategories->bindParam(':id', $category->id);
			$stmCategories->bindParam(':name', $category->name);
			array_push($insetedCategories, $category->id);
			$stmCategories->execute();
		}
// make a relation between product and its categories
		
	
		$stmProduct_Categories->bindParam(':product',$product->sku);
		$stmProduct_Categories->bindParam(':category',$category->id);
		$stmProduct_Categories->execute();
	}

}
