<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Polls;
use App\Models\Gusers;
use App\Models\UserVotes;
use App\Models\Follow;

class putData extends Controller
{
    public static function putVote($id = null, Request $req)
    {
        if (session()->has('name')) {
            $uid = Gusers::getCurrentUid();
            if (UserVotes::where("pid", $id)->where("uid", $uid)->get()->count() == 0) {

                // Poll update
                $poll = Polls::find($id);
                $optn = (array)json_decode($poll->options);
                $optn[$req->optn]->count++;
                $poll->options = json_encode((object)$optn);
                $poll->save();

                // UserVote update
                $vote = new UserVotes();
                $vote->pid = $id;
                $vote->uid = $uid;
                $vote->option = $req->optn;
                $vote->comment = (is_null($req->comments))?"":$req->comments;
                $vote->notify = "";
                $vote->save();

                //Guser update
                $guser = Gusers::where('email', session()->get('email'));
                $binds = [];
                foreach ($optn[$req->optn]->binds as $b) {
                    array_push($binds, json_decode($poll->binds)[$b]);
                }

                $intr=[];
                $intr = (array)json_decode(
                    $guser->pluck('interests')
                        ->first()
                );

                foreach ($binds as $b) {
                    if (isset($intr[$b])) {
                        $intr[$b]++;
                    } else {
                        $intr[$b] = 1;
                    }
                }

                $guser->increment('votes');
                $guser->update([
                        "interests" => json_encode($intr)
                    ]);
                return json_encode(["status" => "success"]);
            } else {
                return json_encode(["status" => "failure","error"=>"ReVote"]);
            }
        } else {
            return json_encode(["status" => "failure","error"=>"SessionExpire"]);
        }
    }

    public static function addPoll($id = null, Request $req)
    {

        // $validated = $req->validate([
        //     'title' => 'required|max:255',
        //     'link' => 'required',
        //     'tags' => 'required',
        //     'optns' => 'required'
        // ]);

        // echo "Validation result : ";
        // print_r($validated);

        $poll = new Polls();
        $poll->title = $req->title;
        $poll->link = $req->link;
        $poll->preface = $req->preface;
        $poll->loca = json_encode(explode(',', $req->loca));
        $poll->subloca = json_encode(explode(',', $req->subloca));
        $poll->year = $req->year;
        $poll->language = $req->language;
        $poll->category = $req->category;
        $poll->subcate = $req->subcate;
        $poll->tags = json_encode(explode(',', $req->tags), JSON_UNESCAPED_UNICODE);
        $poll->binds = json_encode(explode(',', $req->binds), JSON_UNESCAPED_UNICODE);
        $opt = [];
        $ind = 1;
        $tc = 0;
        foreach (explode(',', $req->options) as $opin => $optnz) {
            $optz = explode(":", $optnz);

            $opt[$ind] = ["desc" => $optz[0], "count" => (config("sets.app.seedr")) ? $optz[1] : 0, "binds" => []];
            $tc += $optz[1];

            for ($x = 0; $x < (sizeof(explode(',', $req->binds))); $x++) {
                if (str_replace($x . ".", "", $req->$x) == $opin) {
                    array_push($opt[$ind]["binds"], $x);
                }
            }

            $ind++;
        }
        $poll->options = json_encode($opt);
        $poll->views = (config("sets.app.seedr")) ? $tc : 0;
        $poll->save();
        return redirect()->back();
    }

    public static function signIn(Request $req)
    {
        $r = json_decode(base64_decode(explode(".", $req->creden)[1]));
        session()->put(['creden' => $r, 'name' => $r->name, 'email' => $r->email, 'pic' => $r->picture]);

        $usr = new Gusers();

        if (Gusers::where('email', $r->email)->exists()) {
            $usr = Gusers::where('email', $r->email)->get()->first();
        } else {
            
            $usr->email = $r->email;
            $usr->preferences = json_encode([]);
            $usr->bio = "Assertive";
            $usr->votes = 0;
            $usr->comments = 0;
            $usr->interests = json_encode([]);
            $usr->stand = json_encode([]);
        }

        $usr->name = $r->name;
        $usr->pic = $r->picture;
        $usr->status = "in";
        $usr->save();

        session()->put('id',$usr->id);

        return json_encode(["status" => "success"]);
    }

    public static function followUser(Request $req)
    {
        if ($req->follow=='true')
        {
            $follow = new Follow();
            $follow->uid = session()->get('id');
            $follow->fid = $req->user;
            $follow->save();
        }
        else if ($req->follow=='false')
        {
            $follow = Follow::where(['uid'=>session()->get('id'),"fid"=>$req->user])->delete();
        }
        return json_encode(array("status"=>"success"));
    }
}