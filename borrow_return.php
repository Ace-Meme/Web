<?php
// 0: Edit, 1: borrow, 2: return
    session_start();
    $id = $_SESSION['id'];
    $act = (int)$_POST['act'];
    $doc_id = $_POST['doc'];
    $mysqli = new mysqli('localhost', 'root', '', 'library');
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s", $mysqli->connect_error);
        exit();
    }
    //printf('Connected successfully.');
    //start transaction
    
    $mysqli->autocommit(false);
    try {
        if ($act == 1) {
            $sql = "INSERT INTO borrow VALUES ($id, $doc_id)";
            if($result = $mysqli->query($sql)){
                printf("Table records after transaction...!\n");
            }
            //let's delete some records
            $sql = "UPDATE documents SET quantity = quantity - 1 WHERE document_id = $doc_id";
            if($mysqli->query($sql)){
                printf("Records with age = 25 are deleted successfully....!\n");
            }
        }
        elseif ($act == 2) {
            $sql = "DELETE FROM borrow WHERE student_id = $id AND document_id = $doc_id";
            if($result = $mysqli->query($sql)){
                printf("Table records after transaction...!\n");
            }
            //let's delete some records
            $sql = "UPDATE documents SET quantity = quantity + 1 WHERE document_id = $doc_id";
            if($mysqli->query($sql)){
                printf("Records with age = 25 are deleted successfully....!\n");
            }
        }
        
        $mysqli -> commit();
    } catch (\Throwable $th) {
        $mysqli -> rollback();
    }
    $mysqli->autocommit(true);

    if($mysqli->error){
        printf("Error message: ", $mysqli->error);
    }
    $mysqli->close();
      echo "Hello?";
?>