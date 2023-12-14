@extends('layouts.app')

@section('content')



    <div class="container">

        <div class="form-container">
            <form class="form" method="POST" action="{{ route('login') }}">
                @csrf
                <h2 style="color: white;">Login</h2>
                <div class="form-buttons">
                    <input type="text" placeholder="Nome de usuário" name="username"  value="{{ old('username') }}" required>
                    @error('name')
                       <span> {{ $message }}</span>
                    @enderror
                    <input type="password" placeholder="Senha"  name="password" required>
                    @error('password')
                    <span> {{ $message }}</span>
                     @enderror
                    <button type="submit">Entrar</button>
                </form> 
                    <div class="sem-conta">
                        <span>Não tem uma conta?</span>
                        <a class="register-link" href="{{ route('register')}}">Registrar-se</a>
                    </div>
    
                    <a class="forget-password" href="{{ route('password.request') }}">Esqueceu a senha?</a>
                    
                </div>
     
        </div>
        

          
        <div class="image-container">
            <h1>Seja Bem-Vindo ao GameMedia</h1>
            <img class="image" src="/img/GameMedia.png" alt="Imagem">
        </div>
    </div>

@endsection
