<template>
    <div class="bg-white rounded-lg border p-1 md:p-3 m-1">
      <h3 class="flex justify-center p-2">Post's {{ post.user }}</h3>
      <div class="flex flex-col gap-5 m-3">
        <!-- Comment Container -->
        <div v-for="comment in comments" :key="comment.id">
          <div class="flex w-full justify-between border rounded-md">
            <div class="p-3">
              <div class="flex gap-3 items-center">
                <img
                  :src="comment.avatar"
                  class="object-cover w-10 h-10 rounded-full border-2 border-emerald-400 shadow-emerald-400"
                />
                <h3 class="font-bold">{{ comment.user }}</h3>
              </div>
              <p class="text-gray-600 mt-2">{{ comment.text }}</p>
              <div class="flex justify-between mt-2">
                <button class="btn">{{ comment.time }}</button>
                <button class="btn">Like</button>
                <button class="btn" @click="toggleReplyForm(comment.id)">Reply</button>
              </div>
              <!-- Reply Form -->
              <div v-if="comment.showReplyForm" class="w-full px-3 mb-2 mt-6">
                <textarea
                  v-model="comment.newReply"
                  class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-400 focus:outline-none focus:bg-white"
                  placeholder="Reply"
                  required
                ></textarea>
                <div class="w-full flex justify-end px-3 my-3">
                  <input
                    type="submit"
                    @click="postReply(comment.id)"
                    class="btn btn-primary"
                    value="Post Reply"
                  />
                </div>
              </div>
              <!-- End Reply Form -->
            </div>
          </div>
          <!-- Reply Container -->
          <div v-if="comment.replies.length" class="text-gray-300 font-bold pl-8">|</div>
          <div v-for="reply in comment.replies" :key="reply.id" class="flex justify-between border ml-8 rounded-md">
            <div class="p-3">
              <div class="flex gap-3 items-center">
                <img
                  :src="reply.avatar"
                  class="object-cover w-10 h-10 rounded-full border-2 border-emerald-400 shadow-emerald-400"
                />
                <h3 class="font-bold">{{ reply.user }}</h3>
              </div>
              <p class="text-gray-600 mt-2">{{ reply.text }}</p>
              <div class="flex justify-between mt-2">
                <button class="btn">{{ reply.time }}</button>
                <button class="btn">Like</button>
                <button class="btn" @click="toggleReplyForm(reply.id)">Reply</button>
              </div>
            </div>
          </div>
        </div>
        <!-- END Comment Container -->
      </div>
      <div class="w-full px-3 mb-2 mt-6">
        <textarea
          v-model="newComment"
          class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-400 focus:outline-none focus:bg-white"
          placeholder="Comment"
          required
        ></textarea>
      </div>
      <div class="w-full flex justify-end px-3 my-3">
        <input
          type="submit"
          @click="postComment"
          class="btn btn-primary"
          value="Post Comment"
        />
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'CommentPost',
    props: {
      currentUser: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        post: {
          user: 'Post Author'
        },
        newComment: '',
        comments: []
      };
    },
    mounted() {
      this.loadComments();
    },
    methods: {
      postComment() {
        if (this.newComment.trim() !== '') {
          this.comments.push({
            id: this.comments.length + 1,
            user: this.currentUser.name,
            text: this.newComment,
            avatar: this.currentUser.avatar,
            time: 'just now',
            newReply: '',
            showReplyForm: false,
            replies: []
          });
          this.newComment = '';
          this.saveComments(); // Save comments after posting
        }
      },
      toggleReplyForm(commentId) {
        const comment = this.comments.find(comment => comment.id === commentId);
        comment.showReplyForm = !comment.showReplyForm;
      },
  
      postReply(commentId) {
        const comment = this.comments.find(comment => comment.id === commentId);
        if (comment.newReply.trim() !== '') {
          comment.replies.push({
            id: comment.replies.length + 1,
            user: this.currentUser.name,
            text: comment.newReply,
            avatar: this.currentUser.avatar,
            time: 'just now'
          });
          comment.newReply = '';
          comment.showReplyForm = false;
          this.saveComments(); // Save comments after replying
        }
      },
  
      saveComments() {
        localStorage.setItem('comments', JSON.stringify(this.comments));
      },
  
      loadComments() {
        const savedComments = localStorage.getItem('comments');
        if (savedComments) {
          this.comments = JSON.parse(savedComments);
        }
      }
    }
  };
  </script>
  
  <style>
  /* .btn {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
    cursor: pointer;
    background-color: #6c63ff;
    color: #ffffff;
    margin-right: 0.5rem;
  }
  
  .btn-primary {
    background-color: #4c51bf;
    color: #ffffff;
    border-color: #4c51bf;
  }
  
  .ml-8 {
    margin-left: 2rem;
  } */
  </style>
  