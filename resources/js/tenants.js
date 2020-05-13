import Tenants from "./components/tenants/Tenants";
import New from "./components/tenants/New";
import Edit from "./components/tenants/Edit";
import Show from "./components/tenants/Show";

new Vue({
    el: '#app',
    name: 'App',
    components: {
        Tenants,
        New,
        Edit,
        Show
    },
});
