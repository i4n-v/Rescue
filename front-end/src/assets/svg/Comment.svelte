<script>
  import cookie from "js-cookie";
  let token = cookie.get("access-token");

  export let onClick = () => {};
</script>

<svg
  width="32"
  height="32"
  viewBox="0 0 32 32"
  fill="none"
  xmlns="http://www.w3.org/2000/svg"
  class={`comment ${!!token ? "" : "disabled"}`}
  on:click={onClick}
>
  <path
    d="M2.6665 26.9333V4.66666C2.6665 4.15555 2.8665 3.69443 3.2665 3.28332C3.6665 2.87221 4.13317 2.66666 4.6665 2.66666H27.3332C27.8443 2.66666 28.3054 2.87221 28.7165 3.28332C29.1276 3.69443 29.3332 4.15555 29.3332 4.66666V22C29.3332 22.5111 29.1276 22.9722 28.7165 23.3833C28.3054 23.7944 27.8443 24 27.3332 24H7.99984L4.3665 27.6333C4.05539 27.9444 3.69428 28.0167 3.28317 27.85C2.87206 27.6833 2.6665 27.3778 2.6665 26.9333ZM4.6665 24.5L7.1665 22H27.3332V4.66666H4.6665V24.5ZM4.6665 4.66666V24.5V4.66666Z"
    fill="#4892BC"
  />
</svg>

<style>
  .comment {
    cursor: pointer;
  }

  .comment:hover > * {
    transition: 0.3s;
    fill: var(--p03);
  }

  .disabled {
    opacity: 0.5;
    cursor: default;
    pointer-events: none;
  }
</style>
