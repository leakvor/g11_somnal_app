<template>
    <NavBar/>
    <main class="content">
        <div class="container p-0">
            <h1 class="h3 mb-3">Messages</h1>

            <div class="card">
                <div class="row g-0">
                    <div class="chat-contact col-12 col-lg-5 col-xl-3 border-right p-4">
                        <div class="d-none d-md-block">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <input type="text" class="form-control my-3" placeholder="Search..." v-model="searchTerm">
                                </div>
                            </div>
                        </div>
                        <div class="button-group pb-2">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-success btn-sm p-2" @click="showChats"><i class="material-icons align-middle">chat_bubble</i>Chat</button>
                                <button class="btn btn-warning btn-sm ms-2 p-2" @click="showUsers"><i class="material-icons align-middle">person_add</i>Create Chat</button>
                            </div>
                        </div>

                        <button v-for="user in filteredUsers" :key="user.id" class="chat-item list-group-item list-group-item-action border-0" v-show="isUsers" @click="fetchAllMessages(user.id)">
                            <div class="badge bg-success float-right"></div>
                            <div class="d-flex align-items-start">
                                <img :src="user.profile ? `${BASE_URL}${user.profile}` : 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'" class="rounded-circle mr-1 border"  onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'" alt="" width="40" height="40">
                                <div class="flex-grow-1 ml-3">
                                    <div>
                                        <strong>
                                            {{ user.name }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </button>
                        <button v-for="chat in filteredChats" :key="chat.user_id" class="chat-item list-group-item list-group-item-action border-0" v-show="isChats" @click="fetchAllMessages(chat.user_id)">
                            <div class="badge bg-success float-right" v-if="chat.unread_count > 0">{{chat.unread_count}}</div>
                            <div class="badge bg-success float-right" v-else></div>
                            <div class="d-flex align-items-start">
                                <img :src="chat.user_profile ? `${BASE_URL}${chat.user_profile}` : 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'" class="rounded-circle mr-1 border" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'" alt="" width="40" height="40">
                                <div class="last-message text-truncate">
                                    <div>
                                        <strong>
                                            {{ chat.user_name }}
                                        </strong>
                                    </div>
                                    <small class="opacity-50">{{ chat.last_message }}</small>
                                </div>
                            </div>
                        </button>

                        <hr class="d-block d-lg-none mt-1 mb-0">
                    </div>

                    <div id="chatRoom" class="col-12 col-lg-7 col-xl-9">
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="d-flex align-items-center py-1" v-if="showHeader">
                                <div class="position-relative">
									<img :src="userProfile.profile ? `${BASE_URL}${userProfile.profile}` : 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'" class="userProfile rounded-circle mr-1"  onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'" alt="" width="40" height="40" />
                                </div>
                                <div class="flex-grow-1 pl-3">
                                    <strong>{{ userProfile.name }}</strong>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>

                        <div class="position-relative">
                            <div class="chat-messages p-4" ref="chatMessages">
                                <div v-for="message in messages" :key="message.id" :class="{'chat-message-left': message.user_id !== currentUserId,'chat-message-right': message.user_id === currentUserId}">
                                    <div>
                                        <img :src="message.userProfile ? `${BASE_URL}${message.userProfile}` : 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'" class="userProfile rounded-circle mr-1"  onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'" alt="" width="40" height="40" />
									</div>
										<div class="flex-shrink-1 rounded py-2 px-3 ml-3 mt-1" :class="{'message-left': message.user_id !== currentUserId,'message-right dropdown-toggle dropdown-toggle-split': message.user_id === currentUserId}" v-if="message.user_id === currentUserId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="font-weight-bold font-bold mb-1 text-primary">
                                            You
                                        </div>
                                        <div class="description">
                                            <img :src="`http://localhost:8000/images/chat/${message.image}`" v-if="message.image" class="w-100 chat-imag" alt="image" @click="showLightbox(message.image)" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'" />
                                            <p class="message text-wrap">{{ message.message }}</p>
                                        </div>
                                        <div id="chat-time" class="text-muted small text-nowrap mt-2">
                                            {{ message.created_at_formatted }}
                                        </div>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item message-delete" @click="deleteMessage(message.id)">Delete</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item message-edit" @click="editMessage(message)">Edit</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="flex-shrink-1 rounded py-2 px-3 ml-3 mt-1" :class="{'message-left': message.user_id !== currentUserId, 'message-right dropdown-toggle dropdown-toggle-split': message.user_id === currentUserId}" v-else>
                                        <div class="font-weight-bold font-bold mb-1 text-primary">
                                            {{ message.userName }}
                                        </div>
                                        <div class="description">
                                            <img :src="`http://localhost:8000/images/chat/${message.image}`" v-if="message.image" class="w-100 chat-imag" alt="image" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png'" />
                                            <p class="message text-wrap">{{ message.message }}</p>
                                        </div>
                                        <div id="chat-time" class="text-muted small text-nowrap mt-2">
                                            {{ message.created_at_formatted }}
                                        </div>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item message-delete" @click="deleteMessage(message.id)">Delete</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item message-edit" @click="editMessage(message)">Edit</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="chat-box flex-grow-0 py-3 px-4 border-top" v-show="showChatBox">
                            <form @submit.prevent="sendMessage">
                                <div class="input-group position-relative">
                                    <label class="btn btn-secondary btn-file position-relative">
                                        <i class="fa-solid fa-image"></i>
                                        <input type="file" accept="image/*" style="display: none" @change="handleFileUpload" />
                                        <span v-if="unreadMessages > 0" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ unreadMessages }}
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </label>

                                    <input type="text" class="form-control" placeholder="Type your message" v-model="message" />
                                    <button type="submit" class="btn btn-primary">
                                        <i :class="messageId ? 'fa-solid fa-pen-to-square' : 'fa-solid fa-paper-plane'"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" @click="cancelEdit">
                                        <i class="fa-solid fa-rectangle-xmark"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>


<script>
import axios from 'axios'
import NavBar from "@/Components/NavBar.vue";
import FooterView from "@/Components/Footer.vue";
import { useAuthStore } from '../../../stores/auth-store.ts'
import { useRoute } from 'vue-router'
import { computed } from 'vue'
import pusher from '../../../pusherService';
// base url
// url of api
const CHAT_API_URL = 'http://127.0.0.1:8000/api/chat/'

export default {
	components: {
		NavBar,
		FooterView
	},
		data() {
		return {
			BASE_URL:'http://127.0.0.1:8000/images/',
			users: [],
			chats: JSON.parse(localStorage.getItem('chats')) || [],
			messages: [],
			userProfile: [],
			message: '',
			image: null,
			recieverId: null,
			currentUserId: null,
			unreadMessages: 0,
			messageId: null, 
			cambodiaDateTime: new Date().toLocaleString('en-US', { timeZone: 'Asia/Phnom_Penh' }),
			isChats: true,
			isUsers: false,
			showChatBox: false,
			showHeader: false,
			searchTerm: ''
		};
	},

	setup() {
      const authStore = useAuthStore()
      const currentUserId = computed(() => authStore.user.id)
      return {
        currentUserId
      }
    },
	computed: {
		filteredUsers() {
			return this.users.filter(user => user.name.toLowerCase().includes(this.searchTerm.toLowerCase()));
		},
		filteredChats() {
			const filtered = this.chats.filter(chat => chat.user_name.toLowerCase().includes(this.searchTerm.toLowerCase()));
			return filtered;
		}
	},
	updated() {
    	this.scrollToBottom(); 
  	},
	mounted() {
        this.fetchAllChatUsers();
		this.fetchAllUsers();
        const channel = pusher.subscribe('chat');
        channel.bind('MessageSent', (data) => {
            this.messages.push(data.message);
            this.fetchAllChatUsers();
        });

		
	},
	methods: {
		// show all chat to u
		async showChats(){
			this.isChats = true
			this.isUsers = false
		},
		// show all users
		async showUsers(){
			this.isUsers = true
			this.isChats = false
		},
		// get all users
		async fetchAllUsers() {
		try {
			const token = localStorage.getItem('access_token');
			const response = await axios.get(`${CHAT_API_URL}list/users/makeChat`, {
			headers: {
				Authorization: `Bearer ${token}`
			}
			});
			this.users = response.data;
			// console.log(response.data);
		} catch (error) {
			console.error('Error fetching users:', error);
		}
		},

		// get the user profile by id
		async getUserProfile(userId) {
			try {
				const token = localStorage.getItem('access_token');
				const response = await axios.get(`${CHAT_API_URL}user/profile/${userId}`, {
					headers: {
						Authorization: `Bearer ${token}`
					}
				});
				this.userProfile = response.data;
				this.showHeader =true;
			} catch (error) {
				console.error('Error fetching user profile:', error);
			}
		},

		// get who chat to u
		async fetchAllChatUsers() {
			try {
				const token = localStorage.getItem('access_token');
				const response = await axios.get(`${CHAT_API_URL}list/users`, {
					headers: {
						Authorization: `Bearer ${token}`
					}
				});
				// console.log(response.data);
				this.chats = response.data;
			} catch (error) {
				console.error(error);
			}
		},

		// get the message by user_id
		async fetchAllMessages(userId) {
            try {
                const token = localStorage.getItem('access_token');
                const response = await axios.get(`${CHAT_API_URL}get/message/${userId}`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });

                // Update recipient ID and show chat box
                this.recieverId = userId;
                this.showChatBox = true;

                // Optionally, handle message processing or manipulation here
                this.messages = response.data;

                // Fetch user profile and mark messages as seen
                this.getUserProfile(userId)
                this.seenMessage(userId)

                // Scroll to bottom of chat messages
                this.scrollToBottom()

                // Optionally return messages or handle further actions
                return response.data;

            } catch (error) {
                console.error('Error fetching messages:', error);
            }
        },


		// edit message
		editMessage(message) {
			this.message = message.message 
			this.messageId = message.id 
		},
		// send message
		async sendMessage() {
			if (!this.message.trim() && !this.image) return;

			try {
				const token = localStorage.getItem('access_token');
				const formData = new FormData();
				formData.append('reciever_id', this.recieverId);
				formData.append('message', this.message);
				formData.append('created_at', this.cambodiaDateTime);
				formData.append('updated_at', this.cambodiaDateTime);
				if (this.image) {
				formData.append('image', this.image);
				}

				let url = `${CHAT_API_URL}send/message`;
				if (this.messageId) {
				url = `${CHAT_API_URL}update/message/${this.messageId}`;
				}

				const response = await axios.post(url, formData, {
				headers: {
					Authorization: `Bearer ${token}`,
					'Content-Type': 'multipart/form-data',
				},
				});
				this.fetchAllMessages(this.recieverId)
                this.fetchAllChatUsers();
				this.message = null;
				this.image = null;
				this.messageId = null 
				this.unreadMessages = 0;
				this.scrollToBottom();
			} catch (error) {
				this.fetchAllMessages(this.recieverId)
				this.message = null;
				this.image = null;
				this.messageId = null 
				this.unreadMessages = 0;
				this.scrollToBottom()
				console.error('Error sending message:', error);
			}
		},

		// mark message as seen
		async seenMessage(id) {
			try {
				const token = localStorage.getItem('access_token');
				const response = await axios.post(`${CHAT_API_URL}seen/message/user/${id}`, {}, {
					headers: {
						Authorization: `Bearer ${token}`
					}
				});
                this.fetchAllChatUsers();
			} catch (error) {
				console.error('Error marking message as seen:', error);
			}
		},

		scrollToBottom() {
			const chatMessages = this.$refs.chatMessages;
			chatMessages.scrollTop = chatMessages.scrollHeight;
		},

		// handle upload image
		handleFileUpload(event) {
			const file = event.target.files[0]
			if (file) {
			this.image = file
			this.unreadMessages =1
			}
		},
		// cancel the input
		async cancelEdit() {
				this.message = '' 
				this.messageId = null 
				this.unreadMessages = 0
		},

		//  delete the message by id
		async deleteMessage(messageId) {
			if (!window.confirm('Are you sure you want to delete this message?')) {
			return
			}
			try {
			const token = localStorage.getItem('access_token')
			const response = await axios.delete(
				`${CHAT_API_URL}delete/message/${messageId}`,
				{
				headers: {
					Authorization: `Bearer ${token}`
				}
				}
			)
			// get the message by reciever_id
			this.fetchAllMessages(this.recieverId)
			} catch (error) {
			console.error('Error deleting message:', error)
			}
		},

	},
	watch: {
		chats: {
			handler(newVal) {
				localStorage.setItem('chats', JSON.stringify(newVal));
			},
			deep: true
		}
	},

}
  </script>
  
<style scoped>

.chat-imag {
    max-width: 400px;
  }

.card {
  position: sticky;
  top: 0;
  z-index: 100;
}

.chat-contact {
  border-right: 1px solid rgba(128, 128, 128, 0.405);
  
}

.chat-messages {
    display: flex;
    flex-direction: column;
    max-height: 550px;
    overflow-y: scroll
}

.chat-item{
  cursor: pointer;
  padding: 5px 10px;
  border-radius: 5px;
  margin: 5px;
  border: 1px solid #ccc;
  background-color: #fff;
  transition: background-color 0.3s ease-in-out;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.chat-item:hover{
  background-color: #eef0f9;
}
.last-message{
	max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.chat-message-left,
.chat-message-right {
    display: flex;
    flex-shrink: 0
}

.chat-message-left {
    margin-right: auto
}

.chat-message-right {
    flex-direction: row-reverse;
    margin-left: auto
}
.message-left{
    background-color: #f1f1f1;
}
.message-right{
  background-color: #eef0f9;
}
.py-3 {
    padding-top: 1rem!important;
    padding-bottom: 1rem!important;
}
.px-4 {
    padding-right: 1.5rem!important;
    padding-left: 1.5rem!important;
}
.flex-grow-0 {
    flex-grow: 0!important;
}
.border-top {
    border-top: 1px solid #dee2e6!important;
}
.list-group-item{
  margin:5px ;
}
.chat-box {
	padding: 10px 0;
	background-color: #fff;
    position: sticky;
    bottom: 0;
    z-index: 100;
}
.form-control:focus,
  .btn:focus {
    box-shadow: none;
  }
  .dropdown-toggle::after {
    display: none;
  }
  .message-delete {
    color: red;
  }

  .message-edit {
    color: blue;
  }
</style>
