<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mensagens;


class Mensagem extends Component
{
    public function render()
    {
         
        $user = auth()->user();
        $amigos = $user->friends;
     
        
      
        $mensagensDeAmigos = [];

        foreach ($amigos as $amigo) {
        $mensagens = Mensagens::where(function ($query) use ($user, $amigo) {
            $query->where('sender_id', $user->id)->where('receiver_id', $amigo->id);
        })->orWhere(function ($query) use ($user, $amigo) {
            $query->where('sender_id', $amigo->id)->where('receiver_id', $user->id);
        })->latest()->first();
    
        $mensagensDeAmigos[$amigo->name] = $mensagens;
    }
        
   
         
        return view('livewire.mensagens',compact("amigos", 'mensagensDeAmigos'));
    }
}
