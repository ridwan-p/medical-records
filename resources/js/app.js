/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./utils');

window.Vue = require('vue');
window.lang = require('../lang/id.json')


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('v-select', require('vue-select').default);
// Vue.component('search-component', require('./components/SearchComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// console.log(require('../lang/id.json'))

const app = new Vue({
	el: '#app',
	// data() {
	// 	return {
	// 		diagnosis: [],
	// 		timeRequest : null,
	// 	}
	// },
	// methods: {
	// 	onSearchDiagnosis: function( search, loading ) {
	// 		loading(true);
	// 		if (this.timeRequest) {
	// 	        clearTimeout(this.timeRequest);
	// 	        this.timeRequest = null;
	// 	    }
	// 		this.timeRequest = setTimeout(() => this.searchDiagnosis( { q: search, per_page:5 }, loading ), 800)
	// 	},
	// 	searchDiagnosis: function(params, loading) {
	// 		return axios.get(`/local-api/diagnosis`, { params } )
	// 		.then(res => {
	// 			this.diagnosis = res.data.data
	// 			loading(false)
	// 		})
	// 	}
	// }
});
