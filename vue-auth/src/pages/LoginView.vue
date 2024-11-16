<template>
  <div class="container mt-5">
    <h1>Login</h1>
    <form @submit.prevent="submitForm">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input
          type="email"
          id="email"
          v-model="form.email"
          class="form-control"
          placeholder="Enter your email"
          required
        />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input
          type="password"
          id="password"
          v-model="form.password"
          class="form-control"
          placeholder="Enter your password"
          required
        />
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div v-if="message" class="alert mt-3" :class="{'alert-success': success, 'alert-danger': !success}">
      {{ message }}
    </div>
  </div>
</template>

<script>
import { reactive, ref } from "vue";
import { useStore } from "vuex";
import axios from "axios";
import { useRouter } from "vue-router";  // Import Vue Router

export default {
  name: "LoginView",
  setup() {
    const store = useStore(); // Access Vuex store
    const router = useRouter(); // Access Vue Router
    const form = reactive({
      email: "",
      password: "",
    });
    const message = ref("");
    const success = ref(false);

    const submitForm = async () => {
      try {
        const response = await axios.post("http://localhost/api/login", form);
        const { token, user } = response.data;

        // Dispatch the login action in Vuex store
        store.dispatch("auth/login", { token, user });

        message.value = "Login successful!";
        success.value = true;

        // Redirect to home after successful login
        router.push("/");  // Redirect to the home page

        // Reset the form
        form.email = "";
        form.password = "";
      } catch (error) {
        message.value =
          error.response?.data?.message || "Invalid email or password.";
        success.value = false;
      }
    };

    return {
      form,
      message,
      success,
      submitForm,
    };
  },
};
</script>
