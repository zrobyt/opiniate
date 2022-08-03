@php
use App\Models\Polls;
use App\Models\Gusers;
use WebThumbnailer\WebThumbnailer;
@endphp

@foreach($userVotes as $uv)
@php
$poll = Polls::find($uv->pid);
$option = json_decode($poll->options)->{$uv->option};
@endphp

<li class='d-inline-block col-lg-{{$col}} col-sm-12 col-12 p-1 pb-3 p-lg-2'>


    <div class='w-100 bg-white overflow-hidden rounded shadow relative'>

        @if( session()->get('email')!==null )
        <div class="position-absolute rounded-circle {{ ($poll->votes->where('uid',session()->get('id'))->first() !== null)?'':' border border-success' }} " style='height:0.65rem;width:0.65rem;top:0.5rem;right:0.5rem;'>
        </div>
        @endif

        @if ($comtr)
        <div class='mb-2 border-bottom bg-light'>
            <a href="/profile/{{ base64_encode($uv->uid) }}" class='p-3 fw-bold align-top text-truncate d-inline-block w-50'>
                <img src="{{ Gusers::find($uv->uid)->pic }}" class='d-inline-block rounded-circle overflow-hidden me-2' style='width:1.5rem;height:1.5rem;' alt="" referrerpolicy="no-referrer">
                <small>
                    {{ Gusers::find($uv->uid)->name }}
                </small>
            </a>
            <div class='small text-muted p-3 d-inline-block align-top float-end me-4 '>
                <small>voted {{ $uv->created_at->diffForHumans() }}</small>
            </div>
        </div>
        @endif

        <div class=''>
            <a href='/polls/poll-{{ preg_replace("/=+/","",base64_encode($uv->pid)) }}' target="" class='w-100'>
                <div class='d-inline-block align-middle border-end' style='object-fit:cover;width:22%;height:5em;'>
                    <img class='pollThumb h-100 rounded-circle p-2' src="/{{ (new WebThumbnailer())->maxHeight(280)->maxWidth(240)->crop(true)->thumbnail($poll->link) }}" style='width:5.25rem;height:5.25rem !important' alt="" />


                </div>
                <div class='d-inline-block pr-3 p-2 align-top' style='width:75%;'>

                    <div class='w-100 {{ ($poll->votes->where('uid',session()->get('id'))->first() !== null)?' text-muted':'' }}'>
                        {{ $poll->title }}
                    </div>


                    <div class='small text-muted m-2 ms-0 w-100'>

                        <div class='w-100 pt-2 pb-2' style='display:none;height:2.5rem;'>

                        @if(!$comtr)
                            <div class='d-inline-block w-50 float-start text-start'>{{ $uv->created_at->diffForHumans() }}</div>
                            @endif

                            <div class='d-inline-block w-50 float-end text-end' share="/opinion/op-{{base64_encode($uv->id)}}">
                                <div class='d-inline-block align-middle bg-light border overflow-hidden rounded-circle ' style='width:1.65rem;height:1.65rem;opacity:0.75;margin-top:-0.21rem;'>
                                    <img src="/share.png" class='h-100' style='padding:0.43rem;' alt="">
                                </div>
                                <div class='d-inline-block align-middle ms-2'>Share</div>
                            </div>

                            
                        </div>



                    </div>


                    <div class='small text-dark mt-2'>
                        <div class=''> ✓ {{$option->desc}} </div>
                        @if ($uv->comment!='')
                        <hr>
                        <div class=''> <span class='fw-bold'>Opinion</span> # {{ $uv->comment }}</div>
                        @endif
                    </div>
                </div>
            </a>
        </div>
    </div>

</li>
@endforeach