<script setup>
import Form from './Form.vue';
const props = defineProps({
    teachers:{type:Object}
});
</script>

<template>
    <Form :teachers="teachers"/>
</template>