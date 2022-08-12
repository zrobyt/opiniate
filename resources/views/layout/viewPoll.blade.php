@php 
use Coduo\PHPHumanizer\NumberHumanizer;
use App\Models\Gusers;
use App\Models\Polls;
use App\Http\Controllers\getData;
use App\Helpers\Math;

use WebThumbnailer\WebThumbnailer;

$tv = (new App\Http\Controllers\Votes($poll))->totalVotes;
@endphp

<div class='p-3 ps-lg-5'>

    @if(isset($poll))
    <div class='fs-4 text-success'>{{$poll->title}}</div>
    @csrf

    <div class='w-100 mt-3 small'>
        <div id='share' class='bg-white border p-1 ps-3 pe-3 rounded-pill float-end' style='display:none;'>Share</div>
        <div>
            Created <span class='text-muted'>{{ $poll->created_at->diffForHumans() }}</span>
            @php echo str_repeat('&nbsp;',15); @endphp
            Views : <span class='text-muted'>{{ Math::readable($poll->views) }}</span>
        </div>

        <div>Status : <span class='text-{{ ($poll->status=="open")? "success":"danger" }}'>{{ ucfirst($poll->status) }}</span>
        @php echo str_repeat('&nbsp;',15); @endphp
        <span class=''>Lang : <a class='text-success' href='/lang/{{$poll->language}}'>{{ ucfirst($poll->language) }}</a></span>
        </div>

        <div class='w-100'>
            Votes cast till now :
            <span class='text-muted'>
                {{ Math::readable($tv) }}
            </span>
        </div>

        <div class='w-100'>
            <span class=''>Category :</span>
            <span class='text-muted'>
                @foreach([$poll->category,$poll->subcate] as $cate)
                    <div class='d-inline-block small ps-2 pe-2 rounded-pill'>
                        <a href='/category/{{ $cate }}' target="">{{ $cate }}</a>
                    </div>
                @endforeach
            </span>
        </div>

    </div>
    
    {{ getData::viewOpt($poll->id) }}

    @php $loca = json_decode($poll->loca); $subloca = json_decode($poll->subloca);@endphp
    <div class='overflow-hidden bg-light bg-gradient p-2 ps-0 text-nowrap mt-3'>
        <div class='w-100 fs-6 text-muted'>
            <span class='text-dark fw-bold'>Location :</span>
            <span class='small'>
                @foreach([$subloca[1],$subloca[0],$loca[1],$loca[0]] as $k=>$v)
                <a href='/place/{{ $v }}' target="">
                    {{ $v }}
                </a>{{ ($k<3)?", ":"" }}
                @endforeach
            </span>
        </div>
    </div>

    @if(isset($poll->link))
    <div class='col-12 col-lg-8 rounded text-muted bg-white shadow rounded p-3 mb-3'>
        <a href='{{$poll->link}}' target="">
            <img onerror='iRetry()' class='d-inline-block align-top pollThumb h-100 me-2 rounded-circle overflow-hidden  align-middle' src="/{{ (new WebThumbnailer())->maxHeight(280)->maxWidth(240)->crop(true)->thumbnail($poll->link) }}" alt="" referrerpolicy="no-referrer" style='width:4.25rem;height:4.25rem !important;object-fit:cover;' />
            <div class='d-inline-block small align-middle w-75'>{{ $poll->preface }}</div>
        </a>
    </div>

    <div class='w-100 fs-6 text-muted'>
        <span class='text-dark fw-bold'>Url :</span>
        <a href='{{$poll->link}}' class='small' target="">
            {{$poll->link}}
        </a>
    </div>
    @else
    <div class='mt-3'></div>
    @endif

    <div class='overflow-hidden bg-light bg-gradient p-2 ps-0 text-nowrap'>
        <div class='overflow-auto'>
            <span class='fw-bold'>Tags :</span>
            <span class='small'>
                @foreach(json_decode($poll->tags) as $tag)
                <div class='d-inline-block small ps-2 pe-2 rounded-pill'>
                    <a href='/tag/{{ $tag }}' target="">{{ $tag }}</a>
                </div>
                @endforeach
            </span>
        </div>
    </div>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7783879415436265"
     crossorigin="anonymous"></script>
    <ins class="adsbygoogle"
        style="display:block; text-align:center;"
        data-ad-layout="in-article"
        data-ad-format="fluid"
        data-ad-client="ca-pub-7783879415436265"
        data-ad-slot="5338358831"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

    <div>
        <hr>
        <div class='fw-bold mt-4 mb-3 '>Opinions : </div>
        {{ getData::viewCom($poll->id) }}
    </div>

    @else
    {{ "Poll does not exist" }}
    @endif
</div>
@if (session()->has('failure'))
 <script>alert("{{ session()->get('failure') }}");</script>
@endif