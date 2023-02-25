<template>
  <div>
    <textarea id="summernote" @input="$emit('update:content', $event.target.value)">
      {{ props.content }}
    </textarea>
  </div>
</template>

<script setup>
const props = defineProps({
  content: String,
})
const emits = defineEmits(['update:content']);
console.log(props.content)
onMounted(() => {
  $('#summernote').summernote({
    height: 300
  });
})
onBeforeUnmount(() => {
  $('#summernote').summernote('destroy');
})
</script>

<style scoped>

</style>