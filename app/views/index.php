<?php require APPROOT . '/views/inc/header.php'; ?>



    <table class="table table-striped table-dark" style="color: #cdcdcd">
        <thead></thead>
        <tbody>
        <?php

        foreach ($data['cinema_movies'] as $movie) :
            if (substr($movie->edit_timestamp, 0, 10) ==  date("Y-m-d") || substr($movie->add_timestamp, 0, 10) ==  date("Y-m-d")  ){
                ?>
                <tr>
                    <td>
                        <img src="<?php echo $movie->img; ?>" alt="cinema img">
                    </td>
                    <td>
                        <h1><?php echo $movie->title_pl; ?></h1>
                        <h5><?php echo $movie->title_original; ?></h5>
                        <p><?php foreach (json_decode($movie->info) as $value) {
                                echo $value; ?> <br />
                            <?php }
                            ?></p>
                        <p style="text-align: justify">Opis filmu: <a href="<?php echo $movie->trailer; ?>" class="trailer">zobacz zwiastun</a> <br />
                            <?php echo $movie->description; ?></p>
                    </td>
                    <td class="seance-hour">
                        <p><span class="seance-hour"">Godziny seansu:</span>
                            <?php foreach (json_decode($movie->screen_time) as $value) {
                                if(strlen($value) != 5 ){
                                    $data = $value; ?>
                                   <span><?php echo "<br /><br />" . $value . "<br />";?></span>
                                <?php
                                } else {
                                    if (strtotime('+30 minutes' , strtotime(date('H:i'))) <= strtotime($value)){
                                        $seance=str_replace( ' ', '^',$movie->title_original.';'.$movie->title_pl.';'.$data.';'.$value);
                                        ?>
                                        <a href="<?php echo URLROOT . '/reservation?seance='.$seance; ?>"><?php echo $value; ?></a>
                                        <?php
                                    } else {
                                        echo $value.' ';
                                    }
                                }
                            }
                            ?></p>

                    </td>
                </tr>
                <?php
            }
        endforeach ?>
        </tbody>
    </table>




<?php require APPROOT . '/views/inc/footer.php'; ?>
