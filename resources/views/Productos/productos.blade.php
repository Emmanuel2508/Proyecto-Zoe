<x-plantilla>

  <div class="max-w-5xl mx-auto px-4 py-10">

    
    <div class="mb-8 border-b border-pink-100/60 pb-4 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
      <div>
        <span class="text-xs uppercase tracking-widest text-[#7c7275] font-semibold">Colección</span>
        <h1 class="text-3xl font-light tracking-[0.15em] text-[#3a3a3a] uppercase mt-1">
          Productos
        </h1>
      </div>

      @if(auth()->guard('admin')->check())
        <a href="{{ route('productos.registro') }}"
          class="inline-block px-5 py-2.5 bg-white border border-pink-200 hover:border-pink-400 text-[#7c7275] hover:text-pink-600 rounded-xl text-sm font-medium transition-all shadow-sm active:scale-95 cursor-pointer shrink-0">
          + Agregar Producto
        </a>
      @endif
    </div>

   
    @if(session('success'))
      <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
        {{ session('success') }}
      </div>
    @endif

    
    <div class="flex flex-wrap gap-2 mb-8" id="filtros">
      <button onclick="filtrar('todos')" data-cat="todos"
        class="filtro-btn px-4 py-1.5 rounded-full text-xs font-medium border bg-[#f381ab] text-white border-[#f381ab] transition-all cursor-pointer active:scale-95">
        Todos
      </button>
      <button onclick="filtrar('cosmeticos')" data-cat="cosmeticos"
        class="filtro-btn px-4 py-1.5 rounded-full text-xs font-medium border border-pink-200 text-[#7c7275] bg-white transition-all cursor-pointer hover:border-pink-400 hover:text-pink-600 active:scale-95">
        Cosméticos
      </button>
      <button onclick="filtrar('accesorios')" data-cat="accesorios"
        class="filtro-btn px-4 py-1.5 rounded-full text-xs font-medium border border-pink-200 text-[#7c7275] bg-white transition-all cursor-pointer hover:border-pink-400 hover:text-pink-600 active:scale-95">
        Accesorios
      </button>
      <button onclick="filtrar('perfumes')" data-cat="perfumes"
        class="filtro-btn px-4 py-1.5 rounded-full text-xs font-medium border border-pink-200 text-[#7c7275] bg-white transition-all cursor-pointer hover:border-pink-400 hover:text-pink-600 active:scale-95">
        Perfumes
      </button>
      <button onclick="filtrar('otros')" data-cat="otros"
        class="filtro-btn px-4 py-1.5 rounded-full text-xs font-medium border border-pink-200 text-[#7c7275] bg-white transition-all cursor-pointer hover:border-pink-400 hover:text-pink-600 active:scale-95">
        Otros
      </button>
    </div>

    
    @if($productos->isEmpty())
      <div class="py-16 text-center text-[#8e7f84] italic bg-[#faf8f9]/40 rounded-2xl border border-pink-100/40">
        No hay productos disponibles por el momento.
      </div>
    @else
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" id="grid-productos">

        @foreach ($productos as $producto)
          <div class="producto-card" data-categoria="{{ strtolower($producto->categoria) }}">
            <a href="{{ route('productos.mostrar', $producto->id_productos) }}"
              class="group flex flex-col bg-white border border-pink-100/70 rounded-2xl shadow-sm hover:shadow-md hover:border-pink-200 transition-all overflow-hidden h-full">

              
              <div class="aspect-square bg-gradient-to-br from-[#fff5f8] to-[#f3e8f4] overflow-hidden">
                <img src="{{ url('/productos/'.$producto->id_productos.'/imagen') }}"
                  alt="{{ $producto->nombre }}"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                  onerror="this.style.display='none'">
              </div>

              
              <div class="p-3 flex flex-col flex-1 justify-between">
                <div>
                  <p class="text-[10px] uppercase tracking-wider text-[#a29bb8] font-medium mb-0.5">
                    {{ $producto->categoria }}
                  </p>
                  <p class="text-sm font-medium text-[#3a3a3a] group-hover:text-[#f381ab] transition-colors leading-snug">
                    {{ $producto->nombre }}
                  </p>
                </div>
                <p class="text-sm font-light text-[#3a3a3a] mt-2">
                  ${{ number_format($producto->precio, 0) }}
                </p>
                <span class="mt-1 text-[11px] text-[#f381ab] font-medium tracking-wider uppercase">
                  Ver producto
                </span>
              </div>

            </a>
          </div>
        @endforeach

      </div>
    @endif

  </div>

  <script>
    function filtrar(categoria) {
      const tarjetas = document.querySelectorAll('.producto-card');
      document.querySelectorAll('.filtro-btn').forEach(btn => {
        const activo = btn.dataset.cat === categoria;
        btn.className = activo
          ? 'filtro-btn px-4 py-1.5 rounded-full text-xs font-medium border bg-[#f381ab] text-white border-[#f381ab] transition-all cursor-pointer active:scale-95'
          : 'filtro-btn px-4 py-1.5 rounded-full text-xs font-medium border border-pink-200 text-[#7c7275] bg-white transition-all cursor-pointer hover:border-pink-400 hover:text-pink-600 active:scale-95';
      });
      tarjetas.forEach(t => {
        const visible = categoria === 'todos' || t.dataset.categoria.includes(categoria);
        t.style.display = visible ? '' : 'none';
      });
    }
  </script>

</x-plantilla>
