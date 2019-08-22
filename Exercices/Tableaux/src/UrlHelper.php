<?php
/**
 * Created by PhpStorm.
 * User: Dell_PC
 * Date: 8/22/2019
 * Time: 13:15
 */

namespace App;


class UrlHelper
{

    /**
     * @param string $param
     * @param string $value
     * @return string
     */
   public static function withParam(array $data):string
   {
       return http_build_query(array_merge($_GET,$data));
   }
}