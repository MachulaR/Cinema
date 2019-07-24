<?php require APPROOT . '/views/inc/header.php'; ?>

<?php
echo 'Rezerwacja na dzień: '. $data['seance']->date . ' - godz: '. $data['seance']->hour .'<br />' ;
echo '<h3>'.$data['seance']->title_pl.'</h3>';
?>

<?php require APPROOT . '/views/cinema_hall/cinema_hall_'.$data['seance']->cinema_hall.'.php'; ?>

<form id="reservation-form" action="<?php echo URLROOT . '/reservation/confirm_reservation' ?>" method="POST">
    <input type="text" id="my_hidden_input" name="seats" hidden readonly>
    <input type='hidden' name='captcha_challenge' value=''/>
    <input id="reservation-button" type="submit" value="WYBIERZ MIEJSCA" disabled="disabled">
    <input type='hidden' name='seance-data' value='<?php echo json_encode($data["seance"]);?>'/>
</form>
<div>
    <p>Wybrane miejsca:</p>
    <p id="checked_seats"></p>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>


<script>
    $( document ).ready(function() {
        $("#reservation-button").attr("disabled", true);
    });

    var form = document.getElementById('reservation-form');
    form.onsubmit = function () {
        document.getElementById('my_hidden_input').value = JSON.stringify(seatsArray);
    };


    var seatsArray =[];
    var tekst = "";
    $(".seat-free").click(function(){

        var htmlString = $( this ).html();
        $( this ).text( htmlString );
        var checkRow;
        if(this.clicked){
            $(this).css('background-color', '#438543');
            this.clicked  = false;
            seatsArray.splice( $.inArray(this.id, seatsArray), 1 );
            seatsArray.sort();

            $.each(seatsArray, function( index, value ) {

                value = value.split(".");
                var row = value[0];
                var seat = value[1];

                if (checkRow === undefined) {
                    tekst = "rząd: "+row+" miejsca: "+seat;
                } else if (row === checkRow) {
                    tekst += ", "+seat;
                } else {
                    tekst += "<br />"+"rząd: "+row+" miejsca: "+seat;
                }

                checkRow = row;

            });
            $('#checked_seats').html(tekst);
        } else {
            $(this).css('background-color', '#afa213');
            this.clicked  = true;
            seatsArray.push(this.id);
            seatsArray.sort();

            // var checkRow;
            $.each(seatsArray, function( index, value ) {

                value = value.split(".");
                var row = value[0];
                var seat = value[1];

                if (checkRow === undefined) {
                    tekst = "rząd: "+row+" miejsca: "+seat;
                } else if (row === checkRow) {
                    tekst += ", "+seat;
                } else {
                    tekst += "<br />"+"rząd: "+row+" miejsca: "+seat;
                }

                checkRow = row;

            });
            $('#checked_seats').html(tekst);
        }
        if(seatsArray.length){
            $('#reservation-button').attr("disabled", false).attr('value', 'REZERWUJ');
        } else {
            $("#reservation-button").attr("disabled", true).attr('value', 'WYBIERZ MIEJSCA');;
        }
    });
</script>