<?php
include('header.php');
?>
<div class='container' style='margin-top:200px'>


  <div class="row">
    <!-- Product Details -->
    <div class="col-lg-7">
      <div class="card">
        <div class='card-body'>
          <?php
          $userid = $_SESSION['user_id'];
          $res = $admin_obj->user_details($userid);
          if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            //         // $productres=$admin_obj->getProductById($row['pid']);
            //         //     $product=mysqli_fetch_assoc($productres);
          
            ?>

            <form action="code.php" method="post">


              <div class="card-header">
                <h4>User Details</h4>
              </div>
              <div class="card-body">
                <div class='form-group'>
                  <label for="">
                    <h5>Username <span class='text-danger'>*</span></h5>
                  </label>
                  <input class='form-control' type="text" name="username" value='<?php echo $row['username']; ?>'
                    placeholder='Enter the username'>
                </div>

                <div class='form-group'>
                  <label for="">
                    <h5>Email <span class='text-danger'>*</span></h5>
                  </label>
                  <input class='form-control' type="email" name="email" value='<?php echo $row['email']; ?>'
                    placeholder='Enter the email' required>
                </div>

                <div class='form-group'>
                  <label for="">
                    <h5>Address<span class='text-danger'>*</span></h5>
                  </label>
                  <input class='form-control' type="text" name="address" placeholder='Enter the Address' required>
                </div>

                <div class='form-group'>
                  <label for="">
                    <h5>Address<span class='text-danger'>*</span></h5>
                  </label>
                  <input class='form-control' type="text" name="pincode" placeholder='Enter Pin Code' required>
                </div>

                <div class='form-group'>
                  <label for="">
                    <h5>Contact<span class='text-danger'>*</span></h5>
                  </label>
                  <input class='form-control' type="number" name="contact" value='<?php echo $row['contact']; ?>'
                    placeholder='Enter the Contact' required>
                </div>






              </div>


              <?php

          }


          ?>
            <!-- <a class='btn btn-success text-white btn-order' href="" >PLACE ORDER</a> -->



        </div>
      </div>
    </div>

    <!-- Product billing -->
    <div class="col-lg-5 container px-5 ">
      <div class="order_data bg-light">
        <h4 class="p-3 text-center" style="border-bottom:1px #fe4c50 dotted;">YOUR ORDER DETAILS</h4>
        <table border class="mt-4 mx-4" style="border: #fe4c50;">
          <thead>
            <tr>
              <th class="py-1 px-3" style="width: 150px;color: #fe4c50;">Name</th>
              <th class="py-1 px-3" style="width: 130px;color: #fe4c50;">Qty</th>
              <th class="py-1 px-3" style="width: 150px;color: #fe4c50;">Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $userid = $_SESSION['user_id'];
            $res = $admin_obj->viewcart($userid);
            if (mysqli_num_rows($res) > 0) {
              $cart_quantity = 0;
              $total_cart_pric = 0;
              $cart_price = 0;
              $subtotal = 0;
              $i = 0;
              while ($row = mysqli_fetch_assoc($res)) {
                $pro_code = $row['pid'];
                $pro_res = $admin_obj->getProductById($pro_code);
                $pro_data = mysqli_fetch_assoc($pro_res);
                $products[$i] = $row['pid'];
                $i++;
                ?>
                <tr>
                  <td class='p-2 px-3' width=60%>
                    <?php echo $pro_data['title']; ?>
                  </td>

                  <td class='py-1 px-3'>
                    <?php
                    $cart_quantity = $row['qty'];
                    echo $cart_quantity;
                    ?>
                  </td>

                  <td class='py-1 px-3'>
                    <?php
                      $original_price = $pro_data['original_price'];
                   $discount_price = $original_price- ($original_price*($pro_data['discount']/100));

                  
                    $total_cart_price = $discount_price * $cart_quantity;
                    $subtotal += $total_cart_price;
                    echo $total_cart_price;
                    ?>
                  </td>
                </tr>
                <?php
              }
            }
            $listpro = implode(',', $products);

            ?>
            <input type="hidden" name="prolist" value="<?php echo $listpro; ?>">
          </tbody>
        </table>
        <div class="paymant py-4 px-5"
          style="margin-top: 30px;border-block: 1px dotted red; font-weight: 600;line-height: 30px;">

          <div class="price" style="display: flex; justify-content: space-between;">
            <span>Subtotal :</span><span style="color: #fe4c50;">₹
              <?php echo number_format($subtotal); ?>
            </span>
          </div>

          <div class="tex" style="display: flex; justify-content: space-between;"><span>GST :</span>
            <span
              style="color: #fe4c50;">+ ₹

              <?php
              $tax = $subtotal * (5 / 100);
              echo number_format($tax);
              ?>
            </span>
          </div>


          <div class="totalprice mt-2"
            style="display: flex; justify-content: space-between;border-block:1px solid black">
            <span>Total Payable :</span><span style="color: #fe4c50;"> ₹
              <?php
              $finalprice = $subtotal + $tax;
              echo number_format($finalprice);
              ?>
            </span></div>
          <input type="hidden" name="orderprice" value="<?php echo $finalprice; ?>">
          <input type="hidden" name="orderid" value="<?php echo "UI".$userid."ECOM".rand(10000, 99999);?>">
        </div>
       
        <button type="submit" name="btnorder" id="checkout" class="btn px-4 py-2 ml-5 my-4"
          style="background-color: #fe4c50; color: #eae3e3; font-weight: 500;">
          PLACE ORDER
        </button>


      </div>
    </div>
    </form>

  </div>
</div>
</div>
<?php
include('footer.php');
?>