@php
use Coduo\PHPHumanizer\NumberHumanizer;
use WebThumbnailer\WebThumbnailer;
use App\Helpers\Math;
@endphp
<ul class='list-unstyled d-flex justify-content-start flex-wrap'>
    @foreach($polls as $poll)
    <li class='d-inline-block col-lg-4 col-sm-12 col-12 p-1 pb-3 p-lg-2'>
        <a href='/polls/poll-{{ preg_replace("/=+/","",base64_encode($poll->id)) }}' target="" class='w-100 '>
            <div class='w-100 bg-white overflow-hidden rounded shadow relative'>

                @if( session()->get('email')!==null )
                    <div class="position-absolute rounded-circle {{ ($poll->votes->where('uid',session()->get('id'))->first() !== null)?'':' border border-success' }} " style='height:0.65rem;width:0.65rem;top:0.5rem;right:0.5rem;'>
                    </div>
                @endif

                <div class=''>
                    <div class='d-inline-block align-middle overflow-hidden' style='object-fit:cover;width:22%;height:6.5em;'>
                        <img class='pollThumb h-100 p-3 rounded-circle align-middle' src="/{{ (new WebThumbnailer())->maxHeight(280)->maxWidth(240)->crop(true)->thumbnail($poll->link) }}" alt="" style='width:6.25rem;height:6.25rem !important;object-fit:cover;' />
                    </div>
                    <div class='d-inline-block pr-3 p-2 align-middle' style='width:68%;height:6em;'>
                        <div class='w-100 mb-2 text-truncate overflow-hidden text-wrap {{ ($poll->votes->where('uid',session()->get('id'))->first() !== null)?' text-muted':'' }}' style='height:64.5%;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;'>{{ $poll->title }}</div>

                        <div class='w-100 text-muted small'>
                            <div class='d-inline-block'>
                                Total votes :
                                <span class='text-success'>
                                    @php
                                    echo Math::readable((new \App\Http\Controllers\Votes($poll))->totalVotes);
                                    @endphp
                                </span>
                            </div>
                            <div class='d-inline-block float-end me-1'>
                                Views : <span class='text-success'> {{ Math::readable($poll->views) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='w-100 overflow-hidden bg-light bg-gradient border-top p-2 text-nowrap'>
                    <div class='overflow-auto'>
                        @foreach(json_decode($poll->tags) as $tag)
                        <div class='d-inline-block small ps-2 pe-2 rounded-pill text-muted'>
                            <a href='/tag/{{ $tag }}' target="">{{ $tag }}</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </a>
    </li>
    @endforeach
</ul>