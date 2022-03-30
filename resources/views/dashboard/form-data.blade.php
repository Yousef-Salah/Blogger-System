<div class="form-group form-group-lg">
    <label class="col-sm-2 control-label" for="formGroupInputLarge">Blog Title</label>
    <div class="col-sm-10">
        <input class="form-control" name="title" type="text" id="formGroupInputLarge" value="{{ old('title', $blog->title) }}" placeholder="Large input">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group form-group-lg">
    <label class="col-sm-2 control-label" for="formGroupInputLarge">Blog Text</label>
    <div class="col-sm-10">
        <textarea rows="5" name="text" class="form-control" placeholder="Enter Your Text Here...">{{ old('text', $blog->text) }}</textarea>
        @error('text')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group form-group-lg">
    <label class="col-sm-2 control-label" for="formGroupInputLarge">Blog Image</label>
    <div class="col-sm-2">
        <input  onchange="loadImage(event)" style="margin-top: 13px;" type="file" name="image" id="image">
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-sm-8" style="margin-top: 10px;">
        @if($blog->image)
            <img id="image_viewer" width="60%" src="{{ asset($blog->image) }}">
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
