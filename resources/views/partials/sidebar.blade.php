<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">

        <!-- Mostrar sólo para usuarios Admin -->
        @if(auth()->user()->is_admin)

            <li class="nav-title">{{ __('Manage Checklists') }}</li>
            @foreach($admin_menu as $group)
                <li class="nav-group show"><a class="nav-link"
                                              href="{{ route('admin.checklist_groups.edit', $group['id']) }}">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-library') }}"></use>
                        </svg> {{ $group['name'] }}</a>
                    <ul class="nav-group-items">
                        @foreach($group['checklists'] as $checklist)
                            <li class="nav-item">
                                <a class="nav-link" style="padding: .5rem .5rem .5rem 80px"
                                   href="{{ route('admin.checklist_groups.checklists.edit', [$group['id'], $checklist['id']]) }}">
                                    <svg class="nav-icon">
                                        <use
                                            xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-list') }}"></use>
                                    </svg>{{ $checklist['name'] }}
                                </a>
                            </li>
                        @endforeach
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.checklist_groups.checklists.create', $group) }}"
                               style="padding: 1rem .5rem .5rem 80px">
                                <svg class="nav-icon">
                                    <use
                                        xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-playlist-add') }}"></use>
                                </svg>
                                {{ __('New Checklist') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endforeach
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.checklist_groups.create') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-library-add') }}"></use>
                    </svg>
                    {{ __('New Checklist Group') }}
                </a>
            </li>

            <li class="nav-title">{{ __('Pages') }}</li>
            @foreach(\App\Models\Page::all() as $page)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.pages.edit', $page) }}">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-browser') }}"></use>
                        </svg> {{ $page->title }}
                    </a>
                </li>
            @endforeach

            <li class="nav-title">{{ __('Manage Data') }}</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-browser') }}"></use>
                    </svg> {{ __('Users') }}
                </a>
            </li>

        @else
            @foreach($user_menu as $group)
                <li class="nav-title">
                    {{ $group['name'] }}
                    @if($group['is_new'])
                        <span class="badge badge-sm bg-info ms-auto">New</span>
                    @elseif($group['is_updated'])
                        <span class="badge badge-sm bg-warning ms-auto">Upd</span>
                    @endif
                    <ul class="nav-group-items">
                        @foreach($group['checklists'] as $checklist)
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('users.checklists.show', [$checklist['id']]) }}">
                                    <svg class="nav-icon">
                                        <use
                                            xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-list') }}"></use>
                                    </svg>{{ $checklist['name'] }}
                                    @livewire('completed-tasks-counter', [
                                        'tasks_count' => $checklist['tasks_count'],
                                        'completed_tasks' => $checklist['completed_tasks_count'],
                                        'checklist_id' => $checklist['id']
                                    ])
                                    @if($checklist['is_new'])
                                        <span class="badge badge-sm bg-info ms-auto">New</span>
                                    @elseif($checklist['is_updated'])
                                        <span class="badge badge-sm bg-warning ms-auto">Upd</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach

        @endif

        {{--<li class="nav-title">{{ __('Session') }}</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();"
            >
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}"></use>
                </svg> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>--}}

    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
