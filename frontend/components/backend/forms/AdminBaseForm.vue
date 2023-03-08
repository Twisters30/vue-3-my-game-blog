<template>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{ titleForm  || 'Название формы'}}</h3>
    </div>
    <form @submit.prevent="emits('createOrUpdatePost', data)">
      <div class="card-body">
        <div class="form-group">
          <label for="inputName">Название Статьи</label>
          <input v-model="data.name" type="text" class="form-control" id="inputName">
        </div>
        <div class="form-group">
          <label for="imageInputFile">Загрузить изображение</label>
          <div class="input-group d-flex">
            <div class="custom-file">
              <input ref="postImage" @change="onFileChange($event, 'image')" type="file" class="form-control" id="imageInputFile">
              <label class="custom-file-label" for="imageInputFile">Choose file</label>
            </div>
          </div>
        </div><div class="form-group">
        <label for="iconInputFile">Загрузить иконку</label>
        <div class="input-group d-flex">
          <div class="custom-file">
            <input ref="postIcon" @change="onFileChange($event,'icon')" type="file" class="form-control" id="iconInputFile">
            <label class="custom-file-label" for="iconInputFile">Choose file</label>
          </div>
        </div>
      </div>
        <div class="form-group" v-if="props.postStatuses">
          <label for="exampleFormControlSelect1">Example select</label>
          <select v-model="data.post_status_id" class="form-control" id="exampleFormControlSelect1">
            <option :selected="data.post_status_id  === status.id" :value="status.id" v-for="status of props.postStatuses" :key="status">{{ status.name }}</option>
          </select>
        </div>
      </div>
      <Editor v-model="data" />
      <div class="card-footer bg-transparent">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</template>

<script setup>
const props = defineProps(['titleForm', 'postStatuses', 'post','adminPostsStore']);
const emits = defineEmits(['createOrUpdatePost']);
const postImage = ref(null);
const postIcon = ref(null);
const data = ref(props.post || { post_status_id:props.postStatuses });
const onFileChange = (e,flag) => {
  const files = e.target.files || e.dataTransfer.files;
  data.value[flag] = files[0];
  console.log(data.value);
}
const preloadImageFile = (imagePath, ref) => {
  let imgBlob = new Blob([""], {type: 'text/plain'});
  let file = new File([imgBlob], imagePath || 'фаил не выбран' ,{type:"image/jpeg", lastModified:new Date().getTime()}, 'utf-8');
  let container = new DataTransfer();
  container.items.add(file);
  ref.value.files = container.files;
}
onMounted(() => {
  preloadImageFile(data.value.icon, postImage);
  preloadImageFile(data.value.image, postIcon);
})
</script>

<style scoped>

</style>