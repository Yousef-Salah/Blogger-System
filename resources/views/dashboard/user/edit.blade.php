@extends('layouts.dashboard')

@section('content')

<form action="{{ route('user.information.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group form-group-lg">
        <label class="col-sm-2 control-label" for="formGroupInputLarge">User Name</label>
        <div class="col-sm-10">
            <input class="form-control" name="name" type="text" id="formGroupInputLarge" value="{{ old('name', $user->name) }}" placeholder="Enter Your Name...">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group form-group-lg">
        <label class="col-sm-2 control-label" for="formGroupInputLarge">info</label>
        <div class="col-sm-10">
            <textarea rows="5" name="info" class="form-control" placeholder="Enter Your Info Here...">{{ old('info', $user->info) }}</textarea>
            @error('info')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group form-group-lg">
        <label class="col-sm-2 control-label" for="formGroupInputLarge">User Image</label>
        <div class="col-sm-2">
            <input  onchange="loadImage(event)" style="margin-top: 13px;" type="file" name="image" id="image">
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-sm-8" style="margin-top: 10px;">
            @if($user->image)
                <img id="image_viewer" width="60%" src="{{ asset($user->image) }}">
            @else
                <img id="image_viewer" width="60%" src="{{ asset('/images/user.png') }}">
            @endif
        </div>
    </div>


    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <button onclick=""  class="btn btn-primary">
                Save
            </button>

            <a href="{{ route('user.information.index') }}"  class="btn btn-primary">
                Cancel
            </a>
        </div>
        
        <div class="col-md-3"></div>
    </div>

</form>
@endsection

@push('style')
<style>
    #save_btn {
        position: fixed;
        bottom: 30px;
        left: 50%;
        right:50%;
    }
</style>
@endpush

@push('script')
    <script>
        var loadImage = function(event) {
            var image = document.getElementById('image_viewer');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush
