<div class="root">
  
   



    <header>

        <div class="container">

            <div class="profile">

                <div class="profile-image">

                    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=152&h=152&fit=crop&crop=faces" alt="">

                </div>

                <div class="profile-user-settings">

                    <h1 class="profile-user-name">Comunidades</h1>

                    <button class="btn profile-edit-btn" onclick="openModal()">Criar Comunidade</button>

                    <button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>

                </div>

                <div class="profile-stats">

                    <ul>
                        <li><span class="profile-stat-count">{{ $communitys->count() }}</span> comunidades</li>
                        @php
                        $allCommunitysUsers = 0; 
                        foreach ($communitys as $community) {
                            $membros = $community->users->count();
                            $allCommunitysUsers += $membros;
                        }
                       @endphp
                        <li><span class="profile-stat-count">{{ $allCommunitysUsers }}</span> participantes</li>
                
                    </ul>

                </div>

                <div class="profile-bio">

                    <p><span class="profile-real-name">Comunidades </span>são meios de interação essenciais para descobrir o  que você mais gosta!</p>

                </div>

            </div>
            <!-- End of profile section -->

        </div>
        <!-- End of container -->

    </header>

    <main>

        <div class="container">
        
            <div class="gallery">
                @foreach($communitys as $community)
             <a href="/comunidades/{{ $community->id }}">
                <div class="gallery-item" tabindex="0">
                
                    <img src="{{ asset('storage/' . $community->image )}}" class="gallery-image" alt="">
             
                    <div class="gallery-item-info">

                        <ul>
                          
                        </ul>

                    </div>

                </div>
            </a>
       
               @endforeach
               
            </div>
            <!-- End of gallery -->

  

        </div>
        <!-- End of container -->

    </main>

    
   <div id="modal-image" class="modal" wire:ignore.self >
    
        <div class="modal-content">
          <span id="closeModalBtnVideo"  onclick="closeModal()" class="close">&times;</span>
          <h2>Criar uma comunidade</h2>
          <div class="svg">
            <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 48 48"><path fill="#ffffff" d="M15 17a6 6 0 1 0 0-12a6 6 0 0 0 0 12Zm18 0a6 6 0 1 0 0-12a6 6 0 0 0 0 12ZM4 22.446A3.446 3.446 0 0 1 7.446 19h9.624A7.963 7.963 0 0 0 16 23a7.98 7.98 0 0 0 2.708 6h-2.262a5.444 5.444 0 0 0-4.707 2.705c-3.222-.632-5.18-2.203-6.32-3.968C4 25.54 4 23.27 4 22.877v-.43ZM31.554 29a5.444 5.444 0 0 1 4.707 2.705c3.222-.632 5.18-2.203 6.32-3.968C44 25.54 44 23.27 44 22.877v-.43A3.446 3.446 0 0 0 40.554 19H30.93A7.963 7.963 0 0 1 32 23a7.98 7.98 0 0 1-2.708 6h2.262ZM30 23a6 6 0 1 1-12 0a6 6 0 0 1 12 0ZM13 34.446A3.446 3.446 0 0 1 16.446 31h15.108A3.446 3.446 0 0 1 35 34.446v.431c0 .394 0 2.663-1.419 4.86C32.098 42.033 29.233 44 24 44s-8.098-1.967-9.581-4.263C13 37.54 13 35.27 13 34.877v-.43Z"/></svg>
      </div>
      <form wire:submit.prevent="storeCommunity">
      <label class="inputFile">
        <span class="inputFile-custom"></span>
        <input type="file" id="file" wire:model="image">
        @error('image')  <h1>{{ $message }}</h1>              @enderror
        <div wire:loading wire:target="image">Uploading...</div>
    </label>
    @if ($image && !$errors->has('image'))
    <div id="fileInfo">
        <h1>Imagem da Comunidade</h1>
        <img id="imagePreview" src="{{ $image->temporaryUrl() }}" alt="Image Preview" style="max-width: 70%; object-fit: cover; border-radius: 5px;">
        <input type="text" wire:model="name" placeholder="Digite o nome da comunidade...">
        <textarea wire:model="description"  cols="5" rows="5" placeholder="Digite uma breve descrição da comunidade..."></textarea>
        <button type="submit">Criar Comunidade</button>
    </div>

     @endif
 
    </form>
        </div>

         </div> 
     
</div>
