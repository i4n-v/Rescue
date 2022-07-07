<script>
  import { navigate } from "svelte-routing";
  import cookie from "js-cookie";

  const token = cookie.get("access-token");
  if (!token) navigate("/login", { replace: true });
</script>

<slot />
