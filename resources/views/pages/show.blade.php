@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            @include ('partials/_pages_menu')
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    {{ $page->title }}
                </div>
                <div class="card-body">  
                    <p>{!! $page->body !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
