<template>
  <div>
    <NavBar />
    <div class="container">
      <h1 class="text-dark">List revenue of Adjay</h1>
      <p class="text-dark">Total: <span id="total">{{ total }}</span></p>
      <div class="controls">
        <button @click="listAllDays" class="list-day">List All Days</button>
        <input  type="text" v-model="searchQuery" placeholder="Search user or item..." />
        <Addrevenue @submit="addEntry" />
      </div>
      <div class="table-responsive">
        <table>
          <thead class=" text-nowrap">
            <tr>
              <th>ID</th>
              <th>Item</th>
              <th>Customer</th>
              <th>Date</th>
              <th>Earn</th>
            </tr>
          </thead>
          <tbody class=" text-nowrap">
            <tr class="text-dark" v-for="(entry, index) in filteredEntries" :key="index">
              <td>{{ entry.id }}</td>
              <td>{{ entry.item }}</td>
              <td>{{ entry.customer }}</td>
              <td>{{ entry.date }}</td>
              <td class="earn">{{ entry.earn }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </template>
  
  <script>
  import NavBar from "../../../Components/NavBar.vue";
  import Addrevenue from "../../../Components/dialogs/Addrevenue.vue";
  
  export default {
    name: 'ManagePaidAdjay',
    components: {
      Addrevenue,
      NavBar
    },
    data() {
      return {
        total: '',
        searchQuery: "",
        entries: JSON.parse(localStorage.getItem('entries')) || []
      };
    },
    computed: {
      filteredEntries() {
        const query = this.searchQuery.toLowerCase();
        return this.entries.filter(entry =>
          entry.customer.toLowerCase().includes(query) ||
          entry.item.toLowerCase().includes(query)
        );
      }
    },
    methods: {
      listAllDays() {
        alert("List All Days button clicked");
      },
      addEntry(newEntry) {
        newEntry.id = this.entries.length + 1;
        this.entries.push(newEntry);
        this.updateTotal();
        localStorage.setItem('entries', JSON.stringify(this.entries));
      },
      updateTotal() {
        this.total = this.entries.reduce((sum, entry) => sum + parseFloat(entry.earn), 0);
      }
    },
    mounted() {
      this.updateTotal();
    }
  };
  </script>
  
  <style scoped>
  .container {
    width: 90%;
    margin: 20px auto;
    background-color: white;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .controls {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    margin: 20px 0;
    gap: 30px;
  }
  
  .controls button {
    background-color: #e0e0e0;
    border: 1px solid #ccc;
    padding: 10px 20px;
    cursor: pointer;
  }
  
  .controls input {
    flex-grow: 1;
    margin: 0 10px;
    padding: 10px;
    border: 1px solid #ccc;
  }
  
  .table-responsive {
    margin-top: 20px;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  thead {
    background-color: black;
    color: white;
  }
  
  thead th {
    padding: 10px;
  }
  
  tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  tbody td {
    padding: 10px;
    text-align: start;
  }
  
  tbody .earn {
    color: red;
    font-weight: bold;
  }
  </style>
  