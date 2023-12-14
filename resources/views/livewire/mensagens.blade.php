<div>
  @forelse($amigos as $amigo)
  <a href="/mensagens/{{ $amigo->id }}">
  <div class="nomes">
      
          <span>{{$amigo->name}}</span>
      
      @if (isset($mensagensDeAmigos[$amigo->name]))
          <div class="ultima-mensagem">
              <span>{{$mensagensDeAmigos[$amigo->name]->mensagem}}</span>
              <span class="timestamp">{{$mensagensDeAmigos[$amigo->name]->created_at->diffForHumans()}}</span>
          </div>
    
      @endif
  </div>
</a>
  @empty
  <span>Nenhum amigo encontrado</span>
  @endforelse
</div>