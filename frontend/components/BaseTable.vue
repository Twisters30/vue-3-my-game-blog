<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ props.tableTitle }}</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th v-for="header of props.tableHeaders">{{ header }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(post,i) of props.posts" :key="i">
          <td v-for="item in post" :key="item.id">{{ item }}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  tableTitle: String,
  tableHeaders: Array,
  posts: Object
})
console.log(props)
</script>

<style scoped>

</style>