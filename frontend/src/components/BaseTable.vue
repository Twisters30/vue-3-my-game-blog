<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ tableTitle }}</h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th v-for="(header, index) of tableHeaders" :key="index">
              {{ header }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            @click.stop="$router.push({ path: '/admin/post/' + content.id })"
            v-for="content of tableContent"
            :key="content.id"
            class="box"
          >
            <td v-for="(item, key) of content" :key="key">
              <select
                class="form-control"
                @click.stop
                @change="
                  emits('changeStatus', {
                    post_status_id: $event.target.value,
                    id: content.id,
                  })
                "
                v-if="key === 'post_status_id'"
              >
                <option
                  :selected="Number(status.id) === Number(item)"
                  v-for="status in props.postStatuses"
                  :key="status.id"
                  :value="status.id"
                >
                  {{ status.name }}
                </option>
              </select>
              <span class="cut-text" v-else>{{ striptags(item) }}</span>
            </td>
            <i
              @click.stop="emits('deletePost', content.id)"
              class="fa-solid fa-trash icon-transparent"
            ></i>
            <router-link
              @click.stop
              :to="{ path: '/admin/post/' + content.id }"
            >
              <i class="fa-solid fa-file-pen"></i>
            </router-link>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";
// const regExp = /^(&nbsp;|<br>)+/;
const striptags = require("striptags");
const emits = defineEmits(["deletePost", "changeStatus"]);
const props = defineProps({
  tableTitle: {
    type: String,
  },
  tableHeaders: {
    type: Array,
  },
  tableContent: {
    type: Array,
  },
  postStatuses: {
    type: Array,
  },
});
console.log(props);
</script>
<style>
.cut-text {
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  line-height: 1.3em;
  height: 2.4em;
  max-width: 14em;
}
</style>
