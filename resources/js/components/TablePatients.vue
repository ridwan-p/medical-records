<template>
	<div>
		<div class="row justify-content-between align-items-center mb-3">
			<div class="col-md-9">
				<!-- <slot name="add"></slot> -->
				<a href="/dashboard/patients/create" class="btn btn-primary mr-2"><i class="material-icons">post_add</i> {{ lang['Add'] }}</a>
				<!-- <button class="btn btn-info import-file" data-target=".import-file-upload"><i class="material-icons">library_add</i> Import</button> -->

				<!-- <form action="{{ route('dashboard.patients.import.list') }}" id="form-import" method="POST" enctype='multipart/form-data'>
					<input type="file" name="file" class="d-none import-file-upload">
				</form> -->
			</div>
			<div class="col-md-3">
		        <div class="input-group">
		            <input type="search" name="search" class="form-control" :placeholder="lang['Search']" v-model="query">
		            <div class="input-group-append">
		                <button class="btn btn-primary" type="submit" id="button-addon2" @click="handleSearch"><i class="material-icons">search</i> </button>
		            </div>
		        </div>
			</div>
		</div>
		<div class="table-responsive rounded-top">
			<table class="table table-striped">
				<thead class="bg-primary text-white">
					<tr>
						<!-- <th>
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input checkbox-selected" data-action="all" id="all-patient">
								<label class="custom-control-label" for="all-patient"></label>
							</div>
						</th> -->
						<th>No</th>
						<th>{{ lang["Name"] }}</th>
						<th>{{ lang["Code"] }}</th>
						<th>{{ lang["Address"] }}</th>
						<th>{{ lang["Date of birth"] }}</th>
						<th>{{ lang["Age"] }}</th>
						<th></th>
					</tr>
				</thead>

				<tbody v-if="isGetting">
					<tr>
						<td colspan="8">
							<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="vertical-align: middle;"></span>
							Loading...
						</td>
					</tr>
				</tbody>
				<template v-else-if="items.data.length">
					<tbody>
						<tr v-for="(item, index) in items.data">
							<!-- <td>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input patient">
									<label class="custom-control-label"></label>
								</div>
							</td> -->
							<td>{{ items.from + index }}</td>
							<td>
								<a :href="`/dashboard/patients/${item.id}`"><img :src="avatar(item)" alt="defaul avatar" width="30" class="rounded-circle"> {{item.name}}</a>
							</td>
							<td>{{ item.code }}</td>
							<td>{{ item.address }}</td>
							<td>{{ item.date_of_birth }}</td>
							<td>{{ item.age }} </td>
							<td>
								<div class="dropdown">
								    <button class="btn btn-outline-primary btn-icon material-icons btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown">more_horiz</button>
								    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								        <a class="dropdown-item" :href="`/dashboard/patients/${item.id}`"><i class="material-icons">remove_red_eye</i> {{ lang['Show'] }}</a>
								        <a class="dropdown-item" :href="`/dashboard/patients/${item.id}/edit`"><i class="material-icons">edit</i>  {{ lang['Edit'] }}</a>
								        <a class="dropdown-item" data-action='destroy' data-target="#form-delete-patient" :data-message="`${lang['Are you sure delete it']} !!!`" :href="`/dashboard/patients/${item.id}`"><i class="material-icons">delete_outline</i> {{ lang['Delete'] }}</a>
								    </div>
								</div>
							</td>
						</tr>
					</tbody>
					<tfoot v-if="items.last_page > 1">
						<tr>
							<td colspan="8">
								<paginate
									v-model="items.current_page"
								    :page-count="items.last_page"
								    :page-range="5"
								    :click-handler="(page) => getData({page, q:query})"
								    :prev-text="'‹'"
								    :next-text="'›'"
								    :container-class="'pagination'"
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
						<td colspan="8">{{ lang['Data is empty'] }}...</td>
					</tr>
				</tbody>
			</table>
		</div>
		<slot></slot>
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
				query: '',
				timer: null,
				lang:lang
			}
		},
		mounted() {
			this.getData()
			// console.log(lang)
		},
		watch: {
			query: function(newQuery, oldQuery) {
				this.handleSearch()
			}
		},
		methods: {
			getData : function(params) {
				this.isGetting = true
				return axios.get(`/local-api/patients`, { params })
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
			},
			avatar: function(patient, size = 'small') {
				return patient.photo ? `/${patient.photo[size]}` : '/images/user.svg'
			}
		}
	}
</script>