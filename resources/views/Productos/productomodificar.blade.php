<x-plantilla>

  <div class="min-h-[85vh] flex flex-col justify-center items-center px-4 py-8">

    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl shadow-pink-100/30 border border-pink-100/40 overflow-hidden">

      
      <div class="bg-gradient-to-r from-[#fff5f8] via-[#f3e8f4] to-[#ffedf5] p-6 text-center border-b border-pink-100/40">
        <h1 class="text-2xl font-light tracking-[0.15em] text-[#3a3a3a] uppercase">
          Modificar Producto
        </h1>
        <p class="text-xs text-[#7c7275] mt-1 tracking-wide">
          Actualiza los datos del producto · {{ $producto->nombre }}
        </p>
      </div>

      <div class="p-8">

        
        <div class="mb-6 flex items-center gap-4">
          <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-[#fff5f8] to-[#f3e8f4] border border-pink-100 overflow-hidden flex items-center justify-center shrink-0">
            <img src="{{ url('/productos/'.$producto->id_productos.'/imagen') }}"
              alt="{{ $producto->nombre }}"
              class="w-full h-full object-cover"
              onerror="this.style.display='none'">
          </div>
          <div>
            <p class="text-xs uppercase tracking-wider text-[#7c7275] font-semibold">Imagen actual</p>
            <p class="text-sm text-[#3a3a3a] font-light mt-0.5">{{ $producto->nombre }}</p>
          </div>
        </div>

        
        <form action="{{ route('productos.actualizar', $producto->id_productos) }}"
          id="modificar" method="POST" enctype="multipart/form-data" class="space-y-5">

          @csrf
          @method('PUT')

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div class="flex flex-col gap-1.5">
              <label for="nombre" class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
                Nombre
              </label>
              <input type="text" name="nombre" id="nombre" required value="{{ $producto->nombre }}"
                class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-pink-400 focus:bg-white transition-all text-sm">
            </div>

            <div class="flex flex-col gap-1.5">
              <label for="categoria" class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
                Categoría
              </label>
              <input type="text" name="categoria" id="categoria" required value="{{ $producto->categoria }}"
                class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-pink-400 focus:bg-white transition-all text-sm">
            </div>

            <div class="flex flex-col gap-1.5">
              <label for="precio" class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
                Precio ($)
              </label>
              <input type="number" name="precio" id="precio" required value="{{ $producto->precio }}" min="0" step="0.01"
                class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-pink-400 focus:bg-white transition-all text-sm [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
            </div>

            <div class="flex flex-col gap-1.5">
              <label for="stock" class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
                Stock
              </label>
              <input type="number" name="stock" id="stock" required value="{{ $producto->stock }}" min="0"
                class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-pink-400 focus:bg-white transition-all text-sm [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
            </div>

          </div>

          <div class="flex flex-col gap-1.5">
            <label for="descripcion" class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
              Descripción
            </label>
            <textarea name="descripcion" id="descripcion" required rows="3"
              class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-pink-400 focus:bg-white transition-all text-sm resize-none">{{ $producto->descripcion }}</textarea>
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="imagen" class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
              Nueva Imagen
              <span class="text-[10px] text-[#8e7f84] lowercase font-normal">(dejar en blanco para no cambiar)</span>
            </label>
            <input type="file" name="imagen" id="imagen" accept="image/jpeg"
              class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-pink-400 transition-all text-sm file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-pink-50 file:text-[#f381ab] hover:file:bg-pink-100 cursor-pointer">
          </div>

          <div class="pt-2 flex flex-col sm:flex-row gap-3">
            <button type="submit"
              class="flex-1 py-3 bg-[#f381ab] hover:bg-[#ef6b9d] text-white font-medium rounded-xl shadow-md shadow-pink-200/50 hover:shadow-lg transition-all transform active:scale-[0.98] tracking-wide text-sm cursor-pointer">
              Guardar Cambios
            </button>
            <a href="{{ route('productos.mostrar', $producto->id_productos) }}"
              class="flex-1 py-3 text-center bg-white border border-pink-200 hover:border-pink-400 text-[#7c7275] hover:text-pink-600 rounded-xl text-sm font-medium transition-all active:scale-95 cursor-pointer">
              Cancelar
            </a>
          </div>

        </form>
      </div>
    </div>
  </div>

</x-plantilla>
