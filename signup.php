<?php
session_start();
session_unset();
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
    <h2 class="text-center mb-4">Đăng ký</h2>
        <form name="hoho" action="action.php" method="POST">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input class="form-control" type="text" name="email" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" placeholder="Mật khẩu 2-30 kí tự">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Xác nhận mật khẩu</label>
                    <input class="form-control" type="password" name="confirm" placeholder="Xác nhận mật khẩu">
                </div>
                <div class="mb-3">
                    <label for="inputName" class="form-label">Tên</label>
                    <input class="form-control" type="text" name="name" placeholder="Tên">
                </div>
                <input type="submit" class="btn btn-primary">
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