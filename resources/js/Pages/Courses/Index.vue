<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import Pagination from '@/Components/Pagination.vue';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';

//importar los props (variables del controlador)
const props = defineProps({
	courses:{type:Object},flash:{type:Object}
}); 
const form = useForm({id:'',name:''});
const showModalDel = ref(false);
const msj = ref( (props.flash.success !=null) ? props.flash.success: '' );
const classMsj = ref( (props.flash.success !=null) ? '' : 'hidden' );

const openModalDel = (c) =>{
    form.id = c.id;
    form.name = c.name;
    showModalDel.value = true;
}
const closeModalDel = () =>{
    showModalDel.value = false;
}
const deleteCourse = ()=>{
    form.delete(route('courses.destroy',form.id),{
        onSuccess: () => {ok('Course deleted')}
    });
}
const ok = (m) => {
	closeModalDel();
	form.reset();
	msj.value = m;
	classMsj.value = 'block';
	setTimeout(() => {
		classMsj.value = 'hidden';
	}, 6000);
}

</script>

<template>
    <Head title="Courses"/>
    <AuthenticatedLayout>
		<template #header> 
            Courses 
		</template>
		
		<div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md" :class="classMsj">
				<div class="flex justify-center items-center w-12 bg-green-500">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
					<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
					</svg>
				</div>
				
				<div class="px-4 py-2 -mx-3">
					<div class="mx-3">
						<span class="font-semibold text-green-500">Success</span>
						<p class="text-sm text-gray-600">{{ msj }}</p>
					</div>
				</div>
			</div>

		<div class="w-full overflow-hidden rounded-lg border shadow-md">
			<div class="w-full overflow-x-auto bg-white">
				<table class="w-full whitespace-no-wrap">
					<thead>
						<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                           <th class="px-4 py-3">#</th>
                           <th class="px-4 py-3">Name</th>
                           <th class="px-4 py-3">Duration</th>
						   <th class="px-4 py-3">Image</th>
						   <th class="px-4 py-3">Detail</th>
						   <th class="px-4 py-3">Edit</th>
						   <th class="px-4 py-3">Delete</th>
                        </tr>
					</thead>
					<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
						<tr v-for="c,i in courses.data" :key="c.id" class="text-white">
							<td class="px-4 py-3 text-sm">
								{{ (i+1) }}
							</td>
							<td class="px-4 py-3 text-sm">
								{{ (c.name) }}
							</td>
							<td class="px-4 py-3 text-sm">
								{{ (c.duration) }}
							</td>
							<td class="px-4 py-3 text-sm">
								<img :src="'storage'+c.image" width="90">
							</td>
							
							<td class="px-4 py-3 text-sm">
                                <NavLink :href="route('courses.show',c.id)">
								<SecondaryButton>
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
									</svg>
                                </SecondaryButton>
                                </NavLink>
							</td>
							<td class="px-4 py-3 text-sm">
								<NavLink :href="route('courses.edit',c.id)">
								<WarningButton>
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                                </WarningButton>
							</NavLink>
							</td>
							<td class="px-4 py-3 text-sm">
								<DangerButton @click="openModalDel(c)">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                </svg>
                                </DangerButton>
							</td>
						</tr>
                    </tbody>
				</table>
			</div>
            <div
				class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
				<pagination :links="courses.links" />
            </div>
		</div>
		

		<Modal :show="showModalDel" @close="closeModalDel">
			<div class="p-6">
				<p class="text-2x1 text-gray-900">
					Are you sure delete to  
					<span class="text-2x1 font-medium text-gray-900">{{ form.name }}</span> ? </p>
					<PrimaryButton @click="deleteCourse">
						Yes,delete
					</PrimaryButton>
				</div>
			<div class="m-6 flex justify-end">
				<SecondaryButton @click="closeModalDel">Cancel</SecondaryButton>
			</div>
		</Modal>
	</AuthenticatedLayout>
</template>