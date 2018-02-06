<!-- Table body -->
<?php 
    $numRecordStart++;
    foreach($dsIccCardList as $row) {
        echo ('<tr>');
        echo ('<td class="text-center">' . $numRecordStart++ . '</td>');
        //$lastColumn = count($row) - 1;
        $j = 0;
        foreach($row as $value) {
            if($j > 5 && $j < 11) {
                echo ('<td class="text-left active">' .$value . '</td>');
            } else if($j > 0) {
                echo ('<td class="text-left">' .$value . '</td>');
            }
            $j++;
        }
        echo('</tr>');
    }
?>
<!-- End Table body -->
