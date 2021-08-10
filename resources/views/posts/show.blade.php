@extends('layouts.app')

@section('title', $post->title)

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        @if ($post->thumbnail)
        <img style="height: 450px; object-fit:cover; object-position:top;" 
        class="rounded w-100" src="{{$post->takeImage}}" alt="">
      @endif
      <h1>{{$post->title}}</h1>
      <div class="text-secondary">
        <a href="/categories/{{$post->category->slug}}">{{ $post->category->name}}</a> 
        &middot; {{ $post->created_at->translatedformat("d F Y")}}
        &middot;
        @foreach ($post->tags as $tag)
        <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a>
        @endforeach
      <div class="media my-3">
          <img width="60" class="rounded-circle mr-3" src="{{ $post->author->gravatar()}}" alt="">
          <div class="media-body">
            <div>
              {{$post->author->name}}
            </div>
            {{ '@'.$post->author->username}}
          </div>
      </div>
      </div>
      
      <p>{!! nl2br($post->body)!!}</p>
  
  @can('delete', $post)
  <div>
    <div class="flex mt-3">
       <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staticBackdrop">
             Delete
        </button>
        <a href="/posts/{{$post->slug}}/edit" class="btn btn-sm btn-success">Edit</a> 
    </div>
     
  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Anda yakin ingin menghapusnya ?</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="mb-2">
              <div>{{$post->title}}</div>
              <div class="text-secondary">
                <small>Published: {{$post->created_at->translatedformat('d F Y')}}</small>
              </div>
          </div>
          <form action="/posts/{{$post->slug}}/delete" method="post">
          
            @csrf
            @method("delete")
            <div class="col-4">
              <button class="btn btn-danger " type="submit">Ya</button>
              <button type="button" class="btn btn-success" data-dismiss="modal">Tidak</button>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  @endcan
      </div>
      <div class="col-md-4">
        @foreach ($posts as $post)
            <div>
              <div class="card mb-4">
                
                <div class="card-body">
                    <div>
                        <a href="{{route('categories.show', $post->category->slug)}}" class="text-secondary">
                            <small>{{$post->category->name}} - </small>
                        </a>
                        @foreach ($post->tags as $tag)
                            <a href="{{route('tags.show', $tag->slug)}}" class="text-secondary">
                                <small>{{$tag->name}}</small>
                            </a>
                        @endforeach
                    </div>
                    <h5>
                        <a class="text-dark" href="{{route('posts.show', $post->slug)}}" class="card-title">
                            {{ $post -> title}}
                        </a>
                    </h5>
                    <div class="text-secondary my-3">
                        {{ Str::limit($post->body,130,'.') }}
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div class="media align-items-center">
                            <img width="40" class="rounded-circle mr-3" src="{{ $post->author->gravatar()}}" alt="">
                            <div class="media-body">
                              <div>
                                {{$post->author->name}}
                              </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                    
            </div>
            </div>
        @endforeach
      </div>
    </div>

</div> 

  </div>
  <div>
@endsection

    
