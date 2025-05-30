<div>
    <nav x-data="{ open: false }" class="nav fixed z-10 w-full border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="w-full">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="btn-menu sm:-my-px sm:flex" id="btn-menu">
                        <button
                            class="inline-flex w-full items-center justify-center p-2 text-white hover:text-white-500 focus:outline-none transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('index.admin') }}">
                            <x-application-mark class="block h-9 w-auto" />

                        </a>
                    </div>

                    <!-- Navigation Links -->
                    {{--
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                        --}}
                </div>

                <div class="hidden mx-6 sm:flex sm:items-center sm:ms-6">
                    <!-- Teams Dropdown -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="60">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->currentTeam->name }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="w-60">
                                        <!-- Team Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Team') }}
                                        </div>

                                        <!-- Team Settings -->
                                        <x-dropdown-link
                                            href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            {{ __('Team Settings') }}
                                        </x-dropdown-link>

                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-dropdown-link href="{{ route('teams.create') }}">
                                                {{ __('Create New Team') }}
                                            </x-dropdown-link>
                                        @endcan

                                        <!-- Team Switcher -->
                                        @if (Auth::user()->allTeams()->count() > 1)
                                            <div class="border-t border-gray-200"></div>

                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Switch Teams') }}
                                            </div>

                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-switchable-team :team="$team" />
                                            @endforeach
                                        @endif
                                    </div>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endif

                    <!-- Settings Dropdown -->
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Configuraciones') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Perfil') }}
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 me-3">
                            <img class="h-10 w-10 rounded-full object-cover"
                                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>

                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>

                        <!-- Team Settings -->
                        <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                            :active="request()->routeIs('teams.show')">
                            {{ __('Team Settings') }}
                        </x-responsive-nav-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                {{ __('Create New Team') }}
                            </x-responsive-nav-link>
                        @endcan

                        <!-- Team Switcher -->
                        @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" component="responsive-nav-link" />
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <div class="menu-collapsed fixed z-0" id="vertical-menu">

        <div id="menu-items">
            @can('admin.projects.index')
                @if (Request::path() == 'app/projects')
                    <div class="item activate">
                        <a href="{{ route('admin.projects.index') }}">
                            <div class="icon"><i {{-- Popper::trigger(true,false,false)->position('right')->distance(15)->pop('Proyectos')--}} class="fa-solid fa-file-pen"></i></div>
                            <div class="title"><span>Proyectos</span></div>
                        </a>
                    </div>
                @else
                    <div class="item">
                        <a href="{{ route('admin.projects.index') }}">
                            <div class="icon"><i {{-- Popper::trigger(true,false,false)->position('right')->distance(15)->pop('Proyectos')--}} class="fa-solid fa-file-pen"></i></div>
                            <div class="title"><span>Proyectos</span></div>
                        </a>
                    </div>
                @endif
            @endcan
            @can('admin.evaluateds.index')
                @if (Request::path() == 'app/evaluateds')
                    <div class="item activate">
                        <a href="{{ route('admin.evaluateds.index') }}">
                            <div class="icon"><i {{-- Popper::trigger(true,false,false)->position('right')->distance(15)->pop('Evaluaciones')--}} class="fa-solid fa-flask-vial"></i></div>
                            <div class="title"><span>Evaluaciones</span></div>
                        </a>
                    </div>
                @else
                    <div class="item">
                        <a href="{{ route('admin.evaluateds.index') }}">
                            <div class="icon"><i {{-- Popper::trigger(true,false,false)->position('right')->distance(15)->pop('Evaluaciones')--}} class="fa-solid fa-flask-vial"></i></div>
                            <div class="title"><span>Evaluaciones</span></div>
                        </a>
                    </div>
                @endif

            @endcan
            @can('admin.judges.index')
                @if (Request::path() == 'app/judges')
                    <div class="item activate">
                        <a href="{{ route('admin.judges.index') }}">
                            <div class="icon"><i {{-- Popper::trigger(true,false,false)->position('right')->distance(15)->pop('Jueces')--}} class="fa-solid fa-address-card"></i></div>
                            <div class="title"><span>Jueces</span></div>
                        </a>
                    </div>
                @else
                    <div class="item">
                        <a href="{{ route('admin.judges.index') }}">
                            <div class="icon"><i {{-- Popper::trigger(true,false,false)->position('right')->distance(15)->pop('Jueces')--}} class="fa-solid fa-address-card"></i></div>
                            <div class="title"><span>Jueces</span></div>
                        </a>
                    </div>
                @endif
            @endcan
            @can('admin.users.index')
                @if (Request::path() == 'app/users')
                    <div class="item activate">
                        <a href="{{ route('admin.users.index') }}">
                            <div class="icon"><i {{-- Popper::trigger(true,false,false)->position('right')->distance(15)->pop('Usuarios')--}} class="fa-solid fa-user-gear"></i></div>
                            <div class="title"><span>Usuarios</span></div>
                        </a>
                    </div>
                @else
                    <div class="item">
                        <a href="{{ route('admin.users.index') }}">
                            <div class="icon"><i {{-- Popper::trigger(true,false,false)->position('right')->distance(15)->pop('Usuarios')--}} class="fa-solid fa-user-gear"></i></div>
                            <div class="title"><span>Usuarios</span></div>
                        </a>
                    </div>
                @endif
            @endcan
            @can('admin.reports.index')
                @if (Request::path() == 'app/reports')
                    <div class="item activate">
                        <a href="{{ route('admin.reports.index') }}">
                            <div class="icon"><i
                                    {{-- Popper::trigger(true, false, false)->position('right')->distance(15)->pop('Reportes') --}}
                                    class="fa-solid fa-print"></i></div>
                            <div class="title"><span>Reportes</span></div>
                        </a>
                    </div>
                @else
                    <div class="item">
                        <a href="{{ route('admin.reports.index') }}">
                            <div class="icon"><i
                                    {{-- Popper::trigger(true, false, false)->position('right')->distance(15)->pop('Reportes') --}}
                                    class="fa-solid fa-print"></i></div>
                            <div class="title"><span>Reportes</span></div>
                        </a>
                    </div>
                @endif
            @endcan
            @can('admin.judments.index')
                @if (Request::path() == 'app/judments')
                    <div class="item activate">
                        <a href="{{ route('admin.judments.index') }}">
                            <div class="icon"><i
                                    {{-- Popper::trigger(true, false, false)->position('right')->distance(15)->pop('Juicios') --}}
                                    class="fa-solid fa-list-check"></i></div>
                            <div class="title"><span>Juicios</span></div>
                        </a>
                    </div>
                @else
                    <div class="item">
                        <a href="{{ route('admin.judments.index') }}">
                            <div class="icon"><i
                                    {{-- Popper::trigger(true, false, false)->position('right')->distance(15)->pop('Juicios') --}}
                                    class="fa-solid fa-list-check"></i></div>
                            <div class="title"><span>Juicios</span></div>
                        </a>
                    </div>
                @endif
            @endcan
        </div>
        <div id="menu-item-logout">
            <form class="item" method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    <div class="icon"><i
                            {{-- Popper::trigger(true, false, false)->position('right')->distance(15)->pop('Cerrar Sesión') --}}
                            class="fa-solid fa-power-off"></i></div>
                    <div class="title"><span>Cerrar Sesión</span></div>
                </a>
            </form>
        </div>
    </div>
</div>
