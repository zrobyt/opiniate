<div id='viewCom' class='col-lg-6 col-12 rounded oveflow-hidden'>
    @if (sizeof($userVotes)>0)
    @foreach($userVotes as $uv)
    <div class="w-100 text-wrap">
        <a href="/profile/{{ preg_replace('/=+/','',base64_encode($uv->uid)) }}" target="">
            @php $guser = App\Models\Gusers::find($uv->uid); @endphp
            <div class='d-inline-block align-top bg-white rounded me-1 overflow-hidden p-3' style='width:5rem;height:5rem;'>
                <img onerror='iRetry()' class='w-100 h-100 rounded-circle bg-light' src="{{(session()->has('name'))?$guser->pic:'/default.png'}}" alt="" referrerpolicy="no-referrer" />
            </div>
            <div class="d-inline-block w-75 align-top p-3 bg-white rounded">
                <div class='w-100'>
                    <div class='d-inline-block w-75 text-truncate fw-bold'>{{$guser->name}}</div>
                    <div class='d-inline-block w-25 small float-end text-muted text-end text-nowrap'>{{Carbon\Carbon::parse($uv->created_at)->diffForHumans()}}</div>
                </div>
                <div class='w-100 small text-muted'>
                 ✓ {{ json_decode(\App\Models\Polls::find($uv->pid)->options)->{$uv->option}->desc }}
                </div>
                <hr>
                <div class='small text-muted'> # {{$uv->comment}}</small>
                </div>
        </a>
    </div>
    @if(sizeof($userVotes)!=($loop->index+1)) <div class='mt-2'></div> @endif
    @endforeach
    @else
    No comments found
    @endif
</div>