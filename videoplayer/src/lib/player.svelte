<script>
  import { Icon } from "svelte-awesome";
  import { onDestroy, onMount } from "svelte";
  import { host, simpleCrypto, visited } from "../store";
  import Navmain from "./navmain.svelte";
  import { DB } from "../static/js/db";
  import stepBackward from "svelte-awesome/icons/stepBackward";
  import stepForward from "svelte-awesome/icons/stepForward";
  import download from 'svelte-awesome/icons/download';
  
  export let params;
  export let videoList = [];

  let videoPlayer;
  let videoSource;
  let currentIndex = 0;
  let folderPath = "";
  let filePath = "";
  let fileName = "";

  let no_prev = false;
  let no_next = false;

  function buildUrl(path) {
    return `${host}/proxy.php?video=${path}`;
  }

  onMount(async () => {
    if (params) {
      try {
        const decrypted = await simpleCrypto.decrypt(params);
        const decoded = decodeURIComponent(decrypted);
        filePath = decoded;
        videoSource = buildUrl(decoded);
        folderPath = await GetfOlderPath(decoded);
        await fetchVideos(folderPath);
        fileName = downloadName();
        console.log("🚀 ~ Video source:", videoSource);
        await videoPlayer.play(); 
      } catch (error) {
        console.error("Error decrypting:", error);
      }
    }
  });

  async function fetchVideos(folderPath) {
    try {
      const response = await fetch(`${host}/api/?path=${folderPath}`);
      videoList = await response.json();
      currentIndex = findVideoIndex(filePath);
      console.log(
        "🚀 ~ file: player.svelte:37 ~ fetchVideos ~ currentIndex:",
        currentIndex
      );
    } catch (error) {
      console.error(error);
    }
  }
  async function GetfOlderPath(folderPath) {
    // remove file name
    const decodedPath = folderPath.split("/").slice(0, -1).join("/");

    return decodedPath;
  }

  function findVideoIndex(decodedPath) {
    console.log(
      "🚀 ~ file: player.svelte:51 ~ findVideoIndex ~ decodedPath:",
      decodedPath
    );

    return videoList.findIndex((video) => video.path == decodedPath);
  }

  function playPrevious() {
    if (currentIndex > 0) {
      let prevIndex = currentIndex - 1;
      while (prevIndex >= 0) {
        const prevVideo = videoList[prevIndex];
        if (prevVideo.type === "file") {
          videoSource = buildUrl(prevVideo.path);
          fileName = downloadName();
          markVisited(prevVideo.path);
          currentIndex = prevIndex;
          break;
        }
        prevIndex--;
      }
    }
  }

  function playNext() {
    if (currentIndex < videoList.length - 1) {
      let nextIndex = currentIndex + 1;
      while (nextIndex < videoList.length) {
        const nextVideo = videoList[nextIndex];
        if (nextVideo.type === "file") {
          videoSource = buildUrl(nextVideo.path);
          fileName = downloadName();
          markVisited(nextVideo.path);
          currentIndex = nextIndex;
          videoPlayer.play();
          break;
        }
        nextIndex++;
      }
    } else {
      alert("No next video");
    }
  }

  const downloadName = () => {
    if (videoSource) {
      const path = videoSource.split("/");
      return path[path.length - 1];
    }
    return "video.mp4";
  };

  const markVisited = (path) => {
    if (!$visited.includes(path)) {
      $visited = [...$visited, path];
      DB.set("visited", $visited);
    }
  };

  // save video seek position
  const savePosition = () => {
    if (videoPlayer) {
      DB.set(`position_${filePath}`, videoPlayer.currentTime);
    }
  };

  onDestroy(() => {
    savePosition();
  });

  $: currentIndex &&
    (() => {
      no_next = currentIndex >= videoList.length;
      no_prev = currentIndex <= 1;
    });
</script>

<main
  class="bg-white overflow-y-auto dark:border-gray-600 bg-transition border-l dark:bg-gray-700 darK:text-white"
>
  <Navmain />
  <div class="flex py-8 flex-col items-center">
    {#if videoSource}
      <div
        class="relative w-full max-w-lg rounded-lg overflow-hidden shadow-md"
      >
        <video
          src={videoSource}
          bind:this={videoPlayer}
          on:pause={savePosition}
          on:play={savePosition}
          on:ended={playNext}
          controls
          class="w-full"
          id="videoPlayer"
        >
          <track kind="captions" />
        </video>
      </div>
    {/if}

    <div class="file-name">
      <p class="text-md dark:text-white my-2">
        {#if videoSource}
          <span class="font-bold">playing EP {currentIndex + 1}:</span>
          {fileName}
        {/if}
      </p>
    </div>
    <div class="flex justify-center mt-4 space-x-4">
      <button
        class="px-4 py-2 bg-blue-500 text-white rounded-md disabled:bg-gray-400"
        class:disabled={no_prev}
        on:click={playPrevious}
        disabled={no_prev}
      >
        <Icon data={stepBackward} />
        <span>Previous</span>
      </button>
      <button
        class="px-4 py-2 bg-blue-500 text-white rounded-md"
        on:click={() =>
          videoPlayer.paused ? videoPlayer.play() : videoPlayer.pause()}
      >
        {videoPlayer && !videoPlayer.paused ? "Pause" : "Play"}
      </button>
      <a
        href={videoSource}
        download={downloadName()}
        target="_blank"
        class="px-4 py-2 bg-blue-500 text-white rounded-md"
      >
        <span>Download</span>
        <Icon data={download} />
      </a>
      <button
        class="px-4 py-2 bg-blue-500 text-white rounded-md disabled:bg-gray-400"
        class:disabled={no_next}
        on:click={playNext}
        disabled={no_next}
      >
        <span>Next</span>
        <Icon data={stepForward} />
      </button>
    </div>

    <a
      href="/Vidia/"
      class="text-sm font-medium text-gray-700 dark:text-gray-200 mt-5 bg-green-500 px-4 py-2"
      >Home</a
    >
  </div>
</main>

<style>
  main {
    transition: width 0.5s;
    @apply h-screen relative overflow-y-auto border-l z-30;
  }
</style>
