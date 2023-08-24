<?php
include 'component/config.php';
session_start();

if (isset($_POST['remove_from_userlist'])) {
   $id = $_POST['id'];

   // fetch user details
   $fetch_user = mysqli_query($conn, "SELECT * FROM `user_db` WHERE `id` = $id");
   $fetch_userlist = mysqli_fetch_assoc($fetch_user);

   // check if the user is an admin and is the only admin
   $admin_count = mysqli_query($conn, "SELECT COUNT(*) AS count FROM `user_db` WHERE `role` = 'admin' AND `id` != $id");
   $admin_count_row = mysqli_fetch_assoc($admin_count);
   if ($admin_count_row['count'] == 0 && $fetch_userlist['role'] == 'admin') {
      $_SESSION['Msg'] = "Can't delete the only admin account!";
      header('location:user_section.php');
      exit;
   }

   // delete user
   $delete_user = mysqli_query($conn, "DELETE FROM `user_db` WHERE `id` = $id");
   if ($delete_user) {
      $_SESSION['Msg'] = "User has been deleted successfully!";
      header('location:user_section.php');
      exit;
   } else {
      $_SESSION['Msg'] = "Failed to delete user!";
      header('location:user_section.php');
      exit;
   }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Wishlist</title>

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

   <div class="container">
      <section class="shopping-cart">
      <h1 class="heading" style="margin-bottom: 2rem;">User<span>Section</span></h1>
         <table>
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $select_userlist = mysqli_query($conn, "SELECT * FROM `user_db` ");
               if (mysqli_num_rows($select_userlist) > 0) {
                  while ($fetch_userlist = mysqli_fetch_assoc($select_userlist)) {

               ?>
                     <tr>
                        <td><?php echo $fetch_userlist['id']; ?></td>
                        <td><?php echo $fetch_userlist['name']; ?></td>
                        <td><?php echo $fetch_userlist['username']; ?></td>
                        <td><?php echo $fetch_userlist['email']; ?></td>
                        <td><?php echo $fetch_userlist['role']; ?></td>
                        <td>
                           <form method="post" action="">
                              <input type="hidden" name="id" value="<?php echo $fetch_userlist['id']; ?>">
                              <button type="submit" name="remove_from_userlist" class="option-btn" style="background-color:var(--red);">Delete</button>
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