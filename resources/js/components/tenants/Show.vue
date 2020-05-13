<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p>Name</p>
                <h3>
                    {{ tenant.name }}
                </h3>
                <p>Phone</p>
                <h3>
                    {{ tenant.phone }}
                </h3>
                <p v-if="tenant.image">Image</p>
                <div v-if="tenant.image">
                    <img :src="'storage/images/' + tenant.image"
                         width="150"
                         height="70">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Show",

        data() {
            return {
                tenant: []
            }
        },

        mounted() {
            let id = window.location.pathname.split('/')[2];

            axios.get(`/tenants/${id}`)
                .then(response => {
                    this.tenant = response.data.tenant;
                })
                .catch(error => console.log(error.response.data.errors))
        }
    }
</script>

