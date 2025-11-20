
<?php
class Database{
 private static $i=null;
 static function getInstance(){
 if(!self::$i){
  self::$i=new PDO("mysql:host=localhost;dbname=petpal_forum;charset=utf8mb4","root","",[
   PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
   PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
  ]);
 }
 return self::$i;
}}
