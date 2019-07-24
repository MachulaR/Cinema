<?php

class reservation extends controller {

    public function index(){

        $seance_data = $this->full_seance_data();

        $viewData = [
            'title' => SITENAME,
            'seance' => $seance_data,
            'seats_unavailable' => $this->model('reservations')->get_all_reserved_seats_for_seance($seance_data),
        ];
        $this->view('reservation/index_reservation', $viewData);
    }

    public function confirm_reservation(){
        session_start();
        $viewData = [];
        if ($_POST['captcha_challenge'] && $_SESSION['captcha_text'] && $_SESSION['captcha_text'] === $_POST['captcha_challenge']){
            $this->confirmed($_POST);
            die;
        } else if ($_POST['captcha_challenge'] && $_SESSION['captcha_text'] && $_SESSION['captcha_text'] !== $_POST['captcha_challenge']){
            $_SESSION['Error'] = "Captcha niepoprawna. Spróbuj ponownie.";
            $viewData['form_data'] = [
                'email' => $_POST['email'],
                'name' => $_POST['name'],
                'last-name' => $_POST['last-name'],
                'checkbox1' => $_POST['checkbox1'],
                'checkbox2' => $_POST['checkbox2'], ];
            }

        $viewData['title'] = SITENAME;
        $viewData['seance'] = $_POST['seance-data'];
        $viewData['seats'] = json_decode($_POST['seats']);

        $this->view('reservation/confirm_reservation', $viewData);
    }

    private function confirmed($post_data){
        $post_data['seats'] = json_decode($post_data['seats']);
        $post_data['seance-data'] = json_decode($post_data['seance-data']);
        $reservation_ok = $this->check_reservation($post_data['seats'], $post_data['seance-data']);
        if($reservation_ok === 1){
            $this->send_reservation_email($post_data);
            $this->book_a_seats($post_data);
        }

        $viewData = [
            'title' => SITENAME,
            'reservation_data' => $post_data,
            'confirm' => $reservation_ok,
        ];

        $this->view('reservation/reservation_status', $viewData);
    }

    private function send_reservation_email($data){

        $checkRow = 0;
        $reservation_txt = '';
        $seats = $data['seats'];

        foreach ($seats as $seat){
            $row_seat = explode(".", $seat);
            $row = $row_seat[0];
            $seat = $row_seat[1];

            if ($row === $checkRow) {
                $reservation_txt .= ", ".$seat;
            } else {
                $reservation_txt .= "
            rząd: ".$row." miejsca: ".$seat;
            }

            $checkRow = $row;
        }
        $reservation_txt = substr($reservation_txt, 1);

        $to = $data['email'];
        $subject = 'Ticket(s) - reservation';
        $message = 'Witaj '.$data['name'].' '.$data['last-name'].'. 
To jest Twój email z potwierdzeniem rezerwacji. 
Pamiętaj, że nieodebrana rezerwacja jest anulowana na 15 minut przed rozpoczęciem seansu, więc nie zapomnij być wcześniej i odebrać rezerwacji! 
FILM: '. $data['seance-data']->title_pl .'
DATA: '. $data['seance-data']->date .', godz. '. $data['seance-data']->hour .'
MIEJSCA: '.  $reservation_txt ;
        $headers = 'From: testbopotrzebny@gmail.com' . "\r\n" .
            'Reply-To: testbopotrzebny@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }

    private function check_reservation($seats, $movie_data){

        $reserved_seats = $this->model('reservations')->get_all_reserved_seats_for_seance($movie_data);

        foreach ($seats as $seat){
            if(in_array($seat, $reserved_seats)){
                return 0;
            }
        }
        return 1;
    }

    private function book_a_seats($data){

        $reservation_data = new models__resources__reservation;
        $reservation_data->setEmail($data['email']);
        $reservation_data->setName($data['name']);
        $reservation_data->setLastName($data['last-name']);
        $reservation_data->setReservedSeats($data['seats']);
        $reservation_data->setMovieTitleOriginal($data['seance-data']->title_original);
        $reservation_data->setMovieTitlePl($data['seance-data']->title_pl);
        $reservation_data->setReservationDate($data['seance-data']->date);
        $reservation_data->setReservationHour($data['seance-data']->hour);
        $reservation_data->setCinemaHall($data['seance-data']->cinema_hall);

        $this->model('reservations')->add_reservation($reservation_data);
    }

    private function full_seance_data()
    {

        $data = $_GET['seance'];
        $data = str_replace('^', ' ', $data);
        $data = preg_split('/;/', $data);

        $movie = ($this->model('movies')->get_movie_by_titles($data[1], $data[0]));
        $screen_time = json_decode($movie->screen_time);
        $hour = $data[3];
        $first_key = array_search($data[2], $screen_time);
        $screen_time = array_slice($screen_time, $first_key, 50, true); // todo zorientować się dlaczego -1 nie działa.
        $second_key = array_search($hour, $screen_time);

        $cinema_hall = json_decode($movie->cinema_halls);
        $cinema_hall = $cinema_hall[$second_key];


        $title_original = $data[0];
        $title_pl = $data[1];
        $date = $data[2];
        $hour = $data[3];

        $return = ['title_original' => $title_original, 'title_pl' => $title_pl, 'date' => $date, 'hour' => $hour, 'cinema_hall' => $cinema_hall];
        $return = (object)$return;

        return $return;

    }


}