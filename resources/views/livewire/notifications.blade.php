<div>

  <section class="notifications">
   
      @forelse($solicitations as $solicitation)
          <div class="notification-item" wire:poll="checkNewNotifications">
              <img src="/img/iconenetflixazul.jpg" alt="">
              <div class="notification-content">
                  <span class="sender-name">{{ $solicitation->sender->name }}</span>
                  <p class="sender-username">{{ $solicitation->sender->username }}</p>
              </div>
              <div class="notification-actions">
                  <button class="accept" wire:click="acceptSolicitation({{ $solicitation->id }})"
                      wire:loading.attr="disabled" wire:target="acceptSolicitation({{ $solicitation->id }})">
                     Aceitar
                  </button>
                  <button class="reject" wire:click="rejectSolicitation({{ $solicitation->id }})"
                      wire:loading.attr="disabled" wire:target="rejectSolicitation({{ $solicitation->id }})">
                      Rejeitar
                  </button>
              </div>
          </div>
      @empty
          <h1>Nenhum notificação encontrada.</h1>
      @endforelse
  </section>

</div>
