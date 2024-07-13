import { createStore } from 'vuex';
import axios from 'axios';

interface State {
  userInfo: {};
  notifications: [];
  role_id: number;
}

const store = createStore<State>({
  state: {
    userInfo: {},
    notifications: []
  },
  mutations: {
    SET_USER_INFO(state: State, userInfo: {}) {
      state.userInfo = userInfo;
    },
    SET_NOTIFICATIONS(state: State, notifications: []) {
      state.notifications = notifications;
    }
  },
  actions: {
    async fetchUserInfo({ commit }: { commit: any }) {
      try {
        const token = localStorage.getItem('access_token');
        const response = await axios.get(`http://127.0.0.1:8000/api/me`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        commit('SET_USER_INFO', response.data.data);
      } catch (error) {
        console.error('Error fetching user:', error);
      }
    },
    async fetchNotifications({ commit, state }: { commit: any, state: State }) {
      if (state.userInfo && state.userInfo.role_id) {
        let url = '';
        if (state.userInfo.role_id === 2) {
          url = `http://127.0.0.1:8000/api/notification/user/list`;
        } else if (state.userInfo.role_id === 3) {
          url = `http://127.0.0.1:8000/api/notification/company/list`;
        }
        try {
          const token = localStorage.getItem('access_token');
          const response = await axios.get(url, {
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
          commit('SET_NOTIFICATIONS', response.data.data);
        } catch (error) {
          console.error('Error fetching notifications:', error);
        }
      } else {
        console.error('User info or role_id is not available');
      }
    }
  }
});

export default store;