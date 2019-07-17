<?php
class models__resources__reservation{

    private $id;
    private $name;
    private $last_name;
    private $email;
    private $reserved_seats;
    private $movie_title_pl;
    private $movie_title_original;
    private $reservation_date;
    private $reservation_hour;
    private $cinema_hall;

    /**
     * models__resources__reservation constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getReservedSeats()
    {
        return $this->reserved_seats;
    }

    /**
     * @param mixed $reserved_seats
     */
    public function setReservedSeats($reserved_seats)
    {
        $this->reserved_seats = $reserved_seats;
    }

    /**
     * @return mixed
     */
    public function getMovieTitlePl()
    {
        return $this->movie_title_pl;
    }

    /**
     * @param mixed $movie_title_pl
     */
    public function setMovieTitlePl($movie_title_pl)
    {
        $this->movie_title_pl = $movie_title_pl;
    }

    /**
     * @return mixed
     */
    public function getMovieTitleOriginal()
    {
        return $this->movie_title_original;
    }

    /**
     * @param mixed $movie_title_original
     */
    public function setMovieTitleOriginal($movie_title_original)
    {
        $this->movie_title_original = $movie_title_original;
    }

    /**
     * @return mixed
     */
    public function getReservationDate()
    {
        return $this->reservation_date;
    }

    /**
     * @param mixed $reservation_date
     */
    public function setReservationDate($reservation_date)
    {
        $this->reservation_date = $reservation_date;
    }

    /**
     * @return mixed
     */
    public function getReservationHour()
    {
        return $this->reservation_hour;
    }

    /**
     * @param mixed $reservation_hour
     */
    public function setReservationHour($reservation_hour)
    {
        $this->reservation_hour = $reservation_hour;
    }

    /**
     * @return mixed
     */
    public function getCinemaHall()
    {
        return $this->cinema_hall;
    }

    /**
     * @param mixed $cinema_hall
     */
    public function setCinemaHall($cinema_hall)
    {
        $this->cinema_hall = $cinema_hall;
    }





}