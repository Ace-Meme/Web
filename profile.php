<?php
if(session_status() == PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
</head>
<body>
    <nav class='navbar navbar-expand-lg border-bottom position-sticky top-0 shadow p-3 mb-5 bg-body-tertiary rounded'>
        <div class='container-fluid'>
          <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                <li class='nav-item'>
                  <a class='nav-link active' aria-current='page' href='home.php'>Trang chủ</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='book.php'>Sách</a>
                </li>
                
                <li class='nav-item'>
                  <a class='nav-link' aria-disabled='true'>Cá nhân</a>
                </li>
              </ul>
            
          </div>
        </div>
      </nav>
    <div class='container-fluid border-bottom'>
        <?php
        $id = $_SESSION['id'];
        $per = $_SESSION['permission'];
        $link = mysqli_connect('localhost', 'root');
        if (!$link) {
            die('Not connected : ' . mysqli_error($link));
        }
        // make foo the current db
        $db_selected = mysqli_select_db($link,'test');
        if (!$db_selected) {
            die ('Can\'t use foo : ' . mysqli_error($link));
        }
        $query = "SELECT * FROM members WHERE student_id =$id";
        $result = mysqli_query($link, $query);
        if (!$result) {
            $message = 'Invalid query: ' . mysqli_error() . '<br>';
            $message .= 'Whole query: ' . $query;
            die($message);
        }
  
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['student_name'];
            $date = $row['join_date'];
            echo "
            <h6>Tên: $name</h6>
            <h6>Mã số: $id</h6>
            <h6>Ngày gia nhập: $date</h6>";
        }
        ?>
        <form action='index.php' method='GET'>
          <button class='btn btn-secondary' type='submit'>Đăng xuất</button>
        </form>
        
    </div>
    <h5>Những cuốn sách bạn đã mượn</h5>
    <div class='container-fluid mt-3 d-flex flex-row flex-wrap gap-3'>
      <?php
      $query = "SELECT * FROM borrow JOIN documents ON borrow.document_id = documents.document_id WHERE student_id =$id";
      $result = mysqli_query($link, $query);

      if (!$result) {
          $message = 'Invalid query: ' . mysqli_error() . '<br>';
          $message .= 'Whole query: ' . $query;
          die($message);
      }
      $count = 0;

      while ($row = mysqli_fetch_assoc($result)) {
        $count++;
        $doc_id = $row['document_id'];
        $name = $row['doc_name'];
        $au = $row['author'];
        $quan = $row['quantity'];
          echo "<div class='card' style='width: 18rem;'>
            <div class='card-body'>
                <h5>$doc_id</h5>
              <h5 class='card-title'>$name</h5>
              <h6 class='card-subtitle mb-2 text-body-secondary'>$au</h6>
              <form action='action_on_book.php' method='POST'>
              <input type='hidden' value='2' name='act'>
              <input type='hidden' value=$doc_id name='doc'>
              <button class='btn btn-warning' type='submit'>Bỏ mượn</button>
              </form>
            </div>
        </div>";
      }
      
      if($count == 0){
        echo "Bạn chưa mượn cuốn sách nào";
      }
      mysqli_close($link);
      ?>
        <!--
        <div class='card' style='width: 18rem;'>
            <div class='card-body'>
                <h5>N037</h5>
              <h5 class='card-title'>Xác suất thống kê</h5>
              <h6 class='card-subtitle mb-2 text-body-secondary'>Nguyễn Văn Tuấn</h6>
              <button class='btn btn-success'>Mượn</button>
            </div>
        </div>
        <div class='card' style='width: 18rem;'>
            <div class='card-body'>
                <h5>N037</h5>
              <h5 class='card-title'>Xác suất thống kê</h5>
              <h6 class='card-subtitle mb-2 text-body-secondary'>Nguyễn Văn Tuấn</h6>
              <button class='btn btn-secondary disabled'>Đã mượn</button>
            </div>
        </div>
        <div class='card' style='width: 18rem;'>
            <div class='card-body'>
                <h5>N037</h5>
              <h5 class='card-title'>Xác suất thống kê</h5>
              <h6 class='card-subtitle mb-2 text-body-secondary'>Nguyễn Văn Tuấn</h6>
              <button class='btn btn-secondary disabled'>Đã hết</button>
            </div>
        </div>
        <div class='card' style='width: 18rem;'>
            <div class='card-body'>
                <h5>N037</h5>
              <h5 class='card-title'>Xác suất thống kê</h5>
              <h6 class='card-subtitle mb-2 text-body-secondary'>Nguyễn Văn Tuấn</h6>
              <div class='btn-group' role='group' aria-label='Basic example'>
                <button type='button' class='btn btn-success'>Thêm</button>
                <button type='button' class='btn btn-outline-secondary disabled'>Số lượng: 30</button>
                <button type='button' class='btn btn-danger'>Bớt</button>
              </div>
            </div>
        </div>
        -->
    </div>
</body>
</html>