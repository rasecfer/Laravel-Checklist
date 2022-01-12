<table class="table" wire:sortable="updateTaskOrder">
    <tbody>
    @foreach($tasks as $task)
        <tr wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}">
            <td>{{ $task->name }}</td>
            <td align="right">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a class="btn btn-sm btn-secondary" href="{{ route('admin.checklists.tasks.edit', [$checklist, $task]) }}">{{ __('Edit') }}</a>
                    <form action="{{ route('admin.checklists.tasks.destroy', [$checklist, $task]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
