import DataService from "./modules/data_service.js";
import SessionStore from "./modules/session_store.js";

const dataService = new DataService();
const sessionStore = new SessionStore();

function routeToDashboard() {
  window.location.href = "/dashboard.html";
  loadUsers();
}

function routeToHome() {
  window.location.href = "/";
}

function createUser(name, email) {
  const time = new Date().getTime();
  const user = dataService.create(name, email, time);
  sessionStore.init(name, email, time);
  routeToDashboard();
}

function removeUser(user) {
  if(!user) {
    routeToHome();
    throw new Error("User data is required");

  }
  dataService.delete(user);
  sessionStore.destroy();
};

function loadUsers() {
  const users = dataService.get();
  console.log('Loaded users:', users);
}

export function submitForm(e) {
  e.preventDefault();
  const formData = new FormData(e.target);
  const name = formData.get("fname");
  const email = formData.get("email");
  createUser(name, email);
};

window.addEventListener("beforeunload", (e) => {
  const user = sessionStore.getUser();
  removeUser(user);
});

window.addEventListener("load", (e) => {
  if(window.location.href.includes("dashboard")) {
    loadUsers();
  }
});

