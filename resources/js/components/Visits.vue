<script>
    import {Bar} from 'vue-chartjs';
    import moment from "moment";

    export default {
        name: "Visits",
        props: [
            'period',
            'customPeriod',
            'changePeriod',
        ],
        extends: Bar,

        data() {
            return {
                visits: [],
                uniqueVisits: [],
                labels: [],
                visitsCountArray: [],
                uniqueVisitsCountArray: [],
            }
        },

        watch: {
            period: function (newPeriod) {
                axios.post('/visits/period', {period: newPeriod})
                    .then(response => {
                        this.getVisitData(response);
                    })
                    .catch(error => console.log(error));
            },

            customPeriod: function (newCustomPeriod) {
                axios.post('/visits/period', {
                    customPeriod: {
                        customPeriodStart: newCustomPeriod[0],
                        customPeriodEnd: newCustomPeriod[1],
                    }
                })
                    .then(response => {
                        this.getVisitData(response);
                    })
                    .catch(error => console.log(error));
            },

            changePeriod: function (interval) {
                axios.post('/visits/interval', {period: this.period, interval: interval})
                    .then(response => {
                        this.visits = response.data.visits;
                        this.uniqueVisits = response.data.uniqueVisits;
                        this.labels = [];

                        for (let index = 0; index < response.data.dates.length; index++) {
                            this.labels.push(moment(response.data.dates[index]['start']).format("YYYY/MM/DD"));
                        }

                        if (interval === 'monthly') {
                            this.labels = [];
                            for (let index = 0; index < response.data.dates.length; index++) {
                                this.labels.push(moment(response.data.dates[index]['start']).format("MMMM"));
                            }
                        }

                        this.chartRender(this.labels, this.visits, this.uniqueVisits)
                    })
                    .catch(error => console.log(error))
            },
        },

        mounted() {
            axios.get('/visits')
                .then(response => {
                    this.getVisitData(response)
                })
                .catch(error => console.log(error));
        },

        methods: {
            chartRender(labels, visits, uniqueVisits) {
                this.renderChart({
                    labels: labels,
                    datasets: [
                        {
                            label: 'Visits',
                            backgroundColor: '#1661f8',
                            data: visits,
                        },
                        {
                            label: 'Unique Visits',
                            backgroundColor: '#f84c25',
                            data: uniqueVisits,
                        },
                    ]
                })
            },

            getVisitData(response) {
                this.labels = [];
                this.visitsCountArray = [];
                this.uniqueVisitsCountArray = [];
                this.visits = response.data.visits;
                this.uniqueVisits = response.data.uniqueVisits;

                for (let index = 0; index < this.visits.length; index++) {
                    this.labels.push(moment(response.data.dates[index]['start']).format("YYYY/MM/DD"));
                    this.visitsCountArray.push(this.visits[index]);
                    this.uniqueVisitsCountArray.push(this.uniqueVisits[index])
                }

                this.chartRender(this.labels, this.visitsCountArray, this.uniqueVisitsCountArray)
            },
        },
    }
</script>

<style scoped>
    [data-v-0d6f86b3] {
        width: 1000px;
    }

    canvas {
        height: 600px !important;
    }
</style>
