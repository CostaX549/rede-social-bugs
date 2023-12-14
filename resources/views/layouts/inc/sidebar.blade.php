

@if(request()->is('mensagens') )

<nav   id="navbar" style="max-width: 115px;">
  
    <a  class="first-link" href="/home"><i class='bx bx-home-circle' ></i></a>
  
    <a href="/users"  wire:navigate><i class='bx bx-user' ></i> </a>
    <a href="/comunidades"  wire:navigate><i class='bx bx-compass' ></i></a>
   
    <a href="/mensagens"  wire:navigate><i class='bx bxs-message-square'></i></a>


    <a href="/notifications"  wire:navigate><i class='bx bx-bell' style='position: relative; font-size: 24px;'> <span class='notification-dot' style='
        position: absolute;
        top: -10px;
        right: -10px;
        width: 20px;
        height: 20px;
        text-align: center;
        justify-content: center;
        font-size: 20px;
        
        background-color: red;
        border-radius: 50%;
      '>@livewire('notification-counter')</span></i></a>
    <a wire:ignore href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class='bx bx-log-out'></i> 
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>
@else

<nav  style="width: 300px;" id="navbar">
    @if(request()->is('home'))
    <a  class="first-link" href="/home"  wire:navigate><i class='bx bxs-home-circle' ></i>Página Inicial</a>
    @else
    <a class="first-link" href="/home"  wire:navigate><i class='bx bx-home-circle' ></i>Página Inicial</a>
    @endif
    <a href="/users"  wire:navigate><i class='bx bx-user' ></i>Meu Perfil</a>
    <a href="/comunidades"  wire:navigate><i class='bx bx-compass' ></i>Explorar</a>
 

  
    <a href="/mensagens" ><i class='bx bx-message-square' ></i>Mensagens</a>

    <a href="/notifications"  wire:navigate><i class='bx bx-bell' style='position: relative; font-size: 24px;'> <span class='notification-dot' style='
        position: absolute;
        top: -10px;
        right: -10px;
        width: 20px;
        height: 20px;
        text-align: center;
        justify-content: center;
        font-size: 20px;
        
        background-color: red;
        border-radius: 50%;
      '>@livewire('notification-counter')</span></i>Notificações</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class='bx bx-log-out'></i> Sair
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>

@endif


<div onclick="toggleNavbar()" id="menuIcon">
<i class='bx bx-menu-alt-left'></i>
</div>