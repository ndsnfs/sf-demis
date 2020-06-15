<template>
    <div class="container">

        <div class="row mb-4 mt-5">
            <h4>Add todo</h4>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <form v-on:submit.prevent="submit" class="mb-4">
                    <div class="form-group">
                        <label for="exampleInputDescription">Description</label>
                        <textarea class="form-control" id="exampleInputDescription" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
                <div v-if="validationErrors.length > 0" class="alert alert-danger">
                    <p v-for="err in validationErrors">{{ err }}</p>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

    import axios from "axios";

    export default {
        data: function () {
            return {
                validationErrors: [],
                todo: {
                    id: null,
                    description: null,
                    completed: null,
                }
            }
        },
        methods: {
            submit(event) {
                let formData = new FormData(event.target);
                let sendData = {};
                formData.forEach(function(value, key){
                    sendData[key] = value;
                });
                var json = JSON.stringify(sendData);
                axios
                    .post("/v1/todo", sendData, {
                        "headers": {"Content-Type": "application/json"}
                    })
                    .then(response => {
                        alert('Success added!')
                        this.$router.push('/')
                    })
                    .catch(e => {
                        if (e.response.status == 422) {
                            for (let i in e.response.data) {
                                this.validationErrors.push(e.response.data[i])
                            }
                        }
                    })
            }
        }
    }

</script>
