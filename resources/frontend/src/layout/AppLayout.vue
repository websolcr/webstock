<template>
  <div class="flex h-screen">
    <div class="flex bg-blue-200 h-screen w-72">
      sidebar
    </div>
    <div class="flex-1">
      <div class="bg-blue-600 h-16">
        Navbar
      </div>
      <div class="bg-gray-600 h-screen">
        <router-view />
      </div>
    </div>
  </div>
</template>
