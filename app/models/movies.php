<?php
class movies
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function add_movie(models__resources__movie $data)
    {


        $this->db->query(
            'INSERT INTO movies (title_original, title_pl, trailer, img, info, description, screen_time, cinema_halls, add_timestamp) 
                      VALUES (:title_original, :title_pl, :trailer, :img, :info, :description, :screen_time, :cinema_halls, :add_timestamp)');

        $this->db->bind(':title_original', $data->getTitleOriginal());
        $this->db->bind(':title_pl', $data->getTitlePl());
        $this->db->bind(':trailer', $data->getTrailer());
        $this->db->bind(':img', $data->getImg());
        $this->db->bind(':info', json_encode($data->getInfo()));
        $this->db->bind(':description', $data->getDescription());
        $this->db->bind(':screen_time', json_encode($data->getScreenTime()));
        $this->db->bind(':cinema_halls', json_encode($data->getCinemaHalls()));
        $this->db->bind(':add_timestamp', date("Y-m-d H:i:s"));

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_movies(){
        $this->db->query('SELECT * FROM movies');

        $results = $this->db->resultSet();

        return $results;
    }

    public function get_movie_by_title_pl($title_pl){
        $this->db->query('SELECT * FROM movies WHERE title_pl = :title_pl');

        $this->db->bind(':title_pl', $title_pl);

        $row = $this->db->single();

        return $row;
    }

    public function get_movie_by_titles($title_pl, $title_original){
        $this->db->query('SELECT * FROM movies WHERE title_pl = :title_pl AND title_original = :title_original');

        $this->db->bind(':title_pl', $title_pl);
        $this->db->bind(':title_original', $title_original);

        $row = $this->db->single();

        return $row;
    }

    public function get_movie_by_title_original($title_original){
        $this->db->query('SELECT * FROM movies WHERE title_original = :title_original');

        $this->db->bind(':title_original', $title_original);

        $row = $this->db->single();

        return $row;
    }

    public function update_movie(models__resources__movie $data){

        $this->db->query('UPDATE movies 
                                          SET title_original = :title_original, title_pl = :title_pl, trailer = :trailer, img = :img, info = :info,
                                           description = :description, screen_time = :screen_time, cinema_halls = :cinema_halls, edit_timestamp = :edit_timestamp 
                                          WHERE title_pl = :title_pl');

        $this->db->bind(':title_original', $data->getTitleOriginal());
        $this->db->bind(':title_pl', $data->getTitlePl());
        $this->db->bind(':trailer', $data->getTrailer());
        $this->db->bind(':img', $data->getImg());
        $this->db->bind(':info', json_encode($data->getInfo()));
        $this->db->bind(':description', $data->getDescription());
        $this->db->bind(':screen_time', json_encode($data->getScreenTime()));
        $this->db->bind(':cinema_halls', json_encode($data->getCinemaHalls()));
        $this->db->bind(':edit_timestamp', date("Y-m-d H:i:s"));

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete_movie($id){

        $this->db->query('DELETE FROM movies WHERE id = :id');

        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

}