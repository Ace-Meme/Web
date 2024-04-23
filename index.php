<?php
session_start();
session_unset();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div>
        <form name="hoho" action="action.php" method="POST" class="form-control mt-4">
                <div class="row mb-3">
                    <div class="col">
                        <input class="form-control" type="text" name="email" placeholder="Email">
                    </div>
                    <div class="col">
                        <input class="form-control" type="password" name="password" placeholder="Password 2-30 characters">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </div>
        </form>
    </div>
</body>
</html>