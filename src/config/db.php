<?php

class db{

    private $dbHost='localhost';
    private $dbName='products_db';
    private $dbUser='root';
    private $dbPass='';

    // CONEXION
    public function connectionDB(){
        $mysqlConnect = "mysql:host=$this->dbHost;dbname=$this->dbName";
        $dbConnection = new PDO($mysqlConnect,$this->dbUser,$this->dbPass);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        //Arreglando la codificación
        $dbConnection-> exec("set names utf8");
        return $dbConnection;
    }
}