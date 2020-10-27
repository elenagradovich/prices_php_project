<?php

    //PhpSpreadsheet
    function insertData ($conn, $arr, $itemNum) {
        // подготавливаемый запрос, первая стадия: подготовка \
        if (!($stmt = mysqli_prepare($conn, "INSERT INTO PriceList(
                ORDER_NUMBER, PRODUCT_NAME, PRICE, PRICE_WHOLESALE, AMOUNT_STOCK1, AMOUNT_STOCK2, 
                COUNTRY_FROM) VALUES (?, ?, ?, ?, ?, ?, ?)"))) {
            echo "Не удалось подготовить запрос: (" . mysqli_errno($conn) . ") " . mysqli_error($conn);
        }

        // подготавливаемый запрос, вторая стадия: привязка и выполнение 
        if (!mysqli_stmt_bind_param($stmt, "isddiis", $itemNum, $arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5])) {
            echo "Не удалось привязать параметры: (" .  mysqli_errno($conn) . ") " . mysqli_error($conn);
        };

        if (!($execResult = mysqli_stmt_execute($stmt))) {
            echo "Не удалось выполнить подготовленный запрос: (" . mysqli_errno($conn) . ") " . mysqli_error($conn).'<br>';
        };

        // close statement and connection 
        mysqli_stmt_close($stmt);

    }
        
    function loadXLSData($conn) {
        require 'vendor/autoload.php';
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $spreadsheet = $reader->load('priceList.xls');
        
        $header=array();
        
        if($spreadsheet) {
            $workSheet = $spreadsheet->getActiveSheet();

            $i = 0;
            foreach ($workSheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();

                //не пропускаем пустые ячейки
                $cellIterator->setIterateOnlyExistingCells(false);

                //этот массив будет содержать массивы содержащие в себе значения ячеек каждой строки
                $rowArr = array();

                //пройдемся циклом по ячейкам строки
                foreach ($cellIterator as $cell) {
                    //заносим значения ячеек одной строки в отдельный массив
                    $value = $cell->getCalculatedValue();
                    if($value) {
                       array_push($rowArr, $value);
                    }
                }
                $i==0 ? $header = $rowArr : insertData($conn, $rowArr, $i);
                $i++;

            }

        }
        return $header;
    }
?>

