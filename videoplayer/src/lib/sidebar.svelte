<script>
  import { onMount } from "svelte";
  import Filelist from "./filelist.svelte";

  let videoList = [];

  // Fetch the JSON response from the API
  async function fetchVideos() {
    try {
      const response = await fetch("http://localhost/Vidia/proxy-test.php");
      const data = await response.json();
      videoList = data;
    } catch (error) {
      console.error(error);
    }
  }

  onMount(() => {
    fetchVideos();
  });
</script>

<main
  class="half md:shadow-none shadow-md bg-white bg-transition md:block dark:bg-gray-700 dark:border-none w-full"
>
  <!-- Render the current page component -->
  <ul>
    {#each videoList as item}
      <Filelist {item} />
    {/each}
  </ul>
</main>

<style>
  main {
    transition: width 0.5s;
    @apply h-screen py-8 relative overflow-y-auto border-l z-30;
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
