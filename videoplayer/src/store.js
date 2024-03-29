import { writable } from "svelte/store";
import { DB } from "./static/js/db";
import { toggleDarkClass } from "./static/js/extra";
import SimpleCrypto from "simple-crypto-js"

let path = window.location.pathname.replace("/play/", "");
export let current_video = writable(path);

// host url 
export let host = window.location.origin;
// export let host = "http://localhost:8000";
let vl = [];
async function fetchVideos() { 
  console.log(`the host url is currently: ${host}`)
  try {
    const response = await fetch(`${host}/api/`);
    const data = await response.json();
    vl = data;
  } catch (error) {
    console.error(error);
  }
}

await fetchVideos();

export let videoList = writable(vl);

let visitedList = DB.get("visited") || [];
export let visited = writable(visitedList);

const key = writable('play');

export const simpleCrypto = new SimpleCrypto(key)

export let sidebarIsopen = writable(false);

let isDarkModdeOn = DB.get("darkmode") || false;

export let darkMode = writable(isDarkModdeOn);


if(isDarkModdeOn) {
  document.querySelector("meta[name='theme-color']").content = "#374151";
  toggleDarkClass();
}

