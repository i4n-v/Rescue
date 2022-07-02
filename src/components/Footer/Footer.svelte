<script>
  import { Link } from "../";
  import LogoFooter from "../../assets/svg/LogoFooter.svelte";
  import Instagram from "../../assets/svg/Instagram.svelte";
  import Facebook from "../../assets/svg/Facebook.svelte";
  import Youtube from "../../assets/svg/Youtube.svelte";
</script>

<footer id="footer">
  <section>
    <div>
      <Link href="/" className="link-span-2">
        <LogoFooter />
      </Link>
      <div>
        <h2 class="footer-title">CONTATO</h2>
        <ul class="footer-info">
          <li>+55 81 99999-999</li>
          <li>contato@email.com</li>
        </ul>
        <ul class="footer-info">
          <li>Rua Madona, 42 - Bota Fogo</li>
          <li>Pernambuco - PE</li>
        </ul>
        <ul class="footer-info social-media">
          <li><Link href="#"><Instagram /></Link></li>
          <li><Link href="#"><Facebook /></Link></li>
          <li><Link href="#"><Youtube /></Link></li>
        </ul>
      </div>
      <nav>
        <h2 class="footer-title">INFORMAÇÕES</h2>
        <ul class="footer-info gap">
          <li><Link href="/inicio" className="footer-links">Explorar</Link></li>
          <li><Link href="#" className="footer-links">Contato</Link></li>
          <li><Link href="/duvidas" className="footer-links">Dúvidas</Link></li>
        </ul>
      </nav>
    </div>
    <p>Rescue © alguns direitos reservados.</p>
  </section>
</footer>

<style>
  #footer {
    display: flex;
    justify-content: center;
    width: 100%;
    min-height: 474px;
    padding: 60px 12px 32px 12px;
    background: var(--c12);
  }

  #footer > section {
    width: 100%;
    max-width: 1160px;
  }

  #footer > section > p {
    font: var(--roboto-s);
    color: var(--c06);
    margin-top: 60px;
  }

  #footer > section > div {
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 40px;
  }

  .footer-title {
    font: var(--roboto-l-b);
    color: var(--w);
    letter-spacing: 1.5px;
    margin-bottom: 32px;
  }

  .footer-info {
    list-style: none;
    width: 360px;
    padding: 16px 0px;
  }

  .gap {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .footer-info + .footer-info {
    border-top: 2px solid;
    border-color: var(--c11);
  }

  .footer-info > li {
    font: var(--roboto-m);
    color: var(--c05);
  }

  :global(.footer-links) {
    text-decoration: none;
    font: var(--roboto-m);
    color: var(--c05);
    transition: 0.3s ease-in-out;
  }

  :global(.footer-links:hover) {
    color: var(--p01);
  }

  .social-media {
    display: flex;
    gap: 32px;
  }

  @media (max-width: 970px) {
    #footer > section > div {
      grid-template-columns: 1fr 1fr;
    }

    :global(.link-span-2) {
      grid-column: 1/-1;
    }
  }

  @media (max-width: 775px) {
    #footer > section > div {
      grid-template-columns: 1fr;
    }
  }
</style>
