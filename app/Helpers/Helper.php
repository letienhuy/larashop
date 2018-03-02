<?php

namespace App\Helpers;
use App\Category;
class Helper
{
    public static function category($parent_id = 0)
    {
        $html = "";
        $category = Category::where('parent_id', $parent_id)->get();
        if($parent_id != 0 && count($category) != 0)
            $html = '<ul>';
        foreach($category as $cat){
            $html .= '<li><a href="'.route("category.detail", ["uri" => Helper::seo($cat->name), "id" => $cat->id]).'" title="'.$cat->name.'">'.$cat->name.'</a>';
            $html .= self::category($cat->id);
            $html .= "</li>";
        }
        if($parent_id != 0 && count($category) != 0)
            $html .= "</ul>";
        return $html;
    }
    public static function seo($str){
        $str = preg_replace('/(â|ầ|ầ|ấ|ấ|ậ|ậ|ẩ|ẩ|ẫ|ẫ|ă|ằ|ằ|ắ|ắ|ặ|ặ|ẳ|ẳ|ẵ|ẵ|à|à|á|á|ạ|ạ|ả|ả|ã|ã)/', 'a', $str);  
        $str = preg_replace('/(ê|ề|ề|ế|ế|ệ|ệ|ể|ể|ễ|ễ|è|è|é|é|ẹ|ẹ|ẻ|ẻ|ẽ|ẽ)/', 'e', $str);  
        $str = preg_replace('/(ì|ì|í|í|ị|ị|ỉ|ỉ|ĩ|ĩ)/', 'i', $str);  
        $str = preg_replace('/(ô|ồ|ồ|ố|ố|ộ|ộ|ổ|ổ|ỗ|ỗ|ơ|ờ|ờ|ớ|ớ|ợ|ợ|ở|ở|ỡ|ỡ|ò|ò|ó|ó|ọ|ọ|ỏ|ỏ|õ|õ)/', 'o', $str);  
        $str = preg_replace('/(ư|ừ|ừ|ứ|ứ|ự|ự|ử|ử|ữ|ữ|ù|ù|ú|ú|ụ|ụ|ủ|ủ|ũ|ũ)/', 'u', $str);  
        $str = preg_replace('/(ỳ|ỳ|ý|ý|ỵ|ỵ|ỷ|ỷ|ỹ|ỹ)/', 'y', $str);  
        $str = preg_replace('/(đ)/', 'd', $str);  
        $str = preg_replace('/(B)/', 'b', $str);  
        $str = preg_replace('/(C)/', 'c', $str);  
        $str = preg_replace('/(D)/', 'd', $str);  
        $str = preg_replace('/(F)/', 'f', $str);  
        $str = preg_replace('/(G)/', 'g', $str);  
        $str = preg_replace('/(H)/', 'h', $str);  
        $str = preg_replace('/(J)/', 'j', $str);  
        $str = preg_replace('/(K)/', 'k', $str);  
        $str = preg_replace('/(L)/', 'l', $str);  
        $str = preg_replace('/(M)/', 'm', $str);  
        $str = preg_replace('/(N)/', 'n', $str);  
        $str = preg_replace('/(P)/', 'p', $str);  
        $str = preg_replace('/(Q)/', 'q', $str);  
        $str = preg_replace('/(R)/', 'r', $str);  
        $str = preg_replace('/(S)/', 's', $str);  
        $str = preg_replace('/(T)/', 't', $str);  
        $str = preg_replace('/(V)/', 'v', $str);  
        $str = preg_replace('/(W)/', 'w', $str);  
        $str = preg_replace('/(X)/', 'x', $str);  
        $str = preg_replace('/(Z)/', 'z', $str);  
        $str = preg_replace('/(Â|Ầ|Ầ|Ấ|Ấ|Ậ|Ậ|A|Ẩ|Ẩ|Ẫ|Ẫ|Ă|Ắ|Ằ|Ằ|Ắ|Ặ|Ặ|Ẳ|Ẳ|Ẵ|Ẵ|À|À|Á|Á|Ạ|Ạ|Ả|Ả|Ã|Ã)/', 'a', $str);  
        $str = preg_replace('/(Ẽ|Ẽ|Ê|Ề|E|Ề|Ế|Ế|Ệ|Ệ|Ể|Ể|Ễ|Ễ|È|È|É|É|Ẹ|Ẹ|Ẻ|Ẻ)/', 'e', $str);  
        $str = preg_replace('/(Ì|Ì|Í|Í|Ị|Ị|I|Ỉ|Ỉ|Ĩ|Ĩ)/', 'i', $str);  
        $str = preg_replace('/(Ô|Ồ|Ồ|Ố|Ố|O|Ộ|Ộ|Ổ|Ổ|Ỗ|Ỗ|Ờ|Ơ|Ờ|Ớ|Ớ|Ợ|Ợ|Ở|Ở|Ỡ|Ỡ|Ò|Ò|Ó|Ó|Ọ|Ọ|Ỏ|Ỏ|Õ|Õ)/', 'o', $str);  
        $str = preg_replace('/(Ư|Ừ|Ừ|U|Ứ|Ứ|Ự|Ự|Ử|Ử|Ữ|Ữ|Ù|Ù|Ú|Ú|Ụ|Ụ|Ủ|Ủ|Ũ|Ũ)/', 'u', $str);  
        $str = preg_replace('/(Ỳ|Ỳ|Ý|Ý|Ỵ|Y|Ỵ|Ỷ|Ỷ|Ỹ|Ỹ)/', 'y', $str);
        $str = preg_replace('/(́|̀|̉|̃||̣)/', '', $str);
        $str = preg_replace('/(Đ)/', 'd', $str); 
        $str = str_replace(' ', '-', str_replace('&*#39;','',$str));  
        return $str; 
    }

    public static function getStatus($status){
        $html = "";
        switch($status){
            case 0:
                $html = '<span class="product-status" style="background: #f00;">Hết hàng</span>';
                break;
            case 1:
                $html = '<span class="product-status" style="background: green;">Còn hàng</span>';
                break;
            case -1;
                $html = '<span class="product-status" style="background: #rgb(255, 102, 0);">Ngừng bán</span>';
                break;
            case -2;
                $html = '<span class="product-status" style="background: #rgb(255, 102, 0);">Hàng sắp về</span>';
                break;
        }
        return $html;
    }
    public static function langUpper($fileName){
        return mb_strtoupper(\Lang::get($fileName), 'UTF-8');
    }
    public static function langLower($fileName){
        return mb_strtolower(\Lang::get($fileName), 'UTF-8');
    }
    public static function upper($str){
        return mb_strtoupper($str, 'UTF-8');
    }
    public static function lower($str){
        return mb_strtolower($str, 'UTF-8');
    }
}
?>