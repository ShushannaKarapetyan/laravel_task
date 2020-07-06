<script>
    import {Bar} from 'vue-chartjs';
    import moment from "moment";

    export default {
        name: "Visits",

        extends: Bar,

        data() {
            return {
                visits: [],
                uniqueVisits: [],
                labels: [],
                period: '',
                visitsCountArray: [],
                uniqueVisitsCountArray: [],
            }
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

                for (let index = 0; index < response.data.dates.length; index++) {
                    this.labels.push(moment(response.data.dates[index]['start']).format("YYYY/MM/DD"));
                }

                for (let index = 0; index < this.visits.length; index++) {
                    this.visitsCountArray.push(this.visits[index]);
                    this.uniqueVisitsCountArray.push(this.uniqueVisits[index])
                }

                this.chartRender(this.labels, this.visitsCountArray, this.uniqueVisitsCountArray)
            },

            callVisits(period) {
                axios.post('/visits/period', {period: period})
                    .then(response => {
                        this.period = period;

                        this.getVisitData(response);
                    })
                    .catch(error => console.log(error));
            },

            callCustomPeriodVisits(customPeriodStart, customPeriodEnd) {
                axios.post('/visits/period', {
                    customPeriod: {
                        customPeriodStart: customPeriodStart,
                        customPeriodEnd: customPeriodEnd,
                    }
                })
                    .then(response => {
                        this.getVisitData(response);
                    })
                    .catch(error => console.log(error));
            },

            callChangePeriod(interval) {
                axios.post('/visits/interval', {period: this.period, interval: interval})
                    .then(response => {
                        this.visits = response.data.visits;
                        this.uniqueVisits = response.data.uniqueVisits;
                        this.labels = [];

                        if(interval === 'monthly'){
                            for (let index = 0; index < response.data.dates.length; index++) {
                                this.labels.push(moment(response.data.dates[index]['start']).format("MMMM"));
                            }
                        } else{
                            for (let index = 0; index < response.data.dates.length; index++) {
                                this.labels.push(moment(response.data.dates[index]['start']).format("YYYY/MM/DD"));
                            }
                        }

                        this.chartRender(this.labels, this.visits, this.uniqueVisits)
                    })
                    .catch(error => console.log(error))
            },

            getChangePeriodVisits(interval) {
                if (interval === 'daily') {
                    this.callChangePeriod(interval)
                }

                if (interval === 'weekly') {
                    if (this.period === 'lastWeek') {
                        let sumVisits = [];
                        let sumUniqueVisits = [];
                        sumVisits.push(this.visits.reduce((partial_sum, a) => partial_sum + a, 0));
                        sumUniqueVisits.push(this.uniqueVisits.reduce((partial_sum, a) => partial_sum + a, 0));

                        this.chartRender([1], sumVisits, sumUniqueVisits)
                    }

                    this.callChangePeriod(interval)
                }

                if (interval === 'monthly') {
                    if (this.period === 'lastMonth') {
                        let sumVisits = [];
                        let sumUniqueVisits = [];
                        sumVisits.push(this.visits.reduce((partial_sum, a) => partial_sum + a, 0));
                        sumUniqueVisits.push(this.uniqueVisits.reduce((partial_sum, a) => partial_sum + a, 0));

                        this.chartRender([moment().subtract(1,'months').format('MMMM')], sumVisits, sumUniqueVisits)
                    }

                    this.callChangePeriod(interval)
                }
            }
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
