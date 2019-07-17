<?php require APPROOT . '/views/inc/header.php'; ?>
    <h3>Potwierdzenie rejestracji</h3>
    <form id="confirm-reservation-form" action="<?php echo URLROOT . '/reservation/confirmed' ?>" method="POST">

        <div>
            <input type="email" name="email" placeholder="email" required>
        </div>
        <div>
            <input type="text" name="name" placeholder="imię" required>
        </div>
        <div>
            <input type="text" name="last-name" placeholder="nazwisko" required>
        </div>
        <div>
            <input type="checkbox" name="checkbox1" required> Potwierdzam, że zapoznałam(em) się z treścią <a href="<?php echo URLROOT .'/index/regulamin' ?>" target="_blank">Regulamin</a>u i akceptuję jego postanowienia.
        </div>
        <div>
            <input type="checkbox" name="checkbox2" required> Wyrażam zgodę na przetwarzanie danych osobowych w celach realizacji rezerwacji
        </div>
        <input type="hidden" name="reserved-seats" value='<?php echo json_encode($data['reservation_seats']); ?>' readonly>
        <input type='hidden' name='seance-data' value='<?php echo $data["seance"];?>'/>
        <input type="submit" id="confirm-reservation-button" value="REZERWUJ">
    </form>

<?php require APPROOT . '/views/inc/footer.php'; ?>
