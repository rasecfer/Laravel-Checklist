<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                </svg> {{ __('Dashboard') }}</a>
        </li>

        <!-- Mostrar sólo para usuarios Admin -->
        @if(auth()->user()->is_admin)
            <li class="nav-title">{{ __('Admin') }}</li>
            <li class="nav-group">
                <a class="nav-link" href="{{ route('admin.pages.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-puzzle') }}"></use>
                    </svg> {{ __('Pages') }}
                </a>
            </li>

            <li class="nav-title">{{ __('Manage Checklists') }}</li>
            @foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $group)
                <li class="nav-group show"><a class="nav-link" href="{{ route('admin.checklist_groups.edit', $group->id) }}">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-puzzle') }}"></use>
                        </svg> {{ $group->name }}</a>
                    <ul class="nav-group-items">
                        @foreach($group->checklists as $checklist)
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.checklist_groups.checklists.edit', [$group, $checklist]) }}"><span class="nav-icon"></span>{{ $checklist->name }}</a></li>
                        @endforeach
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.checklist_groups.checklists.create', $group) }}">
                                {{ __('New Checklist') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endforeach
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.checklist_groups.create') }}">
                    {{ __('New Checklist Group') }}
                </a>
            </li>

        @endif

        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-puzzle') }}"></use>
                </svg> Base</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="base/accordion.html"><span class="nav-icon"></span> Accordion</a></li>
            </ul>
        </li>
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
        </li>

    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
