<x-plantilla>

  <div class="max-w-4xl mx-auto px-4 py-12">

    
    <nav class="mb-8 flex items-center gap-2 text-xs text-[#8e7f84]">
      <a href="{{ route('Inicio') }}" class="hover:text-[#f381ab] transition-colors">Inicio</a>
      <span>/</span>
      <a href="{{ route('productos') }}" class="hover:text-[#f381ab] transition-colors">Productos</a>
      <span>/</span>
      <span class="text-[#3a3a3a] font-medium">{{ $producto->nombre }}</span>
    </nav>

    
    <div class="bg-white border border-pink-100/70 rounded-2xl shadow-md shadow-pink-100/20 overflow-hidden mb-8">
      <div class="grid grid-cols-1 md:grid-cols-2">

        
        <div class="bg-gradient-to-br from-[#fff5f8] via-[#f3e8f4] to-[#ffedf5] flex items-center justify-center min-h-72 p-10">
          <img src="{{ url('/productos/'.$producto->id_productos.'/imagen') }}"
            alt="{{ $producto->nombre }}"
            class="max-h-64 w-auto object-contain"
            onerror="this.style.display='none'">
        </div>

        
        <div class="p-8 flex flex-col justify-between border-l border-pink-100/40">

          <div>
            <span class="text-xs uppercase tracking-widest text-[#a29bb8] font-semibold">
              {{ $producto->categoria }}
            </span>
            <h1 class="text-2xl font-light tracking-wide text-[#3a3a3a] mt-2 mb-3">
              {{ $producto->nombre }}
            </h1>
            <p class="text-3xl font-light text-[#f381ab] mb-5">
              ${{ number_format($producto->precio, 0) }}
            </p>

            <div class="border-t border-pink-50 pt-4 mb-4">
              <span class="text-xs uppercase tracking-wider text-[#7c7275] font-semibold">Descripción</span>
              <p class="text-sm text-[#5c5457] leading-relaxed mt-1">
                {{ $producto->descripcion }}
              </p>
            </div>

            <div class="flex items-center gap-2 mb-6">
              <span class="text-xs uppercase tracking-wider text-[#7c7275] font-semibold">Stock:</span>
              @if($producto->stock > 0)
                <span class="text-xs px-2.5 py-0.5 bg-green-50 text-green-700 border border-green-200 rounded-full font-medium">
                  {{ $producto->stock }} disponibles
                </span>
              @else
                <span class="text-xs px-2.5 py-0.5 bg-red-50 text-red-500 border border-red-200 rounded-full font-medium">
                  Agotado
                </span>
              @endif
            </div>
          </div>

        
          @if(auth()->guard('admin')->check())

            <div class="space-y-3">
              <a href="{{ route('productos.modificar', $producto->id_productos) }}"
                class="flex items-center justify-center w-full py-2.5 bg-white border border-pink-200 hover:border-pink-400 text-[#7c7275] hover:text-pink-600 rounded-xl text-sm font-medium transition-all active:scale-95 cursor-pointer">
                Modificar Producto
              </a>
              <form action="{{ route('productos.eliminar', $producto->id_productos) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                  onclick="return confirm('¿Seguro que desea eliminar este producto?')"
                  class="w-full py-2 text-xs font-medium text-red-500 bg-red-50/50 hover:bg-red-50 border border-red-100 rounded-xl transition-all cursor-pointer active:scale-95">
                  Eliminar Producto
                </button>
              </form>
            </div>

          @elseif($producto->stock > 0)

            <form action="{{ route('carrito.agregar') }}" method="post" class="space-y-3">
              @csrf
              @method('POST')
              <input type="hidden" name="id_productos" value="{{ $producto->id_productos }}">
              <div class="flex flex-col gap-1.5">
                <label for="cantidad" class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
                  Cantidad
                </label>
                <input type="number" name="cantidad" id="cantidad"
                  value="1" min="1" max="{{ $producto->stock }}"
                  class="w-24 px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-pink-400 focus:bg-white transition-all text-sm text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
              </div>
              <button type="submit"
                class="w-full py-3 bg-[#f381ab] hover:bg-[#ef6b9d] text-white font-medium rounded-xl shadow-md shadow-pink-200/50 hover:shadow-lg transition-all transform active:scale-[0.98] tracking-wide text-sm cursor-pointer">
                Agregar al Carrito
              </button>
            </form>

          @else

            <button disabled
              class="w-full py-3 bg-gray-100 text-[#8e7f84] font-medium rounded-xl border border-gray-200 text-sm cursor-not-allowed">
              Producto Agotado
            </button>

          @endif

        </div>
      </div>
    </div>

    
    <div class="flex justify-start">
      <a href="{{ route('productos') }}"
        class="inline-block px-5 py-2.5 bg-white border border-pink-200 hover:border-pink-400 text-[#7c7275] hover:text-pink-600 rounded-xl text-sm font-medium transition-all shadow-sm active:scale-95 cursor-pointer">
        ← Regresar a Productos
      </a>
    </div>

  </div>

</x-plantilla>
