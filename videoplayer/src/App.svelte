<script>
  import page from "page";
  import { onMount } from "svelte";
  import Home from "./lib/home.svelte";
  import Player from "./lib/player.svelte";

  let Page;
  let params = null;

  const routes = [
    { path: "/public/", component: Home },
    { path: "/public/play/:id", component: Player },
  ];

  function handleRouteChange({ path }) {
    Page = routes.find((route) => {
      if (route.path.includes(":")) {
        // console.log(path.split("/"), route.path.split("/"))
        const id = path.split("/")[2] || "";
        params = path.replace("/public/play/", "") || null;
        console.log(
          "🚀 ~ file: App.svelte:20 ~ Page=routes.find ~ params:",
          params
        );
        return route.path.split("/")[2] == id;
      }

      return route.path == path;
    })?.component;

    // check if path has a : character
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
