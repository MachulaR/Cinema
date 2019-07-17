<?php
class reservations
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function add_reservation(models__resources__reservation $data)
    {
        $this->db->query(
            'INSERT INTO reservations (name, last_name, email, reserved_seats, movie_title_pl, movie_title_original, reservation_date, reservation_hour, cinema_hall, add_timestamp) 
                      VALUES (:name, :last_name, :email, :reserved_seats, :movie_title_pl, :movie_title_original, :reservation_date, :reservation_hour, :cinema_hall, :add_timestamp)');

        $this->db->bind(':name', $data->getName());
        $this->db->bind(':last_name', $data->getLastName());
        $this->db->bind(':email', $data->getEmail());
        $this->db->bind(':reserved_seats', json_encode($data->getReservedSeats()));
        $this->db->bind(':movie_title_pl', $data->getMovieTitlePl());
        $this->db->bind(':movie_title_original', $data->getMovieTitleOriginal());
        $this->db->bind(':reservation_date', $data->getReservationDate());
        $this->db->bind(':reservation_hour', $data->getReservationHour());
        $this->db->bind(':cinema_hall', $data->getCinemaHall());
        $this->db->bind(':add_timestamp', date("Y-m-d H:i:s"));

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_reservations(){
        $this->db->query('SELECT * FROM reservations');

        $results = $this->db->resultSet();

        return $results;
    }

    public function get_all_reserved_seats(){
        $this->db->query('SELECT reserved_seats FROM reservations');

        $results = $this->db->resultSet();

        $seats = '';
        foreach ($results as $result){
            $result = substr($result->reserved_seats, 1, -1);
            $seats .= $result.',';
        }
        $seats = '['.substr($seats, 0, -1).']';
        $seats = json_decode($seats);
        sort($seats);

        return $seats;
    }

    public function get_all_reserved_seats_for_seance(stdClass $movie_data){
        $this->db->query(
            'SELECT reserved_seats FROM reservations 
                    WHERE movie_title_pl = :movie_title_pl AND movie_title_original = :movie_title_original AND
                    reservation_date = :reservation_date AND reservation_hour = :reservation_hour AND cinema_hall = :cinema_hall');

        $this->db->bind(':movie_title_pl', $movie_data->title_pl);
        $this->db->bind(':movie_title_original', $movie_data->title_original);
        $this->db->bind(':reservation_date', $movie_data->date);
        $this->db->bind(':reservation_hour', $movie_data->hour);
        $this->db->bind(':cinema_hall', $movie_data->cinema_hall);

        $results = $this->db->resultSet();

        $seats = '';
        foreach ($results as $result){
            $result = substr($result->reserved_seats, 1, -1);
            $seats .= $result.',';
        }
        $seats = '['.substr($seats, 0, -1).']';
        $seats = json_decode($seats);
        sort($seats);

        return $seats;
    }

    public function delete_reservation($id){

        $this->db->query('DELETE FROM reservations WHERE id = :id');

        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

}