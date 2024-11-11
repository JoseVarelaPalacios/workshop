<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputGroup from '@/Components/InputGroup.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { ref } from 'vue';


//importar los props (variables del controlador)
const props = defineProps({
	teachers:{type:Object},countries:{type:Object}
}); 

//crear formulario
const form = useForm({name:'',last_name:'',country_id:''});
const v =ref({id:'',name:'',last_name:'',courses:[]});
const showModalView= ref(false);
const showModalForm= ref(false);
const showModalDel= ref(false);
const title = ref('');
const operation=ref(1);
const msj = ref('');
const classMsj = ref('hidden');

const openModalView = (t) =>{
	v.value.name = t.last_name+' '+t.name;
	v.value.country = t.country.country;
	v.value.courses = t.courses;
	showModalView.value=true;
}
const openModalForm = (op,t) =>{
	showModalForm.value = true;
	operation.value = op;
	if (op === 1) {
		title.value = 'Create teacher';
	}
	else{
		title.value = 'Edit teacher';
		form.name = t.name;
		form.last_name = t.last_name;
		form.country_id = t.country_id;
		v.value.id = t.id;
	}
}
const openModalDel = (t) =>{
	showModalDel.value = true;
	v.value.id = t.id;
	v.value.name = t.last_name+' '+t.name;
}
const closeModalView = () =>{
	showModalView.value = false;
	
}
const closeModalForm = () =>{
	showModalForm.value = false;
	form.reset();
}
const closeModalDel = () =>{
	showModalDel.value = false;
	
}
const save = () => {
	if (operation.value == 1) {
		form.post(route('teachers.store'),{
			onSuccess: () => {ok('Teacher created')}
		});
	}
	else{
		form.put(route('teachers.update',v.value.id),{
			onSuccess: () => {ok('Teacher updated')}
		});
	}
}
const ok = (m) => {
	if (operation.value == 2) {
		closeModalForm();
	}
	closeModalDel();
	form.reset();
	msj.value = m;
	classMsj.value = 'block';
	setTimeout(() => {
		classMsj.value = 'hidden';
	}, 6000);
}

const deleteTeacher = () =>{
	form.delete(route('teachers.destroy',v.value.id),{
		onSuccess: () => { ok('Teacher delete')}
	}
)
}

</script>

<template>
    <Head title="Teachers"/>
    <AuthenticatedLayout>
		<template #header> Teachers 
			<DarkButton @click="openModalForm(1)">
				<i fa-solid fa-trash><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
        </svg>
        </i></DarkButton>
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
                           <th class="px-4 py-3">Last Name</th>
						   <th class="px-4 py-3">Country</th>
						   <th class="px-4 py-3">Detail</th>
						   <th class="px-4 py-3">Edit</th>
						   <th class="px-4 py-3">Delete</th>
                        </tr>
					</thead>
					<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
						<tr v-for="t,i in teachers" :key="t.id" class="text-white">
							<td class="px-4 py-3 text-sm">
								{{ (i+1) }}
							</td>
							<td class="px-4 py-3 text-sm">
								{{ (t.name) }}
							</td>
							<td class="px-4 py-3 text-sm">
								{{ (t.last_name) }}
							</td>
							<td class="px-4 py-3 text-sm">
								{{ (t.country.country) }}
							</td>
							
							<td class="px-4 py-3 text-sm">
								<SecondaryButton @click="openModalView(t)">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
									</svg>
                                </SecondaryButton>
							</td>
							<td class="px-4 py-3 text-sm">
								<WarningButton @click="openModalForm(2,t)">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                                </WarningButton>
							</td>
							<td class="px-4 py-3 text-sm">
								<DangerButton @click="openModalDel(t)">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                </svg>
                                </DangerButton>
							</td>
						</tr>
                    </tbody>
				</table>
			</div>
		</div>
		<Modal :show="showModalView" @close="closeModalView">
			<div class="p-6">
				<p>Teacher: <span class="text-lg font-medium text-gray-900">{{ v.name }}</span></p>
				<p>Country: <span class="text-lg font-medium text-gray-900">{{ v.country }}</span></p>
				Courses:
				<ol>
					<li class="text-lg font-medium text-gray-900" v-for="c,i in v.courses">
						{{ (i+1)+') '+ c.name }}
					</li>
				</ol>
			</div>
			<div class="m-6 flex justify-end">
				<SecondaryButton @click="closeModalView">Cancel</SecondaryButton>
			</div>
		</Modal>

		<Modal :show="showModalForm" @close="closeModalForm">
			<div class="p-6">
				<h2 class="text-lg font-medium text-gray-900">{{ name }}</h2>
				<div class="mt-6 mb-6 space-y-6 max-w-xl">
					<InputGroup :text="'Name'" :required="'required'" v-model="form.name" :type="'text'">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
						</svg>
					</InputGroup>
					<InputError class="mt-1" :message="form.errors.name"></InputError>

					<InputGroup :text="'Last Name'" :required="'required'" v-model="form.last_name" :type="'text'" >
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
						</svg>
					</InputGroup>
					<InputError class="mt-1" :message="form.errors.last_name"></InputError>
					
					<SelectInput :text="'Country'" :required="'required'" v-model="form.country_id" :options="countries">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
						</svg>
					</SelectInput>
					<InputError class="mt-1" :message="form.errors.country_id"></InputError>
					<PrimaryButton @click="save">Save</PrimaryButton>
				</div>
			</div>
			<div class="m-6 flex justify-end">
				<SecondaryButton @click="closeModalForm">Cancel</SecondaryButton>
			</div>
		</Modal>

		<Modal :show="showModalDel" @close="closeModalDel">
			<div class="p-6">
				<p class="text-2x1 text-gray-900">
					Are you sure delete to  
					<span class="text-2x1 font-medium text-gray-900">{{ v.name }}</span> ? </p>
					<PrimaryButton @click="deleteTeacher">
						Yes,delete
					</PrimaryButton>
				</div>
			<div class="m-6 flex justify-end">
				<SecondaryButton @click="closeModalDel">Cancel</SecondaryButton>
			</div>
		</Modal>
	</AuthenticatedLayout>
</template>