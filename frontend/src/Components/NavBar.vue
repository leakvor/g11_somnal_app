<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-success">
    <div class="container-fluid">
      <router-link to="/" class="navbar-brand text-white">
        <img src="../assets/image/logo.png" alt="logo" class="w-10 h-10" />
        <span class="text-xl font-bold ms-1">SOMNAL</span>
      </router-link>
      <div
        class="profile-dropdown dropdown-one mb-2"
      >
        <router-link
          to="/"
          href="#"
          class="d-flex align-items-center"
          role="button"
          id="profileDropdown"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8AJM9wkP__z2M-hovSAWcTb_9XJ6smy3NKw&s"
            alt="Profile"
            style="width: 40px; height: 40px; border-radius: 50%"
          />
        </router-link>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
          <li>
            <router-link to="/profile" class="dropdown-item d-flex align-items-center">
              <i class="material-icons icon-align">person</i>
              Profile
            </router-link>
          </li>

          <li>
            <router-link to="/editProfile" class="dropdown-item d-flex align-items-center">
              <i class="material-icons icon-align">edit_square</i>
              Edit Profile
            </router-link>
          </li>

          <li>
            <router-link to="/favorite-page" class="dropdown-item d-flex align-items-center">
              <i class="material-icons icon-align">favorite</i>
              Favorite
            </router-link>
          </li>

          <li>
            <router-link to="/add_post" class="dropdown-item d-flex align-items-center">
              <i class="material-icons icon-align">post_add</i>
              Add Post
            </router-link>
          </li>

          <li>
            <button @click="logout" class="dropdown-item d-flex align-items-center">
                    <i class="material-icons icon-align">logout</i>Logout
                  </button>
          </li>
        </ul>
      </div>
      <button
        class="navbar-toggler position"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li
            class="nav-item me-4"
          >
            <router-link to="/" class="nav-link" :class="{ active: isActive('/') }">
              <i class="material-icons">home</i>
              <span>Home</span>
            </router-link>
          </li>

          <!-- <li
            class="nav-item me-4"
            v-if="authStore.isAuthenticatedUser || authStore.isAuthenticatedCompany"
          >
            <router-link
              to="/post_view"
              class="nav-link"
              :class="{ active: isActive('/post_view') }"
            >
              <i class="material-icons">home</i>
              <span>Home</span>
            </router-link>
          </li> -->

          <!-- <li class="nav-item me-4" v-if="authStore.isAuthenticatedCompany">
            <router-link
              to="/company/revenue"
              class="nav-link"
              :class="{ active: isActive('/company/revenue') }"
            >
              <i class="material-icons">attach_money</i>
              <span>Revenue</span>
            </router-link>
          </li> -->

          <!-- <li class="nav-item me-4" v-if="authStore.isAuthenticatedCompany">
            <router-link
              to="/company/dashboard"
              class="nav-link"
              :class="{ active: isActive('/company/dashboard') }"
            >
              <i class="material-icons">dashboard</i>
              <span>Dashboard</span>
            </router-link>
          </li> -->


          <li class="nav-item me-4" v-if="authStore.isAuthenticatedCompany">
            <router-link
              to="/post/request/sell"
              class="nav-link"
              :class="{ active: isActive('/post/request/sell') }"
            >
              <i class="material-icons">local_mall</i>
              <span>Request to sell</span>
            </router-link>
          </li>

          <li
            class="nav-item me-4"
            v-if="
              authStore.isAuthenticatedUser ||
              !authStore.isAuthenticatedUser ||
              !authStore.isAuthenticatedCompany
            "
          >
            <router-link to="/service" class="nav-link" :class="{ active: isActive('/service') }">
              <i class="material-icons">engineering</i>
              <span>Services</span>
            </router-link>
          </li>

          <!-- <li
            class="nav-item me-4"
            v-if="!authStore.isAuthenticatedUser && !authStore.isAuthenticatedCompany"
          >
            <router-link to="/about" class="nav-link" :class="{ active: isActive('/about') }">
              <i class="material-icons">info</i>
              <span>About Us</span>
            </router-link>
          </li> -->
          <!-- <li
            class="nav-item me-4"
            v-if="authStore.isAuthenticatedUser || authStore.isAuthenticatedCompany">
            <router-link to="/post_view" class="nav-link" :class="{ active: isActive('/post_view') }">
              <i class="material-icons">info</i>
              <span>Post View</span>
            </router-link>
          </li> -->

          <!-- <li class="nav-item me-4" v-if="authStore.isAuthenticatedUser || !authStore.isAuthenticatedUser || !authStore.isAuthenticatedCompany">
            <router-link to="/contact" class="nav-link" :class="{ active: isActive('/contact') }">
              <i class="material-icons">call</i>
              <span>Contact Us</span>
            </router-link>
          </li> -->
          <li class="nav-item me-4" v-if="authStore.isAuthenticatedUser">
            <router-link
              to="/favorite-page"
              class="nav-link position-relative"
              :class="{ active: isActive('/favorite-page') }"
            >
              <i class="material-icons">favorite</i>
              <span>Favorite Item</span>
            </router-link>
          </li>

          <li class="nav-item me-4" v-if="authStore.isAuthenticatedUser || authStore.isAuthenticatedCompany">
            <router-link
              to="/post_view"
              class="nav-link position-relative"
              :class="{ active: isActive('/post_view') }"
            >
              <i class="material-icons">post_add</i>
              <span>Post</span>
            </router-link>
          </li>

          <li class="nav-item me-4" v-if="authStore.isAuthenticatedUser">
            <router-link to="/map" class="nav-link" :class="{ active: isActive('/map') }">
              <i class="material-icons">map</i>
              <span>Map</span>
            </router-link>
          </li>

          <!-- <li class="nav-item me-4" v-if="authStore.isAuthenticatedUser">
            <router-link to="/payment" class="nav-link" :class="{ active: isActive('/payment') }">
              <i class="material-icons">payment</i>
              <span>Payment</span>
            </router-link>
          </li> -->

          <li class="nav-item me-4" v-if="!authStore.isAuthenticatedCompany">
            <router-link to="/partner" class="nav-link" :class="{ active: isActive('/partner') }">
              <i class="material-icons icon-align">people</i>
              <span class="text-below-icon">Our Partner</span>
            </router-link>
          </li>


          <li
            class="nav-item d-flex align-items-center me-4"
            v-if="!authStore.isAuthenticatedUser && !authStore.isAuthenticatedCompany"
          >
            <button
              
              class="nav-link text-white btn btn-login custom-hover pe-3 ps-3" data-bs-toggle="modal"
              data-bs-target="#loginModal"
              >Login</button>
            <button to="/register" class="nav-link btn btn-register pe-3 ps-3" data-bs-toggle="modal" data-bs-target="#registerModal"
              >Register</button
            >
          </li>

          <li
            class="nav-item d-flex align-items-center me-4"
            v-if="authStore.isAuthenticatedUser || authStore.isAuthenticatedCompany"
          >
            <router-link
              to="/chat"
              class="nav-link position-relative"
              :class="{ active: isActive('/chat') }"
            >
              <span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                >+99 <span class="visually-hidden">unread messages</span></span
              >

              <i class="material-icons icon-align">chat_bubble</i>
              <span class="text-below-icon">Chat</span>
            </router-link>
          </li>

          <li
            class="nav-item d-flex align-items-center me-4"
            v-if="authStore.isAuthenticatedUser || authStore.isAuthenticatedCompany"
          >
          <router-link
              to="/notifications"
              class="nav-link position-relative"
              :class="{ active: isActive('/notifications') }"
              @click="resetNotificationCount"
            >
              <span
                class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger"
                id="notification_number"
              >
                {{ displayedNotificationCount }}
                <span class="visually-hidden">unread messages</span>
              </span>
              <i class="material-icons icon-align">notifications</i>
              <span class="text-below-icon">Notifications</span>
            </router-link>
          </li>
          <!-- <NotificationComponent /> -->
          <li
            class="nav-item d-flex align-items-center" v-if="authStore.isAuthenticatedUser || authStore.isAuthenticatedCompany"
          >
            <div class="profile-dropdown dropdown-two">
              <router-link
                to="/"
                href="#"
                class="d-flex align-items-center"
                role="button"
                id="profileDropdown"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <img
                  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8AJM9wkP__z2M-hovSAWcTb_9XJ6smy3NKw&s"
                  alt="Profile"
                  class="mb-2"
                  style="width: 40px; height: 40px; border-radius: 50%"
                />
              </router-link>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li>
                  <router-link to="/profile" class="dropdown-item d-flex align-items-center">
                    <i class="material-icons icon-align">person</i>
                    View Profile
                  </router-link>
                </li>

                <!-- <li>
                  <router-link to="/editProfile" class="dropdown-item d-flex align-items-center">
                    <i class="material-icons icon-align">edit_square</i>
                    Edit Profile
                  </router-link>
                </li> -->

                <!-- <li>
                  <router-link to="/favorite-page" class="dropdown-item d-flex align-items-center">
                    <i class="material-icons icon-align">favorite</i>
                    Favorite
                  </router-link>
                </li> -->


                <!-- <li>
                  <router-link to="/addPost" class="dropdown-item d-flex align-items-center">
                    <i class="material-icons icon-align">post_add</i>
                    Add Post
                  </router-link>
                </li> -->

                <li>
                  <button @click="logout" class="dropdown-item d-flex align-items-center">
                    <i class="material-icons icon-align">logout</i>Logout
                  </button>
                </li>
              </ul>
            </div>
          </li>
          <!-- <li
            class="nav-item me-4"
            v-if="!authStore.isAuthenticatedUser && !authStore.isAuthenticatedCompany"
          >
            <router-link to="/companies" class="nav-link" :class="{ active: isActive('/about') }">
              <i class="material-icons">info</i>
              <span>Companies</span>
            </router-link>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>

   <!-- Login Modal -->
   <div class="modal fade text-black" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content p-3">
        <div class="modal-header border-0">
          <h4 class="modal-title" id="loginModalLabel">Login</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clearModal"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="login">
            <div class="mb-3">
              <input type="email" class="form-control" id="loginEmail" v-model="email" placeholder="email" pattern="\S+@\S+\.\S+" required />
              <small class="text-danger">{{emailLoginError }}</small>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="loginPassword" placeholder="password" v-model="password" pattern=".{8,}" required />
              <small class="text-danger">{{passwordError }}</small>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="showPassword" @change="togglePasswordVisibility('loginPassword')" />
              <label class="form-check-label" for="showPassword"> Show Password </label>
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
            <p class="mt-3">
              Don't have an account?
              <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal"  @click="clearModal">Register</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Register Modal -->
  <div class="modal fade text-black" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content p-3">
        <div class="modal-header border-0">
          <h4 class="modal-title" id="registerModalLabel">Register</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clearModal"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="register">
            <div class="mb-3">
              <input type="text" class="form-control" id="registerName" v-model="name" placeholder="Username" 
                required />
                <small class="text-danger">{{nameError }}</small>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" id="registerPhone" v-model="phone" placeholder="Phone" pattern="0\d{9}"  required />
                <small class="text-danger">{{phoneError }}</small>
            </div>

            <div class="mb-3">
              <input type="email" class="form-control" id="registerEmail" v-model="email" placeholder="Email" pattern="\S+@\S+\.\S+"
                required />
                <small class="text-danger">{{emailError }}</small>
            </div>


            <div class="mb-3">
              <input type="password" class="form-control" id="registerPassword" v-model="password"
                placeholder="Password" pattern=".{8,}" required />
                <small class="text-danger">{{passwordError }}</small>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="showPassword" @change="togglePasswordVisibility('registerPassword')" />
              <label class="form-check-label" for="showPassword"> Show Password </label>
            </div>
            <button type="submit" class="btn btn-success w-100">Register</button>
            <p class="mt-3">
              Already have an account?
              <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal"  @click="clearModal">Login</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Alert Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body d-flex align-items-center p-3">
        <i v-if="isSuccess" class="material-icons icon-align text-success" style="font-size: 3rem;">check_circle</i>
        <i v-if="isError" class="material-icons icon-align text-danger" style="font-size: 3rem;">error</i>
        <p class="text-black mt-3">{{ alertMessage }}</p>
      </div>
    </div>
  </div>
</div>

</div>
</template>

<script>
import axios from 'axios'
import { useAuthStore } from '../stores/auth-store'
import { useRoute, useRouter } from 'vue-router'
// import { useToast } from 'vue-toastification'
import NotificationComponent from './notification/NotificationComponents.vue'
import { ref, onMounted,computed } from 'vue'


export default {
  name: 'NavBar',
  components:{
    NotificationComponent
  },
  data() {
    return {
        name: '',
        phone: '',
        email: '',
        password: '',
        role_id:2,
        nameError: '',
        phoneError: '',
        emailError: '',
        emailLoginError: '',
        passwordError: '',
        alertMessage: '',
        isSuccess: false, 
        isError: false
    }
  },
    computed: {
    passwordFieldType() {
      return this.showPassword ? 'text' : 'password';
    },
  },
  watch: {
    name(newName) {
    if (newName.trim() === "") {
      this.nameError = '';
    } else if (!newName) {
      this.nameError = 'Name cannot be empty.';
    } else if (!/^([A-Z][a-zA-Z]*)( [A-Z][a-zA-Z]*)*$/.test(newName)) {
      this.nameError = 'Please enter a valid full name, example: John Doe';
    } else {
      this.nameError = '';
    }
  },


  email(newEmail) {
  if(newEmail === ""){
    this.emailError = ''
    this.emailLoginError = ''
  }
  else if (!newEmail) {
    this.emailError = 'Email cannot be empty.';
    this.emailLoginError = 'Email cannot be empty.';
  } else if (!/\S+@\S+\.\S+/.test(newEmail)) {
    this.emailError = 'Please enter a valid email address (e.g., example@example.com).';
    this.emailLoginError = 'Please enter a valid email address (e.g., example@example.com).';
  } else {
    axios.post('http://127.0.0.1:8000/api/check-email', { email: newEmail })
     .then(response => {
        if (response.data.available) {
          this.emailError = response.data.message;
        } else if(!response.data.unique) {
          this.emailError = response.data.message;
        }
        else {
          this.emailError = '';
        }
      })
     .catch(error => {
        console.error(error);
        this.emailError = 'Error checking email availability.';
      });
  }
},
  
  phone(newPhone) {
    if(newPhone === ""){
      this.phoneError = ''
    }
    else if (!newPhone) {
      this.phoneError = 'Phone number cannot be empty.';
    } else if (!/^0\d{9}$/.test(newPhone)) {
      this.phoneError = 'Phone number must start with 0 and be 10 digits long.';
    } else {
      this.phoneError = '';
    }
  },
  password(newPassword) {
    if(newPassword === ""){
      this.passwordError = ''
    }
    else if (!newPassword) {
      this.passwordError = 'Password cannot be empty.';
    } else if (newPassword.length < 8) {
      this.passwordError = 'Password must be at least 8 characters long.';
    } else {
      this.passwordError = '';
    }
  },
},
  setup() {
    const authStore = useAuthStore()
    const route = useRoute()
    const router = useRouter()


    const isActive = (path) => route.path === path

    const logout = () => {
      authStore.logout()
      router.push('/')
    }


    onMounted(async () => {
      const navLinks = document.querySelectorAll('.nav-link')
      navLinks.forEach((navLink) => {
        navLink.addEventListener('click', (event) => {
          navLinks.forEach((link) => link.classList.remove('active'))
          event.currentTarget.classList.add('active')

          if (window.innerWidth <= 995) {
            const navbarToggle = document.querySelector('.navbar-toggler')
            const navbarNav = document.getElementById('navbarNav')
            if (navbarNav.classList.contains('show')) {
              navbarToggle.click()
            }
          }
        })
      })
      
    })

    return {
      authStore,
      isActive,
      logout,

    }
  },
  mounted() {
    const navLinks = document.querySelectorAll('.nav-link')
    navLinks.forEach((navLink) => {
      navLink.addEventListener('click', (event) => {
        navLinks.forEach((link) => link.classList.remove('active'))
        event.currentTarget.classList.add('active')

        if (window.innerWidth <= 995) {
          const navbarToggle = document.querySelector('.navbar-toggler')
          const navbarNav = document.getElementById('navbarNav')
          if (navbarNav.classList.contains('show')) {
            navbarToggle.click()
          }
        }
      })
    });
    // Clear input fields and error messages when modal is closed
    $('#loginModal').on('hidden.bs.modal', () => {
      this.clearModal();
    });
    $('#registerModal').on('hidden.bs.modal', () => {
      this.clearModal();
    });
  },
  methods: {
    async register() {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/register', {
            name: this.name,
            phone: this.phone,
            email: this.email,
            password: this.password,
            role_id: this.role_id
          })
          console.log(response.data)
          $('#registerModal').modal('hide')
          this.name = ''
          this.phone = ''
          this.email = ''
          this.password = ''
          this.alertMessage = 'Register successfully.';
          $('#alertModal').modal('show');
          this.isSuccess = true;
          this.isError = false;

          setTimeout(() => {
          $('#alertModal').modal('hide'); 
        }, 2000);

        } catch (error) {
          console.error('Error logging in:', error)
          $('#registerModal').modal('hide')
          this.name = ''
          this.phone = ''
          this.email = ''
          this.password = ''

          this.alertMessage = 'Please try to register again.'
          $('#alertModal').modal('show');
          
          this.isSuccess = false;
          this.isError = true;
          setTimeout(() => {
          $('#alertModal').modal('hide'); 
        }, 2000);
        }
      },
      async login() {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/login', {
            email: this.email,
            password: this.password
            
          })
          const data = response.data
          this.authStore.login(data)

          console.log(response.data)
          $('#loginModal').modal('hide')
          this.email = ''
          this.password = ''
          this.alertMessage = 'Login successfully.';
          $('#alertModal').modal('show');


          this.isSuccess = true;
          this.isError = false;
          setTimeout(() => {
          $('#alertModal').modal('hide'); 
        }, 2000);
        } catch (error) {
          $('#loginModal').modal('hide')
          this.email = ''
          this.password = ''

          this.isSuccess = false;
          this.isError = true;
          this.alertMessage = 'Please try to login again.'
          $('#alertModal').modal('show');

          setTimeout(() => {
          $('#alertModal').modal('hide'); 
        }, 2000);
        }
      },
      togglePasswordVisibility(passwordFieldId) {
      const passwordField = document.getElementById(passwordFieldId);
      passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
    },
    clearModal() {
    this.name = '';
    this.phone = '';
    this.email = '';
    this.password = '';
    this.nameError = '';
    this.phoneError = '';
    this.emailError = '';
    this.passwordError = '';
  }
  },
}

</script>


<style scoped>
.navbar {
  background-color: #fff;
  position: sticky;
  top: 0;
  z-index: 999;
}

.navbar-brand {
  font-weight: bold;
}

.navbar-nav .nav-link {
  color: #fff;
  transition: color 0.4s ease-in-out;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.navbar-nav .nav-link .material-icons {
  margin-right: 5px;
}

.navbar-nav .nav-link span {
  font-size: 0.8rem;
  white-space: normal;
}

.navbar-nav .nav-link:hover {
  color: orange;
}

.nav-item span {
  font-size: 0.8rem;
}

.navbar-nav .nav-link.active {
  color: orange;
  border-bottom: 2px solid orange;
}

.btn-login {
  height: 40px;
  background-color: orange;
  border: none;
  transition: color 0.4s ease-in-out;
}

.btn-login:hover {
  background-color: #ff8c00;
  color: green;
}

.btn-register {
  height: 40px;
  background-color: transparent;
  border: 1px solid #fff;
  color: #fff;
  margin-left: 15px;
}

.btn-register:hover {
  background-color: #fff;
  color: #000;
}

.dropdown-one {
  display: none;
}

.profile-dropdown {
  position: relative;
}

.profile-dropdown .profile-menu {
  display: none;
  position: absolute;
  background-color: #fff;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
  min-width: 100px;
  right: 0;
}

.profile-dropdown:hover .profile-menu {
  display: block;
}

.profile-dropdown .profile-menu {
  color: #000;
  padding: 10px;
  text-decoration: none;
  display: block;
}

.profile-dropdown .profile-menu a:hover {
  background-color: #f9f9f9;
}

.dropdown-item:hover {
  background: #ced4da;
}

@media (max-width: 991.98px) {
  .navbar-nav {
    flex-direction: column;
    align-items: flex-start;
  }

  .navbar-nav .nav-link {
    display: flex;
    flex-direction: row;
  }

  .navbar-nav .nav-link .material-icons {
    margin-right: 5px;
  }

  .nav-item {
    margin-bottom: 10px;
  }

  .dropdown-one {
    left: 25%;
    display: block;
    position: relative;
  }
  .nav-item {
    width: 100%;
  }

  .dropdown-two {
    display: none;
  }

  .profile-dropdown {
    margin-top: 10px;
  }

  .profile-dropdown .profile-menu {
    width: 2px;
    left: -100px;
    top: 0;
  }
}

@media (max-width: 885px) {
  .dropdown-one {
    left: 34%;
  }
}

@media (max-width: 767px) {
  .dropdown-one {
    left: 27%;
  }
}

@media (max-width: 428px) {
  .dropdown-one {
    left: 17%;
  }
}

@media (max-width: 360px) {
  .dropdown-one {
    left: 13%;
  }
}

@media (max-width: 320px) {
  .dropdown-one {
    left: 10%;
  }
}
</style>
