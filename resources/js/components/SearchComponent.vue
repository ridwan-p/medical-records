<template>
  <div class="form-group position-relative">
    <input
      type="text"
      :class="`form-control ${items.length > 0 ? 'rounded-bottom-0' : ''}`"
      v-model="query"
      @keyup="handleSearch()"
    />
    <ul class="list-group list-search">
        <li v-for="item in items" @click="handleSelect(item[column])" class="list-group-item">{{item[column]}}</li>
    </ul>
  </div>
</template>


<script>
  export default {
    props:{
      url: String,
      column: String,
      name: String
    },
    data(){
      return {
        items: [],
        query: '',
        isSearching: false,
        timer: null,
      }
    },

    computed: {
      // listItem() {
      //   return this.items.filter(item => item.toLowerCase().includes(this.query.toLowerCase()))
      // }
    },

    methods: {
      search: function(){
        this.isSearching = true
        let vm = this;
        return axios.get(this.url,{
          params:{
            per_page: 5,
            q: this.query
          }
        })
          .then(res => {
            vm.items = res.data.data
            vm.isSearching = false
            return res
          })
      },

      handleSearch: function(){
        if (this.timer) {
          clearTimeout(this.timer);
          this.timer = null;
        }
        this.timer = setTimeout(this.search, 1000);
      },
      handleSelect: function(item){
        this.query = item
      }
    }
  }
</script>