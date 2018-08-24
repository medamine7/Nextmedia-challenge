@extends('layouts.app')

@section('content')
<div class="container cards-container">
    @foreach ($shops as $shop)
    <div class="card animated fadeInUp">
        <div class="card-header">
            {{$shop->name}}
        </div>
        <div class="card-image">
            <img src="{{$shop->picture}}" alt="">
        </div>
        <div class="card-footer">
            <button @click="removeShop('{{$shop->_id}}')"><i class="far fa-thumbs-down"></i> REMOVE</button>
        </div>
    </div>
   @endforeach
</div>
@endsection
