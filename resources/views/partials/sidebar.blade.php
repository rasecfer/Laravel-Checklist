<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">

        <!-- Mostrar sólo para usuarios Admin -->
        @if(auth()->user()->is_admin)

            <li class="nav-title">{{ __('Manage Checklists') }}</li>
            @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $group)
                <li class="nav-group show"><a class="nav-link"
                                              href="{{ route('admin.checklist_groups.edit', $group->id) }}">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-library') }}"></use>
                        </svg> {{ $group->name }}</a>
                    <ul class="nav-group-items">
                        @foreach($group->checklists as $checklist)
                            <li class="nav-item">
                                <a class="nav-link" style="padding: .5rem .5rem .5rem 80px"
                                   href="{{ route('admin.checklist_groups.checklists.edit', [$group, $checklist]) }}">
                                    <svg class="nav-icon">
                                        <use
                                            xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-list') }}"></use>
                                    </svg>{{ $checklist->name }}
                                </a>
                            </li>
                        @endforeach
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.checklist_groups.checklists.create', $group) }}">
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
            @foreach(\App\Models\ChecklistGroup::with(['checklists' => function($query) { $query->whereNull('user_id'); }])->get() as $group)
                <li class="nav-title">
                         {{ $group->name }}
                    <ul class="nav-group-items">
                        @foreach($group->checklists as $checklist)
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('users.checklists.show', [$checklist]) }}">
                                    <svg class="nav-icon">
                                        <use
                                            xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-list') }}"></use>
                                    </svg>{{ $checklist->name }}
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
