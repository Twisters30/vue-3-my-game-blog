<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <BaseTable
              :tableHeaders="tableHeaders"
              :tableTitle="tableTitle"
              :posts="posts"
          />
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <!-- /.content -->
  </div>
</template>

<script setup>
import BaseTable  from "@/components/BaseTable.vue";

const posts = reactive([
  {
    id:1,
    name: 'testName',
    description: 'test lorem test loremtest lorem test lorem test lorem test lorem test lorem test lorem test lorem',
    image: '/img/test.jpg',
    icon:'/icons/gameIcon.jpg',
    post_status_id:1,
    user_id:1,
    created_at: new Date(),
    updated_at: new Date()
  },{
    id:2,
    name: 'testName',
    description: 'test lorem test loremtest lorem test lorem test lorem test lorem test lorem test lorem test lorem',
    image: '/img/test.jpg',
    icon:'/icons/gameIcon.jpg',
    post_status_id:2,
    user_id:2,
    created_at: new Date(),
    updated_at: new Date()
  },
]);
const tableTitle = 'Редактирование статей';
const tableHeaders = reactive(
    [
      'id','name','description','image','icon','post_status_id','user_id','created_at','updated_at'
    ]
)

</script>



<style scoped>

</style>