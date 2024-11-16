<template>
  <div class="container mt-5">
    <h3>Register</h3>
    <form @submit.prevent="submitForm" class="card p-4">

      <div v-if="message" class="alert mt-3" :class="{'alert-success': success, 'alert-danger': !success}">
      {{ message }}
    </div>
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input
          type="text"
          id="name"
          v-model="form.name"
          class="form-control"
          placeholder="Enter your name"
          required
        />
      </div>
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
      <div class="mb-3">
        <label for="password_confirmation" class="form-label">
          Confirm Password
        </label>
        <input
          type="password"
          id="password_confirmation"
          v-model="form.password_confirmation"
          class="form-control"
          placeholder="Confirm your password"
          required
        />
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
  </div>
</template>

<script>
import { reactive, ref } from "vue";
import axios from "axios";

export default {
  name: "RegisterView", // Use a multi-word name
  setup() {
    const form = reactive({
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    });

    const message = ref("");
    const success = ref(false);

    const submitForm = async () => {
      try {
        await axios.post("http://localhost/api/register", form); // Removed unused 'response'
        message.value = "Registration successful!";
        success.value = true;
        form.name = "";
        form.email = "";
        form.password = "";
        form.password_confirmation = "";
      } catch (error) {
        message.value =
          error.response?.data?.message || "An error occurred. Please try again.";
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
<style>
/* Optional custom styles */
</style>
