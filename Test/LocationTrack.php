<?php


class LocationTrack
{

    public $id = '';
    public $deviceId = '';
    public $longitude = '';
    public $latitude = '';


    public function __construct()
    {
        $conn = mysql_connect('localhost', 'root', 'acs_bl2016') or die("Server Not Found");
        mysql_select_db('db_location') or die("Database Not Found");
    }

    public function prepare($data = '')
    {
        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }
        if (array_key_exists('deviceId', $data)) {
            $this->deviceId = $data['deviceId'];
        }
        if (array_key_exists('long', $data)) {
            $this->longitude = $data['long'];
        }
        if (array_key_exists('lat', $data)) {
            $this->latitude = $data['lat'];
        }


//        print_r($this);
//
//        die();


    }


    public function store(){
        $d = new DateTime('', new DateTimeZone('Asia/Dhaka'));
        if(isset($this->deviceId) && !empty($this->deviceId) && isset($this->longitude) && !empty($this->longitude) && isset($this->latitude) && !empty($this->latitude)){
            $query="INSERT INTO `tbl_location` (`id`, `device_id`,`lng`,`lat`,`created_at`) VALUES ('', '".$this->deviceId."','". $this->longitude."','". $this->latitude."','". $d->format('Y-m-d H:i:s')."')";
//            echo $query;
//            die();
            mysql_query($query);

            header('location:report.php');

        }
    }

    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_location` ORDER BY id DESC" ;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
        header('location:report.php');
    }


    public function mapIndex(){
        $mydata=array();
        $query="SELECT * FROM `tbl_location` WHERE `device_id`='DV201030' ORDER BY id DESC" ;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
    }


}