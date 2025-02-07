<div x-data="{
    open: false,
    abrir:false
}">
    @foreach ($configuracions as $configuracion)
        @foreach ($configuracion->colors as $color)
            <header class="bg-{{ $color->color }} w-full">
                <div class="px-4 py-3 ">
                    <x-container>
                        <div class="flex justify-between items-center space-x-4 md:space-x-8">
                            <button class="text-xl md:text-3xl" x-on:click="open = true">
                                <i class="fas fa-bars text-white"></i>
                            </button>
                            {{-- <button class="text-xl md:text-3xl" x-on:click="abrir = true">
                                <i class="fas fa-bars text-black"></i>
                            </button> --}}
                            <div class=" items-center">
                                <a href="/" class="items-center">
                                    <div class="">
                                        @foreach ($configuracions as $configuracion)
                                            <div class="mr-28 sm:mr-28 md:mr-28 lg:mr-0">
                                                <img src="{{ $configuracion->logotipo }}" alt=""
                                                    class="h-12 w-16 ">
                                            </div>
                                        @endforeach
                                    </div>
                                </a>
                            </div>


                            <div class="flex-1 hidden md:block">
                                @livewire('welcome-productos')
                                {{-- <x-input oninput="search(this.value)" class="w-full" placeholder="Buscar producto" /> --}}
                            </div>
                            <div class="flex items-center space-x-4 md:space-x-8">
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        @auth
                                            <button
                                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                <!-- link de la imagen-->
                                                <img class="h-8 w-8 rounded-full object-cover"
                                                    src="{{ Auth::user()->profile_photo_path }}"
                                                    alt="{{ Auth::user()->name }}" />
                                            </button>
                                        @else
                                            <button class="text-xl md:text-3xl">
                                                <i class="fas fa-user text-white "></i>
                                            </button>
                                        @endauth
                                    </x-slot>
                                    <x-slot name="content">
                                        @guest
                                            <div class="px-4 py-2">
                                                <div class="flex justify-center">
                                                    <a href="{{ route('login') }}" class="btn btn-blue">
                                                        Iniciar sesion
                                                    </a>
                                                </div>
                                                <p class="text-sm text-center mt-2">
                                                    ¿No tienes cuenta? <a href="{{ route('register') }}"
                                                        class="text-blue-600 hover:underline">Unete a nosotros</a>
                                                </p>
                                            </div>
                                        @else
                                            <x-dropdown-link href="{{ route('profile.show') }}">
                                                Mi perfil
                                            </x-dropdown-link>

                                            @can('admin.dashboard')
                                                <div class="border-t border-gray-200"></div>
                                                <x-dropdown-link href="{{ route('admin.dashboard') }}">
                                                    Administrador
                                                </x-dropdown-link>
                                            @endcan

                                        @endguest
                                        @auth
                                            <div class="border-t border-gray-200"></div>
                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}" x-data>
                                                @csrf

                                                <x-dropdown-link href="{{ route('logout') }}"
                                                    @click.prevent="$root.submit();">
                                                    Finalizar sesíon
                                                </x-dropdown-link>

                                            </form>
                                        @endauth
                                    </x-slot>
                                </x-dropdown>
                                <a href="{{ route('cart.index') }}" class="relative">
                                    <i class="fas fa-shopping-cart text-white text-xl md:text-3xl"></i>
                                    <span id="cart-count"
                                        class="absolute -top-2 -end-4 inline-flex items-center justify-center w-4 h-4 bg-red-500 rounded-full text-xs font-bold text-white">
                                        {{ Cart::instance('shopping')->content()->count() }}
                                    </span>
                                </a>


                            </div>
                        </div>
                        <div class="mt4 md:hidden py-1">
                            <x-input oninput="search(this.value)" class="w-full" placeholder="Buscar producto" />
                        </div>
                    </x-container>
                </div>

            </header>
        @endforeach
    @endforeach
    <div x-show="open" x-on:click="open = false" style="display: none"
        class="fixed top-0 left-0 inset-0 bg-black bg-opacity-25 z-10"></div>
    <div x-show="open" style="display: none" class="fixed top-0 left-0 z-20">
        <div class="flex">
            <div class="w-screen sm:w-80 h-screen bg-white">
                @foreach ($configuracions as $configuracion)
                    @foreach ($configuracion->colors as $color)
                        <div class="bg-{{ $color->color }} px-4 py-3 text-white font-semibold">
                            <div class="flex justify-between items-center">
                                <span class="text-lg">
                                    Familias
                                </span>
                                <button x-on:click="open = false">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endforeach
                <div class="h-[calc(100vh-52px)] overflow-auto">
                    <ul>
                        @foreach ($familias as $familia)
                            <li wire:mouseover="$set('familia_id', {{ $familia->id }})">
                                <a href="{{ route('cliente.familias.show', $familia) }}"
                                    class="flex items-center justify-between px-4 py-4 font-semibold text-gray-500 hover:text-blue-950 hover:bg-custom-blue-gray-400 hover:bg-opacity-20">
                                    {{ $familia->nombre }}
                                    <i class="fa-solid fa-angle-right"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="w-[780px] pt-[52px] ">
                <div class="bg-white h-[calc(100vh-52px)] overflow-auto px-5">
                    <div class="mb-1 py-3 flex justify-between items-center">
                        <p class="border-b-[3px] border-blue-400 uppercase text-xl font-semibold">
                            {{ $this->familiaNombre }}
                        </p>
                        <a href="{{ route('cliente.familias.show', $familia_id) }}" class="btn btn-blue"
                            style="margin-right: 20px;">
                            ver todo
                        </a>
                    </div>
                    <ul class="grid grid-cols-3 gap-8 ">
                        @foreach ($this->categorias as $categoria)
                            <li>
                                <a href="{{ route('cliente.categorias.show', $categoria) }}"
                                    class="text-gray-600 font-semibold text-lg">
                                    {{ $categoria->nombre }}
                                </a>
                                <ul class="mt-4 space-y-2">
                                    @foreach ($categoria->subcategorias as $subcategoria)
                                        <li>
                                            <a href="{{ route('cliente.subcategorias.show', $subcategoria) }}"
                                                class="text-sm text-gray-700 hover:text-blue-500">
                                                {{ $subcategoria->nombre }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            Livewire.on('cartUpdated', (count) => {
                document.getElementById('cart-count').innerText = count;
            });
            /* function search(value) {
                Livewire.dispatch('search', {
                    search: value
                });
            } */
        </script>
    @endpush
</div>
