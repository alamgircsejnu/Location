<?php
//session_start();

class LocationTrack
{

    public $id = '';
    public $deviceId = '';
    public $longitude = '';
    public $latitude = '';
    public $status = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $selectedLocations = '';
    public function __construct()
    {
        $conn = mysql_connect('localhost', 'root', 'acs_bl2016') or die("Server Not Found");
        mysql_select_db('db_location') or die("Database Not Found");
    }

    public function prepare($data = '')
    {
//        print_r($data);
//        die();
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
        if (array_key_exists('status', $data)) {
            $this->status = $data['status'];
        }
        if (array_key_exists('dateFrom', $data)) {
            $this->dateFrom = $data['dateFrom'];
        }
        if (array_key_exists('dateTo', $data)) {
            $this->dateTo = $data['dateTo'];
        }
        if (array_key_exists('selectedLocations', $data)) {
            $this->selectedLocations = $data['selectedLocations'];
        }
//        print_r($this);
//
//        die();


    }


    public function store(){
        $d = new DateTime('', new DateTimeZone('Asia/Dhaka'));
        if(isset($this->deviceId) && !empty($this->deviceId) && isset($this->longitude) && !empty($this->longitude) && isset($this->latitude) && !empty($this->latitude)){
            $query="INSERT INTO `tbl_location` (`id`, `device_id`,`lng`,`lat`,`status`,`created_at`) VALUES ('', '".$this->deviceId."','". $this->longitude."','". $this->latitude."','". $this->status."','". $d->format('Y-m-d H:i:s')."')";
//            echo $query;
//            die();
            mysql_query($query);

//            header('location:report.php');

        }
    }

    public function index(){
        $mydata=array();
        $query="SELECT * FROM `tbl_location` WHERE `device_id`='".$this->deviceId."' AND created_at BETWEEN ('".$this->dateFrom." 00.00.00') AND ('".$this->dateTo." 23.59.59') ORDER BY id DESC" ;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        while ($row=  mysql_fetch_assoc($result)){
            $mydata[]=$row;
        }
        return $mydata;
//        header('location:report.php');
    }


    public function mapIndex(){
        if (isset($_SESSION['post_value']['selectedLocations']) && !empty($_SESSION['post_value']['selectedLocations'])){
            $mydata=array();
            for ($i=0;$i<count($_SESSION['post_value']['selectedLocations']);$i++){
                $query="SELECT * FROM `tbl_location` WHERE `id`='".$_SESSION['post_value']['selectedLocations'][$i]."'" ;
//        echo $query;
//        die();
                $result=  mysql_query($query);
                $row=  mysql_fetch_assoc($result);
                $mydata[]=$row;
            }
        }else if (isset($_SESSION['post_value']['deviceId']) && !empty($_SESSION['post_value']['deviceId'])){
             $this->deviceId = $_SESSION['post_value']['deviceId'];
             $this->dateFrom = $_SESSION['post_value']['dateFrom'];
             $this->dateTo = $_SESSION['post_value']['dateTo'];
             $mydata=array();
             $query="SELECT * FROM `tbl_location` WHERE `device_id`='".$this->deviceId."' AND created_at BETWEEN ('".$this->dateFrom." 00.00.00') AND ('".$this->dateTo." 23.59.59') ORDER BY id DESC" ;
//        echo $query;
//        die();
             $result=  mysql_query($query);
             while ($row=  mysql_fetch_assoc($result)){
                 $mydata[]=$row;
             }

         }
//print_r($mydata);
//        die();
        return $mydata;
    }


    public function checkData($device=''){
//        $mydata=array();
        $query="select r.min_lng,r.max_lng,r.min_lat,r.max_lat from `tbl_person` AS p,`tbl_reference` AS r WHERE r.school_id = p.school_id AND p.device_id ='".$device."';" ;
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function boundaryCoords(){
        if (isset($_SESSION['post_value']['deviceId']) && !empty($_SESSION['post_value']['deviceId'])) {
            $this->deviceId = $_SESSION['post_value']['deviceId'];
            $mydata = array();
            $query = "SELECT ba.lat,ba.lng from `tbl_person` AS p,`tbl_bounded_area` AS ba WHERE ba.school_id = p.school_id AND p.device_id ='" . $this->deviceId . "'";
//            echo $query;
//            die();
            $result = mysql_query($query);
            while ($row = mysql_fetch_assoc($result)) {
                $mydata[] = $row;
            }
            return $mydata;
        }
    }


}