<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FriendshipRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Attributes\On; 

class UsersModal extends Component
{
    public $search = '';
    public $modalOpen = false;
    
 
    public function openModal()
    {
        $this->modalOpen = true;
   
    }

    public function sendSolicitation(int $userId) {
        $friendShip = new FriendshipRequest;

        $friendShip->sender_id = auth()->user()->id;

        $friendShip->receiver_id = $userId;

        
     
        $friendShip->save();

         $this->dispatch('solicitation-sended');

        $this->dispatch('message', title:'Solicitação enviada com sucesso.', type:'success');

      
    }

    public function closeModal()
    {
        $this->modalOpen = false;
   
      
    }
    public function render()
    {

 
    $friendIds = FriendshipRequest::where('sender_id', Auth::id())->pluck('receiver_id')->toArray();
    $userIds = FriendshipRequest::where('receiver_id', Auth::id())->pluck('sender_id')->toArray();
    $users = User::where('id', '!=', Auth::id())
    ->whereNotIn('id', $friendIds)
    
    ->whereNotIn('id', $userIds)
    ->where('username', 'like', '%'.$this->search.'%')
    ->get();
    
   
        return view('livewire.users-modal', compact('users'))
        ->layout('components.layouts.app');
    }
}
