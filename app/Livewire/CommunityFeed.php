<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Community;
use Livewire\WithFileUploads;
use App\Models\Post;

class CommunityFeed extends Component
{

    use WithFileUploads;

    public $community;
    public $video;
    public $image;
    public $conteudo;

   

    public function mount(int $id) {
        $this->community = Community::findOrFail($id);

    }

    #[On('post-created')] 
public function refreshPosts()
{
    $this->render();
 
}


    public function post() {
        $user = auth()->user()->id;
        $post = new Post;
        $post->conteudo = $this->conteudo;
        $post->community_id = $this->community->id;
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
        $this->dispatch('message', title: 'Post criado com sucesso.', type: 'success');
    }

    public function like(int $postId){
        $user = auth()->user();
        $post = Post::findOrFail($postId);

     
        if ($user->likes()->where('post_id', $post->id)->exists()) {
        
            $this->dispatch('message', title: 'Post já foi curtido', type: 'warning');
            
    
       
    } else {
        $user->likes()->attach($post);
        $this->dispatch('message', title: 'Post curtido com sucesso', type: 'success');
        $post->likes = $post->likedBy->count();
        $post->save();
    }
    }

    public function dislike(int $postId) {
        $user = auth()->user();
        $post = Post::findOrFail($postId);

      
         
            $user->likes()->detach($post);

            $this->dispatch('message', title: 'Post descurtido com sucesso', type: 'success');
           

   
        $post->likes = $post->likedBy->count();
        $post->save();
 
    }

    public function deletePost($id) {
        $post = Post::findOrFail($id);
    
        $post->delete();
    
        $imagePath = $post->image;
    
        $videoPath = $post->video;
        if ($imagePath) {
            
            Storage::disk('public')->delete($imagePath);
        }
    
        if($videoPath) {
            Storage::disk('public')->delete($videoPath);
        }
    
        $this->dispatch('message', title: 'Post deletado com sucesso.', type: 'success');
    }
    

    public function render()
    {
        $user = auth()->user();
        $posts = $this->community->posts()->latest('created_at') ->get();
        return view('livewire.community-feed', compact('posts', 'user'));
    }
}
