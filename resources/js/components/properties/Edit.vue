<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Update Property
                    </div>
                    <form @submit.prevent="update(property)" method="post" @keydown="errors.clear()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name in English</label>
                                <input type="text"
                                       placeholder="Name"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('name_en')}"
                                       name="name_en"
                                       v-model="property.name_en">
                                <span v-if="errors.has('name_en')" class="invalid-feedback"
                                      v-text="errors.get('name_en')"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Name in Russian</label>
                                <input type="text"
                                       placeholder="Name"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('name_ru')}"
                                       name="name_ru"
                                       v-model="property.name_ru">
                                <span v-if="errors.has('name_ru')" class="invalid-feedback"
                                      v-text="errors.get('name_ru')"></span>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text"
                                       placeholder="Address"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('address')}"
                                       name="address"
                                       v-model="property.address">
                                <span v-if="errors.has('address')" class="invalid-feedback"
                                      v-text="errors.get('address')"></span>
                            </div>
                            <div class="form-group">
                                <label for="description">Description in English</label>
                                <input type="text"
                                       placeholder="Description"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('description_en')}"
                                       name="description_en"
                                       v-model="property.description_en">
                                <span v-if="errors.has('description_en')" class="invalid-feedback"
                                      v-text="errors.get('description_en')"></span>
                            </div>
                            <div class="form-group">
                                <label for="description">Description in Russian</label>
                                <input type="text"
                                       placeholder="Description"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('description_ru')}"
                                       name="description_ru"
                                       v-model="property.description_ru">
                                <span v-if="errors.has('description_ru')" class="invalid-feedback"
                                      v-text="errors.get('description_ru')"></span>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text"
                                       placeholder="Price"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('price')}"
                                       name="price"
                                       v-model="property.price">
                                <span v-if="errors.has('price')" class="invalid-feedback"
                                      v-text="errors.get('price')"></span>
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
                property: {
                    id: null,
                    name_en: '',
                    name_ru: '',
                    address: '',
                    description_en: '',
                    description_ru: '',
                    price: '',
                },
                errors: new Errors(),
            }
        },

        mounted() {
            this.getProperty();
        },

        methods: {
            getProperty() {
                let id = window.location.pathname.split('/')[2];

                axios.get(`/properties/${id}/edit`)
                    .then(response => {
                        this.property = response.data.property;
                    })
                    .catch(error => console.log(error.response.data))
            },

            update(property) {
                this.property.id = property.id;
                this.property.name_en = property.name_en;
                this.property.name_ru = property.name_ru;
                this.property.address = property.address;
                this.property.description_en = property.description_en;
                this.property.description_ru = property.description_ru;
                this.property.price = property.price;

                axios.put(`/properties/${property.id}`, this.$data.property)
                    .then((response) => {
                        alert('Property Updated');
                        window.location.href = 'http://laravel-task.com/properties';
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
    .form-control:focus{
        box-shadow: none;
    }
    .btn-success{
        width: 100%;
    }
</style>
