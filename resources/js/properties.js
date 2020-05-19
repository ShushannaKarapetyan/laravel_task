import Properties from "./components/properties/Properties";
import New from "./components/properties/New";
import Edit from "./components/properties/Edit";
import Show from "./components/properties/Show";
import Search from "./components/Search";

new Vue({
    el: '#app',
    name: 'App',
    components: {
        Properties,
        New,
        Edit,
        Show,
        Search
    },
});
