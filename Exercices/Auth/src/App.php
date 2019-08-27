<?php
/**
 * Created by PhpStorm.
 * User: Dell_PC
 * Date: 8/27/2019
 * Time: 08:07
 */

namespace App;


class App
{
    /**
     * @return null|\PDO
     */
     public static function getPdo():?\PDO
     {
         return new PDO("sqlite:../../db/data.sqlite",null,null,[
             \PDO::ATTR_DEFAULT_FETCH_MODE=>\PDO::FETCH_ASSOC,
             \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
         ]);
     }
}