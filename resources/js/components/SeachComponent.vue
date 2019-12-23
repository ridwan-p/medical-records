<template>
  <div class="form-group position-relative">
    <input
      type="text"
      :class="`form-control ${listItem.length > 0 ? 'rounded-bottom-0' : ''}`"
      v-model="search"
    />
    <ul class="list-group list-search">
      <li v-for="item in listItem" class="list-group-item">{{item}}</li>
    </ul>
  </div>
</template>


<script>
  export default {
    data(){
      return {
        items:['Adi', 'Yayan Iswanto', 'Ara Pradita', 'Yuli', 'Yanti Dwi Astuti'],
        search:''
      }
    },
    computed: {
      listItem() {
        return this.items.filter(item => item.toLowerCase().includes(this.search.toLowerCase()))
      }
    }
  }
</script>