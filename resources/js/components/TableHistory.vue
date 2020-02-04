<template>
	<div>
		<div class="d-flex justify-content-end mb-3">
			<div class="d-inline-flex">
                <input type="date" class="form-control" name="date_start" :placeholder="lang['date start']" v-model="date_start" @change="handleSearch" />
                <input type="date" class="form-control mx-3" name="date_end" :placeholder="lang['date end']" v-model="date_end" @change="handleSearch" />
                <div class="input-group">
                    <input type="search" name="search" class="form-control" :placeholder="lang['Search']" v-model='query_search' >
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="material-icons">search</i> </button>
                    </div>
                </div>
			</div>
        </div>
		<div class="table-responsive rounded-top">
            <table class="table table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>{{ lang['No'] }}</th>
                        <th>{{ lang['Name'] }}</th>
                        <th>{{ lang['Age'] }} / {{ lang['Gender'] }}</th>
                        <th>{{ lang['Address'] }}</th>
                        <th>{{ lang['Anamnese'] }}</th>
                        <th>{{ lang['Physical Report'] }}</th>
                        <th>{{ lang['Diagnosis'] }}</th>
                        <th>{{ lang['Medications'] }}</th>
                        <th>{{ lang['Note'] }}</th>
                        <th>{{ lang['Created at'] }}</th>
                    </tr>
                </thead>
                <tbody v-if="isGetting">
					<tr>
						<td colspan="10">
							<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="vertical-align: middle;"></span>
							Loading...
						</td>
					</tr>
				</tbody>
				<template v-else-if="items.data.length">
                    <tbody>
                        <tr v-for="(item, index) in items.data">
                            <td>{{ index +  items.from }}</td>
                            <td>{{ item.patient.name }}</td>
                            <td>{{ item.patient.age}}/ {{ item.patient.gender === 'm' ? lang['Male'] : lang["Female"] }}</td>
                            <td>{{ item.patient.address }}</td>
                            <td>
                                <ol>
                                    <li v-for="anamnese in item.anamnese">{{ anamnese }}</li>
                                </ol>
                            </td>
                            <td>
                                <ol>
                                	<li v-for="physical_report in item.physical_report">{{ physical_report }}</li>
                                </ol>
                            </td>
                            <td>
                                <ol>
                                	<li v-for="diagnosis in item.diagnosis">{{ diagnosis.name }}</li>
                                </ol>
                            </td>
                            <td>
                                <ol>
                                	<li v-for="medication in item.medications">{{ medication.name }}</li>
                                </ol>
                            </td>
                            <td>{{ item.note }}</td>
                            <td>{{ item.created_at }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">{{ lang['Total'] }} : {{ items.total }} {{ lang['items'] }}</td>
                            <td colspan="7">
								<paginate
									v-model="items.current_page"
								    :page-count="items.last_page"
								    :page-range="5"
								    :click-handler="(page) => getData({page, ...query})"
								    :prev-text="'‹'"
								    :next-text="'›'"
								    :container-class="'pagination float-right'"
								    :prev-class="'page-item'"
								    :next-class="'page-item'"
								    :page-class="'page-item'"
								    :prev-link-class="'page-link'"
								    :next-link-class="'page-link'"
								    :page-link-class="'page-link'"
							    >
								</paginate>
                            </td>
                        </tr>
                    </tfoot>
                </template>

				<tbody v-else>
					<tr>
						<td colspan="10">{{ lang['Data is empty'] }}...</td>
					</tr>
				</tbody>
            </table>
        </div>
	</div>
</template>

<script>
	import Paginate from './Paginate'

	export default {
		components:{ Paginate },
		data() {
			return {
				items: { data: [] },
				isGetting: false,
				query_search: '',
				date_start:null,
				date_end:null,
				timer: null,
				lang:lang
			}
		},
		mounted() {
			this.getData()
		},
		watch: {
			query_search: function(newQuery, oldQuery) {
				this.handleSearch()
			}
		},
		methods: {
			getData : function(params) {
				this.isGetting = true
				return axios.get(`/local-api/history`, { params })
					.then(res => {
						this.items = res.data
						this.isGetting = false
						return res
					})
			},
			handleSearch: function() {
				this.isGetting = true

				if (this.timer) {
			        clearTimeout(this.timer);
			        this.timer = null;
			    }
				this.timer = setTimeout(() => this.getData( { q:this.query_search, date_start:this.date_start, date_end:this.date_end } ), 800)
			}
		}
	}
</script>