<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Update Tenancy
                    </div>
                    <form @submit.prevent="update(tenancy)" method="post" @keydown="errors.clear()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="property">Select a property</label>
                                <select name="property_id" class="form-control" v-model="selectedProperty">
                                    <option v-for="(property, index) in properties"
                                            :key="index"
                                            :value="index">
                                        {{ property }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tenant_id">Select a tenant</label>
                                <select name="tenant_id" class="form-control" v-model="selectedTenant">
                                    <option v-for="(tenant,index) in tenants"
                                            :key="index"
                                            :value="index">
                                        {{ tenant }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="datetime-local"
                                       class="form-control"
                                       :class="{'is-invalid': (errors.has('start_date') || errors.has('period'))}"
                                       name="start_date"
                                       v-model="tenancy.start_date">

                                <span v-text="new Date(tenancy.start_date).toLocaleDateString()"></span>

                                <span v-if="errors.has('start_date')" class="invalid-feedback"
                                      v-text="errors.get('start_date')"></span>
                                <span v-if="errors.has('period')" class="invalid-feedback"
                                      v-text="errors.get('period')"></span>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>

                                <input type="datetime-local"
                                       class="form-control"
                                       v-model="tenancy.end_date"
                                       :class="{'is-invalid': (errors.has('end_date') || errors.has('period'))}"
                                       name="end_date">

                                <span v-text="new Date(tenancy.end_date).toLocaleDateString()"></span>

                                <span v-if="errors.has('end_date')" class="invalid-feedback"
                                      v-text="errors.get('end_date')"></span>
                                <span v-if="errors.has('period')" class="invalid-feedback"
                                      v-text="errors.get('period')"></span>
                            </div>
                            <div class="form-group">
                                <label for="monthly_rent">Monthly Rent</label>
                                <input type="text"
                                       name="monthly_rent"
                                       placeholder="Monthly Rent"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('monthly_rent')}"
                                       v-model="tenancy.monthly_rent">
                                <span v-if="errors.has('monthly_rent')" class="invalid-feedback"
                                      v-text="errors.get('monthly_rent')"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">UPDATE</button>
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
        name: "Edit",

        data() {
            return {
                tenancy: {
                    id: null,
                    tenant_id: '',
                    property_id: '',
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
            this.getData()
        },

        methods: {
            getData() {
                let id = window.location.pathname.split('/')[2];

                axios.get(`/tenancies/${id}/edit`)
                    .then(response => {
                        this.properties = response.data.properties;
                        this.tenants = response.data.tenants;
                        this.tenancy = response.data.tenancy;
                        this.selectedTenant = response.data.tenancy.tenant_id;
                        this.selectedProperty = response.data.tenancy.property_id
                    })
                    .catch(error => console.log(error.response.data.errors))
            },

            update(tenancy) {
                this.tenancy.id = tenancy.id;
                this.tenancy.tenant_id = this.selectedTenant;
                this.tenancy.property_id = this.selectedProperty;
                this.tenancy.start_date = tenancy.start_date;
                this.tenancy.end_date = tenancy.end_date;
                this.tenancy.monthly_rent = tenancy.monthly_rent;

                axios.put(`/tenancies/${tenancy.id}`, this.$data.tenancy)
                    .then(response => {
                        alert('Tenancy Updated');
                        window.location.href = 'http://laravel-task.com/tenancies';
                    })
                    .catch(error => this.errors.record(error.response.data.errors));
            }
        }
    }
</script>

<style scoped>
    .card {
        margin: 50px 0;
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
