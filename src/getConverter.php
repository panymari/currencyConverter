<?php

require_once('./CurrencyConverter.php');


if(isset($_POST['convert'])){
    $amount = $_POST['amount'];
    $from_id = $_POST['from'];
    $to_id = $_POST['to'];

    $converter = new CurrencyConverter();

    $from = $converter->getRateById($from_id);
    $to = $converter->getRateById($to_id);

    $converter->setConvert($to, $from, 1000);

    header( 'Location: index.php?success=1');

}
