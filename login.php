<?php
include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      .card{
        margin-top:200px;
      }
      .form-control{
        background: ;
      }
    </style>
</head>
<body>
  
<section>
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
          
      <div class="card">
        <form action="code.php" method="post">
            

          <div class="card-header"><h4>User Login</h4></div>
          <div class="card-body">
           

            <div class='form-group'>
              <label for=""><h5>Email <span class='text-danger'>*</span></h5></label>
              <input class='form-control' type="email" name="email" placeholder='Enter the email'>
            </div>

           
            
            <div class='form-group'>
              <label for=""><h5>Password<span class='text-danger'>*</span></h5></label>
              <input class='form-control' type="password" name="password" placeholder='Enter the Password'>
            </div>

            <div class='form-group'>
              <input class='form-control btn btn-primary text-white' type="submit" name="btnlogin" >
            </div>

            <div>
              <div style="float:right;">New User |<a  href="register.php"> Sign Up</a></div>
            </div>

          </div>
        </form>  
      </div>
    </div>
    <div class="col-lg-3"></div>


  </div>
</section>



<?php
include 'footer.php';
?>
</body>
</html>