<div>

    <button id="toggleFormButton"></button>

    <!-- Formulario flotante -->
    <div id="floatingForm" style="display: none;">
        <form method="POST" action="{{ route('admin.categorias.store') }}">
            @csrf
            <!-- Aquí colocarías los campos del formulario -->
            <input type="text" name="campo1" placeholder="Campo 1">
            <input type="text" name="campo2" placeholder="Campo 2">
            <!-- Otros campos y botones del formulario -->
            <button type="submit">Enviar</button>
        </form>
    </div>

    <script>
        // Obtener referencias al botón y al formulario
        const toggleFormButton = document.getElementById('toggleFormButton');
        const floatingForm = document.getElementById('floatingForm');
        // Agregar un event listener al botón para mostrar/ocultar el formulario
        toggleFormButton.addEventListener('click', function() {
            if (floatingForm.style.display === 'none') {
                floatingForm.style.display = 'block'; // Mostrar el formulario
            } else {
                floatingForm.style.display = 'none'; // Ocultar el formulario
            }
        });
    </script>


    <form wire:submit="store" enctype="multipart/form-data">

        <!--imagen-->
        {{-- <figure class="mb-4 relative">
            <div class="">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                    <i class="fas fa-camera mr-2">
                        Cargar imagen
                        <input type="file" class="hidden" accept="image/*" wire:model="image">
                    </i>
                </label>
            </div>
            <img class="aspect-[16/9] object-cover object-center w-full h-auto"
                src="{{ $image ? $image->temporaryUrl() : asset('img/no-imagen.png') }}" alt="">
        </figure> --}}

        <div class="card">
            <div>
                <x-validation-errors class="mb-4" />

                <div class="mb-4">

                    <div>
                        <x-label class="mb-3">Nombre</x-label>
                        <x-input class="w-full" placeholder="Ingrese el nombre del producto"
                            wire:model="producto.nombre" />
                    </div>
                    <div>
                        <x-label class="mb-3">stock</x-label>
                        <x-input type="number" class="w-full" placeholder="Ingrese el stock del producto"
                            wire:model="producto.stock" />
                    </div>
                    <div>
                        <x-label class="mb-3">Descripcion</x-label>
                        <x-textarea class="w-full" placeholder="Ingrese la descripsion del producto"
                            wire:model="producto.descripcion" />
                    </div>
                </div>

                <!-- select familia -->
                <x-label class="mb-3">Familia</x-label>
                <x-select class="w-full" wire:model.live="producto.familia_id" wire:loading.attr="disabled"
                    wire:target="updatedProductoFamiliaId">
                    <option value="" disabled>Seleccione una familia</option>
                    @foreach ($familias as $familia)
                        <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                    @endforeach
                </x-select>

                <!-- select categoria -->
                <x-label class="mb-3">Categoría</x-label>
                <x-select class="w-full" wire:model.live="producto.categoria_id" wire:loading.attr="disabled"
                    wire:target="updatedProductoCategoriaId">
                    <option value="" disabled {{ is_null($producto['categoria_id']) ? 'selected' : '' }}>
                        Seleccione una categoría</option>
                    @foreach ($this->categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </x-select>

                <!-- select subcategoria -->
                <x-label class="mb-3">Subcategoría</x-label>
                <x-select class="w-full" wire:model.live="producto.subcategoria_id" wire:loading.attr="disabled"
                    wire:target="updatedProductoCategoriaId">
                    <option value="" disabled>Seleccione una subcategoría</option>
                    @foreach ($this->subcategorias as $subcategoria)
                        <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                    @endforeach
                </x-select>

                <div>
                    <x-label class="mb-3">Precio</x-label>
                    <x-input type="number" step="0.01" class="w-full" placeholder="Ingrese el precio del producto"
                        wire:model="producto.precio" />
                </div>

                <div class="flex justify-end py-3">
                    <x-button>
                        Guardar
                    </x-button>
                </div>
            </div>

    </form>

</div>
