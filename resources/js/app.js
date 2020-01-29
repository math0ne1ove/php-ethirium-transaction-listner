import Vue from 'vue';
import vuetify from './vuetify';

//components
import Transactions from './components/Transactions'

require('./bootstrap');

new Vue({
    vuetify,
    components: {
        Transactions,
    },
    props: {
        source: String,
    },
    data: () => ({
        drawer: null,
        snackbar: window.config.snackbar,
        snackbarColor: window.config.snackbarColor,
        snackbarText: window.config.snackbarText
    }),
    created () {
        this.$vuetify.theme.dark = true
    },
}).$mount('#app');

