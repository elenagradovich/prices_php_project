<?php
    function getQueryResult($conn, $query) {
        if($result = mysqli_query($conn, $query)) {
            $resultArr = mysqli_fetch_array($result);
            return $resultArr[0];
        } else {
            echo "Ошибка" . mysqli_error($conn);
            return false;
        };
        mysqli_free_result($result);
    };
?>

