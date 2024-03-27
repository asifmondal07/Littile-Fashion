<?php
session_start();


?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Tooplate's Little Fashion - Sign Up Page</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="css/slick.css"/>

        <link href="css/tooplate-little-fashion.css" rel="stylesheet">
        
<!--

Tooplate 2127 Little Fashion

https://www.tooplate.com/view/2127-little-fashion

-->
    </head>
    
    <body>

        <section class="preloader">
            <div class="spinner">
                <span class="sk-inner-circle"></span>
            </div>
        </section>
    
        <main>

            <section class="sign-in-form section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 mx-auto col-12">

                            <h1 class="hero-title text-center mb-5">Product Details</h1>

                            <div class="div-separator w-50 m-auto my-5"><span>or</span></div>

                            <div class="row">
                                <div class="col-lg-8 col-11 mx-auto">
                                    <form id="product_details" action="POST" enctype="multipart/form-data">
                                        <div class="form-floating">
                                            <input type="text" name="pname" id="pname" class="form-control" placeholder="Product Name" required>

                                            <label for="name">Product Name</label>
                                        </div>
                                        <div class="form-floating my-4">
                                            <input type="text" name="desc" id="desc" class="form-control" placeholder="Product describtion" required>

                                            <label for="describtion"> Product describtion</label>
                                        </div>  

                                        <div class="form-floating my-4">
                                            <input type="file" name="image" id="image"   class="form-label" placeholder="Upload Image " required>

                                        
                                        </div>

                                        <div class="form-floating my-4">
                                            <input type="text" name="price" id="price" class="form-control" placeholder="Phone Number" required>

                                            <label for="price">Product Price</label>
                                        </div>
                                        <label class="form-label">Select Page Category</label>

                                        <div class="form-floating my-2">
                                        
                                            <select name="Category" id="Category" class="form-select" required>
                                                <option value="">SELECT</option>
                                                <option value="men">TREE POT</option>
                                                <option value="women">FASHION</option>
                                                <option value="kids">DRINKS</option>
                                            </select>

                                            
                                        </div>

                                        <button type="submit" class="btn custom-btn form-control mt-4 mb-3">
                                            Upload Product
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </section>

        </main>
        <div class="container">
            <div class="row">
                <div class=" m-auto">
                <table class="table table-hover border my-6">
                    <tr>
                        <td id="table-data">

                        </td>
                    </tr>
                </table>
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

        <script>
            $(document).ready(function (){
                function Loadtable(){
                    $.ajax({
                        url:"load.php",
                        type:"POST",
                        success:function(data){
                            $("#table-data").html(data);
                        }
                    })
                }
                Loadtable();
                $('#product_details').submit(function (e) {
                    e.preventDefault(); // Prevent form submission
    
                    // Get form data
                    var formData = new FormData(this);
    
                    // Send AJAX request
                    $.ajax({
                        type: 'POST',
                        url: 'product_upload.php', 
                        data: formData,
                        contentType: false, // Don't set contentType
                        processData: false, // Don't process data
                        success: function (response) {
                            // Handle successful response
                            console.log(response);
                            if(response.trim() === "New record created successfully") {
                            // Redirect to sign-in.html if the response indicates success
                            // window.location.href = 'login.html';
                                Loadtable();
                            } else {
                                // Handle other responses, if needed
                                // For example, display an error message
                                alert("An error occurred: " + response);
                            }
                                                
                        },
                        
                        error: function (xhr, status, error) {
                            // Handle error
                            console.error(xhr.responseText);
                        }
                    });
                });
                
                $(document).on("click",".delete-btn",function(){
                    if(confirm("Do You Want To Delete This record ")){
                        var productId=$(this).data("id");
                        var element= this;
                        $.ajax({
                            url:"delete.php",
                            type:"POST",
                            data:{id:productId},
                            success:function(data){
                                if(data==1){
                                    $(element).closest("tr").fadeOut();
                            }
                            }
                        })
                    }
                })
                
                
            });
        </script>
    </body>
</html>
