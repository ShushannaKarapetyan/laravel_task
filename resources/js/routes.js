import VueRouter from 'vue-router';
import Properties from "./components/properties/Properties";

let routes = [
    {
        path: '/properties',
        name: 'properties',
        component: Properties,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/create',
                name: 'create',
                /*component: CreateProperty,*/
            },
        ],

    },

];

export default new VueRouter({
    routes
});
