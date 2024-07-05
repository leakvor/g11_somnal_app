<template>
  <div class="container mt-5">
    <div class="d-flex flex-column justify-content-center" id="firstchild">
      <div class="d-flex justify-content-center text-orange p-3 bg-success rounded-top">
        <h2>View Post</h2>
      </div>
      <div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>UserName</th>
              <th>Post-ID</th>
              <th class="active">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item,) in data" :key="item.ID">
              <td>{{ item.ID }}</td>
              <td>{{ item['Username'] }}</td>
              <td>
                <a href="#" @click.prevent="handlePostIdClick(item['Post-ID'])">{{ item['Post-ID'] }}</a>
              </td>
              <td class="d-flex justify-content-end">
                <button
                  v-for="action in item.actions"
                  :key="action"
                  :class="`btn btn-${getButtonClass(action)}`"
                  @click="handleActionClick(item, action)"
                >
                  {{ action }}
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: [
        {
          ID: "01",
          "Username": "Tiv",
          "Post-ID": "https://adjay.com",
          actions: ["Buy", "Padding", "Cancel"]
        },
        {
          ID: "02",
          "Username": "Vouk",
          "Post-ID": "https://adjay.com",
          actions: ["Buy", "Padding", "Cancel"]
        },
        {
          ID: "03",
          "Username": "Thary",
          "Post-ID": "https://adjay.com",
          actions: ["Buy", "Padding", "Cancel"]
        },
        {
          ID: "04",
          "Username": "leak",
          "Post-ID": "https://adjay.com",
          actions: ["Buy", "Padding", "Cancel"]
        },
        {
          ID: "05",
          "Username": "leak",
          "Post-ID": "https://adjay.com",
          actions: ["Buy", "Padding", "Cancel"]
        },
        {
          ID: "06",
          "Username": "leak",
          "Post-ID": "https://adjay.com",
          actions: ["Buy", "Padding", "Cancel"]
        }
      ]
    };
  },
  methods: {
    deleteRow(index) {
      this.data.splice(index, 1);
      alert("Sure you want to cancel?");
    },
    handlePostIdClick(postId) {
      alert(`View Post ID: ${postId}`);
    },
    handleActionClick(item, action) {
      if (action === "Buy") {
        alert(`Sure you want buy ?: ${item['Post-ID']}`);
      } else if (action === "Cancel") {
        this.deleteRow(this.data.indexOf(item));
      } else {
        alert(`Sure you want:  ${item['Post-ID']}`);
      }
    },
    getButtonClass(action) {
      if (action === "Buy") {
        return "success";
      } else if (action === "Padding") {
        return "warning";
      } else if (action === "Cancel") {
        return "danger";
      } else {
        return "secondary";
      }
    }
  }
};
</script>

<style scoped>

  th,
  td {
    text-align: left;
  }
  th{
    font-weight: bold;
  }
  button {
    margin-right:6%;
  }
  button.success {
    background-color: #4caf50;
    color: white;
  }
  button.warning {
    background-color:rgb(255, 157, 0);
    color: black;
  }
  button.danger {
    background-color: #f44336;
    color: white;
  }
  button.btn-secondary {
    background-color: #6c757d;
    color: white;
  }
  
  /* Mobile */
@media (max-width: 767px) {
  .table thead {
    display:none;

  }
 

  .table,
  .table tbody,
  .table tr,
  .table td {
    display: block;
    
  }

  .table tr {
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #dee2e6;
  }

  .table td {
    position: relative;
  }
  .table td .button{
    margin-left: 50px;
  }

  .table td::before {
    content: attr(data-label);
    position: absolute;
    left: 0;
    width: 50%;
    font-weight: bold;
  
  }
}

/* Tablet */
@media (min-width: 768px) and (max-width: 991px) {
  .table {
    font-size: 0.9rem;
  }

  .table td,
  .table th {
    padding: 0.5rem;
  }
   button {
    margin-right:6%;
  }
}

/* Laptop */
@media (min-width: 992px) {
  .table {
    font-size: 1rem;
  }

  .table td,
  .table th {
    padding: 0.75rem;
  }
  .active{
    display: flex;
    justify-content:center;
  }
}

</style>