<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p>Tenant</p>
                <h3>
                    {{ tenancy.tenant.name }}
                </h3>
                <p>Property</p>
                <h3>
                    {{ tenancy.property['name_' + locale] }}
                </h3>
                <p>Start Date</p>
                <h3>
                    {{ tenancy.start_date }}
                </h3>
                <p>End Date</p>
                <h3>
                    {{ tenancy.end_date }}
                </h3>
                <p>Monthly Rent</p>
                <h3>
                    {{ tenancy.monthly_rent }}
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

