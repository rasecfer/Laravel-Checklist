@extends('layouts.app')

@section('content')
<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('admin.checklist_groups.checklists.update', [$checklistGroup, $checklist]) }}" method="POST">
                    @csrf
                    @method('PUT')
                <div class="card-header">{{ __('Edit Checklist in ') }} {{ $checklistGroup->name }}</div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <label class="form-label" for="name">{{ __('Name') }}</label>
                            <input
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                id="name"
                                name="name"
                                type="text"
                                placeholder="{{ __('Checklist Name') }}"
                                value="{{ $checklist->name }}"
                            >
                            <div class="invalid-feedback">{{ $errors->has('name') ? $errors->first('name') : '' }}</div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">{{ __('Save Checklist') }}</button>
                </div>
                </form>
            </div>
            <form action="{{ route('admin.checklist_groups.checklists.destroy', [$checklistGroup, $checklist]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger mb-2 mt-2" type="submit" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete Checklist') }}</button>
            </form>

            <hr>

            <div class="card">
                <div class="card-header">{{ __('List of Tasks') }}</div>
                <div class="card-body">
                    @livewire('tasks-table', ['checklist' => $checklist])
                </div>

            </div>

            <div class="card mt-4">
                <form action="{{ route('admin.checklists.tasks.store', [$checklist]) }}" method="POST">
                    @csrf
                    <div class="card-header">{{ __('New Task') }}</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">{{ __('Name') }}</label>
                                    <input
                                        class="form-control {{ $errors->storetask->has('name') ? 'is-invalid' : '' }}"
                                        id="name"
                                        name="name"
                                        type="text"
                                        value="{{ old('name') }}"
                                    >
                                    <div class="invalid-feedback">{{ $errors->storetask->has('name') ? $errors->storetask->first('name') : '' }}</div>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label" for="description">{{ __('Description') }}</label>
                                    <textarea
                                        class="form-control {{ $errors->storetask->has('description') ? 'is-invalid' : '' }}"
                                        id="task-textarea"
                                        name="description"
                                        rows="4"
                                    >{{ old('description') }}</textarea>
                                    <div class="invalid-feedback">{{ $errors->storetask->has('description') ? $errors->storetask->first('description') : '' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">{{ __('Save Task') }}</button>
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
            .create( document.querySelector( '#task-textarea' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
