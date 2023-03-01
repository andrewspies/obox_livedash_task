// store session information in local storage

export default class SessionStore {
  constructor() {}

  init(object, data) {
    return localStorage.setItem(object, JSON.stringify({data}));
  }

  get(key, object) {
    const user = JSON.parse(localStorage.getItem(object));
    return user[key];
  }

  getUser() {
    return JSON.parse(localStorage.getItem('user'));
  }

  update(object, data) {
    return localStorage.setItem(object, JSON.stringify(data));
  }
 
  destroy(object) {
    return localStorage.removeItem(object);
  }
}