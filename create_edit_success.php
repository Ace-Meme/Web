<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyLib</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>

    <div class="container bg-light" style="width: 600px">
    <?php
        $act = (int)$_GET['act'];
        $doc_id = $_GET['doc'];
        $string = "";
        $actstring = "";
        if ($act == 1) {    
            $string = "Chỉnh sửa thông tin thành công";
            $actstring = "Tiếp tục chỉnh sửa";
        }
        else if ($act == 2) {
            $string = "Thêm sách thành công";
            $actstring = "Tiếp tục thêm sách";
        }  
        echo "<div class='row'>
            <h2 class='fw-bold text-center mt-2'>$string</h2>
            </div>";
        echo "<form action='create_edit.php' method='POST'>
                <button class='form-control btn btn-primary mt-3' type='submit'>$actstring</button>
                <input type='hidden' value=$doc_id name='doc'>
              <input type='hidden' value='1' name='act'>
            </form>";
        echo "<form action='book.php'>
                <button class='form-control btn btn-primary mt-3' type='submit'>Sách</button>
            </form>";
    ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>