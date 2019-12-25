<template>
  <div class="form-group position-relative">
    <ul>
      <li v-for="tag in tags">{{tag}}</li>
    </ul>
    <input
      type="text"
      :class="`form-control ${items.length > 0 ? 'rounded-bottom-0' : ''}`"
      v-model="query"
      @keyup="handleSearch"
      @keydown.enter.prevent="pushTags(query)"
    />
    <ul class="list-group list-search">
        <li v-for="item in items" @click="pushTags(item[column])" class="list-group-item">{{item[column]}}</li>
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
        tags: []
      }
    },

    methods: {
      search: function(){
        if(this.query.length <= 0) return ''

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

      handleSearch: function(e){
        if (this.timer) {
          clearTimeout(this.timer);
          this.timer = null;
        }
        this.timer = setTimeout(this.search, 1000);
      },

      pushTags: function(item){
        this.tags.push(item)
        this.query = ''
        this.items = []
      }
    }
  }
</script>