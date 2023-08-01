<?php
session_start();
@include 'component/config.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'add_to_cart') {
        if (isset($_SESSION["loggedInUserName"])) {
            $username = $_SESSION["loggedInUserName"];
            $product_category = $_POST['product_category'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = 1;

            $select_cart = mysqli_query($conn, "SELECT * FROM `cart`  WHERE  name = '$product_name' AND username='$username' ");

            if (mysqli_num_rows($select_cart) > 0) {
                $message[] = $product_name . ' already added to cart';
            } else {
                $insert_product = mysqli_query($conn, "INSERT INTO `cart` (username,category,name, price, quantity, image) VALUES ('" . mysqli_real_escape_string($conn, $username) . "','$product_category','$product_name', '$product_price', '$product_quantity', '$product_image')");
                $message[] =  $product_name . '  added to cart succesfully';
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
    } elseif ($_POST['action'] == 'add_to_wishlist') {
        if (isset($_SESSION["loggedInUserName"])) {
            $username = $_SESSION["loggedInUserName"];
            $product_id = $_POST['product_id'];
            $product_category = $_POST['product_category'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];

            $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist`  WHERE  name = '$product_name' AND username='$username' ");

            if (mysqli_num_rows($select_wishlist) > 0) {
                $message[] =  $product_name . ' already added to wishlist';
            } else {
                $insert_wishlist = mysqli_query($conn, "INSERT INTO `wishlist` (username,pid,category, name, price, image) VALUES ('" . mysqli_real_escape_string($conn, $username) . "','$product_id','$product_category','$product_name', '$product_price', '$product_image')");
                $message[] =  $product_name . ' added to wishlist succesfully';
            }
        } else {
            echo '<script>
                    var r = confirm("Please login first to add to wishlist.");
                    if (r == true) {
                        window.location.href = "account2.php";
                    } else {
                        // do nothing
                    }
                  </script>';
        }
    } else {
        // handle invalid action value
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <style>
        html {
            font-size: 42.5%;
            scroll-behavior: smooth;
            scroll-padding-top: 7rem;
        }

        .header {
            font-size: 4rem;

        }

        .header .logo {
            font-size: 3.1rem;
            font-weight: bolder;
            color: var(--black);
            text-decoration: none;
        }

        .header .navbar a {
            font-size: 2.2rem;
            margin: 0 1rem;
            color: var(--black);
            text-decoration: none;
        }

        .header .icons div {
            height: 5rem;
            width: 5rem;
            line-height: 4.5rem;
            line-height: 4.5rem;
            background: #eee;
            color: var(--black);
            font-size: 2.6rem;

            margin-right: .3rem;
            text-align: center;


        }

        .footer .box-container .box h3 {
            font-size: 3.7rem;
        }

        .footer .box-container .box p {
            font-size: 1.8rem;

        }

        .footer .box-container .box .share a {
            font-size: 2.6rem;
        }

        .footer .box-container .box .links {
            font-size: 2rem;
        }

        /* CSS for the drop-down div block */
        .message {
            position: fixed;
            top: -100px;
            left: 50%;
            transform: translate(-50%, 0%);
            z-index: 9999;
            width: 400px;
            padding: 20px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            animation: slide-down 0.5s ease-out forwards;
        }

        /* CSS for the animation */
        @keyframes slide-down {
            0% {
                top: -100px;
                opacity: 0;
            }

            100% {
                top: 50px;
                opacity: 1;
            }
        }

        /* CSS for the close button */
        .close-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 16px;
            font-weight: bold;
            color: #aaa;
            cursor: pointer;
        }

        /* CSS for the message text */
        .message-text {
            font-size: 16px;
            color: #333;
            text-align: center;
        }

        .products .heading {
            margin-top: 6rem;
        }
    </style>


</head>

<body>

    <?php

    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message">';
            echo '<span class="close-btn"  onclick="this.parentElement.style.display=\'none\'">&times;</span>';
            echo '<p class="message-text">' . $message[0] . '</p>';
            echo '</div>';
        };
    }
    ?>
    <!-- Header part-->

    <?php include 'component/header.php'; ?>

    <!--Vegetables -->
    <section class="products" id="products">

        <h1 class="heading" style="margin-top:9.5rem;"><span>Vegetables</span></h1>

        <div class="swiper product-slider">

            <div class="swiper-wrapper" id="product-slider-container">
                <?php

                $select_products = mysqli_query($conn, "SELECT * FROM products WHERE category = 'vegetable';");
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                ?>
                        <div class="swiper-slide">

                            <form action="" method="post">
                                <div class="box">
                                    <img src="images/<?php echo ($fetch_product['category'] == 'fruit') ? 'fruits/' : 'vegetables/'; ?><?php echo $fetch_product['image']; ?>" alt="">
                                    <h3><?php echo $fetch_product['name']; ?></h3>
                                    <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
                                    <input type="hidden" name="product_category" value="<?php echo $fetch_product['category']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                    <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
                                    <input type="hidden" name="action" value="add_to_cart">
                                    <button type="submit" class="btn add-to-cart-btn">Add to cart</button>
                                    <button type="submit" class="wishlist-btn" onclick="toggleActionValue(event)"><i class="far fa-heart"></i></button>
                                </div>
                            </form>

                            <script>
                                function toggleActionValue(event) {
                                    event.preventDefault();
                                    const form = event.target.closest('form');
                                    const actionInput = form.querySelector('input[name="action"]');
                                    const addCartBtn = form.querySelector('.add-to-cart-btn');

                                    if (actionInput.value === 'add_to_cart') {
                                        actionInput.value = 'add_to_wishlist';
                                        addCartBtn.disabled = true;
                                    } else {
                                        actionInput.value = 'add_to_cart';
                                        addCartBtn.disabled = false;
                                    }

                                    form.submit();
                                }
                            </script>



                        </div>
                <?php
                    };
                };
                ?>

            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>

        </div>


    </section>

    <script>
        var swiper = new Swiper('.product-slider', {

            spaceBetween: 15,
            loop: true,
            autoplay: true,
            autoplaySpeed: 500,
            centerSlide: 'true',
            fade: 'true',
            grabCursor: 'true',
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },

            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 50,
                },
            },
        });
    </script>


    <!-- Fruits -->
    <section class="products" id="products" style="margin-bottom: .5rem;">

        <h1 class="heading" style="margin-top:-2.5rem;"><span>Fruits</span></h1>

        <div class="swiper product-slider">

            <div class="swiper-wrapper" id="product-slider-container">
                <?php

                $select_products = mysqli_query($conn, "SELECT * FROM products WHERE category = 'fruit';");
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                ?>
                        <div class="swiper-slide">

                        <form action="" method="post">
                                <div class="box">
                                <img src="images/<?php echo ($fetch_product['category'] == 'fruit') ? 'fruit_dairy/' : 'vegetables/'; ?><?php echo $fetch_product['image']; ?>" alt="">
                                    <h3><?php echo $fetch_product['name']; ?></h3>
                                    <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
                                    <input type="hidden" name="product_category" value="<?php echo $fetch_product['category']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                    <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
                                    <input type="hidden" name="action" value="add_to_cart">
                                    <button type="submit" class="btn add-to-cart-btn">Add to cart</button>
                                    <button type="submit" class="wishlist-btn" onclick="toggleActionValue(event)"><i class="far fa-heart"></i></button>
                                </div>
                            </form>

                            <script>
                                function toggleActionValue(event) {
                                    event.preventDefault();
                                    const form = event.target.closest('form');
                                    const actionInput = form.querySelector('input[name="action"]');
                                    const addCartBtn = form.querySelector('.add-to-cart-btn');

                                    if (actionInput.value === 'add_to_cart') {
                                        actionInput.value = 'add_to_wishlist';
                                        addCartBtn.disabled = true;
                                    } else {
                                        actionInput.value = 'add_to_cart';
                                        addCartBtn.disabled = false;
                                    }

                                    form.submit();
                                }
                            </script>



                        </div>
                <?php
                    };
                };
                ?>

            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>

        </div>


    </section>

    <script>
        var swiper = new Swiper('.product-slider', {

            spaceBetween: 15,
            loop: true,
            autoplay: true,
            autoplaySpeed: 500,
            centerSlide: 'true',
            fade: 'true',
            grabCursor: 'true',
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },

            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 50,
                },
            },
        });
    </script>

    <!-- Dairy -->

    <!-- dairy products -->
    <section class="products" id="dairy" style="margin-bottom: .5rem;">

        <h1 class="heading" style="margin-top:-2.5rem;"><span>Dairy</span></h1>

        <div class="swiper product-slider">

            <div class="swiper-wrapper" id="product-slider-container">
                <?php

                $select_products = mysqli_query($conn, "SELECT * FROM products WHERE category = 'dairy';");
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                ?>
                        <div class="swiper-slide">

                            <form action="" method="post">
                            <div class="box">
                                <img src="images/fruit_dairy/<?php echo $fetch_product['image']; ?>" alt="">
                                    <h3><?php echo $fetch_product['name']; ?></h3>
                                    <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
                                    <input type="hidden" name="product_category" value="<?php echo $fetch_product['category']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                    <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
                                    <input type="hidden" name="action" value="add_to_cart">
                                    <button type="submit" class="btn add-to-cart-btn">Add to cart</button>
                                    <button type="submit" class="wishlist-btn" onclick="toggleActionValue(event)"><i class="far fa-heart"></i></button>
                                </div>
                            </form>

                            <script>
                                function toggleActionValue(event) {
                                    event.preventDefault();
                                    const form = event.target.closest('form');
                                    const actionInput = form.querySelector('input[name="action"]');
                                    const addCartBtn = form.querySelector('.add-to-cart-btn');

                                    if (actionInput.value === 'add_to_cart') {
                                        actionInput.value = 'add_to_wishlist';
                                        addCartBtn.disabled = true;
                                    } else {
                                        actionInput.value = 'add_to_cart';
                                        addCartBtn.disabled = false;
                                    }

                                    form.submit();
                                }
                            </script>


                            <!--  -->
                        </div>
                <?php
                    };
                };
                ?>

            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>

        </div>

    </section>

    <script>
        var swiper = new Swiper('.product-slider', {

            spaceBetween: 15,
            loop: true,
            autoplay: true,
            autoplaySpeed: 500,
            centerSlide: 'true',
            fade: 'true',
            grabCursor: 'true',
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },

            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 50,
                },
            },
        });
    </script>

    <!-- Footer Section-->
    <?php include 'component/footer.php'; ?>


</body>
<script src="js/script.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>



</html>