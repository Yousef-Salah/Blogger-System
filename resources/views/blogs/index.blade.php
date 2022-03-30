@extends('layouts.main-page')

@section('content')


<div class="text-capitalize text-center">
    <h2>{{ $title }}</h2>
</div>


<!-- blog-contents -->

    @foreach($blogs as $blog)
    <article class="blog-item">
        <div class="row">
            <div class="col-md-3">
                <a onclick="event.preventDefault();">
                    <img src="{{ $blog->image }}" class="img-thumbnail center-block" alt="Blog Post Thumbnail">
                </a>
            </div>
            <div class="col-md-9">
                <p>
                    @if($blog->tags)
                    @foreach($blog->tags as $tag)
                    <a href="#">{{ $tag }}</a> ,
                    @endforeach
                    @endif
                    {{ $blog->created_at }}
                </p>
                <h1>
                    <a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
                </h1>
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset($blog->author->image) }}"width="30px" alt="user">
                        
                        <a href="#">{{ $blog->author->name }}</a>
                    </div>

                    <div style="margin-top: 20px;" class="col-md-8">
                        <i class="fa-regular fa-thumbs-up fa-xl col-md-3">
                            {{ $blog->total_likes }}
                        </i>

                        <i class="fa-regular fa-thumbs-down fa-xl col-md-3">
                            {{ $blog->total_dislikes }}
                        </i>

                        <i class="fa-regular fa-comment fa-xl col-md-3">
                            {{ $blog->total_comments }}
                        </i>
                    </div>

                </div>
            </div>
        </div>
    </article>
    @endforeach
    <!-- /.blog-item -->

    {{ $blogs->links() }}
@endsection

@push('script')
    <script src="https://kit.fontawesome.com/aca1f5583c.js" crossorigin="anonymous"></script>
@endpush