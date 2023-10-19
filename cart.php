<style>
    body {
        background: #f1f3f6;
    }

    .card-body {
        /* display:flex; */
        justify-content: space-between;
    }

    .p-info {
        display: flex;
    }

    .p-img {}

    .p-title {}

    .p-delivery {
        margin-left: 20px;
        padding: 5px;
    }

    .quantity input {
        width: 30px;
        border: 1px solid grey;
        height: 20px;
        vertical-align: middle;
        padding-left: 7px;
        border-radius: 10%;

    }

    .minus {
        border: 1px solid grey;
        width: 25px;

        /* font-size:20px; */
        border-radius: 50%;

    }

    .plus {
        border: 1px solid grey;
        width: 25px;
        /* font-size:20px; */
        border-radius: 50%;
    }

    .btn-order {
        float: right;
    }

    .btn-order {
        width: 200px;
        height: auto;
        color: white;
        /* margin-top:20px; */
        background: #fb641b;
        border-radius: none;

    }

    .remove {
        font-size: 30px;
    }
</style>
<?php include "header.php"; ?>

<?php
if (!isset($_SESSION['user_id'])) {
?>
    <script>
        window.location.href = 'login.php'
    </script>
<?php
} else {
?>
    <script>
        // window.location.href='cart.php'    
    </script>
<?php
}
?>
<div class="container" style="margin-top:200px;">
    <div class="row">
        <!-- Product Details -->
        <div class="col-lg-8">
            <div class="card">
                <div class='card-body'>
                    <?php
                    $userid = $_SESSION['user_id'];
                    $res = $admin_obj->viewcart($userid);
                    if (mysqli_num_rows($res) > 0) {
                        $total_price = 0;
                        $count_cart = 0;
                        $discount_price = 0;
                        $total_mrp = 0;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $productres = $admin_obj->getProductById($row['pid']);
                            $product = mysqli_fetch_assoc($productres);
                            $count_cart++;

                    ?>
                            <div class='p-info'>
                                <div class='p-img'>
                                    <img src="admin/<?php echo $product['pic']; ?>" width=100px height=100px alt="">
                                </div>

                                <div class='p-title'>
                                    <strong>
                                        <?php echo $product['title']; ?>
                                    </strong>
                                    <p>
                                        <?php echo $product['colors']; ?>
                                    </p>

                                    <p>Seller:abc</p>


                                    <?php

                                    $original_price = $product['original_price'];
                                    $quantity = $row['qty'];
                                    $original_mrp = $quantity * $original_price;
                                    $total_mrp += $original_mrp;


                                    ?>
                                    <del><span>₹ <span id='original_price<?php echo $row['id']; ?>'>
                                                <?php echo number_format($original_mrp); ?>
                                            </span></span>
                                    </del>


                                    <!-- discount price -->
                                    <?php
                                    $discount_price = $original_price - ($original_price * ($product['discount'] / 100));
                                    $quantity = $row['qty'];
                                    $price = $discount_price * $quantity;
                                    $total_price += $price;


                                    ?>
                                    <span class='ml-3'>₹ <i id='price_count<?php echo $row['id']; ?>'>
                                            <?php echo ($price); ?>
                                        </i>
                                    </span>




                                    <i>|</i><span class='text-success'>
                                        <?php echo $product['discount']; ?> %off
                                    </span>

                                </div>

                                <div class='p-delivery'>
                                    <p>Delivery by Fri Sep 1| <span class='text-success'>FREE</span>&nbsp; <del>&#8377;40</del>
                                    </p>
                                </div>
                            </div>
                            <div class='btn'>

                                <span><button type='submit' class="minus" id='minus<?php echo $row['id']; ?>'>-</button></span>
                                <span class='quantity'><input type="text" id='quantity<?php echo $row['id']; ?>' value='<?php echo $row['qty']; ?>' min='1'></span>
                                <span><button type="submit" class='plus' id='plus<?php echo $row['id']; ?>'>+</button></span>

                                <a href="code.php?removecartid=<?php echo $row['id']; ?>"><span class='fa fa-trash ml-5 remove'></span></a>
                            </div>
                            <hr>
                            <script>
                                $(document).ready(function() {

                                    // --for disable the minus button at starting--

                                    var vel = $('#quantity<?php echo $row['id']; ?>').val();
                                    if (parseInt(vel) == 1) {
                                        $('#minus<?php echo $row['id']; ?>').prop('disabled', true)
                                    }

                                    // --for decrease the quantity--

                                    $('#minus<?php echo $row['id']; ?>').click(function() {
                                        var quantity = $('#quantity<?php echo $row['id']; ?>').val();
                                        var decrease = parseInt(quantity) - 1;

                                        $('#quantity<?php echo $row['id']; ?>').val(decrease);
                                        var vel = $('#quantity<?php echo $row['id']; ?>').val();

                                        // --for disable minus button on click--
                                        if (parseInt(vel) == 1) {
                                            $('#minus<?php echo $row['id']; ?>').prop('disabled', true)
                                        }


                                        // ---for decrease original price--

                                        var oprice = parseInt(<?php echo $original_price; ?>);
                                        var fprice = oprice * decrease;
                                        $('#original_price<?php echo $row['id']; ?>').html(fprice);


                                        // --for decrease price--

                                        var dprice = parseInt(<?php echo $discount_price; ?>);
                                        var finalprice = dprice * decrease;
                                        $('#price_count<?php echo $row['id']; ?>').html(finalprice);


                                        // ---decrease checkout price---

                                        var checkout = parseInt($('#price').html());

                                        var addcheckout = checkout - oprice;

                                        $('#price').html(addcheckout);


                                        // ---discount price---

                                        var discount_price = ($('#discount').html());
                                        var sub_check_discount = discount_price - parseInt(<?php $subdiscount = $total_mrp - $total_price;
                                                                                            echo $subdiscount; ?>);
                                        $('#discount').html(sub_check_discount);



                                        //--- for save money---

                                        sub_check_discount += 40;
                                        $('#savemoney').html(sub_check_discount);

                                        //checkeout finalprice

                                        var addcheckefinal = addcheckout - sub_check_discount;
                                        $('#totalfinalprice').html(addcheckefinal);


                                        // --- For Update quantity---

                                        $.ajax({
                                            url: 'code.php',
                                            type: 'POST',
                                            data: {
                                                id: <?php echo $row['id']; ?>,
                                                do: 'updatecart',
                                                qty: decrease
                                            },
                                            success: function(res) {
                                                alert(res);
                                            }
                                        })


                                    });





                                    // ---for increase the quantity---

                                    $('#plus<?php echo $row['id']; ?>').click(function() {
                                        var quantity = $('#quantity<?php echo $row['id']; ?>').val();
                                        var increase = parseInt(quantity) + 1;

                                        $('#quantity<?php echo $row['id']; ?>').val(increase);

                                        $('#minus<?php echo $row['id']; ?>').prop('disabled', false);


                                        // ---for increase original price--

                                        var oprice = parseInt(<?php echo $original_price; ?>);
                                        var fprice = oprice * increase;
                                        $('#original_price<?php echo $row['id']; ?>').html(fprice);

                                        // ---for increase price---

                                        var inprice = parseInt(<?php echo $discount_price; ?>);
                                        var finalprice = inprice * (increase);
                                        $('#price_count<?php echo $row['id']; ?>').html(finalprice);


                                        // ---increase checkout price---

                                        var checkout = parseInt($('#price').html());

                                        var addcheckout = checkout + oprice;

                                        $('#price').html(addcheckout);


                                        // ---discount price---

                                        var discount_price = parseInt($('#discount').html());
                                        var add_check_discount = discount_price + parseInt(<?php $adddiscount = $total_mrp - $total_price;
                                                                                            echo $adddiscount; ?>);
                                        $('#discount').html(add_check_discount);

                                        //--- for save money---

                                        add_check_discount += 40;
                                        $('#savemoney').html(add_check_discount);

                                        //checkeout finalprice

                                        var addcheckefinal = addcheckout - add_check_discount;
                                        $('#totalfinalprice').html(addcheckefinal);


                                        $.ajax({
                                            url: "code.php",
                                            type: "POST",
                                            data: {
                                                id: "<?php echo $row['id']; ?>",
                                                qty: increase,

                                                do: "updatecart"
                                            },
                                            success: function(res) {
                                                alert(res);
                                            }
                                        })




                                    });


                                    // Send quantity--

                                    // $('btncheckout').submit(function(e){
                                    //     e.preventDefault();
                                    // })

                                })
                            </script>

                    <?php
                        }
                    }
                    ?>


                </div>
            </div>
        </div>

        <!-- Product billing -->
        <?php

        if (isset($count_cart) && $count_cart > 0) {

        ?>
            <div class="col-lg-4">
                <div class='card'>


                    <div class='ml-3 mt-3'>
                        <h5 style="color:grey;">PRICE DETAILS</h5>
                    </div>
                    <hr>
                    <div class='card-body'>


                        <p>Price (
                            <?php echo $count_cart; ?>items):

                            <span style='float:right'>&#8377;<i id='price'>
                                    <?php echo $total_mrp; ?>
                                </i>

                            </span>
                        </p>
                        <p>Discount:
                            <span style='float:right; color:#26a541'>-₹

                                <?php
                                $discount_price = $total_mrp - $total_price;

                                ?>
                                <b><i id='discount'>
                                        <?php echo $discount_price; ?>
                                    </i>
                                </b>
                            </span>

                        </p>

                        <p>Delivery Charge:
                            <span style='float:right'><del>&#8377;40</del> <span style='color:#26a541'><b>Free
                                    </b></span></span>

                        </p>

                    </div>
                    <hr>
                    <div class='ml-3 mr-3'>
                        <h5>Total Amount

                            <?php
                            $total_amount = $total_mrp - $discount_price;

                            ?>
                            <span>&#8377;</span>
                            <span style='float:right' id='totalfinalprice'>
                                <?php
                                echo $total_amount;
                                ?>
                            </span>
                        </h5>
                        <hr>

                        <?php
                        $total_bachat = $discount_price + 40;

                        ?>
                        <div>
                            <p style='color:#26a541'>You will save  &#8377;
                            <span  id='savemoney' >
                                <?php echo $total_bachat; ?>
                            </span>
                            on this order</p>
                        </div>
                    </div>


                </div>
                <a href="checkout.php" name='addtocart' class='btn btn-success btn-order'>Proceed To Checkout</a>
            <?php
        } else {
            ?>
            </div>

            <div class="row" style="display:<?php echo $emptymsg; ?>">
                <div class="col-lg-12 mt-5" style="border: black;">
                    <h1 class="text-center emptymsg">NO PRODUCT IN YOUR CART !</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 my-4 py-2 text-center">
                    <a href="products.php" class="btn contshop">CONTINUE TO SHOP</a>
                </div>
            </div>
        <?php
        } ?>
    </div>
</div>
<?php include "footer.php"; ?>
?>



<!-- <a class='btn btn-success text-white btn-order' href="" >PLACE ORDER</a> -->