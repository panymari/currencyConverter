<!--//$connection = mysqli_connect('mysql', 'root', 'password', 'currency_converter', '3306');-->
<!--//echo "<pre/>";-->
<!--//print_r($connection);-->



<?php

require_once('./CurrencyConverter.php');

$converter = new CurrencyConverter();

$rates = $converter->getRates();

//echo "<pre>";
//print_r($converter->setConvert("EUR", "USD", 1000));

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>


<div class="container col-md-6" style="margin-top: 5rem">
    <form method="POST" action="./getConverter.php">
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" name="amount">
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">From</label>
            <select class="form-select" name="from">
                <?php foreach ($rates as $key => $value): ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">To</label>
            <select class="form-select" name="to">
                <?php foreach ($rates as $key => $value): ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <button type="submit" name="convert" class="btn btn-primary">Convert</button>
    </form>
    <?php
    if ( isset($_GET['success']) && $_GET['success'] == 1 )
    {
        // treat the succes case ex:
        echo "Success";
    }
    ?>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"
        defer></script>
</body>
</html>


