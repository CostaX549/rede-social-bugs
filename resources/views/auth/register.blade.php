@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-container">
        <form class="form" action="{{ route('register') }}" method="POST">
            @csrf
            <h2>Registro</h2>
            <input type="text" placeholder="Nome de usuário" name="username" value="{{ old('username') }}" required>
            @error('username')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="text" placeholder="Apelido" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="text" placeholder="Email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="password" placeholder="Senha" name="password" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="password" placeholder="Confirmar Senha" name="password_confirmation" required>
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <button type="submit">Registrar</button>
        </form>
    </div>

    <div class="image-container">
        <img class="image" src="/img/GameMedia.png" alt="Imagem">
    </div>
</div>

<style>
    .text-danger {
        color: red;
    }
    
</style>
@endsection
