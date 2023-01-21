<template>
  <v-dialog 
    v-model="dialog" 
    max-width="800px"
  >
    <v-card>
      <v-card-title>
        {{ selectedUser.first_name }} {{ selectedUser.last_name }}
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-card>
                <v-card-title>Personal Information</v-card-title>
                <v-card-text>
                  <v-list>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title>Username:</v-list-item-title>
                        <v-list-item-subtitle>{{ selectedUser.username }}</v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title>Email:</v-list-item-title>
                        <v-list-item-subtitle>{{ selectedUser.email }}</v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title>Phone:</v-list-item-title>
                        <v-list-item-subtitle>{{ selectedUser.phone }}</v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title>Website:</v-list-item-title>
                        <v-list-item-subtitle>{{ selectedUser.website }}</v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                  </v-list>
                </v-card-text>
              </v-card>
            </v-col>
            <v-col cols="12">
              <v-card>
                <v-card-title>Address</v-card-title>
                <v-card-text>
                  <v-list>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title>Street:</v-list-item-title>
                        <v-list-item-subtitle>{{ selectedUser.address.street }}</v-list-item-subtitle>
												</v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title>Suite:</v-list-item-title>
                        <v-list-item-subtitle>{{ selectedUser.address.suite }}</v-list-item-subtitle>
												</v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title>City:</v-list-item-title>
                        <v-list-item-subtitle>{{ selectedUser.address.city }}</v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title>Geo:</v-list-item-title>
                        <v-list-item-subtitle>{{'Lat: '+selectedUser.address.geo.lat+' Lng: '+selectedUser.address.geo.lng}}</v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                  </v-list>
                </v-card-text>
              </v-card>
            </v-col>
            <v-col cols="12">
              <v-card>
                <v-card-title>Company Information</v-card-title>
                <v-card-text>
                  <v-list>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title>Name:</v-list-item-title>
                        <v-list-item-subtitle>{{ selectedUser.company.name }}</v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title>Catch Phrase:</v-list-item-title>
                        <v-list-item-subtitle>{{ selectedUser.company.catchPhrase }}</v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-content>
                        <v-list-item-title>BS:</v-list-item-title>
                        <v-list-item-subtitle>{{ selectedUser.company.bs }}</v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                  </v-list>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-btn 
          color="primary" 
          @click="$emit('changeValue', false)"
        >
          Close
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    selectedUser: {
      type: Object,
      required: true
    },
    show: {
      type: Boolean,
      required: true,
      default: false
    }
  },
  data() {
    return {
    };
  },
  computed: {
    dialog: {
      get() {
        return this.show;
      },
      set(newValue) {
        this.$emit('changeValue', newValue);
      }
    },
  }
};
</script>
