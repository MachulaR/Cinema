<?php require APPROOT . '/views/inc/header.php'; ?>

<?php
echo 'Rezerwacja na dzień: '. $data['seance']->date . ' - godz: '. $data['seance']->hour .'<br />' ;
echo '<h3>'.$data['seance']->title_pl.'</h3>';
?>

<?php require APPROOT . '/views/cinema_hall/cinema_hall_'.$data['seance']->cinema_hall.'.php'; ?>

<form id="reservation-form" action="<?php echo URLROOT . '/reservation/confirm_reservation' ?>" method="POST">
    <input type="text" id="my_hidden_input" name="seats" hidden readonly>
    <input id="reservation-button" type="submit" value="WYBIERZ MIEJSCA" disabled="disabled">
    <input type='hidden' name='seance-data' value='<?php echo json_encode($data["seance"]);?>'/>
</form>
<div>
    <p>Wybrane miejsca:</p>
    <p id="checked_seats"></p>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
