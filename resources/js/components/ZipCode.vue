<template>
    <div class="zip-codes">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="zip-code-section col-md-3">
                            <label for="zipCode">Zip Code</label>
                            <select name="zipCode"
                                    class="zipCode"
                                    @change="selectZipCode($event)"
                                    v-model="zipCodeValue"
                                    id="zipCode">
                                <option v-for="(zipCode, index) in zipCodes"
                                        :key="index"
                                        :value="zipCode">{{ zipCode }}
                                </option>
                            </select>
                        </div>
                        <div class="town-section col-md-4">
                            <label for="town">Town</label>
                            <select name="town"
                                    class="town"
                                    @change="selectTown($event)"
                                    v-model="selectedTown"
                                    id="town">
                                <option v-for="(town, index) in towns"
                                        :key="index"
                                        :value="town">{{ town }}
                                </option>
                            </select>
                        </div>
                        <div class="district-section col-md-4">
                            <label for="district">District</label>
                            <div class="alert alert-secondary">{{ district }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="state-section col-md-4">
                            <label for="state">State</label>
                            <div class="alert alert-secondary">{{ state }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ZipCode",

        data() {
            return {
                zipCodes: [],
                zipCodeValue: '',
                selectedTown: '',
                towns: [],
                district: '',
                state: ''
            }
        },

        mounted() {
            axios.get('/zip-codes')
                .then(response => this.zipCodes = response.data.zipCodes)
                .catch(error => console.log(error))
        },

        methods: {
            selectZipCode(event) {
                this.selectedTown = '';
                this.district = '';
                this.state = '';
                this.zipCodeValue = event.target.value;

                axios.post('/towns', {zipCodeValue: this.zipCodeValue})
                    .then(response => {
                        this.towns = response.data.towns
                    })
                    .catch(error => console.log(error));
            },

            selectTown(e) {
                this.selectedTown = e.target.value;
                axios.post('/districtState', {
                    zipCodeValue: this.zipCodeValue,
                    selectedTown: this.selectedTown
                })
                    .then(response => {
                        for (let district in response.data.districtState) {
                            this.district = district;
                            this.state = response.data.districtState[district];
                        }
                    })
                    .catch(error => console.log(error));
            }
        }
    }
</script>

<style scoped>
    .zip-codes {
        margin: 50px 0;
    }

    .zip-code-section, .town-section,
    .district-section, .state-section {
        float: left;
    }

    .alert-secondary {
        height: 40px;
        display: flex;
        align-items: center;
    }

    select {
        height: 40px;
    }

    .zipCode {
        width: 150px;
    }

    .town {
        width: 200px;
    }
</style>
