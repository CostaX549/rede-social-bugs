<div>

  @if(session('msg'))
            <h1>{{session('msg')}}  </h1>
  @endif          
         
  
  
      <section class="posts">
            <div class="posts-header">
                  <h1>Página Inicial</h1>
             
                  <div class="posts-preference">
                      <button wire:click="allPosts">
                  <span  class="{{ $preferencia === 'all' ? 'selected-preference' : '' }}">Todas as Comunidades</span>
                  </button>
                  <button wire:click="myCommunities" >
                  <span  class="{{ $preferencia === 'minhasComunidades' ? 'selected-preference' : '' }}">Minhas Comunidades</span>
              </button>
              </div>
          </div>
        
            <div class="user-post">
              <img class="icon" src="/img/iconenetflix.png" alt="Foto de Perfil do Usuário">
          
           <livewire:create-post />
          
           <div class="mediaIcons">
             <svg id="svgElement" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"  />
              <circle cx="8.5" cy="8.5" r="1.5" />
              <path d="M21 15l-5-5L5 21" />
              
          </svg>
          <svg id="videoElement" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video">
            <path d="M23 7l-7 5 7 5V7z" />
            <rect x="1" y="5" width="15" height="14" rx="2" ry="2" /></svg>
          </div>  

            </div>
         
        <div wire:poll="refreshPosts">
            @forelse($this->posts as $post)
            <div  wire:key="post-{{ $post->id }}" >
       
            <div class="posts-body" >
              <div class="user-info">
              <img src="/img/iconenetflixazul.jpg" alt="Foto de Perfil do Usuário">
          
              <span>{{ $post->user->name }}</span>
              <span><span>@</span>{{ $post->user->username }}</span>
        
              <div class="community-image">
               
                @if(isset($post->community->image))
                  <img  src="{{ asset('storage/'. $post->community->image )}}" style="object-fit: cover;" alt="bob">
                  @endif
            
          </div>
              </div>
              <div class="post-info" >
                <span style="display: flex;" wire:key="conteudo-{{ $post->id }}">{{ $post->conteudo}}</span>
           
                @if(isset($post->image))
                <div class="post-image" wire:key="image-{{ $post->id }}">
                <img  src="{{ asset('storage/' . $post->image) }}" alt="Imagem do Post">
              </div>
                @endif
                @if (isset($post->video))
                <div wire:key="video-{{ $post->id }}">
                    <video  class="my-video" controls id="video-{{ $post->id }}">
                        <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
                        Seu navegador não suporta a exibição de vídeos.
                    </video>
                </div>
            @endif


           <div class="likeButton">    
            
            @if ($this->user->likes->contains($post))
            <button wire:click="like({{ $post->id }})" class="dislike-animation">
              
              
                    <i class='bx bxs-heart'></i>  {{ $post->likedBy->count() }}
             
              
            </button>
        @else
            <button wire:click="like({{ $post->id }})" class="like-animation" >
          
          
              
                    <i class='bx bx-heart'></i>  {{ $post->likedBy->count() }}
                 
              
            </button>
        @endif
     
    </div> 
                      
          @foreach($post->likedBy as $user)
                <p>{{$user->username}}</p>
          @endforeach      
       
          @if($post->user_id === auth()->user()->id)
          <div class="button-delete">
            <button class="trash-icon" wire:click="deletePost({{ $post->id }})" wire:key="delete-{{ $post->id }}" wire:confirm="Você tem certeza que quer deletar este post?">
              <i class='bx bx-trash'></i>
          </button>
        </div>
        @endif
              </div>
            </div>
       
          
            @empty 
     <h1  style="text-align: center;">Nenhum post.</h1>
      @endforelse

    
  </div>
</div>
      </section>
    
   
  
  </div>
  