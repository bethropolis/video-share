<script>
  import { onMount } from "svelte";
  import { sidebarIsopen, videoList } from "../store";
  import Filelist from "./filelist.svelte";
  import Navmain from "./navmain.svelte";

  let vidList = [];
  onMount(() => {
    vidList = $videoList;
    console.log("🚀 ~ file: main.svelte:10 ~ onMount ~ vidList:", vidList);
  });
</script>

<main
  class="bg-white overflow-y-auto dark:border-gray-600 bg-transition border-l dark:bg-gray-700 darK:text-white w-full"
>
  <Navmain />

  <!-- Render the current page component -->
  <ul>
    {#each vidList as item}
      <Filelist {item} />
    {/each}
  </ul>
</main>

<style>
  main {
    transition: width 0.5s;
    @apply h-screen relative overflow-y-auto border-l z-30;
  }

  /* Add some styles for the component */
  ul {
    list-style: none;
    padding-left: 1rem;
  }

  li {
    margin: 0.5rem 0;
  }

  a {
    color: inherit;
    text-decoration: none;
  }

  .icon {
    margin-right: 0.5rem;
  }
</style>
