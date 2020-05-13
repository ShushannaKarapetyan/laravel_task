<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Tenants</h3>
                        <a href="tenants/create" class="float-lg-right">Create New</a>
                    </div>
                    <div class="card-body">
                        <table v-if="tenants.length" class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="tenant in tenants" :key="tenant.id">
                                <td>
                                    <a :href="'/tenants/' + tenant.id">
                                        {{ tenant.name }}
                                    </a>
                                </td>
                                <td>{{ tenant.phone }}</td>
                                <td v-if="tenant.image">
                                    <img :src="'storage/images/' + tenant.image"
                                         width="150"
                                         height="70">
                                </td>
                                <td v-else></td>
                                <td>
                                    <a :href="'/tenants/' + tenant.id + '/edit'"
                                       class="btn btn-warning float-left">
                                        Edit
                                    </a>
                                    <button class="btn btn-danger float-right"
                                            @click="deleteTenant(tenant.id)"
                                    >Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <h1 v-else>No tenants yet.</h1>
                        <div class="pagination" v-if="tenants.length">
                            <ul>
                                <li :class="[{disabled:!pagination.paginate.prev_page_url}]" class="page-item">
                                    <a href="#"
                                       class="page-link"
                                       @click="getPaginateTenants(pagination.paginate.prev_page_url)">
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
                                       @click="getPaginateTenants(pagination.paginate.next_page_url)">
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
        name: "Tenants",

        data() {
            return {
                locale: '',
                tenants: [],
                url: '/tenants',
                pagination: new Pagination()
            }
        },

        mounted() {
            this.getTenants();
        },

        methods: {
            getTenants() {
                axios.get(this.url)
                    .then(response => {
                        this.tenants = response.data.tenants.data;
                        this.locale = response.data.locale;
                        this.pagination.makePagination(response.data.tenants);
                    })
                    .catch(error => console.log(error.response.data.errors));
            },

            deleteTenant(id) {
                if (confirm('Are you sure?')) {
                    axios.delete(`/tenants/${id}`)
                        .then(response => {
                            alert('Tenant Removed');
                            this.getTenants();
                            window.location.reload();
                        })
                        .catch(error => console.log(error.response.data.errors));
                }
            },

            getPaginateTenants(url) {
                this.url = url;
                this.getTenants();
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
