<script>
  import { UnderlineButton, Link } from "../../components";
  import ToTopPage from "../../helper/ToTopPage.svelte";
  import Water from "../../assets/svg/Water.svelte";
  import Doubts from "../../assets/svg/Doubts.svelte";
  import DoubtsMin from "../../assets/svg/DoubtsMin.svelte";
  import computerImage from "../../assets/img/computer-img.png";

  const institutions = ["PEongs", "IFPE", "GOV", "UPE"];
</script>

<svelte:head>
  <title>Rescue</title>
</svelte:head>

<ToTopPage>
  <div id="rescue-intro">
    <div />
    <section id="titles">
      <h3 class="main-subtitle">AQUI SUA AÇÃO FAZ DIFERENÇA</h3>
      <h1 class="main-title">
        Nos ajude a cuidar da nossa comunidade<span>.</span>
      </h1>
    </section>
  </div>
  <section id="complaint-info">
    <div class="complaint-description">
      <h2 class="main-title">
        Denuncie os seus problemas<span>.</span>
      </h2>
      <p class="description">
        Através de pequenas postagens você será um herói, nos ajudando a salvar
        pessoas, resolver problemas e tornar nossa comunidade cada vez melhor.
      </p>
      <UnderlineButton href="/cadastro"
        >CONHEÇA NOSSA COMUNIDADE</UnderlineButton
      >
    </div>
    <div>
      <img src={computerImage} alt="imagem de pessoa no computador." />
    </div>
  </section>
  <section id="patners-info">
    <div>
      <div>
        <h2 class="main-title">
          conheça nossos parceiros<span>.</span>
        </h2>
        <p class="description">
          Estão sempre preparados pra analisar e resolver sua dificuldade.
        </p>
      </div>
      <ul>
        {#each institutions as institution}
          <li>
            <Water />
            <span>{institution}</span>
          </li>
        {/each}
      </ul>
    </div>
  </section>
  <section id="doubt-info">
    <div class="big">
      <Doubts />
    </div>
    <div class="min">
      <DoubtsMin />
    </div>
    <div>
      <h2 class="main-title">
        Denuncie os seus problemas<span>.</span>
      </h2>
      <p class="description">
        Buscamos sanar toda e qualquer questão que você tiver. Mas antes de nos
        contatar dê uma olhada nas <Link href="/duvidas" className="action-link"
          >dúvidas frequentes</Link
        >
        dos nossos usuários.
      </p>
    </div>
  </section>
</ToTopPage>

<style>
  /* Introduction */
  #rescue-intro {
    width: 100%;
    height: 500px;
    position: relative;
    background: url("../../assets/img/rescue-home.jpg") center no-repeat;
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0px 12px;
  }

  #rescue-intro > div {
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.65);
    position: absolute;
    top: 0;
    left: 0;
  }

  #titles {
    width: 100%;
    max-width: 1160px;
    position: relative;
    z-index: 2;
  }

  .main-title {
    font: var(--poppins-xxl);
    color: var(--w);
    max-width: 560px;
  }

  .main-title > span {
    color: var(--p01);
  }

  .main-subtitle {
    font: var(--roboto-l-b);
    color: var(--c02);
    margin-bottom: 8px;
  }

  /* Complaint */
  #complaint-info {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    margin: auto;
    padding: 0px 12px;
    width: 100%;
    max-width: 1308px;
    margin: 120px auto;
  }

  #complaint-info > div {
    min-width: 300px;
    flex: 1;
  }

  .complaint-description {
    max-width: 560px;
  }

  #complaint-info h2 {
    margin-bottom: 32px;
    color: var(--c11);
  }

  #complaint-info img {
    min-width: 300px;
    width: 100%;
    box-shadow: var(--shadow01);
  }

  #complaint-info p {
    margin-bottom: 20px;
  }

  .description {
    font: var(--roboto-l);
    color: var(--c09);
  }

  /* Patners */
  #patners-info {
    width: 100%;
    height: 548px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-inline-end: 0px 12px;
    background: var(--c11);
  }

  #patners-info h2 {
    margin-bottom: 32px;
  }

  #patners-info p {
    color: var(--c05);
  }

  #patners-info > div {
    width: 100%;
    max-width: 1160px;
    display: flex;
    flex-direction: column;
    gap: 60px;
  }

  #patners-info ul {
    list-style: none;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
  }

  #patners-info ul > li {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    height: 120px;
    font: var(--poppins-xl);
    color: var(--c02);
  }

  #patners-info ul > li + li {
    flex: 1;
    border-left: 2px solid var(--c10);
  }

  /* Doubts */
  #doubt-info {
    display: flex;
    flex-wrap: wrap-reverse;
    width: 100%;
    max-width: 1160px;
    gap: 40px;
    margin: 120px auto;
  }

  #doubt-info > div {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 32px;
  }

  #doubt-info h2 {
    color: var(--c11);
  }

  .big {
    display: block !important;
  }

  .min {
    display: none !important;
  }

  :global(.action-link) {
    text-decoration: none;
    color: var(--p01);
    font: var(--roboto-l-b);
    transition: 0.3s ease-in-out;
  }

  :global(.action-link:hover) {
    color: var(--p03);
  }

  @media (max-width: 600px) {
    #rescue-intro {
      height: 300px;
    }

    .main-title {
      font: var(--poppins-xl);
    }

    .main-subtitle {
      font: var(--roboto-m);
    }

    #patners-info ul > li {
      font: var(--poppins-m);
    }

    .description {
      font: var(--roboto-s);
    }
  }

  @media (max-width: 700px) {
    .big {
      display: none !important;
    }
    .min {
      display: block !important;
    }
  }

  @media (max-width: 750px) {
    #patners-info ul {
      grid-template-columns: 1fr 1fr;
    }
  }
</style>
