//index reservation
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
//index reservation