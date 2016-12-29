<?php

/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016-11-17
 * Time: 10:57 AM
 */
class RegisterUser
{

    public $id = '';
    public $deviceId = '';
    public $name = '';
    public $schoolId = '';
    public $phoneNumber1 = '';
    public $phoneNumber2 = '';


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
        if (array_key_exists('name', $data)) {
            $this->name = $data['name'];
        }
        if (array_key_exists('schoolId', $data)) {
            $this->schoolId = $data['schoolId'];
        }
        if (array_key_exists('phoneNumber1', $data)) {
            $this->phoneNumber1 = $data['phoneNumber1'];
        }
        if (array_key_exists('phoneNumber2', $data)) {
            $this->phoneNumber2 = $data['phoneNumber2'];
        }


//        print_r($this);
//
//        die();


    }


    public function store(){
        $d = new DateTime('', new DateTimeZone('Asia/Dhaka'));
        if(isset($this->deviceId) && !empty($this->deviceId) && isset($this->schoolId) && !empty($this->schoolId) && isset($this->phoneNumber1) && !empty($this->phoneNumber1)){
            $query="INSERT INTO `tbl_person` (`id`, `device_id`,`name`,`school_id`,`phone_1`,`phone_2`,`created_at`) VALUES ('', '".$this->deviceId."','". $this->name."','". $this->schoolId."','". $this->phoneNumber1."','". $this->phoneNumber2."','". $d->format('Y-m-d H:i:s')."')";
//            echo $query;
//            die();
            if (mysql_query($query)){
            return $message = "Successfully Added.";
            } else {
                return $message = "This device Id already added.";
            }

        }
    }


    public function userInfo($deviceId=''){
//        $this->id=$id;
        $query="SELECT * FROM `tbl_person` where device_id='".$deviceId."'";
//        echo $query;
//        die();
        $result=  mysql_query($query);
        $row=  mysql_fetch_assoc($result);
        return $row;
    }

    public function storeArea($data=''){
//        print_r($data);
//        die();
        $sl =0;
      $numberOfLocations = (count($data)-1)/2;
        $d = new DateTime('', new DateTimeZone('Asia/Dhaka'));
        for ($i=0;$i<$numberOfLocations;$i++){
            $sl++;
        if(isset($data) && !empty($data)){
            $query="INSERT INTO `tbl_bounded_area` (`id`, `school_id`,`lat`,`lng`,`created_at`) VALUES ('', '".$data['school_id']."','". $data["ID".$sl."_latitude"]."','". $data["ID".$sl."_longitude"]."','". $d->format('Y-m-d H:i:s')."')";
//            echo $query;
//            die();
          mysql_query($query);

        }
        }
        header('location:index.php');
    }


    public function boundaryCoords(){
            $mydata=array();
            $query="SELECT lat,lng FROM `tbl_bounded_area` WHERE `school_id`='123'" ;
//        echo $query;
//        die();
            $result=  mysql_query($query);
            while ($row=  mysql_fetch_assoc($result)){
                $mydata[]=$row;
            }
            return $mydata;
    }




}