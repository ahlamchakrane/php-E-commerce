<?php
$connect = new PDO("mysql:host=localhost;dbname=boutique", 'root', '');
?>
<!DOCTYPE html>
<html>
<head>  
</head>
<style>

      img{
            width: 100px;
            height: 100px;
      }
      .navbar-brand{
             font-size: 16px;
      }
      .navbar-brand{
            color: #fff;
      }
      .badge2{

        padding-left: 9px;
        border-radius: 50%;
        background: orange;
        padding-right: 9px;
        -webkit-border-radius: 9px;
        -moz-border-radius: 9px;

      }
</style>
<body>
<br>
<nav class="navbar navbar-dark bg-primary" >
    <a href="index.php" class="navbar-brand"> Home |</a>
    <?php
    $req= "select c.*, COUNT(*) as product_count from products p inner join productcategories pc on p.sku=pc.product inner join categories c on pc.category=c.id group by c.id";
    $result = $connect ->prepare($req);
      $result->execute(
        array(
        )
      );
      $count = $result->rowCount();
      if($count > 0){
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {?>
    <a href='index.php?id=<?=$row['id']?>' class="navbar-brand"><?= $row['name']?><span class="badge2"><?php echo $row['product_count']?></span>
    </a>
<?php }}?>
</nav>
<table class="table table-striped">
      <thead class="thead-dark">
      <tr>
            <th scope="col">Reference</th>
            <th scope="col">Name product</th>
            <th scope="col">Model</th>
            <th scope="col">Description</th>
            <th scope="col">Prix</th>
            <th scope="col">Image</th>
            <th scope="col">Quantite</th>
            <th scope="col">Action</th>
      </tr>
</thead>
<?php
$query = "SELECT * FROM products ORDER BY price DESC";
if(!empty($_POST['category']))
{

      $query.="  inner join productcategories pc on products.sku=pc.product where pc.category='".$_POST["category"]."'";
}
$statement = $connect->prepare($query);

if($statement->execute())
{
      $result = $statement->fetchAll();
      $output = '';
      foreach($result as $row)
      {
            $output .= '
                  <tr>
                  <td>'.$row["sku"].'</td>
                  <td>'.$row["name"].'</td>
                  <td>'.$row["model"].'</td>
                  <td>'.$row["description"].'</td>
                  <td>'.$row["price"].' MAD</td>
                  <td><img src="'.$row["image"].'"/></td>
            
                  <td><input type="number" name="quantity" id="quantity' . $row["sku"] .'" class="form-control" value="1" /></td>
                  <input type="hidden" name="hidden_name" id="name'.$row["sku"].'" value="'.$row["name"].'" />
                  <input type="hidden" name="hidden_price" id="price'.$row["sku"].'" value="'.$row["price"].'" />
                  <input type="hidden" name="hidden_image" id="image'.$row["sku"].'" value="'.$row["image"].'" />
                  <td><input type="button" name="add_to_cart" id="'.$row["sku"].'" style="margin-top:5px; font-size:15px;" class="btn btn-success form-control add_to_cart" value="Add to Cart" /></td>
            </tr>
            ';
      }
      echo $output;
}
?>
</table>
</body>

</html>