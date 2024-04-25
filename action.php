<?php
session_start();
$acc = $_POST['email'];
$pass = $_POST['password'];
      $link = mysqli_connect('localhost', 'root');
      if (!$link) {
          die('Not connected : ' . mysqli_error($link));
      }
      // make foo the current db
      $db_selected = mysqli_select_db($link,'library');
      if (!$db_selected) {
          die ('Can\'t use foo : ' . mysqli_error($link));
      }
      $query = "SELECT * FROM members";
      $result = mysqli_query($link, $query);

      if (!$result) {
          $message = 'Invalid query: ' . mysqli_error() . '<br>';
          $message .= 'Whole query: ' . $query;
          die($message);
      }
      $count = 0;

      while ($row = mysqli_fetch_assoc($result)) {
        $x = $row['email'];
        $y = $row['password'];
        if ($x == $acc && $y == $pass) {
            $_SESSION['id'] = $row['student_id'];
            $_SESSION['permission'] = $row['permission'];
            include('home.php');
            $count++;
            break;
        }
      }
      
      if($count == 0){
        echo "Chiuj";
      }
      mysqli_close($link);
?>