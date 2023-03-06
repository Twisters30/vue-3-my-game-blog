<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ tableTitle }}</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th v-for="header of tableHeaders">{{ header }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="content of tableContent" :key="content.id" class="box">
          <td v-for="(item, key) of content" :key="key">
            <select v-if="key === 'post_status_id'">
              <option
                  :selected="Number(status.id) === Number(item)"
                  v-for="status in postStatuses" :key="status.id"
                  :value="status.id">
                {{ status.name }}
              </option>
            </select>
            <span v-else>{{ item }}</span>
          </td>
          <i @click="$emit('deletePost',content.id)" class="fa-solid fa-trash icon-transparent"></i>
          <NuxtLink :to="pathUrl + content.id">
            <i class="fa-solid fa-file-pen"></i>
          </NuxtLink>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
const emits = defineEmits(['deletePost'])
const props = defineProps({
  tableTitle: String,
  tableHeaders: Array,
  tableContent: Array,
  pathUrl: String,
  postStatuses: Array,
})
</script>

<style scoped>
</style>