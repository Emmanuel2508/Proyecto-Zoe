<x-plantilla>
    <div class="min-h-[80vh] flex flex-col justify-center items-center px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl shadow-purple-100/30 border border-purple-100/40 overflow-hidden">
            
            <div class="bg-gradient-to-r from-[#fff5f8] via-[#f3e8f4] to-[#ffedf5] p-6 text-center border-b border-pink-100/40">
                <h1 class="text-2xl font-light tracking-[0.15em] text-[#3a3a3a] uppercase">
                    Inicio de Sesión
                </h1>
            </div>

            <div class="p-8">
                @if (session('error'))
                    <div class="mb-5 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm text-center font-medium">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('loginCliente') }}" method="POST" class="space-y-5">
                    @csrf 
                    
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
                            Correo Electrónico
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-purple-300 focus:bg-white transition-all text-sm @error('email') border-red-300 focus:border-red-400 @enderror">
                        
                        @error('email') 
                            <span class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
                            Contraseña
                        </label>
                        <input type="password" name="contraseña" required
                            class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-purple-300 focus:bg-white transition-all text-sm">
                    </div>

                    <div class="pt-2">
                        <button type="submit" 
                            class="w-full py-3 bg-[#a29bb8] hover:bg-[#8f87a8] text-white font-medium rounded-xl shadow-md shadow-purple-200/50 hover:shadow-lg transition-all transform active:scale-[0.98] tracking-wide text-sm cursor-pointer">
                            Iniciar Sesión
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-plantilla>