<template>
	<div>
		 <div class="d-flex mb-3">
            <div class="col-md-9 px-1">
                <a href="/dashboard/journals/create" class="btn btn-primary"><i class="material-icons">post_add</i> {{ lang['Add'] }}</a>
            </div>
            <div class="col-md-3 px-1">
                <div class="input-group">
                    <input type="search" name="search" class="form-control" :placeholder="lang['Search']" v-model="query">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="material-icons">search</i> </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column">
			<div v-if="isGetting" class="col-md-12 p-1">
				<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="vertical-align: middle;"></span>
				Loading...
			</div>
        	<template v-else-if="items.data.length">
	            <div class="col-md-12 p-1" v-for="(item, key) in items.data">
	                <div :class="`card border-${colors[key % 5]}`" style="border-left: 1em solid">
	                    <div class="card-body row align-items-center">
	                        <div class="col-3">
	                            <h5 class="my-0">{{ lang['Anamnese'] }}</h5>
	                            <ol class="px-2">
	                            	<li v-for="anamnese in item.anamnese">{{ anamnese }}</li>
	                            </ol>
	                            <!-- <p class="mb-1">{{ implode(', ', $journal->anamnese) }}</p> -->
	                            <!-- <p class="mb-1">{{ $journal->diagnosis->implode('name', ', ') }}</p> -->
	                        </div>
	                        <div class="col-3 border-left border-light">
	                            <h5 class="my-0">{{ lang['Diagnosis'] }}</h5>
	                             <ol class="px-2">
	                            	<li v-for="diagnosis in item.diagnosis">{{ diagnosis.name }}</li>
	                            </ol>
	                        </div>
	                        <div class="col-4 border-left border-light d-flex">
	                            <!-- <h5 class="font-weight-bold"><i class="material-icons">access_time</i> {{ item.created_at }}</h5> -->
	                            <img src="/images/user.svg" alt="avatar" width="50" class="rounded-circle">
	                            <div class="ml-3">
	                                <h5 class="font-weight-bold">{{ item.patient.name }}</h5>
	                                <p class="my-0"><i class="material-icons text-secondary">location_city</i> {{ item.patient.address }}</p>
	                                <p class="my-0"><i class="material-icons text-secondary">date_range</i> {{ item.patient.date_of_birth }}</p>
	                            	<p class="my-0">{{ lang['Created at'] }} : {{ item.created_at }}</p>
	                            </div>
	                        </div>
	                        <div class="col-2 border-left border-light">
	                            <a :href="`/dashboard/journals/${item.id}/edit`" class="btn btn-primary"> <i class="material-icons">edit</i> {{ lang['Edit'] }}</a>
	                        </div>
	                     </div>
	                </div>
	            </div>
	            <paginate
					v-model="items.current_page"
				    :page-count="items.last_page"
				    :page-range="5"
				    :click-handler="(page) => getData({page, q:query})"
				    :prev-text="'‹'"
				    :next-text="'›'"
				    :container-class="'pagination mt-3'"
				    :prev-class="'page-item'"
				    :next-class="'page-item'"
				    :page-class="'page-item'"
				    :prev-link-class="'page-link'"
				    :next-link-class="'page-link'"
				    :page-link-class="'page-link'"
			    >
				</paginate>
	        </template>
            <div v-else class="col-md-12 p-1">{{ lang['Data is empty'] }} ...</div>
        </div>
	</div>
</template>

<script>
	import Paginate from './Paginate'
	export default {
		components:{ Paginate },
		data() {
			return {
				colors: [ 'primary', 'info', 'warning', 'danger' , 'success'],
				query: '',
				lang:lang,
				items: { data: [] },
				isGetting: false,
				timer: null,
			}
		},
		mounted() {
			this.getData()
		},
		watch: {
			query: function(newQuery, oldQuery) {
				this.handleSearch()
			}
		},
		methods: {
			getData : function(params) {
				this.isGetting = true
				return axios.get(`/local-api/journals`, { params })
					.then(res => {
						this.items = res.data
						this.isGetting = false
						// console.log(res.data)
						return res
					})
			},
			handleSearch: function() {
				this.isGetting = true

				if (this.timer) {
			        clearTimeout(this.timer);
			        this.timer = null;
			    }
				this.timer = setTimeout(() => this.getData( { q: this.query } ), 800)
			}
		}
	}
</script>