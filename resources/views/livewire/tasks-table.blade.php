<table class="table">
    <tbody>
    @foreach($tasks as $task)
        <tr>
            <td>
                @if($task->position > 1)
                    <a href="#" wire:click.prevent="task_up({{$task->id}})" style="text-decoration: none">
                        <svg class="icon icon-2xl">
                            <use
                                xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-arrow-thick-top') }}"></use>
                        </svg>
                    </a>
                @endif
                @if($task->position != count($tasks))
                    <a href="#" wire:click.prevent="task_down({{$task->id}})" style="text-decoration: none">
                        <svg class="icon icon-2xl">
                            <use
                                xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-arrow-thick-bottom') }}"></use>
                        </svg>
                    </a>
                @endif
            </td>
            <td>{{ $task->name }}</td>
            <td align="right">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a class="btn btn-sm btn-secondary"
                       href="{{ route('admin.checklists.tasks.edit', [$checklist, $task]) }}">{{ __('Edit') }}</a>
                    <form action="{{ route('admin.checklists.tasks.destroy', [$checklist, $task]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit"
                                onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
