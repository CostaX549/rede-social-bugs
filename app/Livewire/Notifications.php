<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FriendshipRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On; 

class Notifications extends Component
{

    public $solicitationId, $solicitations;

    public function acceptSolicitation(int $solicitationId) {
        $solicitation = FriendshipRequest::findOrFail($solicitationId);

        if(FriendshipRequest::where('receiver_id', auth()->user()->id)->where('sender_id', $solicitation->sender_id)->where('accepted', '1')->exists()) {
            $this->dispatch('message', title:'Essa solicitação já foi aceita', type: 'warning');
        
    
        } else if($solicitation->receiver_id == Auth::id())  {

        
            
            $solicitation->accepted = '1';

         
            $solicitation->sender->friends()->attach($solicitation->receiver_id);
            $solicitation->receiver->friends()->attach($solicitation->sender_id);
          
            $solicitation->save();
        
            $this->dispatch('solicitation-sended');
            $this->dispatch('message', title:'Solicitação aceitada com sucesso.', type:'success');  
           
        }
    
    }

    public function rejectSolicitation(int $solicitationId) {
        $solicitation = FriendshipRequest::findOrFail($solicitationId);

        if ($solicitation->receiver_id == Auth::id()) {
                $solicitation->delete();
                $this->dispatch('solicitation-sended');
                $this->dispatch('message', title:'Solicitação rejeitada com sucesso.', type:'success');
        }
  
    }


    #[On('solicitation-sended')] 
    public function checkNewNotifications() {
        $user = auth()->user();
    
        $this->solicitations = $user->receivedFriendshipRequests->where('accepted', '0');

    }


    public function render()
    {
          $this->checkNewNotifications();

        return view('livewire.notifications', [
            'solicitations' => $this->solicitations
        ]);
      
    }
}
