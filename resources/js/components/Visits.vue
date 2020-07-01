<script>
    import {Bar} from 'vue-chartjs';

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
            chunkArray(array, chunk_size) {
                let tempArray = [];

                for (let index = 0; index < array.length; index += chunk_size) {
                    let chunk = array.slice(index, index + chunk_size);
                    tempArray.push(chunk);
                }

                return tempArray;
            },

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
                    this.labels.push(index + 1);
                    this.visitsCountArray.push(this.visits[index]);
                    this.uniqueVisitsCountArray.push(this.uniqueVisits[index])
                }

                this.chartRender(this.labels, this.visitsCountArray, this.uniqueVisitsCountArray)
            },

            getVisits(period) {
                axios.post('/visits/period', {period: period})
                    .then(response => {
                        this.period = period;

                        this.getVisitData(response);
                    })
                    .catch(error => console.log(error));
            },

            getCustomPeriodVisits(customPeriodStart, customPeriodEnd) {
                axios.post('/visits/period', {
                    customPeriodStart: customPeriodStart,
                    customPeriodEnd: customPeriodEnd
                })
                    .then(response => {
                        this.getVisitData(response);
                    })
                    .catch(error => console.log(error));
            },

            getChangePeriodVisits(interval) {
                if (interval === 'daily') {
                    this.chartRender(this.labels, this.visitsCountArray, this.uniqueVisitsCountArray)
                }

                if (interval === 'weekly') {
                    let labelsArray = [];
                    let sumVisits = [];
                    let sumUniqueVisits = [];

                    for (let index = 0; index < Math.ceil((this.labels.length) / 7); index++) {
                        labelsArray.push(index + 1);
                        sumVisits.push(this.chunkArray(this.visits, 7)[index].reduce((partial_sum, a) => partial_sum + a, 0))
                        sumUniqueVisits.push(this.chunkArray(this.uniqueVisits, 7)[index].reduce((partial_sum, a) => partial_sum + a, 0))
                    }

                    this.chartRender(labelsArray, sumVisits, sumUniqueVisits)
                }

                if (interval === 'monthly') {
                    let labelsArray = [];
                    let sumVisits = [];
                    let sumUniqueVisits = [];

                    for (let index = 0; index < Math.ceil((this.labels.length) / 30); index++) {
                        labelsArray.push(index + 1);
                        sumVisits.push(this.chunkArray(this.visits, 30)[index].reduce((partial_sum, a) => partial_sum + a, 0))
                        sumUniqueVisits.push(this.chunkArray(this.uniqueVisits, 30)[index].reduce((partial_sum, a) => partial_sum + a, 0))
                    }

                    this.chartRender(labelsArray, sumVisits, sumUniqueVisits)
                }
            }
        },
    }
</script>

<style scoped>
    [data-v-0d6f86b3] {
        /*width: 800px;*/
    }

    canvas {
        height: 600px !important;
    }
</style>
