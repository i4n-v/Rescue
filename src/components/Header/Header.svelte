<script>
  import { Link, OutlinedButton, Dropdown } from "../";
  import Logo from "../../assets/svg/Logo.svelte";
  import MenuMobileIcon from "../../assets/svg/MobileMenuIcon.svelte";

  const dropdownLinks = [
    { name: "Explorar", href: "/inicio" },
    { name: "Entrar", href: "/login" },
    { name: "registre-se", href: "/cadastro" },
  ];

  let displayDropdown = false;

  function togleDropdown() {
    displayDropdown = !displayDropdown;
  }
</script>

<header id="header-menu">
  <div>
    <Link href="/">
      <Logo />
    </Link>
    <nav class="menu">
      <Link href="/inicio" className="menu-link">Explorar</Link>
      <Link href="/login" className="menu-link">Entrar</Link>
      <OutlinedButton href="/cadastro">Registre-se</OutlinedButton>
    </nav>
    <MenuMobileIcon className="mobile-button" onClick={togleDropdown} />
    <Dropdown display={displayDropdown} links={dropdownLinks} />
  </div>
</header>

<style>
  #header-menu {
    background: var(--w);
    width: 100%;
    height: 96px;
    box-shadow: var(--shadow01);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0px 12px;
  }

  #header-menu > div {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    max-width: 1160px;
    position: relative;
  }

  :global(.menu-link) {
    text-decoration: none;
    font: var(--poppins-m);
    color: var(--c07);
    transition: 0.1s ease-in-out;
  }

  :global(.menu-link:hover) {
    color: var(--p01);
  }

  .menu {
    display: flex;
    align-items: center;
    gap: 40px;
  }

  :global(.mobile-button) {
    cursor: pointer;
    display: none;
  }

  :global(.mobile-button > *) {
    fill: var(--c11);
  }

  @media (max-width: 700px) {
    :global(.mobile-button) {
      display: block;
    }

    .menu {
      display: none;
    }
  }
</style>
