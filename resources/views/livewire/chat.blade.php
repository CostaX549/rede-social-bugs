
 


<div>

  <div class="app">
   <div class="header">
  
  
  
    <div class="logo x">
  
    </div>
  
    <div class="search-bar">
     <input type="text" placeholder="Search..." />
    </div>
    <div class="user-settings">
     <div class="dark-light">
      <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
       <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" /></svg>
     </div>
     <div class="settings">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
       <circle cx="12" cy="12" r="3" />
       <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" /></svg>
     </div>
     <img class="user-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" class="account-profile" alt="">
    </div>
   </div>
   <div class="wrapper">
    <div class="conversation-area"    @if($isMobile) @if (!$selectedFriendId) style="display: block;" @else style="display: none;" @endif @endif>
     @foreach($amigos as $amigo)
  
  
  
     <div class="msg  {{ $amigo->id == $selectedFriendId ? 'active' : '' }} {{ $amigo->status === "online" ? 'online' : ''}}"  wire:click.defer="loadMessages({{ $amigo->id }})">
      <img class="msg-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%286%29.png" alt="" />
      <div class="msg-detail" >
       <div class="msg-username">{{ $amigo->username }}</div>
       <div class="msg-content">
          @if (isset($mensagensDeAmigos[$amigo->id]))
          <div wire:poll.1000ms="atualizarMensagensDosAmigos">
        <span class="msg-message"> {{ $mensagensDeAmigos[$amigo->id]->mensagem }}</span>
        <span class="msg-date" >{{$mensagensDeAmigos[$amigo->id]->created_at->diffForHumans()}}</span>
      </div>
        @endif
       </div>
      </div>
      
     </div>
     @endforeach
  
    <div style="text-align: center; padding: 20px;">
     <button class="add" id="openModal" ></button>
    </div>
      @livewire('users-modal')
  
  
    </div>
  
  
    @if ($selectedFriendId)
    @php
     $amigo = App\Models\User::find($selectedFriendId);
    @endphp 
  
    <div class="chat-area" @if($isMobile) @if ($selectedFriendId ) style="display: flex;" @else style="display: none;"  @endif @endif>
  
     <div class="chat-area-header">
      <button id="voltar"  wire:click.defer="backToConversations"><i class='bx bx-arrow-back'></i></button>
      <div class="chat-area-title">{{ $amigo->name }}</div>
      <div class="chat-area-group">
       <img class="chat-area-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="" />
  
  
      </div>
     </div>
   
     <div class="chat-area-main">
   
   
     
  
  
      @forelse($messages as $message)
    
      @if($message->receiver_id == $authenticatedUserId)
      <div class="chat-msg"  wire:poll="loadMessages({{ $selectedFriendId }})">
     
       <div class="chat-msg-profile">
        <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="" />
        <div class="chat-msg-date">Enviado as {{ $message->created_at->format('H:i') }}</div>
       </div>
       <div class="chat-msg-content">
        <div class="chat-msg-text">{{ $message->mensagem }}</div>
     
       </div>
      </div>
      @elseif($message->sender_id == $authenticatedUserId)
      <div class="chat-msg owner">
       <div class="chat-msg-profile">
        <img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
        <div class="chat-msg-date">Enviado as {{ $message->created_at->format('H:i') }}</div>
       </div>
       <div class="chat-msg-content">
        <div class="chat-msg-text">{{ $message->mensagem }}</div>
      
       </div>
      </div>
     
      @endif
      @empty
  
      <h1 style="text-align: center; color: #fff;">Nenhuma mensagem encontrada.</h1>
      
      @endforelse
      
   
       
     </div>
     <div class="chat-area-footer">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video">
       <path d="M23 7l-7 5 7 5V7z" />
       <rect x="1" y="5" width="15" height="14" rx="2" ry="2" /></svg>
      <svg  id="openModalBtn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
       <rect x="3" y="3" width="18" height="18" rx="2" ry="2"   id="openModalBtn"/>
       <circle cx="8.5" cy="8.5" r="1.5" />
       <path  id="openModalBtn" d="M21 15l-5-5L5 21" /></svg>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle">
       <circle cx="12" cy="12" r="10" />
       <path d="M12 8v8M8 12h8" /></svg>
      <svg   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip">
       <path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48" /></svg>
       <form  wire:submit.prevent="storeMessage">
        <input type="text" wire:model="mensagem" placeholder="Digite algo aqui..." />
     
         </form>
        
         @else
         
    <div  class="chat-area" style="color: #fff; text-align: center; padding-top: 250px;">
      <i class='bx bx-message-square' style="font-size: 100px;"></i>
      <h2>Envie fotos e mensagens para um amigo ou grupo
      
      </h2>
     <button  class="sendMessage" id="openModal2" style="">Enviar mensagem</button>
    
     
    </div>
    @endif
      
     
     </div>
    </div>
    
  </div>
  
  
  
  </div>
  
  
  
  