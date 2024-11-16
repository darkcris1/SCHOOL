<template>
  <div class="container mt-5">
    <!-- Check if user is authenticated -->
    <div v-if="isAuthenticated">
      <h2>Welcome back, {{ user.name }}!</h2>
      <p>We're glad to have you here, {{ user.name }}. Enjoy exploring the site.</p>
      <p>Feel free to check out the latest updates and features we've added just for you.</p>
    </div>
    <div v-else>
      <p>You are not logged in. Please log in to access more features.</p>
    </div>
  </div>
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex";

export default {
  name: "HomeView",
  setup() {
    const store = useStore();

    // Computed properties to access the Vuex state
    const isAuthenticated = computed(() => store.getters["auth/isAuthenticated"]);
    const user = computed(() => store.getters["auth/getUser"]);

    return {
      isAuthenticated,
      user,
    };
  },
};
</script>

<style scoped>
/* Optional: Add custom styles if needed */
</style>
