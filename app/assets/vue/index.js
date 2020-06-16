import Vue from "vue";
import App from "./components/App";
import router from "./router";
import Notifications from 'vue-notification'

Vue.use(Notifications)

new Vue({
    components: { App },
    template: "<App/>",
    router
}).$mount("#app");
