@extends('layouts.dashboard')

@section('content')
<form id="form-data" class="form-horizontal" action="{{ route('dashboard.store') }}" method="post" enctype="multipart/form-data">

    @csrf
    
    @include('dashboard.form-data')
    
</form>


@endsection

@push('script')
    <script>
        var loadImage = function(event) {
            var image = document.getElementById('image_viewer');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush
