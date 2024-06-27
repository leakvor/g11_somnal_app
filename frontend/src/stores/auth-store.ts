import { defineStore } from 'pinia';
import { ref } from 'vue';
import Cookies from 'js-cookie';

interface UserData {
  user: {
    id: number;
    name: string;
    profile: string | null;

  };
  // Define other necessary properties
  access_token: string;
}

export const useAuthStore = defineStore('auth', () => {
  const user = ref<UserData['user'] | null>(null);
  const isAuthenticated = ref(false);

  const loadUserFromCookie = () => {
    const userCookie = Cookies.get('user');
    if (userCookie) {
      user.value = JSON.parse(userCookie);
      isAuthenticated.value = true;
    }
  };

  const login = (userData: UserData) => {
    user.value = userData.user;
    isAuthenticated.value = true;
    // Store token in localStorage
    localStorage.setItem('access_token', userData.access_token);
    // Store user data in cookies
    Cookies.set('user', JSON.stringify(userData.user));
  };

  const logout = () => {
    user.value = null;
    isAuthenticated.value = false;
    localStorage.removeItem('access_token');
    Cookies.remove('user');
  };

  return {
    user,
    isAuthenticated,
    login,
    logout,
    loadUserFromCookie,
  };
});
