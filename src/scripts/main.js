import DataService from "./modules/data_service.js";
import SessionStore from "./modules/session_store.js";

const dataService = new DataService();
const sessionStore = new SessionStore();

const createUser = () => {
  const time = new Date().getTime();
  // const user = dataService.create(name, email, time);
  sessionStore.init(name, email, time);
}
const removeUser = (email) => {
  if(!email) {
    throw new Error("Email is required");
  }
  dataService.delete(email);
  sessionStore.destroy();
};

const submitForm = (e) => {
  e.preventDefault();
  const formData = new FormData(e.target);
  const name = formData.get("name");
  const email = formData.get("email");
  console.log(name, email);
  createUser(name, email);
};

window.addEventListener("beforeunload", (e) => {
  console.log(e);
  removeUser(sessionStore.email)
});

export default {submitForm, removeUser, createUser};
