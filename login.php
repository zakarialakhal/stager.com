<?php
session_start(); 

include "db_conn.php";

$message = "";

if (isset($_POST['valider'])) {
    
    if (!empty($_POST['nomadmin']) && !empty($_POST['passwordadmin'])) {
        $nom_admin = htmlspecialchars($_POST['nomadmin']);
        $pass_admin_input = $_POST['passwordadmin'];
      
        $sql = "SELECT * FROM administrator WHERE nomadmin = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nom_admin);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            if ($pass_admin_input === $row['passwordadmin']) {
                $_SESSION['idadmin'] = $row['idadmin'];
                $_SESSION['nomadmin'] = $row['nomadmin'];
              
               
                if (isset($_POST['remember'])) {
                    $expire = time() + 60; 
                    setcookie('remember_username', $nom_admin, $expire, '/');
                    setcookie('remember_password', $pass_admin_input, $expire, '/');
                }

               
                header("location: menu.php");
                exit();
            } else {
                $message = "Incorrect password.";
            }
        } else {
            $message = "Sorry, we can't find this account.";
        }
    } else {
        $message = "Please complete all fields.";
    }
}

$rememberedUsername = isset($_COOKIE['remember_username']) ? $_COOKIE['remember_username'] : '';
$rememberedPassword = isset($_COOKIE['remember_password']) ? $_COOKIE['remember_password'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>www.admin.ma</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="wrapper">
    <form method="POST">
      <h1>Login</h1>
      <div class="input-box">
        <input type="text" name="nomadmin" required placeholder="username" value="<?php echo $rememberedUsername; ?>">
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" name="passwordadmin" required placeholder="password" value="<?php echo $rememberedPassword; ?>">
        <i class='bx bxs-lock-alt'></i>
      </div>
      <div class="rembre">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me</label>
      </div>
      <button type="submit" name="valider" class="btn">Login</button>
      <div class="register-link">
        <i style="color:red">
          <?php
          if (isset($message)) {
            echo $message;
          }
          ?>
        </i>
      </div>
    </form>
  </div>
</body>
</html>
