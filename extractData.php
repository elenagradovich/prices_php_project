<?php
    //запрос к базе данных
    function extractData($conn) {
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        $query = 'SELECT * FROM PriceList';
        $resultArr= array();
        //Если нужно извлечь большой объем данных, используем MYSQLI_USE_RESULT 
        
        if($result = mysqli_query($conn, $query, MYSQLI_USE_RESULT)) {
            while($resultRow = mysqli_fetch_array($result)) {
                global $resultArr;
                // $rowsAmount = mysqli_num_rows($result);
                $objRow = array(
                    'productName' => $resultRow['PRODUCT_NAME'],
                    'price' => $resultRow['PRICE'],
                    'priceWholesale' => $resultRow['PRICE_WHOLESALE'],
                    'amountStock1' => $resultRow['AMOUNT_STOCK1'],
                    'amountStock2' => $resultRow['AMOUNT_STOCK2'],
                    'countryFrom' => $resultRow['COUNTRY_FROM'],
                );
               $resultArr[]=$objRow; 
            }
            mysqli_free_result($result);
        }
       return $resultArr;
    }
?>
