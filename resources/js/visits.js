import PeriodSelection from "./components/PeriodSelection";
import Search from "./components/Search";
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

new Vue({
    el: '#app',
    name: 'App',
    components: {
        PeriodSelection,
        Search,
        DatePicker,
    },
});
