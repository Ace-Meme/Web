<?php
// 1: edit, 2: create
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
</head>
<body>
    <div class='container-fluid'>
        <form action="action_on_edit.php" class="form-control" method="POST">
            <input type="text" class='form-control' name="name" placeholder="name">
            <input type="text" class='form-control' name="author" placeholder="author">
            <input type="text" class='form-control' name="type" placeholder="type">
            <input type="text" class='form-control' name="publisher" placeholder="publisher">
            <input type="number" class='form-control' name="year" placeholder="publish year">
            <input type="number" class='form-control' name="quantity" placeholder="quantity" value=1>
            <textarea type="text" class='form-control' name="des" placeholder="description" maxlength=1000></textarea>
                <?php
                $act =(int) $_POST['act'];
                if ($act == 1) {
                    $doc = $_POST['doc'];
                   echo "<input type='hidden' name='act' value=$act>
                   <input type='hidden' name='doc' value=$doc>";
                }
                elseif ($act == 2) {
                    echo "<input type='hidden' name='act' value=$act>";
                }
                ?>
                <button class='btn btn-primary' type='submit'>Lưu</button>
        </form>
    </div>
</body>
</html>