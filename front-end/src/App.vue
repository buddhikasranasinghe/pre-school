<script setup>
import { RouterLink, RouterView } from 'vue-router'
import SideBar from "./components/utilities/NavBar.vue"
</script>

<template>
  <header>
    <div>
      <SideBar/>
    </div>
  </header>
  <RouterView />
</template>

<style scoped>
</style>
