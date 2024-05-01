<?php
// 1: edit, 2: create
session_start();
$link = mysqli_connect('localhost', 'root');
if (!$link) {
    die('Not connected : ' . mysqli_error($link));
}
// make foo the current db
$db_selected = mysqli_select_db($link,'library');
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysqli_error($link));
}
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    if ($_POST["submit"] == "Lưu") {
        $name = $_POST["name"];
        $au = $_POST['author'];
        $type = $_POST['type'];
        $pub = $_POST['publisher'];
        $des = $_POST["des"];
        $quan = (int) $_POST["quantity"];
        $year = (int) $_POST['year'];
        $act = (int) $_POST['act'];
        $query = "";
        if($act == 1){
            $doc = $_POST['doc'];
            $set = "";
            if(strlen($name) != 0) $set = $set."doc_name='$name'";
            if(strlen($au) != 0) {
                if(strlen($set) != 0) $set = $set.",";
                $set = $set."author='$au'";
            }
            if(strlen($type) != 0) {
                if(strlen($set) != 0) $set = $set.",";
                $set = $set."type='$type'";
            }
            if(strlen($pub) != 0) {
                if(strlen($set) != 0) $set = $set.",";
                $set = $set."publisher='$pub'";
            }
            if(strlen($year) != 0) {
                if(strlen($set) != 0) $set = $set.",";
                $set = $set."publish_year=$year";
            }
            if(strlen($des) != 0) {
                if(strlen($set) != 0) $set = $set.",";
                $set = $set."description='$des'";
            }
            $query = "UPDATE documents SET $set WHERE document_id = $doc";
        }
        else if ($act == 2){
            $query = "INSERT INTO documents (doc_name, type, author, publisher, publish_year, quantity, description) VALUES ('$name', '$type', '$au', '$pub', $year, $quan, '$des')";
        }
        $result = mysqli_query($link, $query);
        if (!$result) {
            $message = 'Invalid query: ' . mysqli_error() . "<br>";
            $message .= 'Whole query: ' . $query;
            die($message);
        }
        // echo "Success!";
        // echo "<form action='home.php' method='GET'>
        // <button class='btn btn-success' type='submit'>Back home</button>
        // </form>";
        mysqli_close($link);
        header("Location: create_edit_success.php?act=$act&doc=$doc");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyLib</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
</head>
<body>
    <div class='container-fluid'>
        <div class="row">
            <div class="col-sm-4">
                <?php
                    $act = (int)$_POST['act'];
                    $img = "";
                    if ($act==1){
                        $doc = $_POST['doc'];
                        $link = mysqli_connect('localhost', 'root');
                        if (!$link) {
                            die('Not connected : ' . mysqli_error($link));
                        }
                        // make foo the current db
                        $db_selected = mysqli_select_db($link,'library');
                        if (!$db_selected) {
                            die ('Can\'t use foo : ' . mysqli_error($link));
                        }
                        $query = "SELECT image_url FROM documents WHERE document_id=$doc";
                        $result = mysqli_query($link, $query);

                        if (!$result) {
                            $message = 'Invalid query: ' . mysqli_error() . '<br>';
                            $message .= 'Whole query: ' . $query;
                            die($message);
                        }
                        while ($row = mysqli_fetch_assoc($result)) {
                            $img = $row['image_url'];
                            break;
                        }
                    } else {
                        $img="https://storage.googleapis.com/proudcity/mebanenc/uploads/2021/03/placeholder-image.png";
                    }
                    echo "<img src=$img class='img-fluid' alt='Cover Image'>";
                ?>
            </div>
            <div class="col-sm-8">
                <h2 class="text-center">Thông tin sách</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                    <input type="text" class='form-control' name="name" placeholder="Tên">
                    <input type="text" class='form-control' name="author" placeholder="Tác giả">
                    <input type="text" class='form-control' name="type" placeholder="Thể loại">
                    <input type="text" class='form-control' name="publisher" placeholder="Nhà xuất bản">
                    <input type="number" class='form-control' name="year" placeholder="Năm xuất bản">
                    <input type="number" class='form-control' name="quantity" placeholder="Số lượng">
                    <textarea type="text" class='form-control' name="des" placeholder="Mô tả" maxlength=1000></textarea>
                    <?php
                    $act = (int)$_POST['act'];
                    if ($act == 1) {
                        $doc = $_POST['doc'];
                    echo "<input type='hidden' name='act' value=$act>
                    <input type='hidden' name='doc' value=$doc>;
                    <input type='hidden' name='img' value=$img>";
                    }
                    else if ($act == 2) {
                        echo "<input type='hidden' name='act' value=$act>
                            <input type='hidden' name='img' value=$img>";
                    }
                    ?>
                    <button class='btn btn-primary' type="submit" name="submit" value='Lưu'>Lưu</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>