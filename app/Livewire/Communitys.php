<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Community;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;

class Communitys extends Component
{
    use WithFileUploads;
    #[Rule('required|image|max:10240')]
    public $image;
    #[Rule('required|string|min:3')]
    public $name;
    #[Rule('required|string|min:3')]
    public $description;

    public function storeCommunity() {
        $community = new Community;
        $community->name = $this->name;
        $community->owner_id = auth()->user()->id;
        $community->description = $this->description;

        $imagem = $this->image->store('uploads', 'public');

        $community->image = $imagem;

        
        $user = auth()->user();

      
        
        $community->save();

        $community->users()->attach($user); 

        $this->image = null;

        $this->dispatch('communityCreated');

    }
    public function participar(int $communityId) {
        $user = auth()->user();
        
        $community = Community::findOrFail($communityId);

        if($community->users->contains($user)) {
            $this->dispatch('message', title:'Você já é participante dessa comunidade', type:'warning');
        } else {

   


       

        $community->users()->attach($user);

    }

    }



    public function delete(int $communityId) {
        $community = Community::findOrFail($communityId);
        $imagePath = $community->image;
        if ($imagePath) {
            
            Storage::disk('public')->delete($imagePath);
        }
        $community->delete();
    }
    public function render()
    {
      $user = auth()->user();
     $communitys = Community::all();
        return view('livewire.communitys', compact('communitys', 'user'));
    }
}
