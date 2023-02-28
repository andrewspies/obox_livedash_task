// store session information in local storage

export default class SessionStore {
  constructor() {}

  init(user) {
    return localStorage.setItem('user', JSON.stringify({user}));
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