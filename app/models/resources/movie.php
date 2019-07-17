<?php
class models__resources__movie
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title_original;

    /**
     * @var string
     */
    private $title_pl;

    /**
     * @var string
     */
    private $trailer;

    /**
     * @var string
     */
    private $img;

    /**
     * @var string
     */
    private $info;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $screen_time;

    /**
     * @var string
     */
    private $cinema_halls;

    /**
     * @var \DateTime
     */
    private $add_timestamp;

    /**
     * @var \DateTime
     */
    private $edit_timestamp;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitleOriginal()
    {
        return $this->title_original;
    }

    /**
     * @param string $title_original
     */
    public function setTitleOriginal($title_original)
    {
        $this->title_original = $title_original;
    }

    /**
     * @return string
     */
    public function getTitlePl()
    {
        return $this->title_pl;
    }

    /**
     * @param string $title_pl
     */
    public function setTitlePl($title_pl)
    {
        $this->title_pl = $title_pl;
    }

    /**
     * @return string
     */
    public function getTrailer()
    {
        return $this->trailer;
    }

    /**
     * @param string $trailer
     */
    public function setTrailer($trailer)
    {
        $this->trailer = $trailer;
    }

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getScreenTime()
    {
        return $this->screen_time;
    }

    /**
     * @param string $screen_time
     */
    public function setScreenTime($screen_time)
    {
        $this->screen_time = $screen_time;
    }

    /**
     * @return string
     */
    public function getCinemaHalls()
    {
        return $this->cinema_halls;
    }

    /**
     * @param string $cinema_halls
     */
    public function setCinemaHalls($cinema_halls)
    {
        $this->cinema_halls = $cinema_halls;
    }

    /**
     * @return DateTime
     */
    public function getAddTimestamp()
    {
        return $this->add_timestamp;
    }

    /**
     * @param DateTime $add_timestamp
     */
    public function setAddTimestamp($add_timestamp)
    {
        $this->add_timestamp = $add_timestamp;
    }

    /**
     * @return DateTime
     */
    public function getEditTimestamp()
    {
        return $this->edit_timestamp;
    }

    /**
     * @param DateTime $edit_timestamp
     */
    public function setEditTimestamp($edit_timestamp)
    {
        $this->edit_timestamp = $edit_timestamp;
    }




}