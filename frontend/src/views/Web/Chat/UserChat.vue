<template>
  <div class="chat-placeholder">
    <NavBar />
    <main class="container py-5">
      <section class="empty-panel text-center">
        <i class="material-icons">chat_bubble_outline</i>
        <h1>Messages</h1>
        <p>Your conversations will appear here when chat is available.</p>
        <router-link to="/" class="btn btn-success">Back Home</router-link>
      </section>
    </main>
  </div>
</template>

<script>
import NavBar from '@/Components/NavBar.vue'

export default {
  name: 'UserChat',
  components: {
    NavBar
  }
}
</script>

<style scoped>
.empty-panel {
  max-width: 560px;
  margin: 64px auto;
  padding: 48px 24px;
  background: #fff;
  border: 1px solid #dfe7dc;
  border-radius: 8px;
  box-shadow: 0 12px 32px rgba(31, 41, 51, 0.08);
}

.empty-panel i {
  color: #177245;
  font-size: 56px;
  margin-bottom: 16px;
}

.empty-panel h1 {
  color: #1f2933;
  font-size: 2rem;
  font-weight: 800;
}

.empty-panel p {
  color: #667085;
  margin-bottom: 24px;
}
</style>
