<script>
  import { Icon } from "svelte-awesome";
  import arrowLeft from "svelte-awesome/icons/arrowLeft";

  import { toggleDarkClass } from "../static/js/extra";
  import { darkMode, sidebarIsopen } from "../store";

  $: {
    document.querySelector("meta[name='theme-color']").content = $darkMode
      ? "#374151"
      : "#FFFFFF";
  }
</script>

<nav class="justify-between">
  <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-full">
    <a href="/public/"> 
      <Icon data={arrowLeft} class="w-6 h-6 text-gray-500 dark:text-gray-300"/></a>
  </button>
  <div class="flex right items-center">
    <!-- toggle dark mode button -->
    <button
      class="mx-2"
      on:click={() => toggleDarkClass()}
      title="toggle dark mode"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 text-gray-500 hidden dark:block dark:text-gray-300"
        viewBox="0 0 24 24"
        ><path
          fill="currentColor"
          d="M12 17q-2.075 0-3.538-1.463T7 12q0-2.075 1.463-3.538T12 7q2.075 0 3.538 1.463T17 12q0 2.075-1.463 3.538T12 17ZM2 13q-.425 0-.713-.288T1 12q0-.425.288-.713T2 11h2q.425 0 .713.288T5 12q0 .425-.288.713T4 13H2Zm18 0q-.425 0-.713-.288T19 12q0-.425.288-.713T20 11h2q.425 0 .713.288T23 12q0 .425-.288.713T22 13h-2Zm-8-8q-.425 0-.713-.288T11 4V2q0-.425.288-.713T12 1q.425 0 .713.288T13 2v2q0 .425-.288.713T12 5Zm0 18q-.425 0-.713-.288T11 22v-2q0-.425.288-.713T12 19q.425 0 .713.288T13 20v2q0 .425-.288.713T12 23ZM5.65 7.05L4.575 6q-.3-.275-.288-.7t.288-.725q.3-.3.725-.3t.7.3L7.05 5.65q.275.3.275.7t-.275.7q-.275.3-.687.288T5.65 7.05ZM18 19.425l-1.05-1.075q-.275-.3-.275-.713t.275-.687q.275-.3.688-.287t.712.287L19.425 18q.3.275.288.7t-.288.725q-.3.3-.725.3t-.7-.3ZM16.95 7.05q-.3-.275-.288-.687t.288-.713L18 4.575q.275-.3.7-.288t.725.288q.3.3.3.725t-.3.7L18.35 7.05q-.3.275-.7.275t-.7-.275ZM4.575 19.425q-.3-.3-.3-.725t.3-.7l1.075-1.05q.3-.275.712-.275t.688.275q.3.275.288.688t-.288.712L6 19.425q-.275.3-.7.288t-.725-.288Z"
        /></svg
      >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 dark:hidden block text-gray-500 dark:text-gray-300"
        viewBox="0 0 24 24"
        ><path
          fill="currentColor"
          d="M12 21q-3.775 0-6.388-2.613T3 12q0-3.45 2.25-5.988T11 3.05q.625-.075.975.45t-.025 1.1q-.425.65-.638 1.375T11.1 7.5q0 2.25 1.575 3.825T16.5 12.9q.775 0 1.538-.225t1.362-.625q.525-.35 1.075-.037t.475.987q-.35 3.45-2.937 5.725T12 21Z"
        /></svg
      >
    </button>
    <div class="flex">
      <a
        href="https://github.com/bethropolis/song-recommendation-system/"
        target="_blank"
        class="mx-2"
        title="github repo"
      >
        <svg
          class="h-6 w-6 text-gray-500 dark:text-gray-300"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          ><path
            fill="currentColor"
            fill-rule="evenodd"
            d="M11.999 1C5.926 1 1 5.925 1 12c0 4.86 3.152 8.983 7.523 10.437c.55.102.75-.238.75-.53c0-.26-.009-.952-.014-1.87c-3.06.664-3.706-1.475-3.706-1.475c-.5-1.27-1.221-1.61-1.221-1.61c-.999-.681.075-.668.075-.668c1.105.078 1.685 1.134 1.685 1.134c.981 1.68 2.575 1.195 3.202.914c.1-.71.384-1.195.698-1.47c-2.442-.278-5.01-1.222-5.01-5.437c0-1.2.428-2.183 1.132-2.952c-.114-.278-.491-1.397.108-2.91c0 0 .923-.297 3.025 1.127A10.536 10.536 0 0 1 12 6.32a10.49 10.49 0 0 1 2.754.37c2.1-1.424 3.022-1.128 3.022-1.128c.6 1.514.223 2.633.11 2.911c.705.769 1.13 1.751 1.13 2.952c0 4.226-2.572 5.156-5.022 5.428c.395.34.747 1.01.747 2.037c0 1.47-.014 2.657-.014 3.017c0 .295.199.637.756.53C19.851 20.979 23 16.859 23 12c0-6.075-4.926-11-11.001-11"
          /></svg
        ></a
      >
    </div>
  </div>
</nav>

<style>
  nav {
    @apply w-full flex p-3;
  }
</style>
