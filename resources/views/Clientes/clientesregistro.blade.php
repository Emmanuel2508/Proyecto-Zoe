<x-plantilla>
    <div class="min-h-[85vh] flex flex-col justify-center items-center px-4 py-8">
        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl shadow-purple-100/30 border border-purple-100/40 overflow-hidden">
            
            <div class="bg-gradient-to-r from-[#fff5f8] via-[#f3e8f4] to-[#ffedf5] p-6 text-center border-b border-pink-100/40">
                <h1 class="text-2xl font-light tracking-[0.15em] text-[#3a3a3a] uppercase">
                    Crear Cuenta
                </h1>
                <p class="text-xs text-[#7c7275] mt-1 tracking-wide">Únete a ZÖE y gestiona tus compras fácilmente</p>
            </div>

            <div class="p-8">
                <form action="{{ route('clientes.guardar') }}" id="registro" method="POST" class="space-y-5">
                    @csrf 

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <div class="flex flex-col gap-1.5">
                            <label for="nombre" class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
                                Nombres
                            </label>
                            <input type="text" name="nombre" id="nombre" required
                                class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-purple-300 focus:bg-white transition-all text-sm">
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="apellido" class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
                                Apellidos
                            </label>
                            <input type="text" name="apellido" id="apellido" required
                                class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-purple-300 focus:bg-white transition-all text-sm">
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="email" class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
                                Correo Electrónico
                            </label>
                            <input type="email" name="email" id="email" required
                                class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-purple-300 focus:bg-white transition-all text-sm">
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="telefono" class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
                                Teléfono
                            </label>
                            <input type="number" name="telefono" id="telefono" required
                                class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-purple-300 focus:bg-white transition-all text-sm [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>

                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="direccion" class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
                            Dirección
                        </label>
                        <input type="text" name="direccion" id="direccion" required
                            class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-purple-300 focus:bg-white transition-all text-sm">
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="contraseña" class="text-xs uppercase tracking-wider text-[#7c7275] font-medium">
                            Contraseña
                        </label>
                        <input type="text" name="contraseña" id="contraseña" required
                            class="w-full px-4 py-2.5 bg-[#faf8f9] border border-pink-200/40 rounded-xl text-[#3a3a3a] focus:outline-none focus:border-purple-300 focus:bg-white transition-all text-sm">
                    </div>

                    <div class="pt-4">
                        <button type="submit" 
                            class="w-full py-3 bg-[#a29bb8] hover:bg-[#8f87a8] text-white font-medium rounded-xl shadow-md shadow-purple-200/40 hover:shadow-lg transition-all transform active:scale-[0.98] tracking-wide text-sm cursor-pointer">
                            Registrarme
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-plantilla>