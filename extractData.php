<?php
    //запрос к базе данных
    function extractData($arguments = null) {
        global $conn;

        $sql = "USE Prices";
        if (!mysqli_query($conn, $sql)) {
            echo "Ошибка БД не выбрана: ".mysqli_error($conn);
        };
        
        function createQuery ($arguments) {
            global $conn;
            $query = 'SELECT * FROM PriceList';
            $newQuery=null;
            if($arguments != null) {
                if($arguments['priceType'] == 'wholesalePrice') {
                    $priceType = 'PRICE_WHOLESALE';
                } else if ($arguments['priceType'] == 'retailPrice') {
                    $priceType = 'PRICE';
                } else {
                    $priceType = '';
                };
                $minPrice = $arguments['minPrice'];
                $maxPrice = $arguments['maxPrice'];
                $amount = $arguments['amount'];
                if($amount || $amount == 0){
                    $limitType = ($arguments['limitType'] == 'limitMore') ? '>' : '<';
                }
                
                $query .= ' WHERE ('.$priceType.' BETWEEN ? AND ?) AND '
                    .'(AMOUNT_STOCK1 '.$limitType. ' ? OR AMOUNT_STOCK2 '.$limitType.' ?)';
                
                if (!($stmt = mysqli_prepare($conn, $query))) {
                    echo "Не удалось подготовить запрос: (" . mysqli_errno($conn) . ") " . mysqli_error($conn);
                }
                
                if (!mysqli_stmt_bind_param($stmt, "iiii", $minPrice, $maxPrice, $amount, $amount)) {
                    echo "Не удалось привязать параметры: (" .  mysqli_errno($conn) . ") " . mysqli_error($conn);
                };

                if (!(mysqli_stmt_execute($stmt))) {
                    echo "Не удалось выполнить подготовленный запрос: (" . mysqli_errno($conn) . ") " . mysqli_error($conn);
                }
                
                $result = mysqli_stmt_get_result($stmt);
                // close statement and connection 
                mysqli_stmt_close($stmt);
                
                return $result;
                
            }
            
            return mysqli_query($conn, $query, MYSQLI_USE_RESULT);
        }
        
        $resultArr= array();
        //Если нужно извлечь большой объем данных, используем MYSQLI_USE_RESULT 
        $result = createQuery($arguments);
        
        if($result) {
            while($resultRow = mysqli_fetch_array($result)) {
                global $resultArr;
                // $rowsAmount = mysqli_num_rows($result);
                $objRow = [
                    'productName' => $resultRow['PRODUCT_NAME'],
                    'price' => $resultRow['PRICE'],
                    'priceWholesale' => $resultRow['PRICE_WHOLESALE'],
                    'amountStock1' => $resultRow['AMOUNT_STOCK1'],
                    'amountStock2' => $resultRow['AMOUNT_STOCK2'],
                    'countryFrom' => $resultRow['COUNTRY_FROM'],
                ];
               $resultArr[]=$objRow;
            }
            mysqli_free_result($result);
        }

        
        
       return $resultArr;
    }
?>
