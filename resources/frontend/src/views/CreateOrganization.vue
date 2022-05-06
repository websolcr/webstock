<template>
  <div>
    <p
      class="cursor-pointer"
      @click="createOrganization"
    >
      create organization
    </p>
  </div>
</template>

<script>
export default {
  name: "CreateOrganization",

  methods: {
    createOrganization() {
      this.$http.post('create-organization')
    }
  }
}
</script>
