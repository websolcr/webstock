<template>
  <div>
    home page

    <router-link :to="{name: 'OrganizationIndex'}">
      Organization Index
    </router-link>
  </div>
</template>

<script>
export default {
  name: "HomePage",
}
</script>
