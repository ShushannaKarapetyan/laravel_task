<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Properties</h3>
                        <a href="properties/create" class="float-lg-right">Create New</a>
                    </div>
                    <div class="card-body">
                        <table v-if="properties.length" class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="property in properties" :key="property.id">
                                <td>
                                    <a :href="'/properties/' + property.id">
                                        {{ property['name_' + locale] }}
                                    </a>
                                </td>
                                <td>{{ property.address }}</td>
                                <td>
                                    {{ property['description_' + locale].substring(0,20) + "..." }}
                                </td>
                                <td>{{ property.price }}</td>
                                <td>
                                    <a :href="'/properties/' + property.id + '/edit'"
                                       class="btn btn-warning float-left">
                                        Edit
                                    </a>
                                    <button class="btn btn-danger float-right"
                                            @click="deleteProperty(property.id)"
                                    >Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <h1 v-else>No properties yet.</h1>
                        <div class="pagination" v-if="properties.length">
                            <ul>
                                <li :class="[{disabled:!pagination.paginate.prev_page_url}]" class="page-item">
                                    <a href="#"
                                       class="page-link"
                                       @click="getPaginateProperties(pagination.paginate.prev_page_url)">
                                        Previous
                                    </a>
                                </li>
                                <li class="page-item disabled">
                                    <a class="page-link text-dark" href="#">
                                        Page {{ pagination.paginate.current_page }} of {{ pagination.paginate.last_page
                                        }}
                                    </a>
                                </li>
                                <li :class="[{disabled:!pagination.paginate.next_page_url}]" class="page-item">
                                    <a href="#"
                                       class="page-link"
                                       @click="getPaginateProperties(pagination.paginate.next_page_url)">
                                        Next
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Pagination from "../../helpers/pagination";

    export default {
        name: 'Properties',

        data() {
            return {
                locale: '',
                properties: [],
                url: '/properties',
                pagination: new Pagination()
            }
        },

        mounted() {
            this.getProperties();
        },

        methods: {
            getProperties() {
                axios.get(this.url)
                    .then(response => {
                        this.properties = response.data.properties.data;
                        this.locale = response.data.locale;
                        this.pagination.makePagination(response.data.properties);
                    })
                    .catch(error => console.log(error));
            },

            deleteProperty(id) {
                if (confirm('Are you sure?')) {
                    axios.delete(`/properties/${id}`)
                        .then(response => {
                            alert('Property Removed');
                            this.getProperties();
                            window.location.reload();
                        })
                        .catch(error => console.log(error));
                }
            },

            getPaginateProperties(url) {
                this.url = url;
                this.getProperties();
            }
        }
    }
</script>

<style scoped>
    .pagination ul {
        list-style: none;
    }

    .pagination ul li {
        float: left;
    }

    table a {
        color: black;
    }
</style>
