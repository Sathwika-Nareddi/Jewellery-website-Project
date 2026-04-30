<?php
session_start();

include("config/db.php");

if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}

if (!isset($_GET['id'])) {
    die("Product not found");
}

$id = intval($_GET['id']);

$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);   

if (!$result || mysqli_num_rows($result) == 0) {
    die("Product not found");
}

$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlspecialchars($product['name']);?></title>
    <link rel="stylesheet" href="/jewellery_store/assets/style.css">
</head>
<body>
    <div class="product-detail-container">

        <!-- LEFT-IMAGE -->
         <div class="product-detail-image">
            <img src ="/jewellery_store/assets/images/<?php echo htmlspecialchars($product['image']); ?>"
                alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>

<!--  RIGHT- INFO -->

         <div class = "product-detail-info">
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
             <div class="product-price">€<?php echo htmlspecialchars($product['price']); ?></div>

             <div class="product-meta">
                <p><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
                <p><strong>Metal:</strong> <?php echo htmlspecialchars($product['type']); ?></p>
                <p><strong>Gender:</strong> <?php echo htmlspecialchars($product['gender']); ?></p>
            </div>
           
             <div class="product-description">
                <?php echo nl2br(htmlspecialchars($product['description'])); ?>
             </div>

             <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="add-to-class-btn-big">
                 Add to Cart 
             </a>
        </div>

      </div>
</div>

</body>
</html>