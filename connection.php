<?php 


    class admin_link{

        function __construct(){
            $this->connect=mysqli_connect("localhost","root","","cyber");
            session_start();
        }

        function register($username, $email, $contact, $password){
            $sql="INSERT INTO user_register(username, email, contact, password ) VALUES('$username', '$email', '$contact', '$password')";
            return mysqli_query($this->connect,$sql);
        }

        function login($email,$password){
            $sql="SELECT * FROM user_register WHERE email='$email' AND password='$password'";
            return mysqli_query($this->connect,$sql);
        }
        function admin_page(){
            $sql="SELECT * FROM user_data";
            return mysqli_query($this->connect,$sql);
        }

      
        function viewproduct(){
            $sql="SELECT * FROM product";
            return mysqli_query($this->connect, $sql);
        }

        function addcart($userid, $proid, $qty){
            $sql="INSERT INTO cart(userid, pid, qty) VALUES('$userid', '$proid', '$qty')";
            return mysqli_query($this->connect, $sql);
        }
        function viewcart($userid){
            $sql="SELECT * FROM cart WHERE userid='$userid'";
            return mysqli_query($this->connect, $sql);
        }
        function getProductById($id){
            $sql= "SELECT * FROM product WHERE code= '$id'";
            return $res= mysqli_query($this->connect, $sql);
           
         }
       
        function removecart($removecartid){
            $sql="DELETE FROM cart WHERE id='$removecartid'";
            return mysqli_query($this->connect, $sql);
        }

        function user_details(){
            $sql= "SELECT * FROM user_register";
            return $res= mysqli_query($this->connect, $sql);
           
         }

         function order($userid, $orderid,$listpro, $orderprice, $username, $email, $address, $pincode , $contact){
            $sql="INSERT INTO order_details(userid, orderid, products  , orderprice, username, email, address, pincode , contact) VALUES('$userid', '$orderid', '$listpro', '$orderprice', '$username', '$email',  '$address', '$pincode', '$contact')";
            return $res=mysqli_query($this->connect, $sql);
         }


         function updateCart($id, $qty){
            $sql="UPDATE cart SET qty='$qty'";
            return $res=mysqli_query($this->connect, $sql);
         }

  
    }

    $admin_obj= new admin_link();