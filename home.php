<?php
if(session_status() == PHP_SESSION_NONE) session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class='navbar navbar-expand-lg border-bottom position-sticky top-0 shadow p-3 mb-5 bg-body-tertiary rounded'>
        <div class='container-fluid'>
          <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                <li class='nav-item'>
                  <a class='nav-link active' aria-current='page' href='#'>Trang chủ</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='book.php'>Sách</a>
                </li>
                
                <li class='nav-item'>
                  <a class='nav-link' aria-disabled='true' href='profile.php'>Cá nhân</a>
                </li>
              </ul>
            
          </div>
        </div>
      </nav>
      <?php
      echo $_SESSION['id'];
      echo $_SESSION['permission'];
      ?>
</body>
</html>