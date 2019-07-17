<div>
    <div style="text-align: center"><?php echo 'SALA '.$data['seance']->cinema_hall?>
        <p><b>EKRAN</b></p></div>

    <div style="text-align: center">

        <!--    first rows-->
        <?php
        for ($i=1; $i<=$rows_cinema_hall-$splitted_rows_cinema_hall ; $i++){
            $row = (strlen($i) == 1 ? "0$i" : $i);
            ?>
            <div>
                <?php
                echo $row." ";
                for ($j=1; $j<=$seats_cinema_hall ; $j++){ //seat
                    $seat = (strlen($j) == 1 ? "0$j" : $j);

                    if (in_array($row.".".$seat, $data['seats_unavailable'])){
                        echo "<button class='seat-taken' id=\"$row.$seat\">$seat</button>";
                    } else {
                        echo "<button class='seat-free' id=\"$row.$seat\">$seat</button>";
                    }

                }
                ?>
            </div>
            <?php
        }
        ?>

        <!--    separated rows-->
        <?php
        for ($i=$rows_cinema_hall-$splitted_rows_cinema_hall+1; $i<=$rows_cinema_hall-$last_row_cinema_hall+1 ; $i++){ //row
            $row = (strlen($i) == 1 ? "0$i" : $i);
            ?>
            <div>
                <?php
                echo $row." ";
                for ($j=1; $j<=$seats_cinema_hall+($separated_seats_cinema_hall*2) ; $j++){ //seat
                    $seat = (strlen($j) == 1 ? "0$j" : $j);


                    if($seat == $separated_seats_cinema_hall ||$seat ==$seats_cinema_hall+$separated_seats_cinema_hall ){
                        $var = 0.9*$row_size.'cm';
                        if (in_array($row.".".$seat, $data['seats_unavailable'])){
                            echo "<button class='seat-taken' id=\"$row.$seat\" style='margin-right:$var'>$seat</button>";
                        } else {
                            echo "<button class='seat-free' id=\"$row.$seat\" style='margin-right:$var'>$seat</button>";
                        }
                    } else {
                        if (in_array($row.".".$seat, $data['seats_unavailable'])){
                            echo "<button class='seat-taken' id=\"$row.$seat\">$seat</button>";
                        } else {
                            echo "<button class='seat-free' id=\"$row.$seat\">$seat</button>";
                        }
                    }
                }

                ?>
            </div>
            <?php
        }
        ?>

        <!--    last rows-->
        <?php
        for ($i=$rows_cinema_hall+1; $i<$rows_cinema_hall+$last_row_cinema_hall+$last_row_cinema_hall ; $i++){ //row
            $row = (strlen($i) == 1 ? "0$i" : $i);
            ?>
            <div>
                <?php
                echo $row." ";
                for ($j=1; $j<=$seats_cinema_hall+($separated_seats_cinema_hall*2)+(2*$row_size) ; $j++){ //seat
                    $seat = (strlen($j) == 1 ? "0$j" : $j);
                    if (in_array($row.".".$seat, $data['seats_unavailable'])){
                        echo "<button class='seat-taken' id=\"$row.$seat\">$seat</button>";
                    } else {
                        echo "<button class='seat-free' id=\"$row.$seat\">$seat</button>";
                    }
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<br />