<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="property-data">
                    <p>Name</p>
                    <h4>
                        {{ property['name_' + locale] }}
                    </h4>
                    <hr>
                    <p>Address</p>
                    <h4>
                        {{ property.address }}
                    </h4>
                    <hr>
                    <p>Description</p>
                    <h4>
                        {{ property['description_' + locale] }}
                    </h4>
                    <hr>
                    <p>Price</p>
                    <h4>
                        {{ property.price }}
                    </h4>
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
                locale: '',
                property: {}
            }
        },

        mounted() {
            let id = window.location.pathname.split('/')[2];

            axios.get(`/properties/${id}`)
                .then(response => {
                    this.locale = response.data.locale;
                    this.property = response.data.property;
                })
                .catch(error => console.log(error.response.data))
        }
    }
</script>

<style scoped>
    .property-data{
        margin: 50px 0 50px 0
    }
</style>
