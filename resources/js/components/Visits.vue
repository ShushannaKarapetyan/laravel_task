<!--<template>

</template>-->

<script>
    import {Bar} from 'vue-chartjs';

    export default {
        name: "Visits",

        extends: Bar,

        data() {
            return {
                labelsArray: [],
                visits: [],
                uniqueVisits: [],
                visitsCountArray: [],
                uniqueVisitsCountArray: [],
            }
        },

        mounted() {
            axios.get('/visits')
                .then(response => {
                    this.visits = response.data.visits;
                    this.uniqueVisits = response.data.uniqueVisits;

                    for (let index = 1; index <= this.visits.length; index++) {
                        this.labelsArray.push(index);
                        this.visitsCountArray.push(this.visits[index-1]);
                        this.uniqueVisitsCountArray.push(this.uniqueVisits[index-1])
                    }

                    this.renderChart({
                        labels: this.labelsArray,
                        datasets: [
                            {
                                label: 'Visits',
                                backgroundColor: '#1661f8',
                                data: this.visitsCountArray,
                            },
                            {
                                label: 'Unique Visits',
                                backgroundColor: '#f84c25',
                                data: this.uniqueVisitsCountArray,
                            },
                        ]
                    })
                })
                .catch(error => console.log(error));
        },
    }
</script>

<style scoped>
    [data-v-0d6f86b3] {
        width: 600px;
    }

    canvas {
        height: 500px !important;
    }
</style>
