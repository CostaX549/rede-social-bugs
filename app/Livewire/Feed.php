<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;


use App\Models\Community;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;

class Feed extends Component
{
    public $preferencia = 'all';


    public $loadedPosts = 10;

  public function placeholder() {
   
        return <<<'HTML'
        <div class="spinner">
         
        </div>
        HTML;
  
  }

    public function allPosts()
    {
        $this->preferencia = 'all';
    }

    public function like(int $postId){
        $user = auth()->user();
           $post = Post::findOrFail($postId);
   
            
           if ($user->likes()->where('post_id', $post->id)->exists()) {
           
                
               $user->likes()->detach($post);
   
            
         
   
      
      
           $post->save(); 
   
           $this->dispatch('liked');
               
       
          
       } else {
           $user->likes()->attach($post);
   
           $post->save();
           $this->dispatch('liked');
       }
      
   
       }
   
   
    public function myCommunities()
    {
        $this->preferencia = 'minhasComunidades';
    }

  
    public function loadMorePosts()
    {
        $this->loadedPosts += 10;
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id === auth()->user()->id) {
            $imagePath = $post->image;
            $videoPath = $post->video;

            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            if ($videoPath) {
                Storage::disk('public')->delete($videoPath);
            }

            $post->delete();
            $this->dispatch('message', title: 'Post deletado com sucesso.', type: 'success');
        }
    }

    #[On('liked')]
  
    #[Computed]
    public function posts()
    {
        $user = auth()->user();

        if ($this->preferencia === 'all') {
            $posts = Post::latest()->get();
        } else {
            $postsFromMemberCommunities = $user->communitys->flatMap(function ($community) {
                return $community->posts;
            });

            $posts = $postsFromMemberCommunities->sortByDesc('created_at');
        }
       
        return $posts;
    }

    public function refreshPosts() {
        $this->posts();
    }
    #[Computed]
    public function user() {
        $user = auth()->user();
     

        return $user;
    }
    public function render()
    {
      
        return view('livewire.feed');
    }
}
