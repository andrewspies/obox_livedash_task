import DataService from "./modules/data_service.js";
import SessionStore from "./modules/session_store.js";

const dataService = new DataService();
const sessionStore = new SessionStore();

function routeToDashboard() {
  window.location.href = "/dashboard.html";
  // wait bfore loading users
  setTimeout(() => {
    loadUsers();
  }, 250);
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
  sessionStore.init("user", user);

  // wait to show loader and route to dashboard
  // ensures users knows something is happening
  setTimeout(() => {
    loader.classList.remove("active");
    backdrop.classList.remove("active");
    routeToDashboard();
  }, 500);
}

function updateUser(user) {
  if (!user) {
    routeToHome();
    throw new Error("User data is required");
  }
  dataService.update(user);
  sessionStore.update("user", user);
  loadUsers();
}

async function loadUsers() {
  const users = await dataService.get();
  sessionStore.init("users", users);
  let storedUsers = sessionStore.get("users");
  const tableBody = document.getElementById("userTable");
  const tableExists = document.querySelectorAll("#userTable");


  if (checkUsersLoaded(users, storedUsers)) {
    if (tableExists && tableExists.length <= 1) {
      for (let user of users) {
        let count = 0;
        count++;
        const id = user.email.replace(/[^a-zA-Z0-9 ]/g, "");
        const row = document.querySelectorAll(`#${id}`);
        if (!row || row.length < 1) {
          const tableRow = document.createElement("tr");
         
          tableRow.id = id;
          tableBody.appendChild(tableRow);

          Object.keys(user).forEach((key) => {
            const tableCol = document.createElement("td");
            tableCol.innerHTML = "<p>" + user[key] + "</p>";
            tableCol.id = key + "-" + count;
            tableRow.appendChild(tableCol);
            const activeIcon = document.createElement("i");

            if (key === "status" && user["status"].toLowerCase() === "active") {
              activeIcon.classList.add("status", "active");
            } else {
              activeIcon.classList.add("status");
            }
            if (tableCol.id === `status-${count}`) {
              tableCol.appendChild(activeIcon);
            }
          });
        }
      }
    }
    sessionStore.update("users", users);
    return;
  }
}

export function submitForm(e) {
  e.preventDefault();
  const formData = new FormData(e.target);
  const name = formData.get("fname");
  const email = formData.get("email");
  const status = "active";
  createUser(name, email, status);
}

function checkUsersLoaded(users, storedUsers) {
  if (!storedUsers) {
    return false;
  }
  if (JSON.stringify(users) === JSON.stringify(storedUsers.data)) {
    return true;
  }
  return false;
}

window.addEventListener("beforeunload", (e) => {
  e.preventDefault();
  if (window.location.href.includes("dashboard")) {
    try {
      const user = sessionStore.getUser();
      user.data.status = "inactive";
      updateUser(user);
      routeToHome();
    } catch (err) {
      console.error(err);
    }
  }
});

window.addEventListener("load", (e) => {
  if (window.location.href.includes("dashboard")) {
    loadUsers();
    setInterval(() => {
      loadUsers();
    }, 3000);
  }
});
