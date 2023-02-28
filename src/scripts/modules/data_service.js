export default class DataService {
  constructor() {}

  create(name, email, time) {
    // create user
  }

  get(email) {
   // ping db and get status
  }

  delete(email) {
    // delete user
    if(!email) {
      throw new Error("Email is required");
    }
  }
}