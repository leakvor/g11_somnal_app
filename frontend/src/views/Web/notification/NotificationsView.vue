<template>
    <div>
        
    <div class="p-4">
      <h2 class="text-2xl font-bold mb-4">Notifications</h2>
      <div>
        <h3 class="text-xl font-semibold mb-2">New</h3>
        <div class="space-y-4">
          <NotificationItem  />
        </div>
      </div>
      <div class="mt-6">
        <h3 class="text-xl font-semibold mb-2">Earlier</h3>
        <div class="space-y-4">
          <NotificationItem
           />
        </div>
      </div>
    </div>
</div>
  </template>
  
  <script>
  import NotificationItem from '../../../Components/notification/notificationItem.vue';
  export default {
    components:{
        NotificationItem
    }
  }
  </script>

  
  
  <style scoped></style>
  