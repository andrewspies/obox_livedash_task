// store session information in local storage

export default class SessionStore {
  constructor() {}

  init(data) {
    return localStorage.setItem('user', JSON.stringify({data}));
  }

  get(key) {
    const user = JSON.parse(localStorage.getItem('user'));
    return user[key];
  }

  getUser() {
    return JSON.parse(localStorage.getItem('user'));
  }

  update(data) {
    return localStorage.setItem('user', JSON.stringify(data));
  }
 
  destroy() {
    return localStorage.removeItem('user');
  }
}