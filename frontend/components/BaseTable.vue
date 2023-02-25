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
        <tr v-for="(content,i) of props.tableContent" :key="i">
          <td v-for="item in content" :key="item.id">{{ item }}</td>
          <i class="fa-solid fa-trash icon-transparent"></i>
          <NuxtLink :to="props.pathUrl + content.id">
            <i class="fa-solid fa-file-pen"></i>
          </NuxtLink>
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
  tableContent: Object,
  pathUrl: String,
})
</script>

<style scoped>
</style>