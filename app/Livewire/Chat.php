<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Mensagens;
use Livewire\Attributes\On; 

use Livewire\Attributes\Url;



class Chat extends Component
{
     public $id,$user, $mensagem, $userId, $friendId, $authenticatedUserId, $amigo, $authenticatedUser, $mensagensDeAmigos, $amigos;
     public $selectedFriendId = null;
     public $messages = [];
     public $pageTitle = 'Mensagens';
     public $isMobile = false;

  
     

     
     public $search = '';


     
     #[On('atualizarIsMobile')] 
     public function atualizarIsMobile($value)
     {
         $this->isMobile = $value;
     }

     public function backToConversations()
{
    $this->selectedFriendId = null; // Defina $selectedFriendId como nulo para voltar à lista de conversas
}

     public function updatedIsMobile($value)
     {
         $this->isMobile = $value;
     }

     #[On('mensagem-atualizada')]
    public function loadMessages(int $friendId) {
     
        $this->authenticatedUserId = auth()->user()->id;

        $authenticatedUserId =auth()->user()->id;

        $user = auth()->user();
     
        $this->friendId = $friendId;

   

        $this->amigo = User::findOrFail($this->friendId);


        if($user->friends->contains($this->amigo)) {

          $this->selectedFriendId = $friendId;
    
     


       $this->messages = Mensagens::where(function ($query) use ($friendId, $authenticatedUserId) {
            $query->where('receiver_id', $authenticatedUserId)
                ->where('sender_id', $friendId);
        })->orWhere(function ($query) use ($friendId, $authenticatedUserId) {
            $query->where('receiver_id', $friendId)
                ->where('sender_id', $authenticatedUserId);
        })->get();

        $this->atualizarMensagensDosAmigos();
    } else {
     $this->dispatch('message', title:'Você não tem acesso a esse amigo', type: 'warning');
    }
      
    }

  

    public function updatePageTitle() {
        if ($this->selectedFriendId) {
            $amigo = User::find($this->friendId);
            $this->pageTitle = "Mensagens / " . $amigo->name;
        } else {
            $this->pageTitle = 'Mensagens';
        }
    }
 

    public function storeMessage() {

     

        $message = new Mensagens;

        $message->mensagem = $this->mensagem;

        $message->receiver_id = $this->selectedFriendId;

        $message->sender_id = $this->authenticatedUserId;

        $message->save();

        $this->loadMessages($this->selectedFriendId);

     

        $this->mensagem = '';

  

        $this->dispatch('mensagem-atualizada', friendId: $this->selectedFriendId );

        $this->dispatch('message', title:'Mensagem enviada com sucesso.', type:'success');

        $this->atualizarMensagensDosAmigos();

        
     }

     private function buscarMensagensDeAmigos($amigos)
     {
         $authenticatedUserId = auth()->user()->id;
         $mensagensDeAmigos = [];
 
         foreach ($amigos as $amigo) {
             $mensagens = Mensagens::where(function ($query) use ($authenticatedUserId, $amigo) {
                 $query->where('sender_id', $this->authenticatedUserId)->where('receiver_id', $amigo->id);
             })->orWhere(function ($query) use ($authenticatedUserId, $amigo) {
                 $query->where('sender_id', $amigo->id)->where('receiver_id', $authenticatedUserId);
             })->latest()->first();
 
             $mensagensDeAmigos[$amigo->id] = $mensagens;
         }

         
         
         return $mensagensDeAmigos;
     }

     public function atualizarMensagensDosAmigos()
     {
      

     
   
         $this->mensagensDeAmigos = $this->buscarMensagensDeAmigos($this->amigos);

         $this->dispatch('message-actualized');
    
     }

    
     #[On('message-actualized')] 
    public function render()
    {
     

   $this->authenticatedUser = auth()->user();
    $this->amigos = $this->authenticatedUser->friends;


       
  
    
        return view('livewire.chat', [
            'amigos' => $this->amigos, 
            'mensagensDeAmigos' => $this->mensagensDeAmigos
        ])
        ->layout('components.layouts.mensagem');
          
     
    }


    
}
