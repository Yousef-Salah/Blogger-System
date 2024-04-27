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
        <textarea id="editor" rows="5" name="content" class="form-control" placeholder="Enter Your Text Here...">{{ old('content', $blog->content) }}</textarea>
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

@push('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

    <script>

        class MyUploadAdapter {
            constructor( loader ) {
                // The file loader instance to use during the upload. It sounds scary but do not
                // worry — the loader will be passed into the adapter later on in this guide.
                this.loader = loader;
            }

            // Starts the upload process.
            upload() {
                return this.loader.file
                    .then( file => new Promise( ( resolve, reject ) => {
                        this._initRequest();
                        this._initListeners( resolve, reject, file );
                        this._sendRequest( file );
                    } ) );
            }

            // Aborts the upload process.
            abort() {
                if ( this.xhr ) {
                    this.xhr.abort();
                }
            }

            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();

                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
                xhr.open( 'POST', "{{ route('dashboard.upload-blog-image') }}", true );
                xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
                xhr.responseType = 'json';
            }

            // Initializes XMLHttpRequest listeners.
            _initListeners( resolve, reject, file ) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener( 'error', () => reject( genericErrorText ) );
                xhr.addEventListener( 'abort', () => reject() );
                xhr.addEventListener( 'load', () => {
                    const response = xhr.response;

                    // This example assumes the XHR server's "response" object will come with
                    // an "error" which has its own "message" that can be passed to reject()
                    // in the upload promise.
                    //
                    // Your integration may handle upload errors in a different way so make sure
                    // it is done properly. The reject() function must be called when the upload fails.
                    if ( !response || response.error ) {
                        return reject( response && response.error ? response.error.message : genericErrorText );
                    }

                    // If the upload is successful, resolve the upload promise with an object containing
                    // at least the "default" URL, pointing to the image on the server.
                    // This URL will be used to display the image in the content. Learn more in the
                    // UploadAdapter#upload documentation.
                    resolve( {
                        default: response.url
                    } );
                } );

                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if ( xhr.upload ) {
                    xhr.upload.addEventListener( 'progress', evt => {
                        if ( evt.lengthComputable ) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    } );
                }
            }

            // Prepares the data and sends the request.
            _sendRequest( file ) {
                // Prepare the form data.
                const data = new FormData();

                data.append( 'image', file );

                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.

                // Send the request.
                this.xhr.send( data );
            }

            // ...
        }
        function MyCustomUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                // Configure the URL to the upload script in your backend here!
                return new MyUploadAdapter( loader );
            };
        }


        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                extraPlugins: [ MyCustomUploadAdapterPlugin ],
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
