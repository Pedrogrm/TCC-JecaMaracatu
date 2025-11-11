console.log("✅ Script carregado com sucesso!");


// ===================================
// 📜 SCRIPT DE MOVIMENTO 
// ===================================

// 👇 Seletores atualizados
const gameArea = document.getElementById('game-area');
const player = document.getElementById('player');

let move = false;
let posX = 300; // posição inicial
let posY = 200;
let targetX = posX;
let targetY = posY;
let endposition = "right"; // Guarda a última direção

// 👇 Use 'let playerSpeed' para que a loja possa modificá-la
let playerSpeed = 6; 

// Atualiza posição do personagem a cada frame
function update() {
  const dx = targetX - posX;
  const dy = targetY - posY;
  const distance = Math.sqrt(dx * dx + dy * dy);

  // Se estiver longe, move o jogador
  if (distance > 3) {
    move = true;
    
    // 👇 Usando 'playerSpeed' (que pode ser alterada pela loja)
    posX += (dx / distance) * playerSpeed;
    posY += (dy / distance) * playerSpeed;

    player.style.left = posX + "px";
    player.style.top = posY + "px";
  
  // Se parou de se mover, muda o sprite para "parado"
  } else if (distance <= 3 && move == true) {
    move = false;
    
    if (endposition == "left") {
      player.src = "img/Jeca-paradoL.gif";
    }
    if (endposition == "right") {
      player.src = "img/Jeca-paradoR.gif";
    }
  }
  requestAnimationFrame(update);
}

// Detecta clique e define novo destino
gameArea.addEventListener('click', (event) => {
  move = true;
  const rect = gameArea.getBoundingClientRect();
  targetX = event.clientX - rect.left;
  targetY = event.clientY - rect.top - 70; // Ajuste do clique

  // Muda o sprite para "correndo"
  if (targetX < posX) {
    player.src = "img/Jeca-correndoL.gif";
    endposition = "left";
  } else {
    player.src = "img/Jeca-correndoR.gif";
    endposition = "right";
  }
});

update(); // inicia loop de animação


// ===================================
// ⚙️ LÓGICA DOS MODAIS (Versão Otimizada)
// ===================================

function setupModal(btnId, modalId) {
  const btn = document.getElementById(btnId);
  const modal = document.getElementById(modalId);
  
  // Verifica se os elementos existem antes de adicionar eventos
  if (!btn || !modal) {
    console.warn(`Elemento de modal não encontrado: ${btnId} ou ${modalId}`);
    return;
  }

  const span = modal.querySelector(".fechar");
  if (!span) {
    console.warn(`Botão .fechar não encontrado no modal: ${modalId}`);
    return;
  }

  // Abrir o modal
  btn.addEventListener("click", () => {
    // Usamos 'flex' por causa do seu CSS para centralizar
    modal.style.display = "flex"; 
  });

  // Fechar pelo "X"
  span.addEventListener("click", () => {
    modal.style.display = "none";
  });

  // Fechar clicando fora
  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
}

// Configura todos os modais
setupModal("btnAbrirConfig", "config");
setupModal("btnAbrirLoja", "loja");
setupModal("btnAbrirReceitas", "receitas");
setupModal("btnAbrirPerfil", "perfil");

// ===================================
// 🔉 BOTÕES DAS CONFIGURAÇÕES 
// ===================================
const btnSom = document.getElementById("btnSom");
let somAtivado = true;

if (btnSom) {
  btnSom.onclick = () => {
    somAtivado = !somAtivado;
    btnSom.textContent = somAtivado ? "🔊 Som: Ativado" : "🔇 Som: Desativado";
  };
}

const btnLinguagem = document.getElementById("btnLinguagem");
let idiomaAtual = "pt";

if (btnLinguagem) {
  btnLinguagem.onclick = () => {
  idiomaAtual = idiomaAtual === "pt" ? "en" : "pt";
  btnLinguagem.textContent =
    idiomaAtual === "pt"
    ? "🌐 Linguagem: Português"
    : "🌐 Language: English";
  };
}

const btnJacquin = document.getElementById("btnJacquin");
if (btnJacquin) {
  btnJacquin.onclick = () => {
  alert("VOCE É VERGONHAA DA POFESSON!");
  };
}


// ===================================
// 💰 LÓGICA DA LOJA 
// ===================================
let dinheiro = 25;
let paciencia = 0;
let bonus = 0;

function atualizarDinheiro() {
  const display = document.getElementById("dinheiro-quantidade");
  if (display) display.textContent = dinheiro;
}

function comprarPowerUp(custo, efeito) {
  if (dinheiro >= custo) {
    dinheiro -= custo;
    efeito(); // Executa a ação do power-up
    atualizarDinheiro();
    alert("Compra realizada com sucesso!");
  } else {
    alert("Dinheiro insuficiente!");
  }
}

// Botões da loja
const btnVelocidade = document.getElementById("btnAumentarVelocidade");
const btnVida = document.getElementById("btnAumentarVida");
const btnDano = document.getElementById("btnAumentarDano");

if (btnVelocidade) {
  btnVelocidade.addEventListener("click", () =>
    comprarPowerUp(10, () => {
      // 👇 CONEXÃO FEITA!
      // Isto agora aumenta a variável 'playerSpeed' que o movimento usa
      playerSpeed += 1.5; // Aumentei para 0.5 para ser mais perceptível
      console.log("Velocidade agora:", playerSpeed.toFixed(2));
    })
  );
}

if (btnVida) {
  btnVida.addEventListener("click", () =>
    comprarPowerUp(15, () => {
      paciencia += 5;
      console.log("Paciência agora:", paciencia);
    })
  );
}

if (btnDano) {
  btnDano.addEventListener("click", () =>
    comprarPowerUp(20, () => {
      bonus += 0.05;
      console.log("Bônus agora:", (bonus * 100).toFixed(1) + "%");
    })
  );
}

// Inicia o display do dinheiro quando a página carrega
atualizarDinheiro();

// ===================================
//  Teste
// ===================================

// window.addEventListener("load", () => {
//   const modal = document.getElementById("teste");

//   if (!modal) {
//     console.warn("Modal #teste não encontrado!");
//     return;
//   }

//   // Verifica se já foi visto
//   const jaViu = localStorage.getItem("tutorialVisto");

//   if (!jaViu) {
//     // Mostra o modal
//     modal.style.display = "flex";
//     console.log("🟢 Modal aberto pela primeira vez");

//     // Salva no localStorage
//     localStorage.setItem("tutorialVisto", "true");
//   } else {
//     console.log("⚪ Modal já foi visto antes, não será exibido.");
//   }
// });

// window.addEventListener("load", () => {
//   const modal = document.getElementById("teste"); // ID do modal que tu quer abrir
//   const jaViu = sessionStorage.getItem("tutorialVisto");

//   // se ainda não viu o modal nesta aba
//   if (!jaViu) {
//     modal.style.display = "flex"; // mostra o modal
//     sessionStorage.setItem("tutorialVisto", "true"); // marca como visto
//   }
// });


// gryg