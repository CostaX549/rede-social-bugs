<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>
  <main>
    <div class="container">
      <img src="/img/GameMedia.png" alt="">
      <div class="btn-group">
        @guest
        <a href="/login"><button>Entrar</button></a>
        <a href="/register"><button>Registrar-se</button></a>
        @endguest
        @auth
        <a href="/home"><button>Acessar o Feed</button></a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <button>
           Sair
        </button>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endauth
      </div>
    </div>
    <h1 style="color: black;">Comunidades mais Populares</h1>
    <!-- Três caixas (boxes) embaixo do container -->
    <div class="boxes">
      <div class="box">
        <img src="/img/valorant.jpeg">
        <hr>
        <p>Valorant é um FPS tático 5x5 que tem como objetivo plantar ou desarmar a Spike. Os jogadores têm apenas uma
          vida por rodada e a partida é vencida pela equipe que ganhar 13 rodadas (de 25) primeiro.</p>
      </div>
      <div class="box">
        <img src="/img/valorant.jpeg">
        <hr>
        <p>Valorant é um FPS tático 5x5 que tem como objetivo plantar ou desarmar a Spike. Os jogadores têm apenas uma
          vida por rodada e a partida é vencida pela equipe que ganhar 13 rodadas (de 25) primeiro.</p>
      </div>
      <div class="box">
        <img src="/img/valorant.jpeg">
        <hr>
        <p>Valorant é um FPS tático 5x5 que tem como objetivo plantar ou desarmar a Spike. Os jogadores têm apenas uma
          vida por rodada e a partida é vencida pela equipe que ganhar 13 rodadas (de 25) primeiro.</p>
      </div>
    </div>

    <div class="feedback-container">
      <h1>Feedbacks</h1>
      <div class="boxes">
        <div class="card">
          <div class="user">
            <img src="/img/iconenetflix.png" alt="Usuário">
            <span>@pedrinho</span>
        
          <div class="textarea">
            <p>Através dessa rede social encontrei um duo! Recomendo muito</p>
          </div>
        </div>
        </div>
        <div class="card"> <div class="user">
          <img src="/img/iconenetflixvermelho.png" alt="Usuário">
          <span>@bobinho</span>
      
        <div class="textarea">
          <p>Através dessa rede social encontrei um duo! Recomendo muito</p>
        </div>
      </div></div>
        <div class="card"> <div class="user">
          <img src="/img/iconenetflixazul.jpg" alt="Usuário">
          <span>@rafael</span>
      
        <div class="textarea">
          <p>Através dessa rede social encontrei um duo! Recomendo muito</p>
        </div>
      </div></div>
      </div>

    </div>
    <section class="contact">
      <div class="contact-info">
          <div class="first-info">
              <img src="/img/logo.png" alt="">
  
              <p>3245 Grant Street Longview, <br> TX united kingdom 765378</p>
              <p>01601348732</p>
              <p>saiudulahmed3080@gmail.com</p>
  
              <div class="social-icon">
                  <a href=""><i class='bx bxl-facebook'></i></a>
                  <a href=""><i class='bx bxl-twitter'></i></a>
                  <a href=""><i class='bx bxl-instagram'></i></a>
                  <a href=""><i class='bx bxl-youtube'></i></a>
                  <a href=""><i class='bx bxl-linkedin'></i></a>
              </div>
          </div>
          <div class="second-info">
              <h4>Suporte</h4>
              <p>Contate-nos</p>
              <p>Sobre a página</p>
              <p>Guia de tamanhos</p>
              <p>Política de devolução</p>
              <p>Privacidade</p>
          </div>
          <div class="third-info">
              <h4>Compre</h4>
              <p>Roupas Masculinas</p>
              <p>Roupas Femininas</p>
              <p>Vestimenta Infantil</p>
              <p>Móveis</p>
              <p>Descontos</p>
          </div>
          <div class="fourth-info">
              <h4>Empresa</h4>
              <p>Sobre</p>
              <p>Blog</p>
              <p>Afiliações</p>
              <p>Streaming</p>
              <p>Login</p>
          </div>
          <div class="five">
            <h4>gamemedia</h4>
           <img src="/img/gamemedia.jpg" alt="">
           
          </div>
         
      </div>
     
  </section>
  <div class="end-text">
    <p>Copyright © @2023. Todos os Direitos Reservados.</p>
</div>  
  </main>
  <script src="script.js" defer></script>
</body>

</html>

