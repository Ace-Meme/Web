<?php
session_start()
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>MyLib</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
</head>
<body>
    <nav class='z-3 navbar navbar-expand-lg border-bottom position-sticky top-0 shadow p-3 mb-5 bg-body-tertiary rounded'>
        <div class='container-fluid'>
          <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                <li class='nav-item'>
                  <a class='nav-link' aria-disabled='true' href='home.php'>Trang chủ</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link active' aria-current='page' href='#'>Sách</a>
                </li>
                
                <li class='nav-item'>
                  <a class='nav-link' aria-disabled='true' href='profile.php'>Cá nhân</a>
                </li>
                <?php if(isset($_SESSION['permission']) && $_SESSION['permission'] == 1): ?>
                  <li class='nav-item'>
                      <a class='nav-link' aria-disabled='true' href='member.php'>Thành viên</a>
                  </li>
                <?php endif; ?>
              </ul>
            
          </div>
        </div>
      </nav>
    <form action='create_edit.php' method='POST'>
      <input type='hidden' value='2' name='act'>
      <button class='btn btn-primary' type='submit'>Thêm sách mới</button>
    </form>
    <div class='container-fluid mt-3 d-flex flex-row flex-wrap gap-3'>
      <?php
      $id = $_SESSION['id'];
      $per = $_SESSION['permission'];
      $link = mysqli_connect('localhost', 'root');
      if (!$link) {
          die('Not connected : ' . mysqli_error($link));
      }
      // make foo the current db
      $db_selected = mysqli_select_db($link,'library');
      if (!$db_selected) {
          die ('Can\'t use foo : ' . mysqli_error($link));
      }
      $query = "SELECT documents.document_id, doc_name, quantity, author FROM documents LEFT JOIN (SELECT * FROM borrow WHERE student_id = $id) AS a ON documents.document_id = a.document_id WHERE student_id IS NULL";
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
          $action = "borrow_return.php";
          $button = "<button class='btn btn-success' type='submit'>Mượn</button>";
          if ($per == 1) {
            $action = "create_edit.php";
            $button = "<button class='btn btn-success' type='submit'>Chỉnh sửa thông tin</button>";
          }
          if ((int) $quan == 0 && $per == 2) {
            $button = "<button class='btn btn-success disabled'>Đã hết</button>";
          }
          echo "<div class='card' style='width: 18rem;'>
            <div class='card-body'>
                <h5>$doc_id</h5>
              <h5 class='card-title'>$name</h5>
              <h6 class='card-subtitle mb-2 text-body-secondary'>$au</h6>
              <form action=$action method='POST'>
              <input type='hidden' value=$doc_id name='doc'>
              <input type='hidden' value='1' name='act'>
              $button
              </form>
            </div>
        </div>";
      }
      
      mysqli_close($link);
      ?>
    </div>
</body>
</html>