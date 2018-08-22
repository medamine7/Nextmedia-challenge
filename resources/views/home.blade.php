@extends('layouts.app')

@section('content')
<div class="container cards-container">
    @foreach ($shops as $shop)
    <div class="card">
        <div class="card-header">
            {{$shop->name}}
        </div>
        <div class="card-image">
            <img src="{{$shop->picture}}" alt="">
        </div>
        <div class="card-footer">
            <button><i class="far fa-thumbs-down"></i> DISLIKE</button>
            <button><i class="far fa-thumbs-up"></i> LIKE</button>
        </div>
    </div>
   @endforeach
</div>
@endsection
