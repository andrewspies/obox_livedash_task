import DataService from "./modules/data_service.js";
import SessionStore from "./modules/session_store.js";

const dataService = new DataService();
const sessionStore = new SessionStore();

function routeToDashboard() {
  window.location.href = "/dashboard.html";
}

function createUser(name, email) {
  const time = new Date().getTime();
  const user = dataService.create(name, email, time);
  sessionStore.init(name, email, time);
  routeToDashboard();
}

function removeUser(email) {
  if(!email) {
    throw new Error("Email is required");
  }
  dataService.delete(email);
  sessionStore.destroy();
};

export function submitForm(e) {
  e.preventDefault();
  const formData = new FormData(e.target);
  const name = formData.get("fname");
  const email = formData.get("email");
  console.log(name, email);
  createUser(name, email);
};

window.addEventListener("beforeunload", (e) => {
  const email = sessionStore.get("email");
  removeUser(email);
});

