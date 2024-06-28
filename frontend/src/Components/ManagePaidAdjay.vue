<template>
    <div class="container">
      <h1>List revenue of Adjay</h1>
      <p>Total: <span id="total">{{ total }}</span></p>
      <div class="controls">
        <button @click="listAllDays" class="list-day">List All Days</button>
        <input type="text" v-model="searchQuery" placeholder="Search user or item..." />
        <!-- <button @click="showForm = true"> + Add</button> -->
        <Addrevenue></Addrevenue>
      </div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Earn</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(entry, index) in filteredEntries" :key="index">
            <td>{{ entry.id }}</td>
            <td>{{ entry.item }}</td>
            <td>{{ entry.customer }}</td>
            <td>{{ entry.date }}</td>
            <td class="earn">{{ entry.earn }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import Addrevenue from "./dialogs/Addrevenue.vue";
  export default {
    name: 'ManagePaidAdjay',
    components: {
      Addrevenue
    },
    data() {
      return {
        total: '',
        searchQuery: "",
        showForm: false,
        entries: JSON.parse(localStorage.getItem('entries')) || [],
        newEntry: {
          id: null,
          item: '',
          customer: '',
          date: '',
          earn: ''
        }
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
      closeForm() {
        this.showForm = false;
        this.clearForm();
      },
      clearForm() {
        this.newEntry = {
          id: null,
          item: '',
          customer: '',
          date: '',
          earn: 0
        };
      },
      submitForm() {
        if (this.newEntry.item && this.newEntry.customer && this.newEntry.date && this.newEntry.earn) {
          this.newEntry.id = this.entries.length + 1;
          this.entries.push({ ...this.newEntry });
          this.updateTotal();
          this.closeForm();
          this.$emit('add-entry', { ...this.newEntry });
        } else {
          alert("Please fill all the fields before adding an entry.");
        }
      },
      updateTotal() {
        this.total = this.entries.reduce((sum, entry) => sum + parseFloat(entry.earn), 0);
        localStorage.setItem('entries', JSON.stringify(this.entries));
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
    align-items: center;
    margin: 20px 0;
    gap: 30px;
  }
  
  .controls button {
    background-color: #e0e0e0;
    border: 1px solid #ccc;
    padding: 10px 20px;
    cursor: pointer;
    margin-right: 1rem;
  }
  
  .controls button:last-child {
    background-color: green;
    color: white;
    border: none;
  }
  
  .controls input {
    flex-grow: 1;
    margin: 0 10px;
    padding: 10px;
    border: 1px solid #ccc;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
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
  