// store session information in local storage

export default class SessionStore {
  constructor(name, email, time) {
    this.name = name;
    this.email = email;
    this.time = time;
  }

  init() {
    return localStorage.setItem('user', JSON.stringify({name: this.name, email: this.email, time: this.time}));
  }
 
  destroy() {
    return localStorage.removeItem('user');
  }
  
}