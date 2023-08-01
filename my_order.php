<?php
@include 'component/config.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sabjiwala-My orders</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/AddUpdateShow.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>
<body>
<!-- Header  -->
<?php include 'component/header.php'; ?>

<!-- Cart  -->

<div class="container">

<section class="shopping-cart">

<h1 class="heading" style="margin-bottom: 2rem;">My<span>Orders</span></h1>
   
   
   <table>
   <thead>
      <tr>
         <th>No.</th>
         <th>Name</th>
         <th>Phone Number</th>
         <th>Email</th>
         <th>Payment Method</th>
         <th>Flat</th>
         <th>Street</th>
         <th>City</th>
         <th>State</th>
         <th>Country</th>
         <th>Pin Code</th>
         <th>Total Products</th>
         <th>Total Price</th>
      </tr>
   </thead>
   <tbody>

   
      <?php
          if ($_SESSION['loggedInUserName'] == 'Admin123') {
            $select_order_history = mysqli_query($conn, "SELECT * FROM `customer_order`");
        } else {
            $select_order_history = mysqli_query($conn, "SELECT * FROM `customer_order` WHERE username = '" . mysqli_real_escape_string($conn, $_SESSION["loggedInUserName"]) . "'");
        }
         if(mysqli_num_rows($select_order_history) > 0){
            $counter = 1; 
            while($fetch_order_history = mysqli_fetch_assoc($select_order_history)){
      ?>
      <tr>
         <td><?php echo $counter++; ?></td>
         <td><?php echo $fetch_order_history['name']; ?></td>
         <td><?php echo $fetch_order_history['number']; ?></td>
         <td><?php echo $fetch_order_history['email']; ?></td>
         <td><?php echo $fetch_order_history['method']; ?></td>
         <td><?php echo $fetch_order_history['flat']; ?></td>
         <td><?php echo $fetch_order_history['street']; ?></td>
         <td><?php echo $fetch_order_history['city']; ?></td>
         <td><?php echo $fetch_order_history['state']; ?></td>
         <td><?php echo $fetch_order_history['country']; ?></td>
         <td><?php echo $fetch_order_history['pin_code']; ?></td>
         <td><?php echo $fetch_order_history['total_products']; ?></td>
         <td>$<?php echo number_format($fetch_order_history['total_price'], 2); ?></td>
      </tr>
      <?php
            }
         } else {
            echo "<tr><td colspan='13'>No records found</td></tr>";
         }
      ?>
   </tbody>
</table>

      
   <div class="checkout-btn">
   <a href="index.php#products" class="option-btn" style="margin-top: 0;">continue shopping</a>
   </div>

</section>

</div>


<!-- Footer  -->
<?php include 'component/footer.php'; ?>

</body>
<script src="js/script.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</html>
  