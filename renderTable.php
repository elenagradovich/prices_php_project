<?php
    require_once 'queriesDB.php';
    require 'extractData.php';
    require 'loadXLSData.php';
    
    function getPriceValue ($conn, $value) {
        $query = 'SELECT MAX(PRICE) FROM PriceList';
        $resultMaxPrice = getQueryResult($conn, $query);
        
        if($value == $resultMaxPrice) {
            return '<td style="color:red;fontWeight: bold;">'.$value.'</td>';
        }
        return '<td>'.$value.'</td>';
    } 
    
    function getPriceWValue($conn, $value) {
        $query = 'SELECT MIN(PRICE_WHOLESALE) FROM PriceList';
        $resultMinPrice = getQueryResult($conn, $query);
        
        if($value == $resultMinPrice) {
            return '<td style="color:green;fontWeight: bold;">'.$value.'</td>';
        }
        return '<td>'.$value.'</td>';
    }
    
    function getNote($conn, $amount1, $amount2) {
        $minAmount = 20;
        if($amount1 < $minAmount || $amount2 < $minAmount) {
            return '<td>Осталось мало!! Срочно докупите!!!</td>';
        }
        return '<td></td>';
    }
    
    function renderTable ($conn) {
        
        $header = loadXLSData($conn);
        $data = extractData($conn);
        
        if($data && $header) {
            echo '<table cellspacing="2" border="1" cellpadding="5">';
            echo '<tr>';
            foreach ($header as $item) {
                echo '<th>'.$item.'</th>';
            };
            echo '<th>Примечание</th>';
            echo '</tr>';
            
            foreach ($data as $itemArr){
                echo '<tr><td>'.$itemArr['productName'].'</td>'
                    .getPriceValue($conn, $itemArr['price'])
                    .getPriceWValue($conn, $itemArr['priceWholesale'])
                    .'<td>'.$itemArr['amountStock1']
                    .'</td><td>'.$itemArr['amountStock2']
                    .'</td><td>'.$itemArr['countryFrom'].'</td>'
                    .getNote($conn, $itemArr['amountStock1'], $itemArr['amountStock2'])
                    .'</tr>';
            };
            echo '</table>';
            
            $query3 = 'SELECT SUM(AMOUNT_STOCK1) FROM PriceList';
            $result = getQueryResult($conn, $query3);
            echo '<p>Общее количество товаров на складе 1 => '.'<b>'.$result.'</b></p>';

            $query4 = 'SELECT SUM(AMOUNT_STOCK2) FROM PriceList';
            $result = getQueryResult($conn, $query4);
            echo '<p>Общее количество товаров на складе 2 => '.'<b>'.$result.'</b></p>';

            $query5 = 'SELECT AVG(PRICE) FROM PriceList';
            $result = getQueryResult($conn, $query5);
            echo '<p>Среднее значение розничной цены => '.'<b>'.$result.'</b></p>';

            $query6 = 'SELECT AVG(PRICE_WHOLESALE) FROM PriceList';
            $result = getQueryResult($conn, $query6);
            echo '<p>Среднее значение оптовой цены => '.'<b>'.$result.'</b></p>';
            
        }
    }
?>

