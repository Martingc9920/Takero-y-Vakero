<?php
class ConexionBanco{
    public function conectar(){
        $link = new PDO("mysql:host=localhost;dbname=banco",
                        "root",
                        "");
        $link->exec("set names utf8");
        return $link;
    }
}