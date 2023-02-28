export default class DataService {
  constructor() {}

  create(user) {
    if (!name || !email || !time) {
      throw new Error("Name, email, and time are required");
    }
    fetch("http://localhost:8000/server/api/UserApi.php", {
      method: "POST",
      headers: { Accept:"application/json" , "Content-Type": "application/json" },
      body: JSON.stringify({user}),
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

  // async update(user) {
  //   if (!user) {
  //     throw new Error("User data is required");
  //   }
  //   await fetch("http://localhost:8000/server/api/UserApi.php", {
  //     method: "POST",
  //     headers: { "Content-Type": "application/json" },
  //     body: JSON.stringify({ user }),
  //   })
  //     .then((response) => console.log(response.json()))
  //     .catch((err) => console.error(err));
  // }
}
