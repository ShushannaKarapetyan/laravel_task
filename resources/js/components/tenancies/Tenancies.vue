<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Tenancies</h3>
                        <a href="tenancies/create" class="float-lg-right">Create New</a>
                    </div>
                    <div class="card-body">
                        <table v-if="tenancies.length" class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Tenant</th>
                                <th>Property</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Monthly Rent</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="tenancy in tenancies" :key="tenancy.id">
                                <td>{{ tenancy.tenant.name }}</td>
                                <td>{{ tenancy.property['name_' + locale] }}</td>
                                <td>{{ tenancy.start_date}}</td>
                                <td>{{ tenancy.end_date }}</td>
                                <td>{{ tenancy.monthly_rent }}</td>
                                <td class="d-flex justify-content-between">
                                    <a :href="'/tenancies/' + tenancy.id" class="btn btn-primary">
                                        {{ tenancy.name }} Show
                                    </a>
                                    <a :href="'/tenancies/' + tenancy.id + '/edit'"
                                       class="btn btn-warning float-left">
                                        Edit
                                    </a>
                                    <button class="btn btn-danger float-right"
                                            @click="deleteTenancy(tenancy.id)"
                                    >Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <h1 v-else>No tenancies yet.</h1>
                        <div class="pagination" v-if="tenancies.length">
                            <ul>
                                <li :class="[{disabled:!pagination.paginate.prev_page_url}]" class="page-item">
                                    <a href="#"
                                       class="page-link"
                                       @click="getPaginateTenancies(pagination.paginate.prev_page_url)">
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
                                       @click="getPaginateTenancies(pagination.paginate.next_page_url)">
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
        name: "Tenancies",

        data() {
            return {
                locale: '',
                tenancies: [],
                start_date: '',
                end_date: '',
                monthly_rent: '',
                pagination: new Pagination(),
                url: '/tenancies'
            }
        },

        mounted() {
            this.getTenanciesData();
        },

        methods: {
            getTenanciesData() {
                axios.get(this.url)
                    .then(response => {
                        this.locale = response.data.locale;
                        this.tenancies = response.data.tenancies.data;
                        this.pagination.makePagination(response.data.tenancies);
                    })
                    .catch(error => console.log(error.response.data.errors));
            },

            deleteTenancy(id) {
                if (confirm('Are you sure?')) {
                    axios.delete(`/tenancies/${id}`)
                        .then(response => {
                            alert('Tenancy Removed');
                            this.getTenanciesData();
                            window.location.reload();
                        })
                        .catch(error => console.log(error.response.data.errors));
                }
            },

            getPaginateTenancies(url) {
                this.url = url;
                this.getTenanciesData();
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
