@extends('layouts.dashboard')

@section('content')

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
                <td>{{ $blog->total_commetns }}</td>
                <td>
                    <a onclick="event.preventDefault(); $('#restore').submit();" class="btn btn-success btn-sm" data-toggle="toolitp" data-placement="top" title="Restore"><i class="fa-solid fa-trash-arrow-up"></i></a>
                    <a href="#" class="btn btn-info btn-sm" data-toggle="toolitp" data-placement="top" title="Show"><i class="fa-solid fa-circle-info"></i></a>
                    <a onclick="event.preventDefault(); $('#delete').submit();" class="btn btn-danger btn-sm" data-toggle="toolitp" data-placement="top" title="Delete"><i class="fa-solid fa-trash"></i></a>
                </td>

                <form id="delete" hidden action="{{ route('dashboard.destroy', $blog->id) }}" method="post">
                    @csrf
                    @method('delete')
                </form>

                <form id="restore" hidden action="{{ route('dashboard.restore', $blog->id) }}" method="post">
                    @csrf
                    @method('put')
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection