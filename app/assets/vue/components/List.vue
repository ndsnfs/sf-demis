<template>
    <div>

        <div class="row mb-4 mt-5">
            <h4>Super todo list!</h4>
        </div>

        <div class="row mb-4">
            <button v-on:click="add()" class="btn btn-success">Add</button>
        </div>

        <table class="table">
            <tr>
                <th>№</th>
                <th>description</th>
                <th>completed</th>
                <th>manage</th>
            </tr>
            <tr v-for="todo in todos">
                <td>{{ todo.id }}</td>
                <td>{{ todo.description }}</td>
                <td>{{ todo.completed }}</td>
                <td>
                    <router-link
                            v-bind:to="'/edit/' + todo.id"
                    >
                        <svg class="bi bi-pencil" width="1.3em" height="1.3em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                            <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                        </svg>
                    </router-link>
                    <a href="" v-on:click.prevent="rm(todo.id)">
                        <svg class="bi bi-trash" width="1.3em" height="1.3em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                </td>
            </tr>
        </table>

    </div>

</template>

<script>

    import axios from "axios";

    export default {
        data: function () {
            return {
                todos: []
            }
        },
        methods: {
            add() {
                this.$router.push("/add");
            },
            rm(id) {
                if (confirm("Удалить запись " + id)) {

                    let context = this;

                    axios
                        .delete("/v1/todo/" + id)
                        .then(response => {
                            alert('Removed')
                            context.load()
                        })
                        .catch(e => {
                            alert('Fatal')
                        });
                }
            },
            load() {

                let context = this;

                axios
                    .get("/v1/todo")
                    .then(response => {
                        context.todos = response.data
                    });
            }
        },
        mounted() {
            this.load()
        }
    }

</script>
