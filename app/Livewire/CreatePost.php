<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\Post;
use Livewire\WithFileUploads;

class CreatePost extends Component
{ 

    use WithFileUploads;

    #[Rule('required_without_all:image,video|max:100')]
    public $conteudo;

    #[Rule('required_without_all:conteudo,video|max:100240')]
    public $image;

    #[Rule('required_without_all:conteudo,image')]
    public $video;

     public function post()
    {
        $this->validate();

        $user = auth()->user()->id;
        $post = new Post;
        $post->conteudo = $this->conteudo;
        $post->user_id = $user;

        if ($this->video) {
            $videoPath = $this->video->store('uploads', 'public');
            $post->video = $videoPath;
        }

        if ($this->image) {
            $imagePath = $this->image->store('uploads', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        $this->conteudo = '';
        $this->image = null;
        $this->video = null;
        $this->dispatch('post-created');
        $this->dispatch('message', title: 'Post criado com sucesso.');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
