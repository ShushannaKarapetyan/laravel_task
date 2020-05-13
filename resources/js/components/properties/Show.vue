<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p>Name</p>
                <h3>
                    {{ property['name_' + locale] }}
                </h3>
                <p>Address</p>
                <h3>
                    {{ property.address }}
                </h3>
                <p>Description</p>
                <h3>
                    {{ property['description_' + locale] }}
                </h3>
                <p>Price</p>
                <h3>
                    {{ property.price }}
                </h3>
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
