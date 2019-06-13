@extends('layout/master')

@section('maincontent')
<section id="slider" class="mt-4">
    <!-- 슬라이더 섹션 -->
    <div class="container">
        <div class="slider">
            <div class="btn-div">
                <button class="btn btn-outline-light">&lt;</button>
                <button class="btn btn-outline-light">&gt;</button>
            </div>
            @foreach($list_slide as $item_slide)
            <div class="slide-image">
                <div class="slide-img">
                    {!! $item_slide->thumbnail !!}
                </div>
                <div class="filter"></div>
                <div class="slide-content">
                    <h1>{{$item_slide->title}}</h1>
                    <p>{{$item_slide->content}}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="indicator">
            <ul>
                <li class="active"></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
</section>

<div class="container mt-5">
    <section id="editorPick">
        @foreach($list as $item)
        <div class="card" style="width: 18rem;">
            {!! $item->thumbnail !!}
            <div class="card-body">
                <h3><a href="/view?id={{ $item->id}}" style="color: #333;">{{$item->title}}</a></h3>
                <p class="card-text">{{$item->content}}</p>
                <span class="badge badge-primary">{{ date("Y년 m월 d일", strtotime($item->wdate))}}</span>
                @if(isset($_SESSION['user']))
                <div class="float-right">
                    <a href="/update?id={{ $item->id }}" class="btn btn-info">수정</a>
                    <a href="/delete?id={{ $item->id }}" class="btn btn-danger">삭제</a>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </section>
    <ul class="pagination justify-content-center">
    @if($p->prev)
            <li class="page-item disabled"><a class="page-link" href="/?p={{$p->start - 1}}" tabindex="-1">Previous</a></li>
            @endif
            @for($i = $p->start; $i <= $p->end; $i++)
                @if($i == $p->current)
                <li class="page-item"><a class="page-link" href="/?p={{$i}}">{{ $i }}</a></li>
                @else
                <li><a class="page-link" href="/?p={{$i}}">{{ $i }}</a></li>
                @endif
                @endfor
                @if($p->next)
                <li class="page-item"><a class="page-link" href="/?p={{$p->end + 1}}">Next</a></li>
                @endif

    </ul>
</div>
@endsection