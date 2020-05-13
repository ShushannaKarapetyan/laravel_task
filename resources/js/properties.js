import Properties from "./components/properties/Properties";
import New from "./components/properties/New";
import Edit from "./components/properties/Edit";
import Show from "./components/properties/Show";

new Vue({
    el: '#app',
    name: 'App',
    components: {
        Properties,
        New,
        Edit,
        Show
    },
});
