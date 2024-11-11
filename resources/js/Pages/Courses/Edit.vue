<script setup>
import Form from './Form.vue';
const props = defineProps({
    teachers:{type:Object},
    course:{type:Object},
    teachersOfCourse:{type:Object}
});
</script>

<template>
    <Form :teachers="teachers" :course="course" 
    :teachersOfCourse="teachersOfCourse"  />
</template>