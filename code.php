<?php

include "connection.php";

// ----user registration----

if(isset($_POST['btnregister'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $password=$_POST['password'];

    if($res=$admin_obj->register($username, $email, $contact, $password)){
        ?>
        <script>
            alert('Registered Successfully');
            window.location.href="login.php"
        </script>
    <?php
    }
    else{
        ?>
        <script>
            window.location.href='register.php'
        </script>
        <?php
    }
}


// ---User Login---

if(isset($_POST['btnlogin'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    if($res=$admin_obj->login($email,$password)){
        if(mysqli_num_rows($res)){
            $data=mysqli_fetch_assoc($res);
            
            $_SESSION['user_id']=$data['id'];
            $_SESSION['name']= $data['username'];
            
                
            ?>
            <script>
                window.location.href="index.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("Invalid Details");
                window.location.href='login.php';

            </script>
            <?php
        }
    }
}

if(isset($_REQUEST['logoutid'])) {
    session_destroy();
    ?>
    <script>
        alert('Log Out Successfully')
        window.location.href='login.php';
    </script>
    <?php
}



// --Add To Cart--

if(isset($_POST['addcart'])){

    $userid= $_POST['userid'];
    $proid= $_POST['pid'];
    $qty= $_POST['qty'];

    //$title=$_POST['title'];
    // $color=$_POST['color'];
    // $seller=$_POST['seller'];
    //$price=$_POST['price'];
    // $originalprice=$_POST['originalprice'];
    // $discount=$_POST['discount'];
    // $deliverydate=$_POST['deliverydate'];
    // $quantity=$_POST['quantity'];

    if($res=$admin_obj->addcart($userid, $proid, $qty)){

    
    }
}

// --Remove from Cart--

if(isset($_REQUEST['removecartid'])){
    $removecartid=$_REQUEST['removecartid'];
   

    if($res=$admin_obj->removecart($removecartid)){
        ?>
        <script>
            alert('Cart Removed')
            window.location.href='cart.php'
        </script>
        <?php
    }
}



// place Order

if(isset($_POST['btnorder'])){
    if(isset($_SESSION['user_id'])){
        $userid=$_SESSION['user_id'];
    }

    $orderid= $_POST['orderid'];

    $orderprice=$_POST['orderprice'];
    $listpro=$_POST['prolist'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $address=$_POST['address'];
    $pincode=$_POST['pincode'];
    
    if($res=$admin_obj->order($userid, $orderid, $listpro, $orderprice, $username, $email, $contact, $address, $pincode)){
        ?>
        <script>
            alert("Order Placed")
            window.location.href="payment/pay.php?oid=<?php echo $orderid;?>"
        </script>
       
    <?php }

}

if(isset($_POST['do']) && $_POST['do']=="updatecart"){
    $id= $_POST['id'];
    $qty= $_POST['qty'];
    if($admin_obj->updateCart($id, $qty)){
        echo $msg= "Cart Updated";
    }
}
?>