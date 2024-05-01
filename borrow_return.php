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
        // 0: Edit, 1: borrow, 2: return
        $id = $_SESSION['id'];
        $act = (int)$_POST['act'];
        $doc_id = $_POST['doc'];
        $mysqli = new mysqli('localhost', 'root', '', 'library');
        $string = "";
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s", $mysqli->connect_error);
            exit();
        }
        
        $mysqli->autocommit(false);
        try {
            if ($act == 1) {
                $sql = "INSERT INTO borrow VALUES ($id, $doc_id)";
                if($result = $mysqli->query($sql)){
                }
                $sql = "UPDATE documents SET quantity = quantity - 1 WHERE document_id = $doc_id";
                if($mysqli->query($sql)){      
                    $string = "Mượn sách thành công";
                }
            }
            elseif ($act == 2) {
                $sql = "DELETE FROM borrow WHERE student_id = $id AND document_id = $doc_id";
                if($result = $mysqli->query($sql)){
                }
                $sql = "UPDATE documents SET quantity = quantity + 1 WHERE document_id = $doc_id";
                if($mysqli->query($sql)){
                    $string = "Trả sách thành công";
                }
            }     
            $mysqli -> commit();
            echo "<div class='row'>
                    <h2 class='fw-bold text-center mt-2'>$string</h2>
                    </div>";
        } catch (\Throwable $th) {
            $mysqli -> rollback();
        }
        $mysqli->autocommit(true);

        if($mysqli->error){
            printf("Error message: ", $mysqli->error);
        }
        $mysqli->close();
    ?>
        <form>
            <a class="form-control btn btn-primary mt-3" href="profile.php">Trang cá nhân</a><br>
            <a class="form-control btn btn-primary mt-3" href="book.php">Mượn sách</a><br>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>