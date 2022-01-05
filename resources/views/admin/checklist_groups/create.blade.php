@extends('layouts.app')

@section('content')
<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('admin.checklist_groups.store') }}" method="POST">
                    @csrf
                <div class="card-header">{{ __('New Checklist Group') }}</div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <label class="form-label" for="name">{{ __('Name') }}</label>
                            <input
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                id="name"
                                name="name"
                                type="text"
                                placeholder="{{ __('Checklist Group Name') }}"
                                value="{{ old('name') }}"
                            >
                            <div class="invalid-feedback">{{ $errors->has('name') ? $errors->first('name') : '' }}</div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
