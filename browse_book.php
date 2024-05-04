
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Library</title>
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
  </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="index.php">MyLib</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="signin.php">Đăng nhập</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="signup.php">Đăng kí</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="browse_book.php">Xem sách</a>
            </li>
        </ul>
    </nav>
    <div class="container mt-5">
    <h2 class="text-center">My Library</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form class="d-flex" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
        <input class="form-control me-2" type="search" placeholder="Nhập tên sách" aria-label="Search" name="doc">
        <button class="btn btn-primary" type="submit" name="submit" value="Tìm kiếm">Nhập</button>
      </form>
    </div>
  </div>
</div>
    <div class='container-fluid mt-3 d-flex flex-row flex-wrap gap-3'>
      <?php
      $link = mysqli_connect('localhost', 'root');
      if (!$link) {
          die('Not connected : ' . mysqli_error($link));
      }
      // make foo the current db
      $db_selected = mysqli_select_db($link,'library');
      if (!$db_selected) {
          die ('Can\'t use foo : ' . mysqli_error($link));
      }
      if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["submit"] == "Tìm kiếm") {
            $name = isset($_POST['doc']) ? $_POST['doc']:null;
            if ($name){
                $query = "SELECT document_id, doc_name, quantity, author FROM documents WHERE doc_name = '$name'";
            } else {
                $query = "SELECT document_id, doc_name, quantity, author FROM documents";
            }
            $result = mysqli_query($link, $query);
            
            if (!$result) {
                $message = 'Invalid query: ' . mysqli_error() . '<br>';
                $message .= 'Whole query: ' . $query;
                die($message);
            }
            
            while ($row = mysqli_fetch_assoc($result)) {
                $doc_id = $row['document_id'];
                $name = $row['doc_name'];
                $au = $row['author'];
                $quan = $row['quantity'];
                echo "<div class='card' style='width: 18rem;'>
                <div class='card-body'>
                    <h5>$doc_id</h5>
                    <h5 class='card-title'>$name</h5>
                    <h6 class='card-subtitle mb-2 text-body-secondary'>$au</h6>
                </div>
            </div>";
            }
        }
    }
    else {
      $query = "SELECT document_id, doc_name, quantity, author FROM documents";
      $result = mysqli_query($link, $query);

      if (!$result) {
          $message = 'Invalid query: ' . mysqli_error() . '<br>';
          $message .= 'Whole query: ' . $query;
          die($message);
      }

      while ($row = mysqli_fetch_assoc($result)) {
          $doc_id = $row['document_id'];
          $name = $row['doc_name'];
          $au = $row['author'];
          $quan = $row['quantity'];
          echo "<div class='card' style='width: 18rem;'>
            <div class='card-body'>
                <h5>$doc_id</h5>
              <h5 class='card-title'>$name</h5>
              <h6 class='card-subtitle mb-2 text-body-secondary'>$au</h6>
            </div>
        </div>";
      }
    }
      mysqli_close($link);
      ?>
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