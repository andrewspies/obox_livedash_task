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
    // routeToDashboard();
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
  const storedUsers = sessionStore.init("users", users);

  if (!checkUsersLoaded(users, storedUsers)) {
    for (let user of users) {
      let count = 0;
      count++;
      const tableBody = document.getElementById("userTable");
      const tableRow = document.createElement("tr");
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
      tableBody.appendChild(tableRow);
    }
    sessionStore.update("users", users);
    return;
  } else {
    console.log("Users already loaded");
    return
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
  if (storedUsers) {
    if (users.length === storedUsers.length) {
      return true;
    }
    return false;
  }
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
  }
});
