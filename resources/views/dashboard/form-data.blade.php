<div class="form-group form-group-lg">
    <label class="col-sm-2 control-label" for="formGroupInputLarge">Blog Title</label>
    <div class="col-sm-10">
        <input class="form-control" name="title" type="text" id="formGroupInputLarge" value="{{ old('title', $blog->title) }}" placeholder="Title">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group form-group-lg">
    <label class="col-sm-2 control-label" for="formGroupInputLarge">Description</label>
    <div class="col-sm-10">
        <input class="form-control" name="description" type="text" id="formGroupInputLarge" value="{{ old('description', $blog->description) }}" placeholder="Brief overview...">
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group form-group-lg">
    <label class="col-sm-2 control-label" for="formGroupInputLarge">Blog Content</label>
    <div class="col-sm-10">
        <textarea rows="5" name="content" class="form-control" placeholder="Enter Your Text Here...">{{ old('content', $blog->content) }}</textarea>
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group form-group-lg">
    <label class="col-sm-2 control-label" for="formGroupInputLarge">Reading Duration</label>
    <div class="col-sm-10">
        <input class="form-control" name="reading_duration" type="number" id="formGroupInputLarge" value="{{ old('reading_duration', $blog->reading_duration) }}" placeholder="Minutes to be read...">
        @error('reading_duration')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group form-group-lg">
    <label class="col-sm-2 control-label">Visibility</label>
    <div class="col-sm-2">
        <input type="checkbox" class="js-switch" checked="" style="display: none;" data-switchery="true">
    </div>
</div>

<div class="form-group form-group-lg">
    <label class="col-sm-2 control-label" for="formGroupInputLarge">Blog Poaster</label>
    <div class="col-sm-2">
        <input  onchange="loadImage(event)" style="margin-top: 13px;" type="file" name="poaster" id="image">
        @error('poaster')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-sm-8" style="margin-top: 10px;">
        @if($blog->poaster)
            <img id="image_viewer" width="60%" src="{{ asset($blog->poaster) }}">
        @else
            <img id="image_viewer" width="60%">
        @endif
    </div>
</div>

<div class="save_btn">
    <button onclick="$('#form-data').submit();" id="" class="btn btn-primary">
        Save
    </button>

    <a href="{{ route('dashboard.index') }}" class="btn btn-primary"> Cancel </a>
</div>


@push('style')
<link rel="stylesheet" href="{{ asset('/assets/css/switchery.min.css') }}">
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
    <script src="{{ asset('/assets/js/switchery.min.js') }}"></script>
    
    <script>
        var loadImage = function(event) {
            var image = document.getElementById('image_viewer');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush
