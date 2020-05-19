import Tenancies from "./components/tenancies/Tenancies";
import New from "./components/tenancies/New";
import Edit from "./components/tenancies/Edit";
import Show from "./components/tenancies/Show";
import Search from "./components/Search";

new Vue({
    el: '#app',
    name: 'App',
    components: {
        Tenancies,
        New,
        Edit,
        Show,
        Search
    },
});
