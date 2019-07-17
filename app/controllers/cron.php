<?php

class cron extends controller {

    public function __construct(){
    }

    public function index(){

        $movies_data = $this -> get_movies_data();

        $this->save_to_db($movies_data);

    }

    private function get_movies_data(){
        new simple_html_dom();
        $movies_data = [];
        $movie_links = [];

        for($i=0;$i<7;$i++){
            $url = 'https://www.helios.pl/42,Gdynia/Repertuar/index/dzien/'.$i.'/kino/42';

            $html = $this->curl($url);
            $html = $html->find('ul[class=seances-list]',0);

            //zbieram linki wszystkich aktualnych filmów
            foreach ($html->find('li[class=seance]') as $item) {

                $movie_link = 'https://www.helios.pl' . $item->find('a[class=movie-link]', 0)->href;
                if(!in_array($movie_link, $movie_links)){
                    $movie_links[]   = $movie_link;
                }
            }

        }
        //pobieram dane
        foreach ($movie_links as $movie_link){
            $movies_data[] = $this->get_movie_data($movie_link);
        }

        $html->clear();
        return $movies_data;
    }

    private function get_movie_data($movie_link){
        $movie_data = [];
        $html = $this->curl($movie_link);


        $values = ($html->find('div[id=page-view]') ?
            $html->find('div[id=page-view]') :
            $html->find('article[id=page-view]') );



        foreach ($values as $value) {

            $img = ($value->find('img', 0) ?
                $value->find('img', 0)->src :
                'image not available');

            $title_pl = ($value->find('h1[class=movie-title]', 0) ?
                trim(strip_tags($value->find('h1[class=movie-title]', 0)->innertext)) :
                trim(strip_tags($value->find('h1[class=title-big]', 0)->innertext)));

            $title_original = ($value->find('h2[class=movie-title-original]', 0) ?
                trim(strip_tags($value->find('h2[class=movie-title-original]', 0)->innertext)) :
                NULL);
            $title_original = mb_convert_encoding($title_original, 'UTF-8', 'HTML-ENTITIES');


            $trailer = ($value->find('a[class=btn-round btn-play show-trailers]') ?
                'https://www.helios.pl' . $value->find('a[class=btn-round btn-play show-trailers]', 0)->href :
                NULL);

            $info = ($value->find('div[class=details]', 0) ?
                $value->find('div[class=details]', 0)->plaintext :
                'no info available');
            $info = trim($info);
            $info = str_replace( '                      				                 				                    				                     					', ' ', $info); //removing multiplied spaces from data

            $info = preg_split("/[\s,]{2,}/",trim($info));


            $description = ($value->find('div[class=description]', 0) ?
                strip_tags($value->find('div[class=description]', 0)->find('p', 0)) :
                'no description available');
            $description =  trim(preg_replace('/\s+/', ' ', $description));

            $screen_time = $this->prepare_screen_time($value);

            $cinema_halls = [];
            for($i=0;$i<count($screen_time);$i++){
                if (strlen($screen_time[$i]) == 5){
                    $cinema_halls[] = rand(1,9);
                } else {
                    $cinema_halls[] = NULL;
                }
            }

            $movie_data = new models__resources__movie();
            $movie_data->setTitleOriginal($title_original);
            $movie_data->setTitlePl($title_pl);
            $movie_data->setDescription($description);
            $movie_data->setInfo($info);
            $movie_data->setImg($img);
            $movie_data->setTrailer($trailer);
            $movie_data->setScreenTime($screen_time);
            $movie_data->setCinemaHalls($cinema_halls);
        }

        $html->clear();

        return $movie_data;
    }

    private function prepare_screen_time($value)
    {
        $screen_time = '';
        $seances = $value->find('div[class=day]');
        foreach ($seances as $seance) {
            $screen_time .= $seance->plaintext;
        }

        $screen_time = trim($screen_time);
        $screen_time = str_replace('     					', ' ', $screen_time);

        $screen_time = str_replace('Pn', 'Poniedziałek -', $screen_time);
        $screen_time = str_replace('Wt', 'Wtorek -', $screen_time);
        $screen_time = str_replace('Śr', 'Środa -', $screen_time);
        $screen_time = str_replace('Cz', 'Czwartek -', $screen_time);
        $screen_time = str_replace('Pt', 'Piątek -', $screen_time);
        $screen_time = str_replace('So', 'Sobota -', $screen_time);
        $screen_time = str_replace('Nd', 'Niedziela -', $screen_time);

        $screen_time = str_replace('sty', 'styczeń', $screen_time);
        $screen_time = str_replace('lut', 'luty', $screen_time);
        $screen_time = str_replace('mar', 'marzec', $screen_time);
        $screen_time = str_replace('kwi', 'kwiecień', $screen_time);
        $screen_time = str_replace('maj', 'maj', $screen_time);
        $screen_time = str_replace('cze', 'czerwiec', $screen_time);
        $screen_time = str_replace('lip', 'lipiec', $screen_time);
        $screen_time = str_replace('sie', 'sierpień', $screen_time);
        $screen_time = str_replace('wrz', 'wrzesień', $screen_time);
        $screen_time = str_replace('paź', ' październik', $screen_time);
        $screen_time = str_replace('lis', 'listopad', $screen_time);
        $screen_time = str_replace('gru', 'grudzień', $screen_time);

        $screen_time = str_replace('*', '', $screen_time);
        $screen_time = preg_split('/\s{2,}/', $screen_time);

        return $screen_time;
    }

    private function curl($url){

        $config['useragent'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:67.0) Gecko/20100101 Firefox/67.0';
        $config['url'] = $url;
        $config['referer'] = 'https://www.google.com/';
        $config['returntransfer'] = 1;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $config['url']); // url
        curl_setopt($ch,CURLOPT_USERAGENT, $config['useragent']); // useragent
        curl_setopt($ch, CURLOPT_REFERER, $config['referer']); // referer
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,  $config['returntransfer']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $result=curl_exec($ch);

        curl_close($ch);

        $html = str_get_html($result);

        return $html;
    }

    private function save_to_db($movies_data){

        foreach ($movies_data as $movie_data)
        {

            $movie = ($this->model('movies')->get_movie_by_title_pl($movie_data->getTitlePl()) &&
            $this->model('movies')->get_movie_by_title_original($movie_data->getTitleOriginal()) ?
                $this->model('movies')->get_movie_by_titles($movie_data->getTitlePl(),$movie_data->getTitleOriginal()) :
                NULL );

            if ( $movie  ){
                $this->model('movies')->update_movie($movie_data);
            } else {
                $this->model('movies')->add_movie($movie_data);
            }


        }

    }


}