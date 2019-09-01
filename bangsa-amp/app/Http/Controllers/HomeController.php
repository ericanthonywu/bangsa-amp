<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    function get_link($slug,$tipe=null){
        $transable = "";
//        if(->request->getQuery('browsefrom') == "desktop"){
//            $transable = "?browsefrom=desktop";
//        }
        $link = url($tipe/$slug);
        return $link.$transable;
    }
    function get_image($data, $tipe, $ukuran = null, $alt = null, $width = null, $height = null, $class = null)
    {
        if ($ukuran) {
            $ukuran = '/' . $ukuran;
        }
        // $imglink	 	= Yii::app()->request->baseUrl.'/images/uploads/';
        $imglink = 'https://bangsaonline.com/images/uploads/';
        $imgfull_link = $imglink . $tipe . $ukuran . '/' . $data;

//        $img = "<img src='".$imgfull_link."' alt='".$alt."' class='".$class."' title='".$alt."' width='".$width."' height='".$height."' />";

        return $imgfull_link;
    }

    public function index()
    {
        $slider = DB::table('view_slide')->orderByDesc('news_date')->limit(5)->get();
        $options = DB::table('options')->select('option_value')->whereIn('option_id', [6, 7])->get();
        $navbar = DB::table('menu')->select([
            "menu_id",
            "root",
            "lft",
            "rgt",
            "level",
            "menu_title",
            "menu_slug",
            "menu_description",
            "menu_title_attribute",
            "menu_url_id",
            "menu_url",
            "menu_type",
            "category_id",
            "group_id"
        ])->where('group_id', '5')->orderBy('lft')->get();
        $level = 0;
        $ullevel = 0;
        $html = '';
        foreach ($navbar as $navbar_key => $navbar_value) {
            if ($navbar_value->level == $level) {
                $html .= "</li>
                ";
            } else if ($navbar_value->level > $level) {
                if (!$ullevel) {
                    $ullevel++;
                } else {
                    $html .= "<ul class='dropdown-menu'>
                        ";
                }
            } else {
                $html .= "</li>
                    ";
                for ($i = $level - $navbar_value->level; $i; $i--) {
                    if ($ullevel == 0) {
                        $ullevel++;
                    } else {
                        $html .= "</ul>
                            ";
                        $html .= "</li>
                            ";
                    }

                    dd( $navbar_value->attributes );
                    if ($navbar_value->menu_id == 1){
                        switch ($navbar_value->menu_type){
                            case "category":
                                $menuslug = DB::table('category')->select([
                                    "category_id",
                                    "category_slug",
                                ])->where('category_id',$navbar_value->menu_url_id)->get();
                                $menulink = $this->get_link($menuslug['category_slug'],"kanal");
                                break;
                            case "page":
                                $menuslug = DB::table('page')->select([
                                    "page_id",
                                    "page_slug"
                                ])->where('page_id',$navbar_value->menu_url_id)->get();
                                $menulink = $this->get_link($menuslug['page_slug']);
                                break;
                            default:
                                $menulink = $navbar_value->menu_url;
                                break;
                        }
                        $html .= "<li id=\"list_$navbar_value->menu_id; \" class=\"".$navbar_value->level==2 ? "dropdown":""."\">
			            <a href=\"$menulink;\" >$navbar_value->menu_title</a>";
                    }
                    $level = $navbar_value->level;
                }
            }
        }
        dd($html);

        return view('home-news',
            [
                "slider" => $slider,
                "options" => $options
            ]
        );
    }
}
