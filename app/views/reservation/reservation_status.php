    <?php require APPROOT . '/views/inc/header.php'; ?>
<?php if ($data['confirm'] === 1) {
    header( "refresh:10;url=".URLROOT );
    ?>
    <h3>Rezerwacja złożona</h3>
    <p> Dziekujemy za złożenie rezerwacji <?php echo $data['reservation_data']['name'] . ' ' . $data['reservation_data']['last-name'] .'.<br />'?>
        Na podany e-mail wysłaliśmy potwierdzenie rezerwacji. Do zobaczenia w kinie!
    </p>

    <?php
} else if($data['confirm'] === 0) { ?>

    <h3>Rezerwacja nieudana</h3>
    <p> Witaj! Podczas rezerwowania biletów, ktoś Cię uprzedził i zajął Twoje miejsca. Spróbuj ponownie!</p>

    <?php
} else {
    echo "Woopsie. Coś poszło nie tak. Spróbuj ponownie!";
}
?>
<p style="text-align: right">
    <a href="<?php echo URLROOT ?>">POWRÓT</a>
</p>

<?php require APPROOT . '/views/inc/footer.php'; ?>
