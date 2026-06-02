<x-plantilla>
    <h1>Login Administradores</h1>
    @if (session('error'))
        {{ session('error') }}
    @endif
    <form action="{{ route('loginAdmin') }}" method="POST">
    @csrf <label>Correo Electrónico</label>
    <input type="email" name="email" value="{{ old('email') }}" required>
    @error('email') <span>{{ $message }}</span> @enderror

    <label>Contraseña</label>
    <input type="password" name="contraseña" required>

    <button type="submit">Iniciar Sesión</button>
</form>
</x-plantilla>