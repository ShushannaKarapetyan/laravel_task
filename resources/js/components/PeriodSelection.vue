<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="m-t-5">Analytics</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <select name="period"
                            v-model="period"
                            @change="selectPeriod($event)"
                    >
                        <option value="lastSevenDays">Last 7 Days</option>
                        <option value="lastWeek">Last Week</option>
                        <option value="lastThirtyDays">Last 30 Days</option>
                        <option value="lastMonth">Last Month</option>
                        <option value="lastYearDays">Last 365 Days</option>
                        <option value="lastYear">Last Year</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <date-picker v-model="datePeriod"
                             name="customRange"
                             @change="selectCustomPeriod($event)"
                             type="date"
                             format="MM/DD/YYYY"
                             range
                >
                </date-picker>
            </div>

            <div class="col-md-3">
                <select name="changePeriod"
                        v-model="changePeriod"
                        @change="selectChangePeriod($event)"
                >
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div>
        </div>

        <visits ref="child"></visits>
    </div>
</template>

<script>
    import Visits from "./Visits";

    export default {
        name: "PeriodSelection",

        components: {
            Visits,
        },

        data() {
            return {
                period: '',
                datePeriod: '',
                changePeriod: '',
            }
        },

        methods: {
            selectPeriod(event) {
                this.period = event.target.value;

                axios.post('/visits/period', {period: this.period})
                    .then(response => {
                        let firstDateObj = new Date(response.data.period[0]);
                        let lastDateObj = new Date(response.data.period[response.data.period.length - 1]);
                        this.datePeriod = [firstDateObj, lastDateObj];
                    })
                    .catch(error => console.log(error));

                this.$refs.child.getVisits(this.period);
            },

            selectCustomPeriod(event) {
                this.$refs.child.getCustomPeriodVisits(event[0], event[1]);
            },

            selectChangePeriod(event) {
                this.$refs.child.getChangePeriodVisits(event.target.value);
            }
        },
    }
</script>

<style scoped>
    select {
        width: 100%;
        height: 40px
    }
</style>
