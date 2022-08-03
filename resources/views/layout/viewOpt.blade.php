@php
use App\Models\Gusers;
use App\Models\Polls;
$poll = Polls::find($id);
$tv = (new App\Http\Controllers\Votes($poll))->totalVotes;
@endphp
<ul poll='{{ $id }}' v='{{ (session()->has("name"))?Polls::isVoted($id,Gusers::getCurrentUid()):-1 }}' status='{{$poll->status}}' class='list-unstyled d-inline-flex container-fluid flex-wrap mt-4 fs-6'>
    @foreach(json_decode($poll->options) as $option)
    <li optn='{{ ($loop->index+1) }}' class='d-inline-flex {{ (Polls::isVoted($id,Gusers::getCurrentUid()))?(($poll->votes->where('uid',session()->get('id'))->first()->option == ($loop->index+1))?"border ":""):"" }} align-bottom col-12 col-lg-4 mb-3 p-2'>
        <div class='w-100 shadow rounded overflow-hidden relative bg-white'>
            <div class='p-3 mb-5'>
                {{ $option->desc }}
                <div class="position-absolute rounded-circle {{ (Polls::isVoted($id,Gusers::getCurrentUid()))?(($poll->votes->where('uid',session()->get('id'))->first()->option == ($loop->index+1))?'bg-success':''):'' }}" style='height:0.5rem;width:0.5rem; top:0.5rem;right:0.5rem;'>
                </div>
            </div>
            <div class='position-absolute w-100 mt-2 bg-success bg-gradient p-2 ps-3 pe-3 overflow-auto' style='bottom:0;'>
                <span id='pCent' class='fw-bold text-white'>
                    {{ floor(($option->count/$tv)*100) }}%
                </span>
                <input id='vCom' class="rounded-pill ps-3" type="text" placeholder="Comment" style='display:none;' />
                <span class='pVote float-end text-success rounded-pill ps-3 pe-3 bg-white fw-bold' style='display:none;cursor:pointer;'>
                    Vote
                </span>
                <span class='poVotes float-end text-light fst-italic small' style='cursor:pointer;'>
                    {{ ($option->count) }} votes
                </span>
            </div>
        </div>

    </li>
    @endforeach
</ul>