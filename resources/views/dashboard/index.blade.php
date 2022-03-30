@extends('layouts.dashboard')

@section('content')

<!-- top tiles -->
<div class="row tile_count">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Blogs</span>
        <div class="count">{{ $blogs->count() }}</div>
        <span class="count_bottom"><i class="green">4% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-clock-o"></i> Total Likes</span>
        <div class="count">{{ $blogs->sum('total_likes'); }}</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last
            Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Dislikes</span>
        <div class="count green">{{ $blogs->sum('total_dislikes') }}</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last
            Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Comments</span>
        <div class="count">{{ $blogs->sum('total_comments') }}</div>
        <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last
            Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
        <div class="count">2,315</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last
            Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
        <div class="count">7,325</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last
            Week</span>
    </div>
</div>
<!-- /top tiles -->

<div>
    <table class="table table-responsive table-striped">
        <thead>
            <th>#</th>
            <th>Blog Title</th>
            <th>Blog Text</th>
            <th>Blog Tags</th>
            <th>Likes</th>
            <th>DisLikes</th>
            <th>Comments</th>
            <th>Actions</th>
        </thead>
        
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->summary }}</td>
                <td>soon B Tags</td>
                <td>{{ $blog->total_likes }}</td>
                <td>{{ $blog->total_dislikes }}</td>
                <td>{{ $blog->total_comments }}</td>
                <td>
                    <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info btn-sm" data-toggle="toolitp" data-placement="top" title="Show"><i class="fas fa-eye"></i></a>
                    <a onclick="event.preventDefault(); $('#delete').submit();" class="btn btn-danger btn-sm" data-toggle="toolitp" data-placement="top" title="Delete"><i class="fa-solid fa-trash"></i></a>
                    <a href="#" class="btn btn-info btn-sm" data-toggle="toolitp" data-placement="top" title="Statistics"><i class="fa-solid fa-chart-line"></i></a>
                    <a href="{{ route('dashboard.edit', $blog->id) }}" class="btn btn-info btn-sm" data-toggle="toolitp" data-placement="top" title="Edit"><i class="fa-solid fa-pen"></i></a>
                </td>

                <form id="delete" hidden action="{{ route('dashboard.destroy', $blog->id) }}" method="post">
                    @csrf
                    @method('delete')
                </form>
            </tr>
            @endforeach
            </tbody>
    </table>
</div>
@endsection




     