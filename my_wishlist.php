<?php
include 'component/config.php';
session_start();

if (isset($_POST['add_to_cart'])) {
   if (isset($_SESSION["loggedInUserName"])) {
      $username = $_SESSION["loggedInUserName"];
      $id = $_POST['product_id'];
      $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '" . mysqli_real_escape_string($conn, $id) . "'");
      if (mysqli_num_rows($select_product) > 0) {
         $fetch_product = mysqli_fetch_assoc($select_product);

         // Check if the same product already exists in the cart
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE username = '" . mysqli_real_escape_string($conn, $username) . "' AND name = '" . mysqli_real_escape_string($conn, $fetch_product['name']) . "'");
         if (mysqli_num_rows($select_cart) > 0) {
            $message[] = 'Product already exists in the cart';
         } else {
            $insert_cart = mysqli_query($conn, "INSERT INTO `cart` (`username`,`category`, `name`, `price`, `quantity`,`image`) VALUES ('" . mysqli_real_escape_string($conn, $_SESSION["loggedInUserName"]) . "','" . mysqli_real_escape_string($conn, $fetch_product['category']) . "','" . mysqli_real_escape_string($conn, $fetch_product['name']) . "', '" . mysqli_real_escape_string($conn, $fetch_product['price']) . "', '1', '" . mysqli_real_escape_string($conn, $fetch_product['image']) . "')");
            if ($insert_cart) {
               $message[] = 'Product added to cart successfully';
            } else {
               $message[] = 'Error adding product to cart';
            }
         }
      }
   } else {
      echo '<script>
              var r = confirm("Please login first to place an order.");
              if (r == true) {
                  window.location.href = "account2.php";
              } else {
                  // do nothing
              }
            </script>';
   }
}


if (isset($_POST['remove_from_wishlist'])) {
   if (isset($_SESSION["loggedInUserName"])) {
      $id = $_POST['id'];
      $delete_wishlist = mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '" . mysqli_real_escape_string($conn, $id) . "' AND username='" . mysqli_real_escape_string($conn, $_SESSION["loggedInUserName"]) . "'");
      if ($delete_wishlist) {
         $message[] = 'Product removed from wishlist successfully';
      } else {
         $message[] = 'Error removing product from wishlist';
      }
   } else {
      echo '<script>
              var r = confirm("Please login first to place an order.");
              if (r == true) {
                  window.location.href = "account2.php";
              } else {
                  // do nothing
              }
            </script>';
   }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sabjiwala-Wishlist</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/AddUpdateShow.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>

<?php include 'component/msg.php'; ?>
   <!-- Header  -->
   <?php include 'component/header.php'; ?>

   <!-- Cart  -->

   <div class="container" >
      <section class="shopping-cart" >
         <h1 class="heading">Wishlist</h1>
         <table>
            <thead>
               <tr>
                  <th>Category</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Move To Cart</th>
                  <th>Delete</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE username = '" . mysqli_real_escape_string($conn, $_SESSION["loggedInUserName"]) . "'");
               if (mysqli_num_rows($select_wishlist) > 0) {
                  while ($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)) {
                     $image_path = ($fetch_wishlist['category'] == 'vegetable') ? 'vegetables/' : 'fruit_dairy/';
               ?>
                     <tr>
                        <td><?php echo $fetch_wishlist['category']; ?></td>
                        <td><?php echo $fetch_wishlist['name']; ?></td>
                        <td>$<?php echo $fetch_wishlist['price']; ?></td>
                        <td><img src="images/<?php echo $image_path . $fetch_wishlist['image']; ?>" height="100" alt=""></td>
                        <td>
                           <form method="post" action="">
                              <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['pid']; ?>">
                              <button type="submit" name="add_to_cart" class="option-btn">Move To Cart</button>

                              <!-- <input type="hidden" name="id" value="<?php echo $fetch_wishlist['id']; ?>"> -->

                           </form>
                        </td>

                        <td>
                           <form method="post" action="">
                              <input type="hidden" name="id" value="<?php echo $fetch_wishlist['id']; ?>">
                              <button type="submit" name="remove_from_wishlist" class="option-btn" style="background-color:var(--red);">Delete</button>
                           </form>
                        </td>
                     </tr>
               <?php
                  }
               } else {
                  echo "<tr><td colspan='6'>No records found</td></tr>";
               }
               ?>
            </tbody>
         </table>

         <!-- Script -->
         <div class="checkout-btn">
            <a href="product.php" class="option-btn" style="margin-top: 0;background-color:var(--blue);">Continue Shopping</a>
         </div>
      </section>
   </div>

   <!-- Footer  -->
   <?php include 'component/footer.php'; ?>

</body>
<script src="js/script.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</html>