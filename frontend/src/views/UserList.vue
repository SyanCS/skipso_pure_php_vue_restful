<template>
  <v-container>
    <v-data-table 
      :headers="headers" 
      :items="items" 
      @click:row="rowClicked"
      class="mt-5"
    />
    <user-modal 
      :selected-user="selectedUser"
      :show="showModal"
      @changeValue="showModal = $event"
    />
  </v-container>
</template>

<script>
import UserModal from "@/components/UserModal.vue";
import UserService from "@/services/UserService.js";

export default {
  components: {
    UserModal
  },
  data() {
    return {
      headers: [
        { text: "Name", value: "name" },
        { text: "Username", value: "username" },
        { text: "Email", value: "email" },
        { text: "Phone", value: "phone" },
        { text: "Website", value: "website" },
        { text: "Company Name", value: "company.name" },
      ],
      items: [],
      selectedUser: {},
      showModal: false,
    };
  },
  created() {
    UserService
      .getAll()
      .then(response => {
        this.items = response.data;
      })
      .catch(error => {
        this.$toast.error("Error retrieving submissions", "", { position: "topRight"});
      })
  },
  methods: {
    rowClicked(item) {
      this.selectedUser = item;
      this.showModal = true;
    }
  }
};
</script>

