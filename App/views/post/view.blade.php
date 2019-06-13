@extends('layout/master')

@section('maincontent')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    {{$data->title}} 
                    <span class="badge badge-light">
                        {{ $data->writer }}
                    </span>
                    <span class="badge badge-primary">
                        {{ $data->wdate }}
                    </span>
                </div>
                <div class="card-body">
                    {!! $data->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection