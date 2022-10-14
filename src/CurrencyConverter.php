<?php

//<!--//На входе у нас должно быть 3 значения: string fromCurrency, string toCurrency,-->
//<!--//float amount (например: USD, BYN, 215,14)-->
//<!--//Мы хотим конвертировать какую-то сумму из одной валюты в другую. На выход хотим получать значение-->
//<!--//в валюте (toCurrency)-->
//<!--//-->
//<!--//Одно из самых важных при работе с PHP - ООП, оно везде. Так что сам конвертер в PHP должен быть-->
//<!--//реализован как один класс, например CurrencyConverter::class. Курсы валют будем-->
//<!--//брать через запрос на API, например https://fixer.io/documentation. Можно использовать любое другое API-->
//<!---->

class CurrencyConverter
{
    protected $curl;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    function getResponse($url): bool|string
    {
        curl_setopt_array($this->curl, array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: r8TNr2QoIzd7A0An21NCNVjRSbMiXDMQ"
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));
        $response = curl_exec($this->curl);
        curl_close($this->curl);
        return $response;
    }

    function getRates(): array
    {
        $response = $this->getResponse("https://api.apilayer.com/fixer/symbols");
        $arr = json_decode($response, true);
        return array_keys($arr["symbols"]);
    }

    function getRateById($id)
    {
        $rates = $this->getRates();
        foreach ($rates as $key => $value) {
            if ($key === $id) {
                return $value;
            }
        }
    }

    function setConvert($to, $from, $amount): array
    {
        $response = $this->getResponse("https://api.apilayer.com/fixer/convert?to=$to&from=$from&amount=$amount");
        $arr = json_decode($response, true);
        return $arr["query"];
    }
}