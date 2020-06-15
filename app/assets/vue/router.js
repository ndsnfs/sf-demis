import Vue from "vue";
import VueRouter from "vue-router";
import Edit from "./components/Edit";
import List from "./components/List";
import Add from "./components/Add";

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        { path: "/edit/:id", component: Edit, name: "edit" },
        { path: "/add", component: Add, name: "add" },
        { path: "/", component: List, name: "main" },
    ]
});
