<template>
  <div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <RouterLink class="navbar-brand" to="/">Hello App!</RouterLink>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <RouterLink class="nav-link" to="/">Home</RouterLink>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li v-if="isAuthenticated" class="nav-item">
              <button class="btn btn-outline-danger" @click="logout">
                Logout
              </button>
            </li>

            <!-- If Not Authenticated -->
            <template v-else>
              <li class="nav-item">
                <RouterLink class="nav-link" to="/login">Login</RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink class="nav-link" to="/register">Register</RouterLink>
              </li>
            </template>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Content -->
    <div class="container mt-2">
      <RouterView />
    </div>
  </div>
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex"; // Make sure Vuex store is imported

export default {
  name: "App",
  setup() {
    const store = useStore(); // Access Vuex store

    // Access getters and call them as functions
    const isAuthenticated = computed(() => store.getters["auth/isAuthenticated"]);
    const user = computed(() => store.getters["auth/getUser"]);

    const logout = () => {
      store.dispatch("auth/logout");
    };

    return {
      isAuthenticated,
      user,
      logout,
    };
  },
};
</script>

<style>
/* Optional: Add custom styles if needed */
</style>
