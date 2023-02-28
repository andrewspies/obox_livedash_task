// store session information in local storage

export default class SessionStore {
  constructor() {}

  init(name, email, time) {
    return localStorage.setItem('user', JSON.stringify({name, email, time}));
  }
 
  destroy() {
    return localStorage.removeItem('user');
  }
}