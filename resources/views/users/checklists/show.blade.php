@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <div class="fade-in">
            @livewire('header-totals-count', ['checklist_group_id' => $checklist->checklist_group_id])
            @livewire('checklist-show', ['checklist' => $checklist])
        </div>
    </div>
@endsection

@section('scripts')

@endsection
