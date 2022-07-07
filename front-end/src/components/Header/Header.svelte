<script>
  import { Link, OutlinedButton, Dropdown } from "../";
  import { navigate } from "svelte-routing";
  import { limitName } from "../../scripts/utils";
  import Logo from "../../assets/svg/Logo.svelte";
  import MenuMobileIcon from "../../assets/svg/MobileMenuIcon.svelte";
  import Profile from "../../assets/svg/Profile.svelte";
  import cookie from "js-cookie";

  const token = cookie.get("access-token");
  const userName = cookie.get("user-name");

  function logout() {
    cookie.remove("access-token");
    cookie.remove("user-name");
    cookie.remove("user-id");

    navigate("/");
    navigate("/login", { replace: true });
    togleDropdown();
  }

  let dropdownLinks = [];
  let displayDropdown = false;

  function togleDropdown() {
    displayDropdown = !displayDropdown;
  }

  if (!!token) {
    dropdownLinks = [
      { name: "Perfil", href: "/perfil", onClick: togleDropdown },
      { name: "Configurações", href: "/configuracoes", onClick: togleDropdown },
      { name: "Sair", onClick: logout },
    ];
  } else {
    dropdownLinks = [
      { name: "Explorar", href: "/inicio", onClick: togleDropdown },
      { name: "Entrar", href: "/login", onClick: togleDropdown },
      { name: "registre-se", href: "/cadastro", onClick: togleDropdown },
    ];
  }
</script>

<header id="header-menu">
  <div>
    <Link href="/">
      <Logo />
    </Link>
    <nav class="menu">
      {#if !token}
        <Link href="/inicio" className="menu-link">Explorar</Link>
        <Link href="/login" className="menu-link">Entrar</Link>
        <OutlinedButton href="/cadastro">Registre-se</OutlinedButton>
      {:else}
        <Link href="/inicio" className="menu-link">Início</Link>
        <div id="profile-icon" on:click={togleDropdown}>
          <span>
            {limitName(userName, 2)}
          </span>
          <Profile />
        </div>
      {/if}
    </nav>
    <MenuMobileIcon className="mobile-button" onClick={togleDropdown} />
    <Dropdown
      display={displayDropdown}
      responsive={!token}
      links={dropdownLinks}
    />
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

  #profile-icon {
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    font: var(--poppins-m);
    color: var(--c07);
    transition: 0.3s;
  }

  #profile-icon:hover {
    color: var(--p01);
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
