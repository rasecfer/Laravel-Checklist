@extends('layouts.app')

@section('content')
<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('admin.checklist_groups.update', $checklistGroup) }}" method="POST">
                    @csrf
                    @method('PUT')
                <div class="card-header">{{ __('Edit Checklist Group') }}</div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <label class="form-label" for="name">{{ __('Name') }}</label>
                            <input
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                id="name"
                                name="name"
                                type="text"
                                value="{{ $checklistGroup->name }}"
                            >
                            <div class="invalid-feedback">{{ $errors->has('name') ? $errors->first('name') : '' }}</div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                </div>
                </form>
                <form action="{{ route('admin.checklist_groups.destroy', $checklistGroup->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mx-3 mb-2 mt-2" type="submit" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
