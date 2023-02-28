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

function createUser(name, email, status) {
  const loader = document.querySelector(".loader");
  const backdrop = document.querySelector(".backdrop");
  const time = new Date().getTime();
  const user = { name, email, time, status };

  loader.classList.add("active");
  backdrop.classList.add("active");
  dataService.create(user);
  sessionStore.init(user);

  setTimeout(() => {
    loader.classList.remove("active");
    backdrop.classList.remove("active");
    routeToDashboard();
  }, 1_250);
}

function updateUser(user) {
  if(!user) {
    routeToHome();
    throw new Error("User data is required");
  }
  dataService.create(user);
  sessionStore.update(user);
}

async function loadUsers() {
  const users = await dataService.get();

  for(let user of users) {
    const tableBody = document.getElementById("userTable");
    const tableRow = document.createElement("tr");

    Object.keys(user).forEach((key) => {
      const tableCol = document.createElement("td");
      tableCol.innerHTML = user[key];
      tableRow.appendChild(tableCol);
      if(key === "status" && user["status"] === "active") {
        const activeIcon = document.createElement("i");
        activeIcon.classList.add("status", "active");
        tableCol.appendChild(activeIcon);
      } else {
        const inactiveIcon = document.createElement("i");
        inactiveIcon.classList.add("status");
        tableCol.appendChild(activeIcon);
      }
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
    user.status = "inactive";
    updateUser(user);
  }
});

window.addEventListener("load", (e) => {
  if(window.location.href.includes("dashboard")) {
    loadUsers();
  }
});

