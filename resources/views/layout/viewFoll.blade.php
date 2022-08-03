<div class='p-1 ps-3 pe-3'>
    @php
    use App\Models\Follow;
    use App\Models\Gusers;
    $flors = Follow::where('fid',(int)($id));
    $flngs = Follow::where('uid',(int)($id));
    @endphp

    <div class='float-start w-50' onclick='$(this).siblings(".flors").toggle(400);$(this).siblings(".flngs").hide(400);$(this).next().children().removeClass("text-success").addClass("text-muted");if($(this).children().hasClass("text-muted")){$(this).children().removeClass("text-muted").addClass("text-success");}else{$(this).children().addClass("text-muted").removeClass("text-success");}'>
        <span class='fw-bold text-success' style='cursor:pointer;'>Followers</span> : {{ $flors->get()->count() }}
    </div>
    <div class='float-end w-50 text-end' onclick='$(this).siblings(".flngs").toggle(400);$(this).siblings(".flors").hide(400);$(this).prev().children().removeClass("text-success").addClass("text-muted");if($(this).children().hasClass("text-muted")){$(this).children().removeClass("text-muted").addClass("text-success");}else{$(this).children().addClass("text-muted").removeClass("text-success");}'>
        <span class='fw-bold text-muted' style='cursor:pointer;'>Following</span> : {{ $flngs->get()->count() }}
    </div>

    <div class='flors w-100 overflow-hidden' style='display:flex;'>
        <div class='w-100 overflow-auto mt-3 mb-3'>
            @foreach($flors->get() as $flor)
            @php $flr = Gusers::find($flor->uid); @endphp
            <div class='d-inline-block small pt-3 me-2 rounded bg-white align-middle text-center shadow' style='width:6rem;height:8.5rem;'>
                <a href="/profile/{{ base64_encode($flr->id) }}">
                    <img onerror='iRetry' src="{{ $flr->pic }}" style='width:4.5rem;height:4.5rem;' class='rounded-circle overflow-hidden' alt="" referrerpolicy="no-referrer">
                    <div class='bg-success bg-gradient text-white small w-100 p-1 ps-2 pe-2 mt-2 text-truncate w-100 mt-3'> {{ $flr->name }} </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class='flngs w-100 overflow-hidden' style='display:flex;display:none;'>
        <div class='w-100 overflow-auto mt-3 mb-3'>
            @foreach($flngs->get() as $flng)
            @php $fln = Gusers::find($flng->fid); @endphp
            <div class='d-inline-block small pt-3 me-2 rounded bg-white align-middle text-center shadow' style='width:6rem;height:8.5rem;'>
                <a href="/profile/{{ base64_encode($fln->id) }}">
                    <img onerror='iRetry' src="{{ $fln->pic }}" style='width:4.5rem;height:4.5rem;' class='rounded-circle overflow-hidden' alt="" referrerpolicy="no-referrer">
                    <div class='bg-success bg-gradient text-white small w-100 p-1 ps-2 pe-2 mt-2 text-truncate w-100 mt-3'> {{ $fln->name }} </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>