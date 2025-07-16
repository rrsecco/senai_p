<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
  <title>Sigepe 9.14</title>

  <!-- Layout da página -->
  <style>
    body,
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html,
    body {
      max-height: 100vh;
      background: #000;
      color: #fff;
      font-family: Arial, sans-serif;
    }

    .o-container {
      display: grid;
      grid-template-areas:
        "aside main main"
        "footer footer footer";
      grid-template-columns: 20% 80%;
      grid-template-rows: 1fr auto;
      height: 99vh;
      width: 96%;
      gap: 0.5rem;
      margin: 1rem auto;
    }

    .o-aside,
    .o-main,
    .o-footer {
      background: #000;
      color: #fff;
      border-radius: 10px;
      border-style: groove;
    }

    .o-aside {
      grid-area: aside;
      padding: 1rem;
      height: 100%;
    }

    .o-main {
      grid-area: main;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      height: 100%;
    }

    .o-footer {
      grid-area: footer;
      padding: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      flex-wrap: wrap;
      background-color: #000;
      box-sizing: border-box;
      overflow: hidden;
      /* Impede transbordamento */
      max-height: 93%;
      /* Evita ultrapassar o contêiner */
      border-radius: 10px;
      /* Garante que a borda se aplique a tudo */
      height: auto;
    }

    .o-footer * {
      max-width: 100%;
      box-sizing: border-box;
      overflow-wrap: break-word;
      /* Evita que textos ou tags longas quebrem o layout */
    }

    .o-footer a.weatherwidget-io {
      width: 100%;
      height: auto;
      display: block;
    }

    .carousel-item {
      position: relative;
      width: 100%;
      min-width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .carousel-slide {
      display: flex;
      transition: transform 0.5s ease-in-out;
      width: 100%;
      height: 100%;
    }

    .media-container {
      position: relative;
      width: 100%;
      height: 100%;
      max-height: 100%;
      overflow: hidden;
    }

    .carousel-item img,
    .carousel-item video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      /* object-fit: cover; */
      border-radius: 10px;
      z-index: 1;
    }

    .custom-style {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      padding: 10px;
      background: rgba(0, 0, 0, 0.6);
      color: white;
      text-align: justify;
      font-size: 14px;
      font-family: Arial, Helvetica, sans-serif;
      z-index: 2;
    }

    @media (max-width: 768px) {
      .o-container {
        display: flex;
        flex-direction: column;
        height: auto;
        width: 100%;
        margin: 0;
        gap: 0;
      }

      .o-aside,
      .o-main,
      .o-footer {
        width: 100%;
        margin: 0;
        border: none;
        border-radius: 0;
      }

      .o-main {
        height: 60vh;
      }

      .media-container {
        height: 100%;
      }

      .custom-style {
        font-size: 12px;
        padding: 8px;
      }

      .o-footer {
        padding: 5px;
      }

      .o-footer a.weatherwidget-io {
        font-size: 11px;
      }
    }
  </style>

  <!-- CARROSSEL -->
  <style>
    @keyframes pulse {
      0% {
        transform: scale(1);
        opacity: 1;
      }

      50% {
        transform: scale(1.05);
        opacity: 0.8;
      }

      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    .info-unavailable {
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #000;
    }

    .info-unavailable-text {
      color: #fff;
      font-size: 50px;
      text-align: center;
      animation: pulse 2s infinite;
    }
  </style>

  <!-- Widget e Horario Mundial-->
  <style>
    :root {
      --bg-dark: #111;
      --bg-light: #f9f9f9;
      --text-dark: #fff;
      --text-light: #111;
      --accent: #fff;
    }

    .widget-box {
      width: 100%;
      max-width: 600px;
      margin: 10px auto;
      padding: 5px;
      border-radius: 8px;
      font-family: 'Segoe UI', sans-serif;
      transition: all 0.4s ease;
      box-shadow: 0 0 20px rgba(0, 255, 204, 0.2);
      background: linear-gradient(135deg, var(--bg-dark), #222);
      color: var(--text-dark);
      border: 2px solid var(--accent);
    }

    .widget-box h2,
    .widget-box h3,
    .widget-box h4 {
      text-align: center;
      font-size: 16px;
      margin-bottom: 5px;
    }

    .moeda,
    .horario-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: rgba(255, 255, 255, 0.05);
      padding: 5px;
      border-radius: 8px;
      margin-bottom: 5px;
      transition: background 0.3s ease;
      background-color: #fff;
      font-size: small;
      color: #000;
    }

    .moeda:hover,
    .horario-item:hover {
      background-color: rgba(0, 255, 204, 0.15);
    }

    .moeda div {
      display: flex;
      align-items: center;
      font-weight: 600;
    }

    .moeda img {
      margin-right: 8px;
      vertical-align: middle;
    }

    .moeda span,
    .horario-item span {
      /* font-weight: bold; */
      font-size: small;
      color: #000;
    }

    .atualizado {
      text-align: center;
      margin-top: 10px;
      font-size: 10px;
      color: #aaa;
      font-style: italic;
    }

    .horario-item:last-child {
      margin-bottom: 0;
    }
  </style>

  <!-- Scroll -->
  <style>
    .scroll-vertical {
      width: 100vh;
      height: 20vh;
      /* altura do container */
      overflow: hidden;
      /* esconde o que ultrapassa a altura */
      position: relative;
    }

    .scroll-vertical img {
      width: 100%;
      height: auto;
      position: relative;
      object-fit: cover;
      animation: scrollUp 8s linear infinite;
    }

    @keyframes scrollUp {
      0% {
        top: 100%;
        /* imagem começa abaixo do container */
      }

      100% {
        top: -100%;
        /* imagem sobe para sair acima do container */
      }
    }
  </style>
</head>

<body>
  <div class="o-container">
    <!-- ASIDE -->
    <div class="o-aside">
      <div id="myDIV"><button type="button" onclick="ativarFullscreenERegistrar()" style="background: rgba(0, 0, 0, 0.6); color:#fff"><i class="fa fa-arrows-alt"></i> Tela cheia</button></div>
      <div class="logo">
        <img class="img-profile rounded" src="./img/senai.svg" alt="Logo da Empresa" style="width: 100%;">
        <p style="text-align: center; font-family: 'Segoe UI', sans-serif; font-size: 1.2rem; font-weight: 600; color: #fff; margin: 20px 0; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">Escola SENAI "Santo Paschoal Crepaldi"</p>
      </div>
      <hr>
      <div class="scroll-vertical">
        <img src="./app/views/outdoor/curso1.jpeg" alt="Imagem com scroll vertical">
      </div>
      <hr>
      <!-- ✅ Widget de Cotações e Horários Integrado -->
      <div class="widget-box">
        <h4>Cotações em Tempo Real</h4>
        <div class="horario-item">
          <div><img src="https://flagcdn.com/16x12/us.png" alt="USD"> USD/BRL</div><span id="usd"></span>
        </div>
        <div class="horario-item">
          <div><img src="https://flagcdn.com/16x12/eu.png" alt="EUR"> EUR/BRL</div><span id="eur"></span>
        </div>
        <div class="horario-item">
          <div><img src="https://flagcdn.com/16x12/br.png" alt="BRL"> BRL/USD</div><span id="brl_usd"></span>
        </div>
        <div class="horario-item">
          <div><img src="https://flagcdn.com/16x12/br.png" alt="BRL"> BRL/EUR</div><span id="brl_eur"></span>
        </div>
        <div class="atualizado" id="hora"></div>
      </div>
      <hr>
      <div class="widget-box">
        <h4>Horário Mundial</h4>
        <div class="horario-item">
          <div><img src="https://flagcdn.com/16x12/br.png" alt="BRL"> Brasília</div><span id="hora_brasilia"></span>
        </div>
        <div class="horario-item">
          <div><img src="https://flagcdn.com/16x12/us.png" alt="BRL"> Washington</div><span id="hora_washington"></span>
        </div>
        <div class="horario-item">
          <div><img src="https://flagcdn.com/16x12/jp.png" alt="BRL"> Tóquio</div><span id="hora_tokyo"></span>
        </div>
        <div class="horario-item">
          <div><img src="https://flagcdn.com/16x12/gb.png" alt="BRL"> Londres</div><span id="hora_londres"></span>
        </div>
      </div>
    </div>

    <!-- CARROSSEL -->
    <div class="o-main">
      <div class="carousel-slide"><!-- conteúdo será carregado dinamicamente --></div>
    </div>

    <!-- RODAPÉ -->
    <div class="o-footer">
      <a class="weatherwidget-io" href="https://forecast7.com/pt/n22d12n51d39/presidente-prudente/"
        data-label_1="Pres. Prudente" data-label_2="HOJE" data-theme="original" data-basecolor="#000">PRESIDENTE
        PRUDENTE WEATHER</a>
    </div>
  </div>

  <!-- FUNÇÃO TELA CHEIA -->
  <script>
    // Ativar fullscreen
    function requestFullScreen() {
      const el = document.documentElement;
      if (el.requestFullscreen) el.requestFullscreen();
      else if (el.mozRequestFullScreen) el.mozRequestFullScreen();
      else if (el.webkitRequestFullscreen) el.webkitRequestFullscreen();
      else if (el.msRequestFullscreen) el.msRequestFullscreen();
    }

    // Verifica se está em fullscreen
    function isFullScreenActive() {
      return document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement;
    }

    // Salva no localStorage quando fullscreen for ativado
    function ativarFullscreenERegistrar() {
      requestFullScreen();
      localStorage.setItem('fullscreenAtivo', '1');
    }

    // Remove flag do localStorage se fullscreen for perdido
    document.addEventListener('fullscreenchange', () => {
      if (!isFullScreenActive()) {
        localStorage.removeItem('fullscreenAtivo');
      }
    });

    // Ao carregar a página, verifica se deve restaurar fullscreen
    window.addEventListener('load', () => {
      if (localStorage.getItem('fullscreenAtivo') === '1') {
        setTimeout(() => {
          requestFullScreen();
        }, 500); // Delay para garantir que a página está pronta
      }
    });
  </script>

  <!-- SCRIPT DO CARROSSEL -->
  <script>
    let counter = 0;
    let items = [];
    let intervalId = null;
    let ultimaAtualizacao = null;

    function showSlide(index) {
      if (intervalId) clearTimeout(intervalId); // limpa qualquer timeout anterior

      items.forEach((item, i) => {
        item.style.display = i === index ? 'block' : 'none';
      });

      const currentItem = items[index];
      const video = currentItem.querySelector('video');

      if (video) {
        video.currentTime = 0;
        video.play();

        video.onended = () => {
          nextSlide();
        };
      } else {
        intervalId = setTimeout(nextSlide, 15000); // imagem: 15s
      }
    }

    function nextSlide() {
      counter = (counter + 1) % items.length;
      showSlide(counter);
    }

    async function atualizarCarrossel() {
      try {
        const estavaFullscreen = isFullScreenActive();

        const res = await fetch('./apiUltimasMidias');
        const data = await res.json();

        const dtaHoje = new Date().toISOString().split('T')[0];
        const container = document.querySelector('.carousel-slide');
        container.innerHTML = '';

        data.indoor.forEach((mi) => {
          const valido = mi.dataf >= dtaHoje;
          const temItens = data.itensPorMidia[mi.idmindoor];

          if (valido && temItens) {
            data.itensPorMidia[mi.idmindoor].forEach(item => {
              const arquivo = item.img_nome;
              const ext = arquivo.split('.').pop().toLowerCase();
              const isVideo = ['mp4', 'webm', 'ogg', 'avi', 'mov', 'flv', 'wmv'].includes(ext);

              const itemHTML = `
                <div class="carousel-item" style="display:none;">
                  <div class="media-container">
                    ${isVideo
                  ? `<video muted playsinline preload="auto">
                          <source src="./app/views/outdoor/${arquivo}" type="video/${ext}">
                          Seu navegador não suporta vídeo.
                        </video>`
                  : `<img src="./app/views/outdoor/${arquivo}" alt="Imagem Indoor">`
                }
                    ${(mi.acao || mi.descricao)
                  ? `<div class="custom-style">
                          ${mi.acao ? `<span><strong>Ação:</strong> ${mi.acao}</span><br>` : '-----'}
                          ${mi.descricao ? `<span><strong>Cenário Formativo:</strong> ${mi.descricao}</span>` : '-----'}
                        </div>`
                  : ''
                }
                  </div>
                </div>
              `;
              container.insertAdjacentHTML('beforeend', itemHTML);
            });
          }
        });

        if (!container.children.length) {
          container.innerHTML = `<div class="info-unavailable"><div class="info-unavailable-text">Informações Indisponíveis!</div></div>`;
        }

        items = document.querySelectorAll('.carousel-item');
        counter = 0;
        showSlide(counter);

        if (estavaFullscreen) {
          setTimeout(() => requestFullScreen(), 300);
        }
      } catch (err) {
        console.error('Erro ao atualizar o carrossel:', err);
      }
    }

    async function verificarAtualizacoes() {
      try {
        const res = await fetch('./apiStatusMidias');
        const data = await res.json();

        if (!ultimaAtualizacao || ultimaAtualizacao !== data.updated_at) {
          ultimaAtualizacao = data.updated_at;
          await atualizarCarrossel(); // só atualiza se mudou
        }
      } catch (err) {
        console.error("Erro ao verificar atualização:", err);
      }
    }

    window.onload = function () {
      verificarAtualizacoes(); // inicial
      setInterval(verificarAtualizacoes, 10000); // checa a cada 10s
    };
  </script>

  <!-- SCRIPT DAS COTAÇÕES -->
  <script>
    async function atualizarCotacoes() {
      try {
        const res = await fetch("https://economia.awesomeapi.com.br/last/USD-BRL,EUR-BRL");
        const data = await res.json();

        const usd = parseFloat(data.USDBRL.bid).toFixed(2);
        const eur = parseFloat(data.EURBRL.bid).toFixed(2);
        const brl_usd = (1 / parseFloat(data.USDBRL.bid)).toFixed(4);
        const brl_eur = (1 / parseFloat(data.EURBRL.bid)).toFixed(4);

        document.getElementById("usd").textContent = `R$ ${usd}`;
        document.getElementById("eur").textContent = `R$ ${eur}`;
        document.getElementById("brl_usd").textContent = `$ ${brl_usd}`;
        document.getElementById("brl_eur").textContent = `€ ${brl_eur}`;

        const agora = new Date();
        document.getElementById("hora").textContent =
          `Atualizado: ${agora.toLocaleTimeString('pt-BR')}`;
      } catch (error) {
        console.error("Erro ao carregar cotações:", error);
      }
    }

    atualizarCotacoes();
    setInterval(atualizarCotacoes, 60000); // Atualiza a cada 60 segundos
  </script>

  <!-- SCRIPT DO HORÁRIO MUNDIAL -->
  <script>
    function atualizarHorarios() {
      const now = new Date();

      const bras = new Date(now.toLocaleString("en-US", { timeZone: "America/Sao_Paulo" }));
      const wash = new Date(now.toLocaleString("en-US", { timeZone: "America/New_York" }));
      const tokyo = new Date(now.toLocaleString("en-US", { timeZone: "Asia/Tokyo" }));
      const lond = new Date(now.toLocaleString("en-US", { timeZone: "Europe/London" }));

      const formatar = (data) => data.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });

      document.getElementById("hora_brasilia").textContent = formatar(bras);
      document.getElementById("hora_washington").textContent = formatar(wash);
      document.getElementById("hora_tokyo").textContent = formatar(tokyo);
      document.getElementById("hora_londres").textContent = formatar(lond);
    }

    atualizarHorarios();
    setInterval(atualizarHorarios, 60000);
  </script>

  <!-- Widget do tempo -->
  <script>
    (function (d, s, id) {
      const js = d.createElement(s), fjs = d.getElementsByTagName(s)[0];
      if (!d.getElementById(id)) {
        js.id = id;
        js.src = 'https://weatherwidget.io/js/widget.min.js';
        fjs.parentNode.insertBefore(js, fjs);
      }
    })(document, 'script', 'weatherwidget-io-js');
  </script>
</body>

</html>