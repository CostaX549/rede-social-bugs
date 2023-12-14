<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\FriendshipRequest;
use Illuminate\Support\Facades\Auth;

class NotificationCounter extends Component
{

    public $notificationsCount;

    #[On('solicitation-sended')] 
    public function checkSolicitationsCount()
    {
        if (Auth::check()) {
        return $this->notificationsCount = FriendshipRequest::where('receiver_id',Auth::id())->where('accepted', '0')->count();
        } else {
            return $this->notificationsCount = 0;
        }
    }
    public function render()
    {
        $this->notificationsCount = $this->checkSolicitationsCount();
        return view('livewire.notification-counter', [
            'notificationsCount' => $this->notificationsCount
        ]);
    }
}
