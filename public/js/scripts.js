
// Verifica se o elemento com ID "openModal" existe antes de adicionar um ouvinte de evento
if (document.getElementById("openModal")) {
  document.getElementById("openModal").addEventListener("click", function() {
      var modal = document.getElementById("modal");
      if (modal) {
          modal.style.display = "block";
      }
  });
}

// Verifica se o elemento com ID "openModal2" existe antes de adicionar um ouvinte de evento
if (document.getElementById("openModal2")) {
  document.getElementById("openModal2").addEventListener("click", function() {
      var modal = document.getElementById("modal");
      if (modal) {
          modal.style.display = "block";
      }
  });
}

// Verifica se o elemento com ID "closeModalBtn" existe antes de adicionar um ouvinte de evento
if (document.querySelector("#closeModalBtn")) {
  document.querySelector("#closeModalBtn").addEventListener("click", function() {
      var modal = document.getElementById("modal");
      if (modal) {
          modal.style.display = "none";
      }
  });
}


var closeModalBtnImage = document.querySelector("#closeModalBtnImage");
if (closeModalBtnImage) {
   closeModalBtnImage.addEventListener("click", function() {
      var modalImage = document.getElementById("modalImage");
      if (modalImage) {
         modalImage.style.display = "none";
      }
   });
}

var svgElement = document.getElementById("svgElement");
if (svgElement) {
   svgElement.addEventListener("click", function() {
      var modalImage = document.getElementById("modalImage");
      if (modalImage) {
         modalImage.style.display = "block";
      }
   });
}

var modal = document.querySelector(".modal");
if (modal) {
   modal.addEventListener("click", function(e) {
      if (e.target === modal) {
         var modalImage = document.getElementById("modalImage");
         if (modalImage) {
            modalImage.style.display = "none";
         }
      }
   });
}

var closeModalBtnVideo = document.querySelector("#closeModalBtnVideo");
if (closeModalBtnVideo) {
   closeModalBtnVideo.addEventListener("click", function() {
      var modalVideo = document.getElementById("modalVideo");
      if (modalVideo) {
         modalVideo.style.display = "none";
      }
   });
}

var videoElement = document.getElementById("videoElement");
if (videoElement) {
   videoElement.addEventListener("click", function() {
      var modalVideo = document.getElementById("modalVideo");
      if (modalVideo) {
         modalVideo.style.display = "block";
      }
   });
}

if (modal) {
   modal.addEventListener("click", function(e) {
      if (e.target === modal) {
         var modalVideo = document.getElementById("modalVideo");
         if (modalVideo) {
            modalVideo.style.display = "none";
         }
      }
   });
}

   

// Quando o botão de abrir modal é clicado
function verificarTamanhoDaTela() {
  var isMobile = window.innerWidth <= 1000;

  Livewire.dispatch('atualizarIsMobile', {
     value: isMobile
  });
}


window.addEventListener('resize', verificarTamanhoDaTela);


function toggleNavbar() {
  var navbar = document.getElementById("navbar");
  navbar.classList.toggle("open");

  if (navbar.classList.contains("open")) {
      // Adiciona um ouvinte de clique no documento quando a navbar está aberta
      document.addEventListener("click", closeNavbarOutside);
  } else {
      // Remove o ouvinte de clique do documento quando a navbar está fechada
      document.removeEventListener("click", closeNavbarOutside);
  }
}

function closeNavbarOutside(event) {
  var navbar = document.getElementById("navbar");

  // Verifica se o clique ocorreu fora da barra de navegação
  if (!navbar.contains(event.target) && !document.getElementById("menuIcon").contains(event.target)) {
      // Fecha a barra de navegação
      navbar.classList.remove("open");
      // Remove o ouvinte de clique do documento
      document.removeEventListener("click", closeNavbarOutside);
  }
}

if(document.getElementById('modal-image')) {


function openModal() {
  var modal = document.getElementById('modal-image');
  modal.style.display = 'block';
}



// Função para fechar o modal
function closeModal() {
  var modal = document.getElementById('modal-image');
  modal.style.display = 'none';
}    


  Livewire.on('communityCreated', function () {
 
      closeModal();
  });

}