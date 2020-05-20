<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Tenancies</h4>
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
                                <td>
                                    {{ tenancy.tenant.name }}
                                </td>
                                <td>{{ tenancy.property['name_' + locale] }}</td>
                                <td>{{ tenancy.start_date}}</td>
                                <td>{{ tenancy.end_date}}</td>
                                <td>{{ tenancy.monthly_rent }}</td>
                                <td class="d-flex justify-content-between">
                                    <a :href="'/tenancies/' + tenancy.id" class="btn">
                                        <svg aria-hidden="true" focusable="false" data-prefix="far"
                                             data-icon="info-circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 512 512" class="svg-inline--fa fa-info-circle fa-w-16 fa-lg">
                                            <path fill="currentColor"
                                                  d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 448c-110.532 0-200-89.431-200-200 0-110.495 89.472-200 200-200 110.491 0 200 89.471 200 200 0 110.53-89.431 200-200 200zm0-338c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"
                                                  class=""></path>
                                        </svg>
                                    </a>
                                    <a :href="'/tenancies/' + tenancy.id + '/edit'"
                                       class="btn">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <button class="btn"
                                            @click="deleteTenancy(tenancy.id)"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <h2 v-else>No tenancies yet.</h2>
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
