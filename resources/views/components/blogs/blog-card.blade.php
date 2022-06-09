@props([
  'blogs' => [],


  
])


<article class="blog-item">
  <div class="row">
    <div class="col-md-3">
      <a onclick="event.preventDefault();">
        <img src="{{ $blog->image }}" class="img-thumbnail center-block" alt="Blog Post Thumbnail">
      </a>
    </div>
    <div class="col-md-9">
      <p>
        @if($blogs)
        @foreach($tags as $tag)
        <a href="#">{{ $tag }}</a> ,
        @endforeach
        @endif
        {{ $blog->created_at }}
      </p>
      <h1>
        <a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
      </h1>
      <div class="row">
        <div class="col-md-4 writer-figure">
          <img src="{{ asset($blog->author->image) }}" alt="user">

          <a href="#">{{ $blog->author->name }}</a>
        </div>

        <div class="col-md-8 thumbnails-icons">
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