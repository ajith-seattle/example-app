<template>
    <div>
        <table>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <tr v-for="(user, index) in users" :key="user.id">
                <td>{{ index + 1 }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>
                    <a :href="editUserUrl(user.id)">Edit</a>
                    <button @click="confirmDelete">Delete</button>
                </td>
            </tr>
        </table>
        <div>
            <button
                @click="getUsers(pagination.prev_page_url)"
                :disabled="!pagination.prev_page_url"
            >
                &laquo; Previous
            </button>
            <span>{{ pagination.current_page }}</span>
            <button
                @click="getUsers(pagination.next_page_url)"
                :disabled="!pagination.next_page_url"
            >
                Next &raquo;
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            users: [], // Initial empty array to hold user data
            pagination: {}, // Object to hold pagination information
            successMessage: "", // Success message variable
        };
    },
    methods: {
      getUsers(url) {
  axios
    .get(url)
    .then(response => {
      this.users = response.data.data;
      this.pagination = {
        current_page: response.data.current_page,
        last_page: response.data.last_page,
        prev_page_url: response.data.prev_page_url,
        next_page_url: response.data.next_page_url
      };
    })
    .catch(error => {
      console.error(error);
    });
}

        deleteUser(id) {
            // Handle the logic to delete a user based on their 'id'
            // You can make an API call to delete the user and update the 'users' variable
        },
        editUserUrl(id) {
            // Return the URL to edit the user based on their 'id'
            // Modify this method to return the actual URL or use Vue Router to navigate to the edit page
        },
        confirmDelete() {
            // Show a confirmation dialog before deleting the user
            // You can use a modal or a custom implementation based on your preference
        },
    },
    mounted() {
        // Call the 'getUsers' method when the component is mounted to fetch initial user data
        this.getUsers("/users"); // Provide the URL to fetch the user data from the server
    },
};
</script>

<style>
/* Add your custom styles here */
</style>
