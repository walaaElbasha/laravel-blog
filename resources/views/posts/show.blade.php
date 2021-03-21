@extends('layouts.app')

@section('title')Show Page @endsection

@section('content')
<div class="card">
    <div class="card-header">
      Post Info
    </div>
    <div class="card-body">
      <h5 class="card-title">Title:</h5>
      <p class="card-text">{{ $post->title }}</p>
      <h5 class="card-title">Description:</h5>
      <p class="card-text">{{ $post->description }}</p>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
      Post Creator info
    </div>
    <div class="card-body">
      <h5 class="card-title">Name:</h5>
      <p class="card-text">{{ $post->user ? $post->user->name : 'user not found' }}</p>
      <h5 class="card-title">Email:</h5>
      <p class="card-text">{{ $post->user ? $post->user->email : 'email not found' }}</p>
      <h5 class="card-title">Created At:</h5>
      <p class="card-text">{{ \Carbon\Carbon::parse( $post->created_at ,'d/m/Y H:i:s')->isoFormat('ddd Do \of MMMM YYYY, h:mm:ss a') }}</p>

    </div>
</div>

@endsection