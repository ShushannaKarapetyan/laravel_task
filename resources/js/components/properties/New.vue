<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Property
                    </div>
                    <form @submit.prevent="add" @keydown="errors.clear()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name in English</label>
                                <input type="text"
                                       placeholder="Name"
                                       v-model="property.name_en"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('name_en')}"
                                       name="name_en">
                                <span v-if="errors.has('name_en')" class="invalid-feedback"
                                      v-text="errors.get('name_en')"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Name in Russian</label>
                                <input type="text"
                                       placeholder="Name"
                                       v-model="property.name_ru"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('name_ru')}"
                                       name="name_ru">
                                <span v-if="errors.has('name_ru')" class="invalid-feedback"
                                      v-text="errors.get('name_ru')"></span>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text"
                                       placeholder="Address"
                                       v-model="property.address"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('address')}"
                                       name="address">
                                <span v-if="errors.has('address')" class="invalid-feedback"
                                      v-text="errors.get('address')"></span>
                            </div>
                            <div class="form-group">
                                <label for="description">Description in English</label>
                                <input type="text"
                                       placeholder="Description"
                                       v-model="property.description_en"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('description_en')}"
                                       name="description_en">
                                <span v-if="errors.has('description_en')" class="invalid-feedback"
                                      v-text="errors.get('description_en')"></span>
                            </div>
                            <div class="form-group">
                                <label for="description">Description in Russian</label>
                                <input type="text"
                                       placeholder="Description"
                                       v-model="property.description_ru"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('description_ru')}"
                                       name="description_ru">
                                <span v-if="errors.has('description_ru')" class="invalid-feedback"
                                      v-text="errors.get('description_ru')"></span>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text"
                                       placeholder="Price"
                                       v-model="property.price"
                                       class="form-control"
                                       :class="{'is-invalid': errors.has('price')}"
                                       name="price"
                                >
                                <span v-if="errors.has('price')" class="invalid-feedback"
                                      v-text="errors.get('price')"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Create</button>
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
                property: {
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

        methods: {
            add() {
                axios.post('/properties', this.$data.property)
                    .then((response) => {
                        alert('Property Created');
                        window.location.href = 'http://laravel-task.com/properties';
                    })
                    .catch(error => this.errors.record(error.response.data.errors));
            }
        }
    }
</script>
