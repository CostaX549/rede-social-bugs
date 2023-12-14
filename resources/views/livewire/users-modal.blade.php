<div>


    <div id="modal" class="modal" wire:ignore.self >
    
        <div class="modal-content">
            <span id="closeModalBtn" class="close">&times;</span>
            <h2>Encontrar novos amigos</h2>
            <div class="search-bar" style="margin-left: auto;">
                <input type="text" wire:model.live="search" placeholder="Buscar..." />
            </div>
                   
       

 
            @if($search != '') 
            @forelse ($users as $user)
           
        
                <div class="msg">
                    <img class="msg-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%286%29.png" alt="" />
                    <div class="msg-detail">
                        <div class="msg-username">{{ $user->username }}</div>
                    </div>
                    <div class="msg-actions">
                        <button class="btn-action" wire:click.defer="sendSolicitation({{ $user->id }})"  >

                          Enviar Solicitação
                          
                            
                        </button>
                    </div>
                </div>
             @empty
             <h2>Nenhum usuário encontrado com o termo {{ $search }}.</h2>
            @endforelse
         @else
            <h2>Nenhum usuário pesquisado.</h2>
            @endif 
        </div>
    </div>
</div>
