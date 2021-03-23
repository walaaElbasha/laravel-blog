@extends('layouts.app')

@section('title')Index Page @endsection

@section('content')
<a href="{{route('posts.create')}}" class="btn btn-success" style="margin-bottom: 20px;">Create Post</a>


<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Posted By</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>
        <th scope="col">Slug </th>
      </tr> 
    </thead>
    <tbody>
    @foreach($posts as $post)
    <tr>
        <th scope="row">{{ $post->id }}</th>
        <td>{{ $post->title }}</td>
        <td>{{ $post->user ? $post->user->name : 'user not found' }}</td>
        <td>{{ \Carbon\Carbon::parse( $post->created_at,'d/m/Y H:i:s')->isoFormat('Y-m-d') }}</td>
        
        <td>
          <a href="{{ route('posts.show',['post' => $post['id']]) }}" class="btn btn-info" style="margin-bottom: 20px;">View</a>
          <a href="{{ route('posts.edit',['post' => $post['id']]) }}" class="btn btn-secondary" style="margin-bottom: 20px;">Edit</a>
          
          <form style="display:inline" method="POST" action="{{route('posts.destroy',['post' => $post['id']])}}">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Are you sure?')"  class="btn btn-danger" type="submit"style="margin-bottom: 20px;">Delete</button>
      <td> {{$post->slug}} </td>
 </form>
        </td>
      </tr>
    @endforeach
    </tbody>
</table>

<div class="text-center">
    {{$posts->links("pagination::bootstrap-4")}}

</div>


@endsection