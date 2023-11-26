import { darkMode } from "../../store";
import { DB } from "./db";


// a toggle dark class function (exported)
export function toggleDarkClass() {
  const body = document.querySelector("body");
  body.classList.toggle("dark");
  darkMode.update((value) => !value);
  DB.set("darkmode", !DB.get("darkmode"));
}

