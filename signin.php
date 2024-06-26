<?php
session_start();
session_unset();
$link = mysqli_connect('localhost', 'root');
if (!$link) {
    die('Not connected : ' . mysqli_error($link));
}
// make foo the current db
$db_selected = mysqli_select_db($link,'library');
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysqli_error($link));
}
$query = "SELECT * FROM members";
$result = mysqli_query($link, $query);

if (!$result) {
    $message = 'Invalid query: ' . mysqli_error() . '<br>';
    $message .= 'Whole query: ' . $query;
    die($message);
}
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["submit"] == "Đăng nhập") {
        $acc = isset($_POST['email']) ? $_POST['email']:null;
        $pass = $_POST["password"];
        if (!$acc && $acc != 0) {
            echo '<script>alert("Nhập email")</script>';
        }
        else if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $acc)) {
            echo '<script>alert("Email phải có dạng sth@sth.sth")</script>';
        }
        else if (strlen($pass) < 2 || strlen($pass) > 30) {
            echo '<script>alert("Mật khẩu có độ dài từ 2-30 ký tự")</script>';
        } 
        else {
            $count = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $x = $row['email'];
                $y = $row['password'];
                if ($x == $acc && $y == $pass) {
                    $_SESSION['id'] = $row['student_id'];
                    $_SESSION['permission'] = $row['permission'];
                    header("Location: home.php");
                    exit;
                    $count++;
                    break;
                }
            }
            
            if($count == 0){
                echo '<script>alert("Người dùng không tồn tại")</script>';
            }
            mysqli_close($link);
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyLib</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh; 
      background-image: url('images/library.png');
      background-size: cover;
      background-position: center;
    }
    .content {
      flex: 1; 
    }
    footer {
        margin-top: auto;
    }
    .signin-container {
      max-width: 400px;
      margin: 100px auto;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 8px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
    <div class="container signin-container">
    <h2 class="text-center mb-4"><a href="index.php" style="text-decoration: none; color: black;">My Library</a></h2>
    <h2 class="text-center mb-4">Đăng nhập</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input class="form-control" type="text" name="email" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" placeholder="Mật khẩu 2-30 kí tự">
                </div>
                <input type="submit" class="form-control btn btn-primary" name="submit" value="Đăng nhập">
        </form>
        <form action='signup.php'>
            <div class="text-center mt-3">
            <p>Bạn chưa có tài khoản? <a href="signup.php">Đăng ký ngay</a></p> 
            </div>
        </form>
    </div>

    <footer class='bg-light text-center py-3 mt-auto border border-4 rounded-3'>
        <div class='container'>
            <p class='m-0'>© 2024</p>
            <p class='m-0'>Liên hệ: contact@example.com</p>
            <div class='mt-3'>
                <a href='https://www.facebook.com/yourcompany' target='_blank' class='me-3 text-primary'> 
                    <i class='fab fa-facebook fa-2x'></i>
                </a>
                <a href='https://www.instagram.com/yourcompany' target='_blank' class='text-danger'>
                    <i class='fab fa-instagram fa-2x'></i>
                </a>
            </div>
        </div>
    </footer>
</body>
</html>