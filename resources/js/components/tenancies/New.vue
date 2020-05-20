<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Tenancy
                    </div>
                    <form @submit.prevent="add" @keydown="errors.clear()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="property">Select a property</label>
                                <select name="property_id"
                                        class="form-control"
                                        :class="{'is-invalid': errors.has('property_id')}"
                                        v-model="selectedProperty">
                                    <option v-for="(property, index) in properties"
                                            :key="index"
                                            :value="index">
                                        {{ property }}
                                    </option>
                                </select>
                                <span v-if="errors.has('property_id')" class="invalid-feedback"
                                      v-text="errors.get('property_id')"></span>
                            </div>
                            <div class="form-group">
                                <label for="tenant_id">Select a tenant</label>
                                <select name="tenant_id"
                                        class="form-control"
                                        :class="{'is-invalid': errors.has('tenant_id')}"
                                        v-model="selectedTenant">
                                    <option v-for="(tenant,index) in tenants"
                                            :key="index"
                                            :value="index">
                                        {{ tenant }}
                                    </option>
                                </select>
                                <span v-if="errors.has('property_id')" class="invalid-feedback"
                                      v-text="errors.get('property_id')"></span>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('start_date')}"
                                       name="start_date"
                                       v-model="tenancy.start_date">
                                <span v-if="errors.has('start_date')" class="invalid-feedback"
                                      v-text="errors.get('start_date')"></span>
                                <span v-if="errors.has('period')" class="invalid-feedback"
                                      v-text="errors.get('period')"></span>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('end_date')}"
                                       name="end_date"
                                       v-model="tenancy.end_date">
                                <span v-if="errors.has('end_date')" class="invalid-feedback"
                                      v-text="errors.get('end_date')"></span>
                                <span v-if="errors.has('period')" class="invalid-feedback"
                                      v-text="errors.get('period')"></span>
                            </div>
                            <div class="form-group">
                                <label for="monthly_rent">Monthly Rent</label>
                                <input type="text"
                                       placeholder="Monthly Rent"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('monthly_rent')}"
                                       name="monthly_rent"
                                       v-model="tenancy.monthly_rent">
                                <span v-if="errors.has('monthly_rent')" class="invalid-feedback"
                                      v-text="errors.get('monthly_rent')"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">CREATE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Errors from "../../helpers/errors";

    export default {
        name: "New",

        data() {
            return {
                tenancy: {
                    property_id: '',
                    tenant_id: '',
                    start_date: '',
                    end_date: '',
                    monthly_rent: '',
                },
                selectedTenant: '',
                selectedProperty: '',
                properties: {},
                tenants: {},
                errors: new Errors(),
            }
        },

        mounted() {
            this.getPropertiesAndTenants();
        },

        methods: {
            getPropertiesAndTenants() {
                axios.get('/tenancies/create')
                    .then(response => {
                        this.properties = response.data.properties;
                        this.tenants = response.data.tenants;
                    })
                    .catch(error => console.log(error.response.data.errors))
            },

            add() {
                this.tenancy.property_id = this.selectedProperty;
                this.tenancy.tenant_id = this.selectedTenant;

                axios.post('/tenancies', this.$data.tenancy)
                    .then(response => {
                        alert('Tenancy Created');
                        window.location.href = 'http://laravel-task.com/tenancies';
                    })
                    .catch(error => this.errors.record(error.response.data.errors));
            }
        }
    }
</script>

<style scoped>
    .card {
        margin: 50px 0 50px 0;
        box-shadow: 0 0 20px 0 #c1c1c1;
    }

    input {
        border: none;
        border-bottom: 1px solid;
        border-radius: 0;
    }

    .card-header {
        text-align: center;
        font-size: 20px;
        font-weight: 700;
        background: transparent;
        border-bottom: none;
    }

    .form-control:focus {
        box-shadow: none;
    }

    .btn-success {
        width: 100%;
    }
</style>
