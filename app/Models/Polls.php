<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polls extends Model
{
    use HasFactory;

    protected static function isVoted($pid,$uid)
    {
        return UserVotes::where("pid", $pid)->where("uid", $uid)->get()->count();
    }

    protected static function trending()
    {
        return self::where('created_at', '>', now()->subDays(7)->endOfDay())->orderBy('views', 'desc');
    }

    protected function votes()
    {
        return $this->hasMany(UserVotes::class, 'pid', 'id');
    }

    protected static function regions()
    {
        return self::places("loca",0);
    }

    protected static function nations()
    {
        return self::places("loca",1);
    }

    protected static function states()
    {
        return self::places("subloca",0);
    }

    protected static function cities()
    {
        return self::places("subloca",1);
    }

    public static function places($field,$key)
    {
        $loca = [];
            foreach(Polls::orderBy($field,"ASC")->pluck($field)->toArray() as $l)
            {
                if (json_decode($l)[$key]!="")
                {
                    array_push($loca,json_decode($l)[$key]);
                }
                
            }
            return array_unique($loca);
    }

    public static function categories()
    {
        return array_unique(Polls::orderBy("category","ASC")->pluck("category")->toArray());
    }

    public static function subcategories()
    {
        return array_unique(Polls::orderBy("subcate","ASC")->pluck("subcate")->toArray());
    }

    public static function languages()
    {
        return array_unique(Polls::orderBy("language","ASC")->pluck("language")->toArray());
    }

    public static function years()
    {
        return array_unique(Polls::orderBy("year","ASC")->pluck("year")->toArray());
    }

    public static function tags()
    {   
        $t = [];

        foreach(self::categories() as $cat)
        {
            foreach(Polls::where("category",$cat)->get() as $poll)
            {
                if (isset($t[$cat." ".$poll->subcate]))
                {
                    $t[$cat." ".$poll->subcate]=array_merge($t[$cat." ".$poll->subcate],json_decode($poll->tags));
                }
                else
                {
                    $t[$cat." ".$poll->subcate]=json_decode($poll->tags);
                }

                $t[$cat." ".$poll->subcate] = array_unique($t[$cat." ".$poll->subcate]);
                
            }
        }

        return $t;
    }
}
