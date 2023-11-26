<script>
  import { simpleCrypto, visited } from "../store";
  import { Icon } from "svelte-awesome";
  import file from "svelte-awesome/icons/file";
  import folder from "svelte-awesome/icons/folder";
  import { slide } from "svelte/transition";
  import { DB } from "../static/js/db";
  import { onMount } from "svelte";

  export let item; // the item to render
  let isOpen = false; // whether the folder is open or closed

  // toggle the isOpen variable when the user clicks on the folder icon or name
  function toggleFolder() {
    isOpen = !isOpen;
    saveFolderState();
  }

  function markVisited(path) {
    // check if the path has been visited before
    if (!$visited.includes(path)) {
      $visited = [...$visited, path];
      DB.set("visited", $visited);
    }
  }

  function beenVisited(path) {
    return $visited.includes(path);
  }

  function saveFolderState() {
    DB.set(`folder_${item.path}`, isOpen);
  }

  onMount(() => {
    isOpen = DB.get(`folder_${item.path}`);
  });
</script>

<li class="w-full">
  {#if item.type === "file"}
    <div class="hover:bg-gray-200 dark:hover:bg-gray-700 py-2">
      <Icon
        class="icon text-sm font-medium text-gray-700 dark:text-gray-200"
        data={file}
      />
      <!-- Use the md5 function to hash the item.path and use it as the href -->
      <a
        href={"play/" + simpleCrypto.encrypt(item.path)}
        class="text-sm font-medium text-gray-700 dark:text-gray-200"
        class:visited={beenVisited(item.path)}
        on:click={() => markVisited(item.path)}>{item.name}</a
      >
    </div>
  {:else if item.type === "directory" && item.content.length > 0}
    <a href="#" class="directory" on:click={toggleFolder}>
      <Icon
        class="icon text-lg text-gray-700 dark:text-gray-300"
        data={folder}
        on:click={toggleFolder}
      />
      <strong class="text-xl text-gray-700 dark:text-gray-300"
        >{item.name}</strong
      >
    </a>
    <!-- Use a transition to animate the folder content -->
    {#if isOpen}
      <ul transition:slide>
        {#each item.content as subitem}
          <!-- Use <svelte:self> to render the subitem -->
          <svelte:self item={subitem} />
        {/each}
      </ul>
    {/if}
  {/if}
</li>

<style>
  /* Add some styles for the component */
  ul {
    list-style: none;
    padding-left: 1rem;
  }

  .visited {
    @apply text-red-400;
  }

  li {
    margin: 0.5rem 0;
  }

  a {
    color: inherit;
    text-decoration: none;
  }

  :global(.icon) {
    width: 1.25rem;
    margin-right: 0.5rem;
    cursor: pointer;
  }
</style>
