<?php
session_start();
include 'database_connect.php';
                            
                            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
                                if (isset($_SESSION["user-id"])) {
                                    $userID = $_SESSION["user-id"];
                                    
                                        $productPrice=$_SESSION["product-price"]; 
                                    
                                           
                                            // Fetch cart contents
                                            $result = mysqli_query($conn, "SELECT * FROM `shoppingcart` WHERE user_id=$userID");
                                            // Check if there are items in the cart
                                            if (mysqli_num_rows($result) > 0) {
                                                $totalAmount = 0;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $price = $row['product_price'];
                                                    $totalAmount = $row['total-price'];
                                       
                            
                            echo'
                            <div class="col-lg-6 col-12 mt-4 mt-lg-0">
                                <img src="admin/'.$row["product_image"].'" class="img-fluid product-image" alt="">
                            </div>

                            <div class="col-lg-6 col-12 mt-3 mt-lg-0">
                                <h3 class="modal-title" id="exampleModalLabel">'. $row["product_name"].'</h3>

                                <p class="product-price text-muted mt-3">$'. $price.'</p>

                                <label for="Quatity:">Quatity: </label>
                                <input type="button" class="dicrease-btn" id="'. $row["cart_id"].'" value="-">

                                <span class="m-2 quantity">'.$row["quantity"].'</span>
                                
                                <input type="button" class="increase-btn" id="'. $row["cart_id"].'" value="+">
                                
                                
                                <div class="border-top mt-4 pt-3">
                                    <p class="product-p"><strong>Total: <span class="ms-1">'.$totalAmount.'</span></strong></p>
                                </div>
                                <button type="button"  class="btn btn-danger remove-cart" data-cart-id="'. $row["cart_id"].'">Remove Cart</button>

                            </div>';
                        
                                    }    
                                }
                            }
                        }
                        
?>