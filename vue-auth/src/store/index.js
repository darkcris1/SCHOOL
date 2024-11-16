import { createStore } from "vuex";
import auth from "./auth"; // Ensure you have an `auth.js` as shown in the previous example

const store = createStore({
  modules: {
    auth,
  },
});

export default store;
