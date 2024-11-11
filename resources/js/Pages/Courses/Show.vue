<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DarkButton from '@/Components/DarkButton.vue';

const props = defineProps({
    course:{type:Object},
    teachers:{type:Object}
})



</script>
<template>
    <Head title="Course" />
    <AuthenticatedLayout>
		<template #header> 
            <div class="inline-flex overflow-hidden mb-4 w-full">
                {{ course.name }}
                <NavLink :href="route('courses.index')">
                    <DarkButton>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </DarkButton>
                </NavLink>
            </div>
		</template>
        <div class="grid gap-6 bg-white mb-8 md:grid-cols-2 border rounded-lg">
            <div class="win-w-0 p-4 rounded-lg shadow-xs">
                <p>Description: <span class="text-gray-900 font-semibold"> {{ course.description }}</span></p>
                <p>Duration: <span class="text-gray-900 font-semibold"> {{ course.duration }}</span></p>
                <p>Teachers:
                    <span v-for="t,i in teachers" class="text-gray-900 font-semibold">
                     <a v-if="i == (teachers.length-1)">{{ t.last_name+' '+t.name }}</a>
                     <a v-else>{{ t.last_name+' '+t.name+', ' }}</a>
                    </span></p>
                <p>Mode: <span class="text-gray-900 font-semibold"> {{ course.mode }}</span></p>
                <p>Start date: <span class="text-gray-900 font-semibold"> {{ course.start_date }}</span></p>
                <p>Finish date: <span class="text-gray-900 font-semibold"> {{ course.finish_date }}</span></p>
                <p>Cost: <span class="text-gray-900 font-semibold"> {{ course.cost }}</span></p>
            </div>
            <div class="win-w-0 p-4 rounded-lg shadow-xs">
                <img :src="'../storage'+course.image" :alt="course.name" width="500">
            </div>
        </div>
</AuthenticatedLayout>
</template>