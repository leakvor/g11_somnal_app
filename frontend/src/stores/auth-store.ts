import { defineStore } from 'pinia';
import { ref } from 'vue';
import Cookies from 'js-cookie';


interface UserData {
  user: {
    id: number;
    name: string;
    profile: string | null;
    role_id: number; 
  };
  access_token: string;
}

export const useAuthStore = defineStore('auth', () => {
  const user = ref<UserData['user'] | null>(null);
  const isAuthenticated = ref(false);
  const isAuthenticatedUser = ref(false);
  const isAuthenticatedCompany = ref(false);

  const loadUserFromCookie = () => {
    const userCookie = Cookies.get('user');
    if (userCookie) {
      const userData = JSON.parse(userCookie);
      user.value = userData;
      isAuthenticated.value = true;
      if (userData.role_id === 2) {
        isAuthenticatedUser.value = true;
      } else if (userData.role_id === 3) {
        isAuthenticatedCompany.value = true;
      }
    }
  };

  // Call loadUserFromCookie when initializing the store
  loadUserFromCookie();

  const login = (userData: UserData) => {
    user.value = userData.user;
    isAuthenticated.value = true; // Set authenticated state
    
    // Set role-based authentication states
   
    
    // Store token in localStorage
    localStorage.setItem('access_token', userData.access_token);
    
    // Store user data in cookies
    Cookies.set('user', JSON.stringify(userData.user));
    
    if (userData.user.role_id === 2) {
      isAuthenticatedUser.value = true;
    } else if (userData.user.role_id === 3) {
      isAuthenticatedCompany.value = true;
    }
  };

  const logout = () => {
    user.value = null;
    isAuthenticated.value = false;
    isAuthenticatedUser.value = false; // Reset role-based states
    isAuthenticatedCompany.value = false; // Reset role-based states
    localStorage.removeItem('access_token');
    Cookies.remove('user');
    
  };

  return {
    user,
    isAuthenticated,
    isAuthenticatedUser,
    isAuthenticatedCompany,
    login,
    logout,
    // loadUserFromCookie,
  };
});
