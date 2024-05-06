<?php
session_start()
?>

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
    .table{
      width: 80%;
      margin: auto auto;
    }
    .table th, .table td {
            text-align: center;
        }
        .table th {
          background-color: #FBAB7E;
          /* background-image: linear-gradient(62deg, #FBAB7E 0%, #F7CE68 100%); */
            border: 2px solid black;
        }
        .table td{
          background-color: white;
          border: 2px solid black;
          background-color: #85FFBD;
          /* background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%); */
        }
        h1{
          margin: auto auto;
          font-weight: 700;
        }
        .navigation:hover{
            background-color: #ccc;
        }
  </style>
</head>
<body>
    <nav class='z-3 navbar navbar-expand-lg border-bottom position-sticky top-0 shadow p-3 mb-5 bg-body-tertiary rounded'>
        <div class='container-fluid'>
          <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                <li class='nav-item'>
                  <a class='nav-link navigation' aria-disabled='true' href='home.php'>Trang chủ</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link navigation' aria-current='page' href='book.php'>Sách</a>
                </li>
                
                <li class='nav-item'>
                  <a class='nav-link navigation' aria-disabled='true' href='profile.php'>Cá nhân</a>
                </li>
                <?php if(isset($_SESSION['permission']) && $_SESSION['permission'] == 1): ?>
                  <li class='nav-item'>
                      <a class='nav-link active navigation' aria-disabled='true' href='#'>Thành viên</a>
                  </li>
                <?php endif; ?>
              </ul>
            
          </div>
        </div>
      </nav>

      <div class='container-fluid mt-3 d-flex flex-row flex-wrap gap-3'>
      <h1 class='text-center mb-4'>Danh sách thành viên</h1>
        <?php
        $id = $_SESSION['id'];
        $link = mysqli_connect('localhost', 'root');
        if (!$link) {
            die('Not connected : ' . mysqli_error($link));
        }
        // make foo the current db
        $db_selected = mysqli_select_db($link,'library');
        if (!$db_selected) {
            die ('Can\'t use foo : ' . mysqli_error($link));
        }
        $query = "SELECT * FROM borrow JOIN documents JOIN members ON borrow.document_id = documents.document_id AND borrow.student_id = members.student_id";
        $result = mysqli_query($link, $query);

        if (!$result) {
            $message = 'Invalid query: ' . mysqli_error() . '<br>';
            $message .= 'Whole query: ' . $query;
            die($message);
        }
        echo "
              <table class='table table-striped table-hover table-bordered'>
                <thead>
                  <tr>
                    <th scope='col'>Mã số</th>
                    <th scope='col'>Tên</th>
                    <th scope='col'>Ngày gia nhập</th>
                    <th scope='col'>Sách đang mượn</th>
                  </tr>
                </thead>
                <tbody>";

        $count = 0;
        $docs = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $count++;
            if ($count > 1) {
                if ($row['student_id'] != $student_id){
                    $doc_string = implode("<br/>", $docs);
                    echo "<tr>
                            <td>$student_id</td>
                            <td>$name</td>
                            <td>$join_date</td>
                            <td>$doc_string</td>
                          </tr>";
                    // Reset giá trị mới
                    $student_id = $row['student_id'];
                    $name = $row['student_name'];
                    $join_date = $row['join_date'];
                    $doc_name = $row['doc_name'];
                    $docs = array($doc_name);
                } else {
                    $doc_name = $row['doc_name'];
                    $docs[] = $doc_name;
                }
            } else {
                $student_id = $row['student_id'];
                $name = $row['student_name'];
                $join_date = $row['join_date'];
                $doc_name = $row['doc_name'];
                $docs[] = $doc_name;
            }
        }

        // Dòng cuối cùng
        $doc_string = implode("<br/>", $docs);
        echo "<tr>
                <td>$student_id</td>
                <td>$name</td>
                <td>$join_date</td>
                <td>$doc_string</td>
              </tr>";

        echo "</tbody>
              </table>";
        
        if($count == 0){
          echo "Không có thành viên nào";
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