<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Update Tenant
                    </div>
                    <form @submit.prevent="update(tenant)" @keydown="errors.clear()" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text"
                                       placeholder="Name"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('name')}"
                                       name="name"
                                       v-model="tenant.name">
                                <span v-if="errors.has('name')" class="invalid-feedback"
                                      v-text="errors.get('name')"></span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text"
                                       placeholder="Phone"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('phone')}"
                                       name="phone"
                                       v-model="tenant.phone"
                                >
                                <span v-if="errors.has('phone')" class="invalid-feedback"
                                      v-text="errors.get('phone')"></span>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file"
                                       :class="{'is-invalid': errors.has('phone')}"
                                       name="image"
                                       @change="onImageSelected">
                                <span v-if="errors.has('image')" class="invalid-feedback"
                                      v-text="errors.get('image')"></span>
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
                tenant: {
                    id: null,
                    name: '',
                    phone: '',
                    image: ''
                },
                errors: new Errors(),
            }
        },

        mounted() {
            this.getTenant();
        },

        methods: {
            onImageSelected(event) {
                this.tenant.image = event.target.files[0];
            },

            getTenant() {
                let id = window.location.pathname.split('/')[2];

                axios.get(`/tenants/${id}/edit`)
                    .then(response => {
                        this.tenant = response.data.tenant;
                    })
                    .catch(error => console.log(error.response.data.errors))
            },

            update(tenant) {
                let formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('id', tenant.id);
                formData.append('image', this.tenant.image);
                formData.append('name', tenant.name);
                formData.append('phone', tenant.phone);

                axios.post(`/tenants/${tenant.id}`, formData)
                    .then(response => {
                        alert('Tenant Updated');
                        window.location.href = 'http://laravel-task.com/tenants';
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
    .form-control:focus{
        box-shadow: none;
    }
    .btn-success{
        width: 100%;
    }
</style>
