@extends('layouts.app')

@section('content')
<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-4">
                <form action="{{ route('admin.pages.update', [$page]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-header">{{ __('Edit Page') }}</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-sm-12">
                                @if(session('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="form-label" for="name">{{ __('Title') }}</label>
                                    <input
                                        class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                        id="title"
                                        name="title"
                                        type="text"
                                        value="{{ $page->title }}"
                                    >
                                    <div class="invalid-feedback">{{ $errors->has('title') ? $errors->first('title') : '' }}</div>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label" for="content">{{ __('Content') }}</label>
                                    <textarea
                                        class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
                                        id="page-textarea"
                                        name="content"
                                        rows="4"
                                    >{{ $page->content }}</textarea>
                                    <div class="invalid-feedback">{{ $errors->has('content') ? $errors->first('content') : '' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">{{ __('Save Page') }}</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create( document.querySelector( '#page-textarea' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
