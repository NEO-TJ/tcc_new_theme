<!-- Table body -->
<?php 
    $numRecordStart++;
    foreach($dsIccCardList as $row) {
        echo ('<tr>');
        echo ('<td class="text-center">' . $numRecordStart++ . '</td>');
        $lastColumn = count($row) - 1;
        $j = 0;
        foreach($row as $value) {
            if ($j == $lastColumn) {
                echo ('<td class="text-center">');
                echo($rIccCardStatus[$value]);
                if( (($level == 1) || ($level == 2)) && ($value == 1) ) {
                    echo ('<div>');
                    echo ('<button id="approveIccCard" type="button" class="btn btn-info">อนุมัติ</button>');
                    echo ('</div>');
                }
                echo ('</td>');
            } else if ($j > 0) {
                echo ('<td class="text-left">' .$value . '</td>');
            }
            $j++;
        }
        echo('<td class="text-center">');
            echo('<a style="float:left; margin-right:8px;" ');
            echo('title="แก้ไขแบบฟอร์ม" class="btn btn-primary btn-xs" ');
            echo('href="#" role="button" id="editIccCard">');
                echo('<i class="fa fa-cog "></i>');
            echo('</a>');
            echo('<input type="hidden" id="iccCardId" value="' . $row['id'] . '"/>');
        echo('</td>');
        echo('<td class="text-center">');
            echo('<a href="#" id="eventImageAdmin"');
            echo('class="button button-block button-rounded button-large">ภาพกิจกรรม</a>');
        echo('</td>');
    echo('</tr>');
    }
?>
<!-- End Table body -->
