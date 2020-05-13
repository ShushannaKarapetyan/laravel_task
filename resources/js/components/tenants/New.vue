<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Tenant
                    </div>
                    <form @submit.prevent="add" @keydown="errors.clear()" enctype="multipart/form-data">
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
                                       v-model="tenant.phone">
                                <span v-if="errors.has('phone')" class="invalid-feedback"
                                      v-text="errors.get('phone')"></span>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file"
                                       name="image"
                                       :class="{'is-invalid': errors.has('image')}"
                                       @change="onFileSelected">
                                <span v-if="errors.has('image')" class="invalid-feedback"
                                      v-text="errors.get('image')"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
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
                tenant: {
                    name: '',
                    phone: '',
                    image: '',
                },
                errors: new Errors(),
            }
        },

        methods: {
            onFileSelected(event) {
                this.tenant.image = event.target.files[0];
            },

            add() {
                let formData = new FormData();
                formData.append('image', this.tenant.image);
                formData.append('name', this.tenant.name);
                formData.append('phone', this.tenant.phone);
                axios.post('/tenants', formData)
                    .then(response => {
                        alert('Tenant Created');
                        window.location.href = 'http://laravel-task.com/tenants';
                    })
                    .catch(error => {
                            this.errors.record(error.response.data.errors);
                            console.log(error.response.data.errors);
                        }
                    );
            }
        }
    }
</script>

