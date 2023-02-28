// store session information in local storage

export default class SessionStore {
  constructor() {}

  init(name, email, time) {
    return localStorage.setItem('user', JSON.stringify({name, email, time}));
  }

  get(key) {
    const user = JSON.parse(localStorage.getItem('user'));
    return user[key];
  }

  getUser() {
    return JSON.parse(localStorage.getItem('user'));
  }

  update(user) {
    return localStorage.setItem('user', JSON.stringify(user));
  }
 
  destroy() {
    return localStorage.removeItem('user');
  }
}