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
    }
    .content {
      flex: 1; 
    }
    footer {
        margin-top: auto;
    }
    .content-section {
      display: flex;
      flex-direction: column;
      justify-content: center;
      height: 70%; 
    }
    .navbar{
        display: flex;
        flex-direction: row-reverse;
    }
    .navigation:hover{
            background-color: #ccc;
        }
  </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">

        <div class="col-sm-6">
            <img src="images/library.png" class="img-fluid" alt="Cover Image">
        </div>
        
        <div class="col-sm-6">
            <nav class="navbar navbar-expand-sm navbar-light bg-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active navigation" href="index.php">MyLib</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link navigation" href="signin.php">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link navigation" href="signup.php">Đăng kí</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link navigation" href="browse_book.php">Xem sách</a>
                    </li>
                </ul>
            </nav>
            <div class="content-section">
                <h2>Kiến thức của bạn - Ưu tiên của chúng tôi </h2>
                <p>Trang web cung cấp các tài liệu chất lượng<br>Cập nhật liên tục các tác phẩm, tài liệu mới</p>
                <form action='signin.php'>
                    <button class='btn btn-primary' type='submit'>Mượn sách ngay</button>
                </form>
            </div>
        </div>
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