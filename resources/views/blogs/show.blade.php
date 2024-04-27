@extends('layouts.main-page')

@section('content')

<section class="blog-post section-header-offset">
    <div class="blog-post-container container">
        <div class="blog-post-data">
            <h3 class="title blog-post-title">{{ $blog->title }}</h3>
            <div class="article-data">
                <span>{{ Carbon\Carbon::parse($blog->publish_at)->format('M jS Y') }}</span>
                <span class="article-data-spacer"></span>
                <span>{{ $blog->reading_duration }} Min read</span>
            </div>
            <img src="{{ asset($blog->poaster) }}" alt="{{ $blog->title }} Poaster">
        </div>

        <div class="container">
            {!! $blog->content !!}
        </div>
    </div>
</section>
@endsection

@push('style')
    <style>
        table, th, td {
            border: 1px solid #AFB6CD;
            border-collapse: collapse;
            padding: 5px;
        }

        /* thead th, thead td, tbody th, tbody td {
            border: 1px solid #AFB6CD !important;
            border-width: 3px
        }
        /* td {
            border-width: 3px;
        }
        thead td, thead th {
            border-width: 3px;
        } */ */
    </style>
@endpush

@push('script')
    <script src="https://kit.fontawesome.com/aca1f5583c.js" crossorigin="anonymous"></script>
@endpush
