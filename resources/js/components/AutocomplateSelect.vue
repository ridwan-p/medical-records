<template>
	<div>
		<v-select
			:label="label"
			:filterable="false"
			:options="options"
			@search="onSearch"
			multiple
			taggable
			push-tags
			v-model="items"
		> </v-select>
		<input
			v-for="(item, i) in items"
			type="hidden"
			:value="item[label] ? item[label] : item"
			:name="`${name}[${i}]${label ? `[${label}]` : ``}`"
		>
	</div>
</template>

<script>
	import vSelect from 'vue-select'
	export default {
		components:{ vSelect },
		props:{
	      url: String,
	      label: String,
	      name: String,
	    },
		data() {
			return {
				options:[],
				timeRequest: null,
				items:[]
			}
		},
		methods: {
			onSearch: function( search, loading ) {
				loading(true);
				if (this.timeRequest) {
			        clearTimeout(this.timeRequest);
			        this.timeRequest = null;
			    }
				this.timeRequest = setTimeout(() => this.handleSearch( { q: search, per_page:5 }, loading ), 800)
			},
			handleSearch: function(params, loading) {
				return axios.get(this.url, { params } )
				.then(res => {
					this.options = res.data.data
					loading(false)
				})
			}
		}
	}
</script>