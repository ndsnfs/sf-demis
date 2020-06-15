<template>
    <div class="container">

        <div class="row mb-4 mt-5">
            <h4>View todo</h4>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>id</td>
                            <td>{{ todo.id }}</td>
                        </tr>
                        <tr>
                            <td>description</td>
                            <td>{{ todo.description }}</td>
                        </tr>
                        <tr>
                            <td>completed</td>
                            <td>{{ todo.completed }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>

    import axios from "axios";

    export default {
        data: function () {
            return {
                id: null,
                todo: {
                    id: null,
                    description: null,
                    completed: null,
                }
            }
        },
        methods: {
            load() {

                let context = this;
                this.id = this.$route.params.id;

                axios
                    .get("/v1/todo/" + this.id)
                    .then(response => {
                        context.todo = response.data
                    });
            }
        },
        mounted() {
            this.load()
        }
    }

</script>
