import DataService from "./modules/data_service";
import SessionStore from "./modules/session_store";

const dataService = new DataService();
const sessionStore = new SessionStore();

const createUser = (name, email) => {
  const time = new Date().getTime();
  const user = dataService.create(name, email, time);
  sessionStore.init(user);
}

const removeUser = (email) => {
  dataService.delete(email);
  sessionStore.destroy();
};

document.addEventListener("beforeunload", removeUser(sessionStore.email));
