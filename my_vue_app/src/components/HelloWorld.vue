<template>
  <v-data-table
    :headers="headers"
    :items="products"
    :items-per-page="5"
    class="elevation-1"
  ></v-data-table>
</template>
<script>
  export default {
    data () {
      return {
        headers: [
          {
            text: 'Name',
            align: 'start',
            sortable: false,
            value: 'name',
          },
          { text: 'Description', value: 'description' },
          { text: 'Price', value: 'price' },
        ],
        products: []
      }
    },
    methods: {
      getData(){
        this.$axios.get('http://localhost/product/index').then(response => {
          console.log(response.data)
          this.products = response.data
        })
      }
    },
    mounted(){
      this.getData()
    }
  }
</script>