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
  const loader = document.querySelector(".loader");
  const backdrop = document.querySelector(".backdrop");
  loader.classList.add("active");
  backdrop.classList.add("active");
  const time = new Date().getTime();
  dataService.create(name, email, time);
  sessionStore.init(name, email, time);
  setTimeout(() => {
    loader.classList.remove("active");
    backdrop.classList.remove("active");
    routeToDashboard();
  }, 1_250);
}

function removeUser(user) {
  if(!user) {
    routeToHome();
    throw new Error("User data is required");
  }
  dataService.delete(user);
  sessionStore.destroy();
};

async function loadUsers() {
  const users = await dataService.get();
  console.log('Loaded users:', users);
  for(let user of users) {
    const tableBody = document.getElementById("userTable");
    const tableRow = document.createElement("tr");

    Object.keys(user).forEach((key) => {
      const tableCol = document.createElement("td");
      tableCol.innerHTML = user[key];
      tableRow.appendChild(tableCol);
    });
    tableBody.appendChild(tableRow);
  }
}

export function submitForm(e) {
  e.preventDefault();
  const formData = new FormData(e.target);
  const name = formData.get("fname");
  const email = formData.get("email");
  createUser(name, email);
};

window.addEventListener("beforeunload", (e) => {
  e.preventDefault();
  if(window.location.href.includes("dashboard")) {
    const user = sessionStore.getUser();
    removeUser(user);
  }
});

window.addEventListener("load", (e) => {
  if(window.location.href.includes("dashboard")) {
    loadUsers();
  }
});

