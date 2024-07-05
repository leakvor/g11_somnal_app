<template>
  <nav class="navbar navbar-expand-lg bg-success ">
    <div class="container-fluid ">
      <router-link to="/" class="navbar-brand text-white">
        <img src="../assets/image/logo.png" alt="logo" class="w-10 h-10" />
        <span class="text-xl font-bold ms-1">SOMNAL</span>
      </router-link>
      <div class="profile-dropdown dropdown-one mb-2">
        <router-link to="/" href="#" class="d-flex align-items-center" role="button" id="profileDropdown"
          data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8AJM9wkP__z2M-hovSAWcTb_9XJ6smy3NKw&s"
            alt="Profile" style="width: 40px; height: 40px; border-radius: 50%;">
        </router-link>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
          <li>
            <router-link to="/profile" class="dropdown-item d-flex align-items-center ">
              <i class="material-icons icon-align">person</i>
              Profile
            </router-link>
          </li>

          <li>
            <router-link to="/editProfile" class="dropdown-item d-flex align-items-center ">
              <i class="material-icons icon-align">edit_square</i>
              Edit Profile
            </router-link>
          </li>

          <li>
            <router-link to="/favorite-page" class="dropdown-item d-flex align-items-center ">
              <i class="material-icons icon-align">favorite</i>
              Favorite
            </router-link>
          </li>

          <li>
            <router-link to="/add_post" class="dropdown-item d-flex align-items-center ">
              <i class="material-icons icon-align">post_add</i>
              Add Post
            </router-link>
          </li>
          

          <li>
            <router-link to="/logout" @click="authStore.logout()" class="dropdown-item d-flex align-items-center ">
              <i class="material-icons icon-align">logout</i>Logout
            </router-link>
          </li>
        </ul>
      </div>
      <button class="navbar-toggler position" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">

          <li class="nav-item me-4">
            <router-link to="/" class="nav-link" :class="{ active: isActive('/') }">
              <i class="material-icons">home</i>
              <span>Home</span>
            </router-link>
          </li>

          <li class="nav-item me-4">
            <router-link to="/post" class="nav-link" :class="{ active: isActive('/post') }">
              <i class="material-icons">home</i>
              <span>Home</span>
            </router-link>
          </li>

          <li class="nav-item me-4">
            <router-link to="/company/dashboard" class="nav-link" :class="{ active: isActive('/company/dashboard') }">
              <i class="material-icons">dashboard</i>
              <span>Dashboard</span>
            </router-link>
          </li>

          <li class="nav-item me-4">
            <router-link to="/salesrequest" class="nav-link" :class="{ active: isActive('/service') }">
              <i class="material-icons">engineering</i>
              <span>Services</span>
            </router-link>
          </li>

          <li class="nav-item me-4">
            <router-link to="/about" class="nav-link" :class="{ active: isActive('/about') }">
              <i class="material-icons">info</i>
              <span>About Us</span>
            </router-link>
          </li>

          <li class="nav-item me-4">
            <router-link to="/contact" class="nav-link" :class="{ active: isActive('/contact') }">
              <i class="material-icons">call</i>
              <span>Contact Us</span>
            </router-link>
          </li>

          <li class="nav-item me-4">
            <router-link to="/partner" class="nav-link" :class="{ active: isActive('/partner') }">
              <i class="material-icons icon-align">people</i>
              <span class="text-below-icon">Our Partner</span>
            </router-link>
          </li>

          <li class="nav-item d-flex align-items-center me-4">
            <button class="nav-link text-white btn btn-login custom-hover pe-3 ps-3">Login</button>
            <button class="nav-link btn btn-register pe-3 ps-3">Register</button>
          </li>


          <li class="nav-item d-flex align-items-center me-4 ">
            <router-link to="/chat" class="nav-link position-relative" :class="{ active: isActive('/chat') }">
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">+99 <span class="visually-hidden">unread messages</span></span>
               
              <i class="material-icons icon-align">chat_bubble</i>
              <span class="text-below-icon">Chat</span>
            </router-link>
          </li>

          <li class="nav-item d-flex align-items-center me-4">
            <router-link to="/notifications" class="nav-link position-relative" :class="{ active: isActive('/notifications') }">
              <span class="position-absolute top-0 start-50 ms-3 translate-middle badge rounded-pill bg-danger"  id="notification_number">+99 <span class="visually-hidden">unread messages</span></span>
              <i class="material-icons icon-align">notifications</i>
              <span class="text-below-icon">Notifications </span>
            </router-link>
          </li>

          <li class="nav-item d-flex align-items-center">
            <div class="profile-dropdown dropdown-two ">
              <router-link to="/" href="#" class="d-flex align-items-center" role="button" id="profileDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8AJM9wkP__z2M-hovSAWcTb_9XJ6smy3NKw&s"
                  alt="Profile" class="mb-2" style="width: 40px; height: 40px; border-radius: 50%;">
              </router-link>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li><router-link to="/profile" class="dropdown-item d-flex align-items-center ">
                    <i class="material-icons icon-align">person</i>
                    View Profile
                  </router-link>
                </li>

                <li>
                  <router-link to="/editProfile" class="dropdown-item d-flex align-items-center ">
                    <i class="material-icons icon-align">edit_square</i>
                    Edit Profile
                  </router-link>
                </li>

                <li>
                  <router-link to="/favorite-page" class="dropdown-item d-flex align-items-center ">
                    <i class="material-icons icon-align">favorite</i>
                    Favorite
                  </router-link>
                </li>

                <li>
                  <router-link to="/addPost" class="dropdown-item d-flex align-items-center ">
                    <i class="material-icons icon-align">post_add</i>
                    Add Post
                  </router-link>
                </li>

                <li>
                  <router-link to="/logout" @click="authStore.logout()"
                    class="dropdown-item d-flex align-items-center ">
                    <i class="material-icons icon-align">logout</i>Logout
                  </router-link>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
</template>

<script>
import { onMounted, watch } from 'vue';
import { useAuthStore } from '../stores/auth-store';
import { useRoute } from 'vue-router';

// const authStore = useAuthStore();

export default {
  name: "NavBar",
  setup() {
    const route = useRoute();

    const isActive = (path) => route.path === path;

    return {
      isActive,
    };
  },
  mounted() {
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(navLink => {
      navLink.addEventListener('click', (event) => {
        navLinks.forEach(link => link.classList.remove('active'));
        event.currentTarget.classList.add('active');

        if (window.innerWidth <= 995) {
          const navbarToggle = document.querySelector('.navbar-toggler');
          const navbarNav = document.getElementById('navbarNav');
          if (navbarNav.classList.contains('show')) {
            navbarToggle.click();
          }
        }
      });
    });
  },
};
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

.dropdown-item:hover{
  background:#ced4da;
}

@media(max-width: 991.98px) {
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
  .nav-item{
    width:100%;
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

@media(max-width: 885px) {
  .dropdown-one {
    left: 34%;
  }
}

@media(max-width: 767px) {
  .dropdown-one {
    left: 27%;
  }
}

@media(max-width: 428px) {
  .dropdown-one {
    left: 17%;
  }
}

@media(max-width: 360px) {
  .dropdown-one {
    left: 13%;
  }
}

@media(max-width: 320px) {
  .dropdown-one {
    left: 10%;
  }
}
</style>
