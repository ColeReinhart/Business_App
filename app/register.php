<?php
include_once 'db.php';

?>

<script LANGUAGE="JavaScript">
    function myFunction(id) {
      var x = document.getElementById(id);
      var y = document.querySelector('#hide');

      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        y.style.visibility='hidden';

      } else {
        x.className = x.className.replace(" w3-show", "");

      }
    }
      function mployee(emp){
        if (emp.value == "1"){
        document.getElementById("basic").style.display = "block";
        document.getElementById("buss_owner").style.display = "none";

    }
    if (emp.value == "0"){
        document.getElementById("basic").style.display = "block";
        document.getElementById("buss_owner").style.display = "block";

    }
      }

        </script>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <title>Register</title>
  </head>
  <body>
       <div class="bg" ></div>

    <header class="centered" id="header">
       <h1 class="header-h1">Man-A-Biz</h1>
       <h2>Register</h2>

        <section class="sign">
          <a class="a" onclick="myFunction('Demo1')"  class="w3-btn w3-block w3-black w3-left-align" id="hide" >Login</a>
          <div id="Demo1" class="w3-container w3-hide">
            <label for="uname"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
               <input type="password" placeholder="Enter Password" name="psw" required>
            <a class="a" onclick="myFunction('Demo1')" class="w3-btn w3-block w3-black w3-left-align" id="login">Login</a>
          </div>
    </header>
    <h3>What is your role?</h3>
  <form>
    <input type="radio" name="type-of-user" id="owner" onclick="mployee(this)" value="0"required>
      <label for="user">Business Owner</label>
      <input type="radio" name="type-of-user" id="employee" onclick="mployee(this)" value="1"required>
      <label for="user">Employee</label><br>
<div style="display: none;" id="basic" class="show-forms-employee">
      <label for="Fname">First Name</label><input class="" type="text" name="Fname"><br>
      <label for="Lname">Last Name</label><input class="" type="text" name="Lname"><br>
      <label for="Email">Email</label><input class="" type="text" name="Email"><br>
      <label for="Phone" class="">Phone (Format: 000-000-0000)</label><input class="" type="tel" name="Phone" pattern="[[0-9]{3}-[0-9]{3}-[0-9]{4}"><br>
      <label for="Birth" class="">Date Of Birth</label><input class="" type="date" name="Birth"><br>
      <label for="Pword">Password</label><input class="" type="text" name="Pword"><br>
      <label for="Ccode" class="">Company Code</label><input class="" type="text" name="Ccode"><br>

</div>
<div style="display: none;" id="buss_owner" class="show-forms-employee">
      <label for="CompName">Company Name</label><input class="" type="text" name="CompName"><br>
      <label for="BAddress">Business Address</label><input class="" type="text" name="BAddress"><br>
      <label for="City">City</label><input class="" type="text" name="City"><br>
      <label for="State" class="">State</label><input class="" type="text" name="State"><br>
      <label for="BPhone" class="">Business Phone (Format: 000-000-0000)</label><input class="" type="tel" name="BPhone" pattern="[[0-9]{3}-[0-9]{3}-[0-9]{4}"><br>

</div>

<input id="button" type="submit" name="submit" value="Submit">
  <form>
<?php
if(isset($_GET['submit'])){
  $role = $_GET['type-of-user'];

  $fname = $_GET['Fname'];
  $lname = $_GET['Lname'];
  $email = $_GET['Email'];
  $phone = $_GET['Phone'];
  $birth = $_GET['Birth'];
  $password = $_GET['Pword'];
  $compName = $_GET['CompName'];
  $baddress = $_GET['BAddress'];
  $city = $_GET['City'];
  $state = $_GET['State'];
  $bphone = $_GET['BPhone'];
  $Ccode = $_GET['Ccode'];
$compID = "No";

  if(($role == "0" & $fname != "" & $lname != "" & $email != "" & $phone != ""
& $password != "" & $birth != "" & $compName != "" & $baddress != "" & $city != "" & $state != "" & $bphone != "" & $Ccode != "")){
  $sql = "INSERT INTO `Company`(Business_Name, Business_Address, Phone, Email, City, State, Company_Code) VALUES ('$compName','$baddress','$bphone','$email','$city','$state','$Ccode')";
  mysqli_query($conn,$sql);

  $UserCompanyID = "SELECT ID FROM `Company` WHERE Company_Code = '$Ccode'";
  $result = mysqli_query($conn, $UserCompanyID);

  $resultCheck = mysqli_num_rows($result);
  echo $resultCheck;
  if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
    $compID = $row['ID'];
  }
  }


  $sql = "INSERT INTO `Users`(Fname, Lname, Phone, Email, Password, DoB, Company_Code, Approved, Type_Of_User, Company_ID) VALUES ('$fname','$lname','$phone','$email','$password','$birth', '$Ccode', '0','$role','$compID')";
  mysqli_query($conn,$sql);

  $EmpID = "SELECT ID FROM `Users` WHERE Email = '$email'";
  $result = mysqli_query($conn, $EmpID);

  $resultCheck = mysqli_num_rows($result);
  echo $resultCheck;
  if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
    $employID = $row['ID'];
  }
  }


  $sql = "INSERT INTO `Employees`(Company_ID, Emp_ID, Authorization) VALUES ('$compID', '$employID', 'Secretary')";
  mysqli_query($conn,$sql);
  ?>
  <script type="text/javascript">
  window.location.href = 'http://localhost/Man-A-Biz/app/';
  </script>
  <?php
}
if($role == "1" & $fname != "" & $lname != "" & $email != "" & $phone != "" & $password != "" & $birth != ""){

  $UserCompanyID = "SELECT ID FROM `Company` WHERE Company_Code = '$Ccode'";
  $result = mysqli_query($conn, $UserCompanyID);

  $resultCheck = mysqli_num_rows($result);
  echo $resultCheck;
  if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
    $compID = $row['ID'];
  }
  }


  $sql = "INSERT INTO `Users`(Company_ID, Fname, Lname, Phone, Email, Password, DoB, Approved, Type_Of_User, Company_Code) VALUES ('$compID', '$fname','$lname','$phone','$email','$password','$birth','0','$role','$Ccode')";
  mysqli_query($conn,$sql);

  $EmpID = "SELECT ID FROM `Users` WHERE Email = '$email'";
  $result = mysqli_query($conn, $EmpID);

  $resultCheck = mysqli_num_rows($result);
  echo $resultCheck;
  if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
    $employID = $row['ID'];
  }
  }

  $sql = "INSERT INTO `Employees`(Company_ID, Emp_ID, Authorization) VALUES ('$compID', '$employID', 'Employee')";
  mysqli_query($conn,$sql);

  ?>
  <script type="text/javascript">
  window.location.href = 'http://localhost/Man-A-Biz/app/';
  </script>
  <?php

}



}
?>
    <footer>
      <h2 class="footer-h1">Man-A-Biz</h2>
      <address>
        <p>750 E King St</p>
        <p>Lancaster, PA 17602</p>
        <p><a href="tel:1-717-299-7701" class="phone">717.299.7701</a></p>
      </address>
    </footer>

  </body>
</html>
