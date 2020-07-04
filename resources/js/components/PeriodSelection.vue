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
                    <label for="period">Select Period</label>
                    <select name="period"
                            v-model="period"
                            id="period"
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
                <p>Custom Period</p>
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
                <label for="changePeriod">Change Period</label>
                <select name="changePeriod"
                        id="changePeriod"
                        v-model="changePeriod"
                        @change="selectChangePeriod($event)"
                >
                    <option value="daily" :disabled="disabledDaily">Daily</option>
                    <option value="weekly" :disabled="disabledWeekly">Weekly</option>
                    <option value="monthly" :disabled="disabledMonthly">Monthly</option>
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
                disabledDaily: true,
                disabledWeekly: true,
                disabledMonthly: true,
            }
        },

        methods: {
            selectPeriod(event) {
                this.period = event.target.value;

                this.disabledDaily = this.period === 'lastYearDays' || this.period === 'lastYear';
                this.disabledWeekly = false;
                this.disabledMonthly = this.period === 'lastSevenDays' || this.period === 'lastWeek';

                if (this.period === 'lastYearDays' || this.period === 'lastYear') {
                    this.changePeriod = 'weekly';
                } else {
                    this.changePeriod = 'daily';
                }

                axios.post('/visits/period', {period: this.period})
                    .then(response => {
                        let firstDateObj = new Date(response.data.period[0]);
                        let lastDateObj = new Date(response.data.period[response.data.period.length - 1]);
                        this.datePeriod = [firstDateObj, lastDateObj];
                    })
                    .catch(error => console.log(error));

                this.$refs.child.callVisits(this.period);
            },

            selectCustomPeriod(event) {
                this.$refs.child.callCustomPeriodVisits(event[0], event[1]);
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
        height: 40px;
    }

    .mx-input {
        height: 40px !important;
    }

    p {
        margin-bottom: 13px;
    }
</style>
