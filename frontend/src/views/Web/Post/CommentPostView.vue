<template>
    <div>
      <CommentPost :currentUser="currentUser" />
    </div>
  </template>
  
  <script>
  import CommentPost from '../../../Components/dialogs/CommentPost.vue';
  
  export default {
    name: 'commentPostView',
    components: {
      CommentPost
    },
    data() {
      return {
        currentUser: {
          name: 'Victoria', 
          avatar: 'path_to_avatar.jpg' 
        }
      };
    }
  };
  </script>
<style>

</style>