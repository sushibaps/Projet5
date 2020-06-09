@extends('layouts.menu')

@section('title')
    {{$prestation->title}}
@endsection

@section('content')
    <div class="container-fluid d-flex flex-column mt-5">
        <div class="container d-flex flex-column align-items-center mt-5">
            <h2 class="mb-5 border-bottom border-dark pb-2">{{$prestation->title}}</h2>
            <figure>
                <img src="/photo/medium/{{$prestation->main_id}}" alt="{!! $prestation->content !!}"
                     class="accueilfigure">
            </figure>
            <div class="container-fluid d-flex flex-column align-items-center">
                <p>{!! $prestation->content !!}</p>
                <p class="align-self-end">Tarif horaire : {{$prestation->price}} euros</p>
            </div>
        </div>

        <div class="container d-flex flex-column flex-wrap max-height-80">
            <h2 class="mb-5 pb-2">Quelques travaux du photographe :</h2>
            @if($count > 4 )
                <div class="container-fluid mt-5 d-flex justify-content-around">
                    @for($i = 0; $i < 4; $i++)
                        <div class="col-3">
                            @if($i > 0)
                                @php
                                    $newdiv = $count / 4;
                                    $k = ($i + 1)/4;
                                    $m = $k * $count;
                                    $p = floor($m);
                                @endphp
                                @for($j = floor($newdiv * $i); $j < $p ; $j++)
                                    <figure class="mb-3 homediv">
                                        <img src="/illustration/{{$prestation->illustrations[$j]->id}}" alt="{{$prestation->content}}">
                                    </figure>
                                @endfor
                            @else
                                @for($j = 0; $j < (intdiv($count, 4)); $j++)
                                    <figure class="mb-3 homediv">
                                        <img src="/illustration/{{$prestation->illustrations[$j]->id}}" alt="{{$prestation->content}}">
                                    </figure>
                                @endfor
                            @endif
                        </div>
                    @endfor
                </div>
            @else
                <div class="container-fluid mt-5 d-flex flex-column justify-content-around">
                    @foreach($prestation->illustrations as $illustration)
                        <figure class="homediv">
                                <img src="/illustration/{{$illustration->id}}" alt="{{$prestation->content}}">
                        </figure>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
