<?php
if(session_status() == PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

    <title>MyLib</title>

    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
    <style>
      .title-profile{
        text-align: center;
        font-weight: 700;
        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        margin-bottom: 1.5em;
      }
      .profile-content{
        width:70%;
        margin: auto auto;
        background-color: #FBAB7E;
        background-image: linear-gradient(62deg, #FBAB7E 0%, #F7CE68 100%);
        padding: 20px;
        border-radius: 20px;
      }
      .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
        .logout{
          margin-top: 1em;
        }
        .borrow-box{
          width:70%;
          margin: auto auto;
          margin-top: 50px;
        }
        .borrow-box h2{
          text-align: center;
          font-weight: 700;
          font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        .borrow-item{
          background-color: #85FFBD;
          background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);
        }
        .navigation:hover{
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <nav class='navbar navbar-expand-lg border-bottom position-sticky top-0 shadow p-3 mb-5 bg-body-tertiary rounded'>
        <div class='container-fluid'>
          <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                <li class='nav-item'>

                  <a class='nav-link navigation' aria-current='page' href='home.php'>Trang chủ</a>

                </li>
                <li class='nav-item'>
                  <a class='nav-link navigation' href='book.php'>Sách</a>
                </li>
                
                <li class='nav-item'>

                  <a class='nav-link active navigation' aria-disabled='true' href='#'>Cá nhân</a>
                </li>
                <?php if(isset($_SESSION['permission']) && $_SESSION['permission'] == 1): ?>
                  <li class='nav-item'>
                      <a class='nav-link navigation' aria-disabled='true' href='member.php'>Thành viên</a>
                  </li>
                <?php endif; ?>

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

        $db_selected = mysqli_select_db($link,'library');

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
              <div class='title-profile'>
                <h1 class='title-profile'>My profile</h1>
              </div>
              <div class='row profile-content'>
                <div class='col-md-3 text-center'>
                    <img src='images/avatar.png' class='profile-image' alt='Profile Picture'>
                </div>
                <div class='col-md-9'>
                    <h4>Thông tin cá nhân</h4>
                    <h6>Tên: $name</h6>
                    <h6>Mã số: $id</h6>
                    <h6>Ngày gia nhập: $date</h6>
                    <form action='index.php' method='GET'>
                  <button class='btn btn-secondary logout' type='submit'>Đăng xuất</button>
                </form>
                </div>
              </div>
            ";
        }
        ?>     
    </div>
    <div class="borrow-box">
      <h2>Những cuốn sách bạn đã mượn</h2>
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
              <div class='card-body borrow-item'>
                  <h5>Mã số sách: $doc_id</h5>
                <h5 class='card-title'>$name</h5>
                <h6 class='card-subtitle mb-2 text-body-secondary'>$au</h6>

                <form action='borrow_return.php' method='POST'>
                <input type='hidden' value='2' name='act'>
                <input type='hidden' value=$doc_id name='doc'>
                <button class='btn btn-warning' type='submit'>Trả</button>

                </form>
              </div>
          </div>";
        }
        
        if($count == 0){
          echo "Bạn chưa mượn cuốn sách nào";
        }
        mysqli_close($link);
        ?>
      </div>
    </div>
</body>
</html>