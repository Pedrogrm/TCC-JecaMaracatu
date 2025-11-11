<?php


include ("protect.php");

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>JecaMaracatu</title>
</head>
<body>
  <div id="game">
    <header>
      <div class="log">
        <img src="img/icon.png" alt="">
        <!-- <h1>JecaMaracatu</h1> -->
      </div>
      <nav>
        <button id="btnAbrirConfig"><img src="img/configuracao.png" alt=""></button>
        <button id="btnAbrirLoja"><img src="img/mercado.png" alt=""></button>
        <button id="btnAbrirReceitas"><img src="img/receitas.png" alt=""></button>
        <button id="btnAbrirPerfil"><img src="img/perfil.png" alt=""></button>
      </nav>

      <div class="dinheiro-display">
        <span><img src="img/saco.png" alt=""></span>
        <span id="dinheiro-quantidade">25</span>
      </div>
    </header>
  </div>

  <main>
    
      <img id="mesa1" src="img-cenario/Mesa.png">
      <img id="mesa2" src="img-cenario/Mesa.png">
      <img id="mesa3" src="img-cenario/Mesa.png">
      <div id="parede"></div>
      <div id="parede2"></div>
      <div id="chao"></div>

    <div class="tela" id="game-area">
      <img src="img-cenario/fundo.png" alt="fundo" class="fundo">
      <img src="img/Jeca-paradoR.gif" id="player" class="player" alt="Player">
    </div>
  </main>

  <!-- Script do jogo -->
  <!-- <script>
    const game-area = document.getElementById("game-area");
    const player = document.getElementById("player");

    let posX = game-area.clientWidth / 2; // posição inicial central
    let posY = game-area.clientHeight / 2;
    let targetX = posX;
    let targetY = posY;
    const speed = 6;

    player.style.position = "absolute";
    player.style.left = posX + "px";
    player.style.top = posY + "px";

    function update() {
      const dx = targetX - posX;
      const dy = targetY - posY;
      const distance = Math.sqrt(dx * dx + dy * dy);

      if (distance > 3) {
        posX += (dx / distance) * speed;
        posY += (dy / distance) * speed;
        player.style.left = posX + "px";
        player.style.top = posY + "px";
      }

      requestAnimationFrame(update);
    }

    game-area.addEventListener("click", (event) => {
      const rect = game-area.getBoundingClientRect();
      targetX = event.clientX - rect.left - 5;
      targetY = event.clientY - rect.top - 5;
    });

    update();
  </script> -->

  <!-- Modal Receitas -->
  <div id="receitas" class="modal">
    <div class="modal-content">
      <span class="fechar">&times;</span>
      <h2>📒 Receitas</h2>
      <p>Este é o conteúdo do seu modal.</p>
    </div>
  </div>

  <!-- Modal Loja -->
  <div id="loja" class="modal">
    <div class="modal-content">
      <span class="fechar">&times;</span>
      <h2>🛒 Loja de Power-ups</h2>

      <div id="powerupsLoja">
        <div class="powerup" id="powerup-velocidade">
          <h4>Pés Rápidos</h4>
          <p>Velocidade +10</p>
          <p>Custo: <span class="preco">10</span> 💰</p>
          <button id="btnAumentarVelocidade">Comprar</button>
        </div>

        <div class="powerup" id="powerup-vida">
          <h4>Bom Cozinheiro</h4>
          <p>+5 de paciência</p>
          <p>Custo: <span class="preco">15</span> 💰</p>
          <button id="btnAumentarVida">Comprar</button>
        </div>

        <div class="powerup" id="powerup-dano">
          <h4>Tempero Especial</h4>
          <p>+5% de bônus</p>
          <p>Custo: <span class="preco">20</span> 💰</p>
          <button id="btnAumentarDano">Comprar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Perfil -->
  <div id="perfil" class="modal">
    <div class="modal-content">
      <span class="fechar">&times;</span>
      <h2>👤 Perfil</h2>
      Bem Vindo!, <?php echo $_SESSION['nome']; ?>

      <p>
        <a href="logout.php">Sair</a>
      </p>
    </div>
  </div>

  <!-- Modal Configurações -->
  <div id="config" class="modal">
    <div class="modal-content">
      <span class="fechar">&times;</span>
      <h2>⚙️ Configurações</h2>
      <div class="config-opcoes">
        <button id="btnSom">🔊 Som: Ativado</button>
        <button id="btnLinguagem">🌐 Linguagem: Português</button>
        <button id="btnJacquin">👨‍🍳 Érick Jacquin</button>
      </div>
    </div>
  </div>

  <!-- Modal teste -->
  <!-- <div id="teste" class="modal">
  <div class="modal-content">
    <span class="fechar">&times;</span>
    <h2>teste</h2>
    Bem Vindo!, <?php echo $_SESSION['nome']; ?>
  </div>
</div> -->

  <!-- Script principal -->
  <script src="script.js"></script>
</body>
</html>

<!-- gryg -->

