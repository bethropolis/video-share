
export const DB = {
  set: (key, value) => {
    localStorage.setItem(key, JSON.stringify(value));
  },
  get: (key) => {
    const value = localStorage?.getItem(key);
    return value ? JSON.parse(value) : null;
  },
  update: (key, value) => {
    const currentValue = DB.get(key);
    if (currentValue !== null) {
      DB.set(key, value);
    }
  },
  remove: (key) => {
    localStorage.removeItem(key);
  },
  clear: () => {
    localStorage.clear();
  },
};
