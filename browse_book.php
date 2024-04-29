<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Library</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
</head>
<body>
    <div class='container-fluid mt-3 d-flex flex-row flex-wrap gap-3'>
      <?php
      $link = mysqli_connect('localhost', 'root');
      if (!$link) {
          die('Not connected : ' . mysqli_error($link));
      }
      // make foo the current db
      $db_selected = mysqli_select_db($link,'library');
      if (!$db_selected) {
          die ('Can\'t use foo : ' . mysqli_error($link));
      }
      $query = "SELECT documents.document_id, doc_name, quantity, author FROM documents";
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
          echo "<div class='card' style='width: 18rem;'>
            <div class='card-body'>
                <h5>$doc_id</h5>
              <h5 class='card-title'>$name</h5>
              <h6 class='card-subtitle mb-2 text-body-secondary'>$au</h6>
            </div>
        </div>";
      }
      
      mysqli_close($link);
      ?>
    </div>
</body>
</html>