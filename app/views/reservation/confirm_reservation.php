<?php require APPROOT . '/views/inc/header.php'; ?>

    <h3>Potwierdzenie rejestracji</h3>
    <form id="confirm-reservation-form" action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="POST">
        <br />
        <div>
            <label>Email:</label><br />
            <input type="email" name="email" placeholder="email" value="<?php if( array_key_exists('form_data', $data) ){echo $data['form_data']['email'];} ?>" required>
        </div>
        <div>
            <label>Imię:</label><br />
            <input type="text" name="name" placeholder="imię" value="<?php if( array_key_exists('form_data', $data) ){echo $data['form_data']['name'];} ?>" required>
        </div>
        <div>
            <label>Nazwisko:</label><br />
            <input type="text" name="last-name" placeholder="nazwisko" value="<?php if( array_key_exists('form_data', $data) ){echo $data['form_data']['last-name'];} ?>" required>
        </div>
        <div>
            <input type="checkbox" name="checkbox1" <?php echo (array_key_exists('form_data', $data) ) ? 'checked' : '' ?> required> Potwierdzam, że zapoznałam(em) się z treścią <a href="<?php echo URLROOT .'/index/regulamin' ?>" target="_blank">Regulamin</a>u i akceptuję jego postanowienia.
        </div>
        <div>
            <input type="checkbox" name="checkbox2" <?php echo (array_key_exists('form_data', $data) ) ? 'checked' : '' ?> required> Wyrażam zgodę na przetwarzanie danych osobowych w celach realizacji rezerwacji
        </div>
        <div>
<?php
if(isset($_SESSION['Error'])) {
    echo "<p style=\"color: red;\">",$_SESSION['Error'],"</p>";
    unset($_SESSION['Error']);
}
?>
            <img src="/captcha/captcha.php" alt="CAPTCHA" class="captcha-image"><br />
            <input type="text" id="captcha" name="captcha_challenge" placeholder="Wpisz captchę" required>
            <button type="button" id="refresh-captcha"><i class="fa fa-refresh" aria-hidden="true"></i></button>
        </div>
        <input type="hidden" name="seats" value='<?php echo json_encode($data['seats']); ?>' readonly>
        <input type='hidden' name='seance-data' value='<?php echo $data["seance"];?>'/>
        <input type="submit" id="confirm-reservation-button" value="REZERWUJ">
    </form>

<?php require APPROOT . '/views/inc/footer.php'; ?>


<script>
    var refreshButton = document.getElementById('refresh-captcha');
    refreshButton.onclick = function() {
        document.querySelector(".captcha-image").src = '/captcha/captcha.php?' + Date.now();
    }
</script>