
$(document).ready(function() {
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

        //show totalcard

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
            ShowBagcart();

            
            $(document).on("click", ".remove-cart", function() {
                console.log('hhhhh');
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
                quantity: quantity
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
