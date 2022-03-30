@extends('layouts.main-page')

@section('content')

<article class="single-blog-item">

    <div class="alert alert-info">
        <a href="#">home</a>,
        <a href="#">css3</a>,
        <a href="#">jquery</a>,
        <a href="#">tutorials</a>
        updated
        <time>july 30,2015</time>
    </div>

    <h1>{{ $blog->title }}</h1>
    
    <div class="advertisement">
        <img class="img-responsive" src="{{ asset($blog->image) }}" alt="Template Store">
        <div class="overlay"></div>
    </div>
    
    <div class="row">
        <p>
            {{ $blog->text }}
        </p>
    </div>
    
    <div style="margin: 20px;" class="row">
        @auth
            <a onclick="event.preventDefault(); $('#like_status').val('like'); $('#interaction').submit();">    
                <i class="@if($status == 'like') fa-solid @else fa-regular @endif fa-thumbs-up fa-xl col-md-4">
                    {{ $blog->total_likes }}
                </i>
            </a>
             
            <a onclick="event.preventDefault(); $('#like_status').val('dislike');  $('#interaction').submit();">
                <i class="@if($status == 'dislike') fa-solid @else fa-regular @endif fa-thumbs-down fa-xl col-md-4">
                    {{ $blog->total_dislikes }}
                </i>
            </a>

            <form hidden action="{{ route('blogs.interaction', $blog->id) }}" method="post" id="interaction">
                @csrf
                <input type="hidden" id="like_status" name="interaction" value="">
            </form>
        @else
            <a href="{{ route('login') }}">
                <i class="fa-regular fa-thumbs-up fa-xl col-md-4">
                    {{ $blog->total_likes }}
                </i>
            </a>

            <a onclick="{{ route('login') }}">
                <i class="fa-regular fa-thumbs-down fa-xl col-md-4">
                    {{ $blog->total_dislikes }}
                </i>
            </a>
        @endauth

        <a href="#feedback">
            <i class="fa-regular fa-comment fa-xl col-md-4">
                {{ $blog->total_comments }}
            </i>
        </a>
    </div>

</article>

<h4>Related Articles</h4>
<div class="related-articles">
    <div class="alert alert-info">
        <a href="http://themewagon.com">Free HTML5 Website Templates </a>
    </div>
</div>

<div class="author">
    <p>Written by <strong class="text-capitalize">{{ $blog->author->name }}</strong></p>
    <p>
        {{$blog->author->info}}
    </p>
</div>

<div id="feedback" class="feedback">
    <div class="row">
        <div class="col-md-12">
            <h1>feedback</h1>
            @foreach($blog->comments as $comment)
            <div class="cmnt-clipboard"><span class="btn-clipboard">Reply</span></div>
            <div class="well">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset($comment->writer->image) }}" class="img-responsive center-block">
                    </div>
                    <div class="col-md-10">
                        <p class="comment-info">
                            <strong>{{ $comment->writer->name }}</strong> <span>22 april 2015</span>
                        </p>
                        <p>
                            {{ $comment->comment }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="comment-post">
    <h1>post a comment</h1>
    @auth
    <form method="post" action="{{ route('blogs.comment', $blog->id) }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <textarea name="comment" type="text" class="form-control" id="comment" rows="5" required="required"
                    placeholder="Type here your comment"></textarea>
                @error('comment')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <button type="submit" id="submit" name="submit" class="btn btn-cmnt">post comment</button>
            </div>
        </div>
    </form>
    @else
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4 ">
            <h2><a class="btn btn-cmnt" href="{{ route('login') }}"> Log In To Post A comment</a></h2>
        </div>
    </div>
    @endauth
</div>

@endsection

@push('script')
    <script src="https://kit.fontawesome.com/aca1f5583c.js" crossorigin="anonymous"></script>
@endpus