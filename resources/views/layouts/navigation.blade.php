<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('images/logo-app.png') }}" alt="App Logo" class="block h-14 w-auto" style="max-height:56px;" />
                        </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            <span class="inline-flex items-center gap-1">
                                <i class="fa-solid fa-house text-gray-500"></i>
                                Inicio
                            </span>
                    </x-nav-link>
                        <x-nav-link :href="route('evaluations.index')" :active="request()->routeIs('evaluations.*')">
                                <span class="inline-flex items-center gap-1">
                                    <i class="fa-solid fa-clipboard-list text-gray-500"></i>
                                    Evaluaciones
                                </span>
                        </x-nav-link>
                        {{-- Enlace para crear evaluación --}}
                        <x-nav-link :href="route('evaluations.create')" :active="request()->routeIs('evaluations.create')">
                                <span class="inline-flex items-center gap-1">
                                    <i class="fa-solid fa-plus text-green-500"></i>
                                    Nueva Evaluación
                                </span>
                        </x-nav-link>
                        {{-- Enlace para enviar evaluación (puede requerir lógica extra) --}}
                        {{-- <x-nav-link :href="route('evaluations.submit', ['evaluation' => 1])">Enviar Evaluación</x-nav-link> --}}
                        @if(auth()->user() && auth()->user()->hasRole('admin'))
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                                    <span class="inline-flex items-center gap-1">
                                        <i class="fa-solid fa-user-gear text-indigo-500"></i>
                                        Administración de Usuarios
                                    </span>
                            </x-nav-link>
                            <x-nav-link :href="route('admin.items.index')" :active="request()->routeIs('admin.items.*')">
                                    <span class="inline-flex items-center gap-1">
                                        <i class="fa-solid fa-boxes-stacked text-blue-500"></i>
                                        Administración de Ítems
                                    </span>
                            </x-nav-link>
                            <x-nav-link :href="route('admin.subjects.index')" :active="request()->routeIs('admin.subjects.*')">
                                    <span class="inline-flex items-center gap-1">
                                        <i class="fa-solid fa-users text-gray-500"></i>
                                        Sujetos
                                    </span>
                            </x-nav-link>
                            <x-nav-link :href="route('admin.prompts.index')" :active="request()->routeIs('admin.prompts.*')">
                                    <span class="inline-flex items-center gap-1">
                                        <i class="fa-solid fa-lightbulb text-yellow-500"></i>
                                        Prompts
                                    </span>
                            </x-nav-link>
                            <x-nav-link :href="route('admin.questions.index')" :active="request()->routeIs('admin.questions.*')">
                                    <span class="inline-flex items-center gap-1">
                                        <i class="fa-solid fa-question text-purple-500"></i>
                                        Administración de Preguntas
                                    </span>
                            </x-nav-link>
                        @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>
                                @auth
                                    {{ Auth::user()->name }}
                                @else
                                    Invitado
                                @endauth
                            </div>

                            <div class="ms-1">
                                    <i class="fa-solid fa-chevron-down text-gray-500" style="font-size: 20px;"></i>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                                <span class="inline-flex items-center gap-1">
                                    <i class="fa-solid fa-user text-gray-500"></i>
                                    Perfil
                                </span>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    <span class="inline-flex items-center gap-1">
                                        <i class="fa-solid fa-right-from-bracket text-red-500"></i>
                                        Cerrar sesión
                                    </span>
                                </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <span :class="{'hidden': open, 'inline-flex': ! open }"><i class="fa-solid fa-bars h-6 w-6"></i></span>
                        <span :class="{'hidden': ! open, 'inline-flex': open }"><i class="fa-solid fa-xmark h-6 w-6"></i></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <span class="inline-flex items-center gap-1">
                        <i class="fa-solid fa-house text-gray-500"></i>
                        Inicio
                    </span>
            </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('evaluations.index')" :active="request()->routeIs('evaluations.*')">
                        <span class="inline-flex items-center gap-1">
                            <i class="fa-solid fa-clipboard-list text-gray-500"></i>
                            Evaluaciones
                        </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('evaluations.create')" :active="request()->routeIs('evaluations.create')">
                        <span class="inline-flex items-center gap-1">
                            <i class="fa-solid fa-plus text-green-500"></i>
                            Nueva Evaluación
                        </span>
                </x-responsive-nav-link>
                @if(auth()->user() && auth()->user()->hasRole('admin'))
                    <x-responsive-nav-link :href="route('admin.items.index')" :active="request()->routeIs('admin.items.*')">
                            <span class="inline-flex items-center gap-1">
                                <i class="fa-solid fa-boxes-stacked text-blue-500"></i>
                                Administración de Ítems
                            </span>
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.subjects.index')" :active="request()->routeIs('admin.subjects.*')">
                            <span class="inline-flex items-center gap-1">
                                <i class="fa-solid fa-users text-gray-500"></i>
                                Sujetos
                            </span>
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.questions.index')" :active="request()->routeIs('admin.questions.*')">
                            <span class="inline-flex items-center gap-1">
                                <i class="fa-solid fa-question text-purple-500"></i>
                                Administración de Preguntas
                            </span>
                    </x-responsive-nav-link>
                @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">
                    @auth
                        {{ Auth::user()->name }}
                    @else
                        Invitado
                    @endauth
                </div>
                <div class="font-medium text-sm text-gray-500">
                    @auth
                        {{ Auth::user()->email }}
                    @endauth
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                        <span class="inline-flex items-center gap-1">
                            <i class="fa-solid fa-user text-gray-500"></i>
                            Perfil
                        </span>
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <span class="inline-flex items-center gap-1">
                                <i class="fa-solid fa-right-from-bracket text-red-500"></i>
                                Cerrar sesión
                            </span>
                        </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
