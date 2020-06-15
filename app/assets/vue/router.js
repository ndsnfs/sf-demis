import Vue from "vue";
import VueRouter from "vue-router";
import Edit from "./components/Edit";
import List from "./components/List";
import Add from "./components/Add";
import View from "./components/View";

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        { path: "/view/:id", component: View, name: "view", },
        { path: "/edit/:id", component: Edit, name: "edit" },
        { path: "/add", component: Add, name: "add" },
        { path: "/", component: List, name: "main" },
    ]
});
