

<script>
import { useToast } from 'vue-toastification';
import axios from 'axios';
import { ref, onMounted } from 'vue';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

export default {
name: 'NotificationComponent',
setup() {
  const user_info = ref(null);
  const notification_alert = ref([]);
  const toast = useToast();

  const fetchUser = async () => {
    try {
      const token = localStorage.getItem('access_token');
      const response = await axios.get('http://127.0.0.1:8000/api/me', {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      user_info.value = response.data.data;
      console.log('User info:', user_info.value);
    } catch (error) {
      console.error('Error fetching user:', error);
      // Handle error fetching user info, e.g., redirect to login
    }
  };

  const getAlert = async () => {
    try {
      await fetchUser(); // Ensure user info is fetched before proceeding

      if (!user_info.value || !user_info.value.role_id) {
        throw new Error('User info or role_id is not available');
      }

      let endpoint = '';
      if (user_info.value.role_id === 2) {
        endpoint = 'user';
      } else if (user_info.value.role_id === 3) {
        endpoint = 'company';
      }

      const token = localStorage.getItem('access_token');
      const response = await axios.get(
        `http://127.0.0.1:8000/api/notification/${endpoint}/list/alert`,
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );

      notification_alert.value = response.data.data;

      for (const notification of notification_alert.value) {
        toast.info(notification.message);
        if (notification.id) {
          await markAsSeen(notification.id);
        }
      }
    } catch (error) {
      console.error('Error fetching notifications:', error);
      // Handle error fetching notifications
    }
  };

  const markAsSeen = async (id) => {
    try {
      const token = localStorage.getItem('access_token');
      await axios.get(`http://127.0.0.1:8000/api/notification/status/${id}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
    } catch (error) {
      console.error('Error marking notification as seen:', error);
      // Handle error marking notification as seen
    }
  };

  onMounted(() => {
    getAlert();
    window.Pusher = Pusher;
    window.Echo = new Echo({
      broadcaster: 'pusher',
      key: 'bad4962d55e08304a906', 
      cluster: 'ap1', // Replace with your Pusher cluster
      encrypted: true,
    });

    Echo.channel('notifications')
      .listen('.notification.created', (e) => {
        notification_alert.value.push(e.notification);
        toast.info(e.notification.message);
      });
  });

  return {
    notification_alert,
    user_info,
  };
},
};
</script>
