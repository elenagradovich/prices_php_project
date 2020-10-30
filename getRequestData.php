<?php
    require_once 'connect.php';
    require 'extractData.php';
    //глобальный ассоциативном массиве $_GET
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $limitType = $_GET['limitType'];
        $priceType = $_GET['priceType'];
        $amount = (int) $_GET['amount'];
        $minPrice = (int) $_GET['minPrice'];
        $maxPrice = (int) $_GET['maxPrice'];
    
        function clean($value=" ") {
          $value = trim($value);
          $value = strip_tags($value);
          $value = stripslashes($value);
          $value = htmlspecialchars($value);//фильтрацию и заменит все опасные символы в ней на подходящие HTML-мнемоники
          return $value;
        };
        
        
        $limitType = isset($limitType) ? clean($limitType) : 'undefined';
        $priceType = isset($priceType) ? clean($priceType) : 'undefined';
        $amount = isset($amount) ? clean($amount) : 'undefined';
        $minPrice = isset($minPrice) ? clean($minPrice) : 'undefined';
        $maxPrice = isset($maxPrice) ? clean($maxPrice) : 'undefined';
        
        $args = array(
            'priceType' => $priceType,
            'limitType' => $limitType,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'amount' => $amount
        );
        connect();
        $result = extractData($args);
        closeConnection();
        echo json_encode($result);
    }
?>