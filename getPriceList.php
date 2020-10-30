<?php
    require_once 'queriesDB.php';
    require 'extractData.php';
    
    function getPriceList($params) {
        global $conn;
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
                    .getPriceValue($itemArr['price'])
                    .getPriceWValue($itemArr['priceWholesale'])
                    .'<td>'.$itemArr['amountStock1']
                    .'</td><td>'.$itemArr['amountStock2']
                    .'</td><td>'.$itemArr['countryFrom'].'</td>'
                    .getNote($itemArr['amountStock1'], $itemArr['amountStock2'])
                    .'</tr>';
            };
            echo '</table>';
            
        }
    }
?>

