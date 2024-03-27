<?php
session_start();
include 'database_connect.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Tooplate's Little Fashion - Product Detail</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="css/slick.css"/>

        <link href="css/tooplate-little-fashion.css" rel="stylesheet">

    </head>
    
    <body>

        <section class="preloader">
            <div class="spinner">
                <span class="sk-inner-circle"></span>
            </div>
        </section>
    
        <main>

            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <a class="navbar-brand" href="index.php">
                        <strong><span>Little</span> Fashion</strong>
                    </a>

                    <div class="d-lg-none">
                        <a href="sign-in.html" class="bi-person custom-icon me-3"></a>

                        <a href="product-detail.php" class="bi-bag custom-icon"></a>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="about.php">Story</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="products.php">Products</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="faq.php">FAQs</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact</a>
                            </li>
                        </ul>

                        <div class="d-none d-lg-block">
                            <?php
                            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
                              echo '<div>Welcome back, <span id="customer-first-name"></span>-><a href="customer-profile.php " class="profile bi-person custom-icon me-3"></a></div>

                              <a href="logut.php" class="btn btn-outline-danger me-3">Logout</a>
                              <a href="#" class="bi-bag custom-icon" data-bs-toggle="modal" data-bs-target="#cart-modal"><span id="total_product"></span></a>';  
                            }
                            else{
                                echo'<a href="sign-in.html" class="bi-person custom-icon me-3"></a>

                                <a href="sign-in.html" class="bi-bag custom-icon"></a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </nav>

            <header class="site-header section-padding d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-10 col-12">
                            <h1>
                                <span class="d-block text-primary">We provide you</span>
                                <span class="d-block text-dark">Fashionable Stuffs</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </header>

            <section class="product-detail section-padding">
                <div class="container">
                    <div class="row">
                    <?php
                        if(isset($_GET['image_id']) && !empty($_GET['image_id'])){
                            $imgid=$_GET['image_id'];
                            $result=mysqli_query($conn,"SELECT * FROM product WHERE sno=$imgid");
                            if($row=mysqli_fetch_assoc($result)){ 
                    ?>
                            <!-- Product details -->
                            <div class="col-lg-6 col-12">
                                <div class="product-thumb">
                                    <img src="admin/<?php echo $row["image"]; ?>" class="img-fluid product-image" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="product-info d-flex">
                                    <!-- Product name and other details -->
                                    <div>
                                        <h2 class="product-title mb-0"><?php echo $row["pname"]; ?></h2>
                                        <p class="product-p">Original package design from house</p>
                                    </div>
                                    <!-- Product price -->
                                    <small class="product-price text-muted ms-auto mt-auto mb-5">$<?php echo $row["price"]; ?></small>
                                </div>
                                <!-- Product description -->
                                <div class="product-description">
                                    <strong class="d-block mt-4 mb-2">Description</strong>
                                    <p class="lead mb-5"><?php echo $row["description"]; ?></p>
                                </div>
                                <!-- Quantity selection and add to cart button -->
                                <div class="product-cart-thumb row">
                                    <div class="col-lg-6 col-12">
                                        <select id="quantity" class="form-select cart-form-select">
                                            <option selected value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-12 mt-4 mt-lg-0">
                                        <button type="button" class="btn custom-btn cart-btn" id="addToCartButton">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<h2>No Product Here</h2>";
                    }
                    ?>

                        

                        

                    </div>
                </div>
            </section>

            <section class="related-product section-padding border-top">
                <div class="container">
                    <div class="row">

                        <div class="col-12">
                            <h3 class="mb-5">You might also like</h3>
                        </div>

                        <?php
                            $result=mysqli_query($conn,"SELECT * FROM product");
                            while($row=mysqli_fetch_assoc($result)){     
                            echo'
                                        
                                            <div class="col-lg-4 col-12 mb-4">
                                                <div class="product-thumb">
                                                    <a href="product-detail.php?image_id=' . $row["sno"] . '">
                                                        <img src="admin/'.$row["image"]. '" class="img-fluid product-image">
                                                    </a>

                                                    <div class="product-top d-flex">
                                                        <span class="product-alert me-auto">New Arrival</span>

                                                        <a href="#" class="bi-heart-fill product-icon"></a>
                                                    </div>

                                                    <div class="product-info d-flex">
                                                        <div>
                                                            <h5 class="product-title mb-0">
                                                                <a href="product-detail.php?image_id=' . $row["sno"] . '" class="product-title-link">'.$row["pname"]. '</a>
                                                            </h5>

                                                            <p class="product-p">Original package design from house</p>
                                                        </div>

                                                        <small class="product-price text-muted ms-auto">$'.$row["price"]. '</small>
                                                    </div>
                                                </div>
                                            </div>';
                            }
                        ?>

                    </div>
                </div>
            </section>

        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-10 me-auto mb-4">
                        <h4 class="text-white mb-3"><a href="index.php">Little</a> Fashion</h4>
                        <p class="copyright-text text-muted mt-lg-5 mb-4 mb-lg-0">Copyright © 2022 <strong>Little Fashion</strong></p>
                        <br>
                        <p class="copyright-text">Designed by <a href="https://www.tooplate.com/" target="_blank">Tooplate</a></p>
                    </div>

                    <div class="col-lg-5 col-8">
                        <h5 class="text-white mb-3">Sitemap</h5>

                        <ul class="footer-menu d-flex flex-wrap">
                            <li class="footer-menu-item"><a href="about.php" class="footer-menu-link">Story</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Products</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Privacy policy</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">FAQs</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Contact</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-4">
                        <h5 class="text-white mb-3">Social</h5>

                        <ul class="social-icon">

                            <li><a href="#" class="social-icon-link bi-youtube"></a></li>

                            <li><a href="#" class="social-icon-link bi-whatsapp"></a></li>

                            <li><a href="#" class="social-icon-link bi-instagram"></a></li>

                            <li><a href="#" class="social-icon-link bi-skype"></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>

            <!-- CART MODAL -->
                <div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0">
                        <div class="modal-header flex-column">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row" id="modal_row">
                                
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="row w-50">
                                <button type="button" class="btn custom-btn cart-btn ms-lg-4">Checkout</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            

       

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>

$(document).ready(function(){
    
    // Function to fetch and display customer's first name
    function showCustomerFirstName() {
        $.ajax({
            url: 'getFirstName.php',
            type: 'GET',
            success: function(response) {
                $('#customer-first-name').text(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Call the function on page load
    showCustomerFirstName();


    function showTotalCard() {
            $.ajax({
                url: "total-cart.php",
                type: "POST",
                success: function(response) {
                    $('#total_product').text(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
    }
showTotalCard();

        var productId = <?php echo $_GET['image_id']?>;
    
    $('#addToCartButton').click(function(e) {
        e.preventDefault();
        var quantity = $('#quantity').val();
                var data = {
                    product_id: productId,
                    quantity: quantity
                };

                // Make an Ajax request to the server
                $.ajax({
                    type: 'POST',
                    url: 'add_to_cart.php',
                    data: data,
                    success: function(response) {
                        console.log(response);
                        if(response.trim() === "YOU NEED TO LOGIN FIRST") {
                            // Redirect to sign-in.html if the user is not logged in
                            window.location.href = 'sign-in.html';
                        } else if (response.trim() === "success") {
                            // Product added to cart successfully, you can handle UI updates here
                            showTotalCard();
                            ShowBagcart();
                            
                        } else {
                            // Handle other responses here, if needed
                            alert('An error occurred: ' + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while adding the product to cart.');
                        console.error(error);
                    }
                });
    });

            //click bag icon show modal
            function ShowBagcart(){
                // $(document).on("click", ".bi-bag", function(e) {
                    // e.preventDefault();
                    $.ajax({
                        url: "modal.php",
                        type: "POST",
                        success: function(data) {
                            $("#modal_row").html(data);
                        }
                    });
                // });
            }
            //  $(document).on("click", ".bi-bag", function(e) {
            ShowBagcart();
            //  });


            $(document).on("click", ".remove-cart", function() {
            var cartId = $(this).data("cart-id");
            // var $productContainer = $(this).closest(".row");
            $.ajax({
                url: "remove_from_cart.php",
                type: "POST",
                data: { cartID: cartId },
                success: function(response) {
                    console.log(response);
                    if (response == 1) {
                        // $productContainer.fadeOut();
                        ShowBagcart();
                        showTotalCard();
                    } else {
                        alert("Failed to remove product from cart.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("An error occurred while processing your request. Please try again later.");
                }
            });
        });


     // Decrease button click event
    $(document).on("click",".dicrease-btn",function(){
        var cartId = $(this).attr('id');
        var quantityElement = $(this).next('.quantity');
        var quantity = parseInt(quantityElement.text()) - 1;
        if(quantity >= 1) {
            updateQuantity(cartId, quantity, quantityElement);
        }
    });

    // Increase button click event
    $(document).on("click",".increase-btn",function(){
        var cartId = $(this).attr('id');
        var quantityElement = $(this).prev('.quantity');
        var quantity = parseInt(quantityElement.text()) + 1;
        
        if(quantity<=10){
            updateQuantity(cartId, quantity, quantityElement);
        }
        
    });

    // Function to update quantity via AJAX
    function updateQuantity(cartId, quantity, quantityElement) {
        $.ajax({
            url: 'update_quantity.php',
            type: 'POST',
            data: {
                cart_id: cartId,
                quantity: quantity,
            },
            success: function(response) {
                console.log(response);
                // Update quantity in the DOM
                quantityElement.text(quantity);
                ShowBagcart();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Handle error
            }
        });
    }

        
    
});

 

        
</script>



</body>
</html>