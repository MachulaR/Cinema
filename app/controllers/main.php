<?php

class main extends controller {

    public function __construct(){
    }

    public function index(){

        $movies_data = $this->download_data();

        $viewData = [
            'title' => SITENAME,
            'cinema_movies' => $movies_data,
        ];

        $this->view('index', $viewData);
    }

    public function regulamin(){

        $viewData = [
            'title' => 'aaa',
        ];

        $this->view('main/regulamin', $viewData);
    }


    private function download_data(){
        $movies_data = $this->model('movies')->get_movies();

        return $movies_data;
    }

}