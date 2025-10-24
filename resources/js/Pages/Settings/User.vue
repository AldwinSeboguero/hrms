<script setup>
import { Dropdown, Modal } from 'flowbite'
import { router, usePage, Link, Head, usePoll } from '@inertiajs/vue3'
import { ref, computed, watch, reactive, onMounted } from 'vue'
import debounce from 'lodash/debounce'
import { initFlowbite } from 'flowbite'
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
    getPositions(1);
})
usePoll(2000, {
    onStart() {


    },
    onFinish() {
        // console.log('Polling request finished')
    }
})


const { props } = usePage();
const positions = ref({});
const work_days = ref({});

const loading = ref(true);
const search = ref('');


// Function to fetch positions from the API
const getPositions = async (page) => {
    loading.value = true;
    try {
        const response = await axios.get(`/positions?page=${page}`);
        positions.value = response.data.positions;
    } catch (error) {
        console.error('Error fetching positions:', error);
    } finally {
        loading.value = false;
    }
};
const searchName = async (search) => {
    loading.value = true;
    try {
        const response = await axios.get(`/positions?search=${search}`);
        positions.value = response.data.positions;
    } catch (error) {
        console.error('Error fetching positions:', error);
    } finally {
        loading.value = false;
    }
};


const dialogVisible = ref(false);
const dialogDeleteVisible = ref(false);



const form = reactive({
    id: '',
    name: '',
    sg: '',

});
const openModal = () => {
    form.id = '';
    form.name = '';
    form.sg = '';
    dialogVisible.value = true;

}


const openUpdateModal = (formData) => {
    form.id = formData.id;
    form.name = formData.name;
    form.sg = formData.sg;


    dialogVisible.value = true;

}

const saveData = async () => {
    try {


        const response = await axios.post('/positions', { data: form });
        positions.value = response.data.positions;
        dialogVisible.value = false;

    } catch (error) {
        console.error('Error updating timesheet:', error);
    }


};



</script>

<template>
    <div class="flex flex-wrap  ">
    <div v-for="networkInterface in props.mac_address" :key="networkInterface.id" class="w-full max-w-sm p-4 bg-white rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700 border-b-4 border-pink-500 m-2">
        <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400">{{ networkInterface.name }}</h5>
        <div class="flex items-baseline text-gray-900 dark:text-white"> 
            <span class="text-5xl font-extrabold tracking-tight">{{ networkInterface.ipv4_address }}</span> 
        </div>
        <ul role="list" class="space-y-5 my-7">
            <li class="flex items-center">
                <svg class="shrink-0 w-4 h-4 text-blue-700 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400 ms-3">Mac Address: {{ networkInterface.mac_address }}</span>
            </li> 
        </ul>
    </div>
</div>

</template>