<template>
  <div class="flex flex-col">
    <div class="pb-4 text-center pb-2">
      <div class="font-bold">
        Create New Organization
      </div>
    </div>
    <div class="flex flex-col justify-center py-6">
      <div class="flex justify-center pb-2">
        <base-input
          id="organization_name"
          v-model="form.name"
          label="Name"
          placeholder="Organization name"
        />
      </div>
      <div class="flex justify-center pb-2">
        <base-button
          label="Create Organization"
          @click="createOrganization"
        />
      </div>
    </div>
    <div class="flex justify-center">
      <div>
        <router-link
          :to="{name: 'OrganizationIndex'}"
        >
          <base-button label="Organization Index" />
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import BaseButton from "@/components/common/BaseButton"
import BaseInput from "@/components/common/BaseInput"

export default {
  name: "OrganizationCreate",

  components: {
    BaseButton,
    BaseInput,
  },


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
