@extends('layout.main')

@section('title', 'App | Blog')
    
@section('content')

    <h1 class="mb-3 text-center">{{ $title }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="\post">

                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                @if(request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-danger" type="submit" id="button-addon2">Search</button>
                  </div>
            </form>
        </div>
    </div>

    @if ($posts->count())

        <div class="card mb-3 text-center">
            @if ($posts[0]->image)
           
            <div style="max-height:400px; overflow:hidden;">
            <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="post-image" class="img-fluid">
            </div>

           @else
           <img src="https://source.unsplash.com/1200x400/?{{ $posts[0]->category->name }}" class="card-img-top" alt="post-image">
           @endif
                <div class="card-body">
                <h3 class="card-title"><a href="/post/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>
                <small class="text-muted">
                <p>By.<a href="/post?author={{ $posts[0]->Author->username }}" class="text-decoration-none "> {{ $posts[0]->Author->name }}</a> in <a href="/post?category={{ $posts[0]->category->slug }}" class="text-decoration-none"> {{ $posts[0]->category->name }} </a>
                {{ $posts[0]->created_at->diffForHumans() }}</p>
                </small>
                <p class="card-text">{{ $posts[0]->excerpt }}</p>
                <a href="/post/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Read more</a>
            </div>
        </div>
   


    <div class="container">
        <div class="row">

            @foreach($posts->skip(1) as $post)

            <div class="col-md-4 mb-3">
                <div class="card" style="width: 18rem;">
                    <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba(0, 0, 0, 0.8)">
                        <a href="/post?category={{ $post->category->slug }}" class="text-white text-decoration-none">{{ $post->category->name }}</a>
                    </div>
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="post-image" class="img-fluid">
                    @else

                        <img src="https://source.unsplash.com/500x500/?{{ $post->category->name}}" class="card-img-top" alt="post-image">

                    @endif
           
                    <div class="card-body">
                      <h5 class="card-title">{{ $post->title }}</h5>
                        <small class="text-muted">
                        <p>By.<a href="/post?author={{ $post->Author->username }}" class="text-decoration-none "> {{ $post->Author->name }}</a> 
                        {{ $post->created_at->diffForHumans() }}</p>
                        </small>
                      <p class="card-text">{{ $post->excerpt }}</p>
                      <a href="/post/{{ $post->slug }}" class="btn btn-primary">Read more</a>
                    </div>
                  </div>
            </div>


            @endforeach

        </div>
    </div>
    
     @else
        <p class="text-center fs-4">No post found.</p>
    @endif


    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
    

@endsection
        
    