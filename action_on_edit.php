<?php
    session_start();
    $name = $_POST["name"];
    $au = $_POST['author'];
    $type = $_POST['type'];
    $pub = $_POST['publisher'];
    $des = $_POST["des"];
    $quan = (int) $_POST["quantity"];
    $year = (int) $_POST['year'];
    $act = (int) $_POST['act'];
    // if (strlen($name) == 0 or strlen($des) == 0 or $price <= 0) {
    //     die('Your input format is not correct. Try again');
    // }////// check
    $link = mysqli_connect('localhost', 'root');
    if (!$link) {
        die('Not connected : ' . mysqli_error($link));
    }
    // make foo the current db
    $db_selected = mysqli_select_db($link,'test');
    if (!$db_selected) {
        die ('Can\'t use foo : ' . mysqli_error($link));
    }
    
    $query = "";
    if($act == 1){
        $doc = $_POST['doc'];
        $set = "";
        if(strlen($name) != 0) $set = $set."doc_name=".$name;
        if(strlen($au) != 0) {
            if(strlen($set) != 0) $set = $set.",";
            $set = $set."author='$au";
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
            $set = $set."description='$des";
        }
        $query = "UPDATE documents SET $set WHERE document_id = $doc";
        echo $query;
    }
    elseif($act == 2){
        $query = "INSERT INTO documents (doc_name, type, author, publisher, publish_year, quantity, description) VALUES ('$name', '$type', '$au', '$pub', $year, $quan, '$des')";
        echo $query;
    }
    $result = mysqli_query($link, $query);
    if (!$result) {
        $message = 'Invalid query: ' . mysqli_error() . "<br>";
        $message .= 'Whole query: ' . $query;
        die($message);
    }
    echo "Success!";
    echo "<form action='home.php' method='GET'>
    <button class='btn btn-success' type='submit'>Back home</button>
    </form>";
    mysqli_close($link);
?>