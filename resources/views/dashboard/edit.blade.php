@extends('layouts.dashboard')




@section('content')

    <form id="form-data" action="{{ route('dashboard.update', $blog->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.form-data',['blog' => $blog])
    </form>


@endsection

