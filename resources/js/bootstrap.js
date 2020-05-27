import Vue from 'vue';
import axios from 'axios';

window.Vue = Vue;
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '0eda8708aa499611903f',
    cluster: 'mt1',
    encypted: true,
});
