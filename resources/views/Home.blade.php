<x-plantilla :title="$title">
 
  <div class="max-w-4xl mx-auto px-4 py-12">
 
    <div class="text-center py-16">
      <span class="text-xs uppercase tracking-widest text-[#a29bb8] font-semibold">
        Bienvenida a
      </span>
      <h1 class="text-6xl font-light tracking-[0.3em] text-[#3a3a3a] mt-3 mb-4">
        ZÖE
      </h1>
      <p class="text-sm text-[#8e7f84] font-light max-w-sm mx-auto leading-relaxed mb-8">
        Cosméticos, accesorios y perfumes seleccionados para ti.
      </p>
      <a href="{{ route('productos') }}"
        class="inline-block px-8 py-3 bg-[#f381ab] hover:bg-[#ef6b9d] text-white font-medium rounded-xl shadow-md shadow-pink-200/50 hover:shadow-lg transition-all transform active:scale-[0.98] tracking-wide text-sm cursor-pointer">
        Ver Productos
      </a>
    </div>
 
    <div class="border-t border-pink-100/60 mb-10"></div>
 
    @if(auth()->guard('admin')->check())
      <div class="border-t border-pink-100/60 pt-6 flex flex-wrap gap-3 justify-end">
        <a href="{{ route('clientes') }}"
          class="px-4 py-2 text-xs font-medium text-[#a29bb8] bg-purple-50/50 hover:bg-purple-50 border border-purple-100 rounded-xl transition-all cursor-pointer active:scale-95">
          Panel de Clientes
        </a>
        <a href="{{ route('productos.registro') }}"
          class="px-4 py-2 text-xs font-medium text-[#f381ab] bg-pink-50/50 hover:bg-pink-50 border border-pink-100 rounded-xl transition-all cursor-pointer active:scale-95">
          Registrar Producto
        </a>
      </div>
    @endif
 
  </div>
 
</x-plantilla>