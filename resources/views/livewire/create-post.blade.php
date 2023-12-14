<div>
<form wire:submit.prevent="post" class="post-form" >
                
                <input type="text" wire:model="conteudo" placeholder="O que está acontecendo?">
                @error('conteudo') <h1>{{  $message }}</h1>  @enderror
                <div id="modalImage" class="modal-image" wire:ignore.self >
      
                  <div class="modal-content">
                    <span id="closeModalBtnImage" class="close">&times;</span>
                    <h2>Enviar uma imagem</h2>
                    <div class="svg">
                    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
                      <rect x="3" y="3" width="18" height="18" rx="2" ry="2"  />
                      <circle cx="8.5" cy="8.5" r="1.5" />
                      <path d="M21 15l-5-5L5 21" />
                  </svg>
                 </div>
                <label class="inputFile">
                  <span class="inputFile-custom"></span>
                  <input type="file" id="file" wire:model="image">
                  @error('image')  <h1>{{ $message }}</h1>              @enderror
                  <div wire:loading wire:target="image">Uploading...</div>
              </label>
         
              @if ($image && !$errors->has('image'))
              <div id="fileInfo">
                  <img id="imagePreview" src="{{ $image->temporaryUrl() }}" alt="Image Preview" style="max-width: 70%; object-fit: cover; border-radius: 5px;">
              </div>
          @endif
                  </div>
              </div>
              <div id="modalVideo" class="modal" wire:ignore.self >
      
                <div class="modal-content">
                  <span id="closeModalBtnVideo" class="close">&times;</span>
                  <h2>Enviar um vídeo</h2>
                  <div class="svg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video">
                      <path d="M23 7l-7 5 7 5V7z" />
                      <rect x="1" y="5" width="15" height="14" rx="2" ry="2" /></svg>
              </div>
              <label class="inputFile">
                <span class="inputFile-custom"></span>
                <input type="file" id="file" wire:model="video"    wire:click="$set('video', null); ">
                @error('video')  <h1>{{ $message }}</h1>              @enderror
              </label>
            
                <div class="spinner"  wire:loading wire:target="video"></div>
        
                @if($video && !$errors->has('video'))
                <div style="padding: 20px;"  >
                <video controls  >
                    <source src="{{ $video->temporaryUrl()}}" type="video/mp4" >
                    Seu navegador não suporta a exibição de vídeos.
                </video>
               
              </div>
             @endif
        
                 
                </div>
               </div>
                <button type="submit">Postar</button>
               </form>
</div>
