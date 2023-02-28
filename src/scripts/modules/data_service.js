export default class DataService {
  constructor() {}

  create(name, email, time) {
    if (!name || !email || !time) {
      throw new Error("Name, email, and time are required");
    }
    // create user
    fetch("http://localhost:8080/server/api/Users", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ name, email, time }),
    })
      .then((res) => console.log(res))
      .then((data) => console.log(data))
      .catch((err) => console.error(err));
  }

  get() {
    // ping db and get status
    fetch("http://localhost:8080/server/api/Users", {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    })
      .then((res) => console.log(res))
      .then((data) => console.log(data))
      .catch((err) => console.error(err));
  }

  delete(user) {
    // delete user
    if (!user) {
      throw new Error("User data is required");
    }
    fetch("http://localhost:8080/server/api/Users", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ user }),
    })
      .then((res) => console.log(res))
      .then((data) => console.log(data))
      .catch((err) => console.error(err));
  }
}
