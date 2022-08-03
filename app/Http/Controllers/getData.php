<?php

namespace App\Http\Controllers;

use App\Models\Polls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use App\Models\UserVotes;
use App\Models\Gusers;


class getData extends Controller
{
   protected static function viewHome()
   {
      return view('home', ["latest" => Polls::latest()->take(6)->get(), "top" => Polls::trending()->take(3)->get()]);
   }

   protected static function viewTrending()
   {
      return view('filter', ["filter"=>"Trending","polls" => Polls::trending()->take(50)->get()]);
   }

   protected static function viewRecent()
   {
      return view('filter',["filter"=>"Recent","polls" => Polls::latest()->take(50)->get()]);
   }

   protected static function viewPoll($id = null)
   {
      if (isset($id)) {
         if (preg_match("/^((poll-)([a-zA-Z0-9]+))?/", $id)) {
            return view('poll', ["poll" => Polls::find(base64_decode(str_replace('poll-', "", ($id))))]);
         } else {
            abort(404);
         }
      } else {
         return view('pollan', ["polls" => Polls::all()]);
      }
   }

   public static function viewCom($id = null)
   {
      if (isset($id))
      {
         return view('layout.viewCom',["userVotes"=>\App\Models\UserVotes::where("pid",$id)->where("comment","!=","")->orderBy('created_at','DESC')->get()]);
      }
   }

   public static function viewOpt($id = null)
   {
      if (isset($id))
      {
         return view('layout.viewOpt',["id"=>$id]);
      }
   }

   protected static function viewFilter($filter = null)
   {
      $route = \Illuminate\Support\Facades\Route::currentRouteName();
      if (in_array($route, ['loca', 'category'])) {
         if ($route == 'category') {
            $Posts = Polls::where('category', 'LIKE', "%" . $filter . "%")->orWhere('subcate', 'LIKE', "%" . $filter . "%")->get();
         } else if ($route == 'loca') {
            $Posts = Polls::where('loca', 'LIKE', "%" . $filter . "%")->orWhere('subloca', 'LIKE', "%" . $filter . "%")->get();
         }
      } else {
         $Posts = Polls::where($route, 'LIKE', "%" . $filter . "%")->get();
      }

      return view("filter", ["filter" => $filter, "polls" => $Posts]);
   }

   protected static function viewProfile($id = null)
   {

      $route = \Illuminate\Support\Facades\Route::currentRouteName();

      if ($route=='profile')
      {
         if (is_null($id)) {
            $id = Gusers::where("email", session()->get('email'))->get()->pluck('id')->first();
         } else {
            $id = base64_decode($id);
         }

         return view("profile", ["id"=>$id]);
      }
      else if($route=='opinion')
      {
         $uvid = base64_decode(str_replace('op-','',$id));
         $id = UserVotes::find($uvid)->uid;
         return view("profile", ["id"=>$id,"uvid"=>$uvid]);
      }
      
      
   }
}
