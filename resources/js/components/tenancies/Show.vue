<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="tenancy-data">
                    <p>Tenant</p>
                    <h4>
                        {{ tenancy.tenant.name }}
                    </h4>
                    <hr>
                    <p>Property</p>
                    <h4>
                        {{ tenancy.property['name_' + locale] }}
                    </h4>
                    <hr>
                    <p>Start Date</p>
                    <h4>
                        {{ tenancy.start_date }}
                    </h4>
                    <hr>
                    <p>End Date</p>
                    <h4>
                        {{ tenancy.end_date}}
                    </h4>
                    <hr>
                    <p>Monthly Rent</p>
                    <h4>
                        {{ tenancy.monthly_rent }}
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
                tenancy: [],
                locale: ''
            }
        },

        mounted() {
            let id = window.location.pathname.split('/')[2];

            axios.get(`/tenancies/${id}`)
                .then(response => {
                    this.locale = response.data.locale;
                    this.tenancy = response.data.tenancy[0];
                })
                .catch(error => console.log(error.response.data.errors))
        }
    }
</script>

<style scoped>
    .tenancy-data{
        margin: 50px 0 50px 0
    }
</style>
