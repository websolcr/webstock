<template>
  <div>
    <input
      v-model="form.name"
      type="text"
      placeholder="enter organization name"
      required
    >
    <p
      class="cursor-pointer"
      @click="createOrganization"
    >
      create organization
    </p>

    <router-link :to="{name: 'OrganizationIndex'}">
      Organization Index
    </router-link>
  </div>
</template>

<script>
export default {
  name: "CreateOrganization",

  data() {
    return {
      form: {
        name: '',
      }
    }
  },

  methods: {
    async createOrganization() {
      await this.$http.post('/tenant/create', this.form)
        .then(() => {
          this.$router.push({name: 'OrganizationIndex'})
        }).catch(error => {
          console.log(error.response.data)
        })
    }
  }
}
</script>
