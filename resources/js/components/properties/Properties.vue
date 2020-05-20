<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Properties</h4>
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
                                    {{ property['name_' + locale] }}
                                </td>
                                <td>{{ property.address }}</td>
                                <td>
                                    {{ property['description_' + locale].substring(0,20) + "..." }}
                                </td>
                                <td>{{ property.price }}</td>
                                <td class="d-flex justify-content-between">
                                    <a :href="'/properties/' + property.id" class="btn">
                                        <svg aria-hidden="true" focusable="false" data-prefix="far"
                                             data-icon="info-circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 512 512" class="svg-inline--fa fa-info-circle fa-w-16 fa-lg">
                                            <path fill="currentColor"
                                                  d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 448c-110.532 0-200-89.431-200-200 0-110.495 89.472-200 200-200 110.491 0 200 89.471 200 200 0 110.53-89.431 200-200 200zm0-338c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"
                                                  class=""></path>
                                        </svg>
                                    </a>
                                    <a :href="'/properties/' + property.id + '/edit'"
                                       class="btn">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <button class="btn"
                                            @click="deleteProperty(property.id)"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <h2 v-else>No properties yet.</h2>
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
    .card {
        margin: 50px 0 50px 0;
        border: none;
    }

    .pagination ul {
        list-style: none;
    }

    .pagination ul li {
        float: left;
    }

    table a {
        color: black;
    }

    .float-lg-right {
        float: right !important;
        padding: 7px;
        border: solid 1px;
        border-radius: 3px;
        background: #1b3d58;
        color: white;
    }

    .fa-trash-alt {
        color: red;
    }

    svg {
        width: 15px;
    }
</style>
