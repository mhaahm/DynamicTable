<?php
/**
 * Created by PhpStorm.
 * User: Dell_PC
 * Date: 8/21/2019
 * Time: 22:21
 */

namespace App;
use App\UrlHelper;
/**
 * Class TableHelper
 * @package App
 */
class TableHelper
{
    /**
     * @param float $price
     * @param string $sigle
     * @return string
     */
    public static function price(float $price, string $sigle = "&euro;"): string
    {
        return number_format($price, 0, '', ' ').' '.$sigle;
    }

    public static function getHr($keyCol,$dir,$data){
        $url = UrlHelper::withParam(['sort'=>$keyCol,'dir'=>$dir]);
        $text = ucfirst($keyCol);
        $last_sort = $data['sort'] ?? '';
        $icon = '';
        if($last_sort == $keyCol) {
            $icon = ($dir == 'asc' && $last_sort == $keyCol) ? 'v' : '^';
        }
        return <<<html
<th><a href="?$url">$text $icon</a></th>
html;

    }
}