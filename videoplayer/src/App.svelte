<script>
  import page from "page";
  import { onMount } from "svelte";
  import Home from "./lib/home.svelte";
  import Player from "./lib/player.svelte";

  let Page;
  let params = null;

  const routes = [
    { path: "/", component: Home },
    { path: "", component: Home },
    { path: "/play/:id", component: Player },
  ];

  function handleRouteChange({ path }) {
    Page = routes.find((route) => {
      if (route.path.includes(":")) {
        // console.log(path.split("/"), route.path.split("/"))
        const id = path.split("/")[2] || "";
        params = path.replace("/play/", "") || null;
        return route.path.split("/")[2] == id;
      }

      return route.path == path;
    })?.component;

    if (path.includes(":")) {
      const id = path.split(":")[1];
    }
  }

  page(handleRouteChange);

  onMount(() => {
    page.start();
  });
</script>

<main>
  <svelte:component this={Page} {params} />
</main>
