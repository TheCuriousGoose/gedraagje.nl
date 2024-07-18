<div class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow min-vh-100" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4">{{ config('app.name') }}</span>
    </a>
    <hr>
    @can('dashboard')
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link @if (request()->routeIs('dashboard')) active @endif">
                    <i class="fa fa-chart-line"></i>
                    Dashboard
                </a>
            </li>
        </ul>
    @endcan
    @can('qoutes.show')
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="{{ route('quotes.index') }}" class="nav-link @if (request()->routeIs('quotes.*')) active @endif">
                    <i class="fa fa-comment"></i>
                    Quotes
                </a>
            </li>
        </ul>
    @endcan
    <hr>
    @php
        $routeActive =
            request()->routeIs('users.*') ||
            request()->routeIs('settings.*') ||
            request()->routeIs('permissions.*') ||
            request()->routeIs('roles.*');
    @endphp
    <ul class="nav nav-pills flex-column flex-grow-1">
        <li class="nav-item d-inline-flex align-items-center">
            <a class="text-decoration-none nav-link d-inline-flex align-items-center justify-content-between w-100"
                data-bs-toggle="collapse" href="#collapseManagement" role="button" aria-expanded="{{ $routeActive }}"
                aria-controls="collapseManagement">
                <div>
                    <i class="fa fa-list me-2"></i>
                    {{ __('Management') }}
                </div>
                <i class="fa fa-chevron-down ms-auto"></i>
            </a>
        </li>
        <div class="collapse ms-4 border-start {{ $routeActive ? 'show' : '' }}" id="collapseManagement">
            <div class="nav-group ms-1 row-gap-2 d-flex flex-column ">
                @can('users.show')
                    <li class="nav-item ps-1">
                        <a href="{{ route('users.index') }}"
                            class="text-decoration-none @if (request()->routeIs('users.*')) nav-link active @endif">
                            <i class="px-1 fa fa-users"></i>
                            {{ __('Users') }}
                        </a>

                    </li>
                @endcan()
                @can('settings.show')
                    <li class="nav-item ps-1">
                        <a href="{{ route('settings.index') }}"
                            class="text-decoration-none @if (request()->routeIs('settings.*')) nav-link active @endif">
                            <i class="px-1 fa fa-cog"></i>
                            {{ __('Settings') }}
                        </a>
                    </li>
                @endcan
                @can('permissions.show')
                    <li class="nav-item ps-1">
                        <a href="{{ route('permissions.index') }}"
                            class="text-decoration-none @if (request()->routeIs('permissions.*')) nav-link active @endif">
                            <i class="px-1 fa fa-list"></i>
                            {{ __('Permissions') }}
                        </a>
                    </li>
                @endcan
                @can('roles.show')
                    <li class="nav-item ps-1">
                        <a href="{{ route('roles.index') }}"
                            class="text-decoration-none @if (request()->routeIs('roles.*')) nav-link active @endif">
                            <i class="px-1 fa fa-list"></i>
                            {{ __('Roles') }}
                        </a>
                    </li>
                @endcan
            </div>
        </div>
    </ul>
</div>
