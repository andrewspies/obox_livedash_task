export default class DataService {
  constructor() {}

  create(user) {
    if (!user) {
      throw new Error("Name, email, and time are required");
    }
    fetch("http://localhost:8000/server/api/UserApi.php", {
      method: "POST",
      headers: { Accept:"application/json" , "Content-Type": "application/json" },
      body: JSON.stringify({name: user.name, email: user.email, time: user.time, status: user.status}),
    })
      .then((response) => console.log(response.json()))
      .catch((err) => console.error(err));
  }

  async get() {
    const data = await fetch("http://localhost:8000/server/api/UserApi.php", {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    })
      .then((response) => { 
        return response.json().then(res => res.data);
      })
      .catch((err) => console.error(err));
    return data;
  }

  update(user) {
    if (!user) {
      throw new Error("No user information supplied to update.");
    }
    fetch("http://localhost:8000/server/api/UserApi.php", {
      method: "PATCH",
      headers: { Accept:"application/json" , "Content-Type": "application/json" },
      body: JSON.stringify({name: user.name, email: user.email, time: user.time, status: user.status}),
    })
      .then((response) => console.log(response.json()))
      .catch((err) => console.error(err));
  }

}
