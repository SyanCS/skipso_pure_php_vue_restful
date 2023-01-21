<template>
  <v-form @submit.prevent="validateForm" ref="form">
    <v-container>
      <v-row>
        <v-col cols="6">
          <v-card>
            <v-card-title>Personal Information</v-card-title>
              <v-card-text>
                <v-text-field v-model="form.first_name" label="First Name" required :rules="nameRules" />
                <v-text-field v-model="form.last_name" label="Last Name" required :rules="nameRules" />
                <v-text-field v-model="form.username" label="Username" required :rules="usernameRules" />
                <v-text-field v-model="form.email" label="Email" type="email" required :rules="emailRules" />
              </v-card-text>
          </v-card>
        </v-col>
        <v-col cols="6">
          <v-card>
            <v-card-title>Address</v-card-title>
              <v-card-text>
                <v-text-field v-model="form.street" label="Street" required :rules="addressRules" />
                <v-text-field v-model="form.city" label="City" required :rules="addressRules" />
                <v-text-field v-model="form.zip_code" label="Zip Code" required :rules="zipRules" />
                <v-text-field v-model="form.country" label="Country" required :rules="addressRules" />
              </v-card-text>
          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="6">
          <v-card>
            <v-card-title>Company Information</v-card-title>
              <v-card-text>
                <v-checkbox v-model="hasCompany" label="Has Company"></v-checkbox>
                <template v-if="hasCompany">
                  <v-text-field v-model="form.company_name" label="Company Name" :rules="companyRules" />
                  <v-textarea v-model="form.company_description" label="Company Description"></v-textarea>
                </template>
              </v-card-text>
          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <v-col> </v-col>
      </v-row>
      <v-row>
        <v-col cols="6">
          <v-btn 
            type="submit" 
            color="primary"
            :disabled="loading"
          >
            Register
          </v-btn>
        </v-col>
      </v-row>
    </v-container>
  </v-form>
</template>

<script>
import UserService from "@/services/UserService.js";

export default {
  data() {
    return {
      form: {
        first_name: null,
        last_name: null,
        username: null,
        email: null,
        street: null,
        city: null,
        zip_code: null,
        country: null,
        company_name: null,
        company_description: null
      },
      hasCompany: false,
      loading: false,
      companies: [],
      nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 40) || 'Name must be less than 40 characters'
      ],
      usernameRules: [
        v => !!v || 'Username is required',
        v => (v && v.length <= 20) || 'Username must be less than 20 characters'
      ],
      emailRules: [
        v => !!v || 'Email is required',
        v => /.+@.+/.test(v) || 'Email must be valid'
      ],
      addressRules: [
        v => !!v || 'Thid field is required',
        v => (v && v.length <= 100) || 'Address must be less than 100 characters'
      ],
      zipRules: [
        v => !!v || 'Zip code is required',
        //v => /^[0-9]{5}(?:-[0-9]{4})?$/.test(v) || 'Zip code must be valid (e.g. 12345 or 12345-6789)'
      ],
      companyRules: [
        v => (this.hasCompany && !!v) || 'Company name is required'
      ]
    };
  },
  created() {
  },
  methods: {
    validateForm() {
      if(this.$refs.form.validate()){
        this.submitForm()
      } else {
        this.$toast.error("Invalid form, check the inputs.", "", { position: "topRight"});
      }
    },
    submitForm() {
      if (this.$refs.form.validate()) {
        // Send the form data to the server
        this.loading = true;
        this.$toast.info("Submitting user", "", { position: "topRight"});
        UserService
          .post(this.form)          
          .then(response => {
            this.$toast.success("User submitted!", "", { position: "topRight"});
            this.form = {
              first_name: null,
              last_name: null,
              username: null,
              email: null,
              street: null,
              city: null,
              zip_code: null,
              country: null,
              company_name: null,
              company_description: null
            };
            this.hasCompany = false;
          })
          .catch(error => {
            this.$toast.error("Error submitting user: "+error.data, "", { position: "topRight"});
          })
          .finally(() => {
            this.loading = false;
            this.$refs.form.resetValidation()
          });
      }
    }
  }
};
</script>


