<template>
    <div class="dropdown search-box">
        <div class="dropdown-content">
            <input type="text"
                   @keyup="getSearchResult()"
                   name="search"
                   class="form-control"
                   v-model="search"
                   placeholder="Search ...">
            <button type="submit" @click="getSearchResult()">
                <i class="fas fa-search"></i>
            </button>
            <div class="content" v-html="result"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Search",

        data() {
            return {
                search: '',
                result: ''
            }
        },

        methods: {
            getSearchResult() {
                this.result = '';
                if (this.search.length > 2) {
                    axios.get(`/search?search=${this.search}`)
                        .then(response => {
                            for (let index = 0; index < response.data.data.length; index++) {
                                this.result += `<a href='/properties/${response.data.data[index].id}'>` + response.data.data[index].name_en + "</a>";
                            }
                        })
                        .catch(error => console.log(error.response.data.errors));
                }
            }
        }
    }
</script>
