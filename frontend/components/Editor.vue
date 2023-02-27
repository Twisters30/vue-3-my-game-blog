<template>
  <div>
    <textarea id="summernote" type="text" ref="editor" v-model="data.description">
      {{ data.description }}
    </textarea>
  </div>
</template>

<script setup>
let props = defineProps(['content','modelValue']);
let emit = defineEmits(['update:modelValue', 'update-editor']);
const editor = ref(null)
const data = computed(() => {
  return new Proxy(props.modelValue, {
    set (obj, key, value) {
      emit('update:modelValue', { ...obj, [key]: value });
      return true;
    }
  });
});
onMounted(() => {
  $(editor.value).summernote({
    height: 300,
    callbacks: {
      onChange: (content) => {
        data.value.description = content;
      }
    }
  });
});
onBeforeUnmount(() => {
  $('#summernote').summernote('destroy');
})
</script>

<style scoped>

</style>