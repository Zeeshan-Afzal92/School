<?php
Include("../Send.php");
?>
      <form method="post" action="">
			<?php 
      if(isset($_GET['E'])) {
      echo "Nothing Done Yet!!!<br><br>"; 
    }
      if(isset($_GET['E1'])) {
			echo "Error ! Invalid Username OR Password.<br><br>"; 
    }
      if(isset($_GET['E2'])) {
        echo "Error ! You don,t have priviliges for this operation.<br><br>";
      }
      if(isset($_GET['E3'])) {
			echo "Logged Out Successfully.<br><br>";
    }
    if(isset($_GET['E4'])) {
			echo "Error ! Please Login First.<br><br>";
    }if(isset($_GET['E5'])) {
      echo "Attention ! You already have 1 loged In User in this Browser.<br><br>";
    }
    ?>
    <label>Username:</label>
    <input type="input" placeholder="Username" name="ID" id="ID" required>
    <br><br>
    <label>Password:</label>
    <input type="password" placeholder="Password" name="password" id="password" required>
    <br><br>
    <button type="submit" name='SubmitButton' class="btn btn-primary">Login</button>
    </form>
<?php
  if(isset($_POST['SubmitButton']))
  {
      $username        = $_POST['ID'];
      $password        = $_POST['password'];

      $dataToSend = array('username' => $username, 'password' => $password);
      $result = sendRequest("login","placeholder",$dataToSend);

// if (!$result) {
//   //echo "string";
//   header('Location: login.php?E');
//   '<script>window.location.href = "add_Class.php?E";</script>';
// }
     if($result['loginStatus'] == "success" )
     {
         if($result['userType'] == 1)
         {
          header('Location: FrontEndTest.php');
             //echo '<script>window.location.href = "FrontEndTest.php";</script>';
         }else if($result['userType'] == 2)
         {
          header('Location: FrontEndTest.php');
             //echo '<script>window.location.href = "FrontEndTest.php";</script>';
         }else if($result['userType'] == 3)
         {
          header('Location: FrontEndTest.php');
             //echo '<script>window.location.href = "FrontEndTest.php";</script>';
         }else
         {
          header('Location: FrontEndTest.php');
             //echo '<script>window.location.href = "FrontEndTest.php";</script>';
         }
     }
     else if($result['loginStatus'] == "LogedIn")
     {
      header('Location: login.php?E5');
      //echo '<script>window.location.href = "login.php?E1";</script>';
     }
     else if($result['loginStatus'] == "fail")
     {
      header('Location: login.php?E1');
     	//echo '<script>window.location.href = "login.php?E1";</script>';
     }

  }
?>
