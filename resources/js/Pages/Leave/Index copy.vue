<script>
export default {
    data() {
        modal: ''
    },
    methods: {
        toggleModal() {
            modal.value = true;
            // this.modal.toggle();
        }
    },
    mounted() {
        // set the modal menu element
        const targetEl = document.getElementById('defaultModal');

        if (targetEl) {
            // options with default values
            const options = {
                placement: 'center',
                // backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0',
                onHide: () => {
                    console.log('modal is hidden');
                },
                onShow: () => {
                    console.log('modal is shown');
                },
                onToggle: () => {
                    console.log('modal has been toggled');
                }
            };

            this.modal = new Modal(targetEl, options);
        }

    }
}
</script>
<script setup>
import AppLayout from '@/Layouts/MyLayout.vue';
import { ref, computed, watch,reactive } from 'vue'
import Welcome from '@/Components/Welcome.vue';
import { router, usePage, Link } from '@inertiajs/vue3'
import { onMounted, onUpdated } from 'vue'
import { store } from '../../store.js'
import debounce from 'lodash/debounce'
import InputError from '@/Components/InputError.vue';


import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
    Listbox,
    ListboxLabel,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
    RadioGroup,
    RadioGroupLabel,
    RadioGroupDescription,
    RadioGroupOption,
    Dialog, DialogPanel, DialogTitle, TransitionChild
} from '@headlessui/vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
const props = defineProps({
    table_data: Object,
    filters: Object,
    time_records: Array,
    attendances: Object,
    at: Object,
    employee: Object,
    selectedMonth: String,
    selectedYear: String,
    offices: Object,
    years: Object,
    open: Boolean,



})

let plans = ref(props.table_data.data)

let selected = ref(props.filters.employee_id);
let item = ref('')
let search = ref(props.filters.search);
const plan = ref(plans[0]);


const months = [
    { id: 1, name: 'January', unavailable: false },
    { id: 2, name: 'February', unavailable: false },
    { id: 3, name: 'March', unavailable: false },
    { id: 4, name: 'April', unavailable: true },
    { id: 5, name: 'May', unavailable: false },
    { id: 6, name: 'June', unavailable: false },
    { id: 7, name: 'July', unavailable: false },
    { id: 8, name: 'August', unavailable: false },
    { id: 9, name: 'September', unavailable: false },
    { id: 10, name: 'October', unavailable: false },
    { id: 11, name: 'November', unavailable: false },
    { id: 12, name: 'December', unavailable: false },

]
let selectedMonth = ref(months[props.selectedMonth - 1])


let selectedYear = ref(props.selectedYear)

let people = [
    { id: 1, name: 'Wade Cooper' },
    { id: 2, name: 'Arlene Mccoy' },
    { id: 3, name: 'Devon Webb' },
    { id: 4, name: 'Tom Cook' },
    { id: 5, name: 'Tanya Fox' },
    { id: 6, name: 'Hellen Schmidt' },
]

let selectedOffice = ref(props.offices.find(office => office.id == props.filters.selectedOffice))
let query = ref('')

let filteredPeople = computed(() =>
    query.value === ''
        ? props.offices
        : props.offices.filter((person) =>
            person.name
                .toLowerCase()
                .replace(/\s+/g, '')
                .includes(query.value.toLowerCase().replace(/\s+/g, ''))
        )
)

onMounted(() => {

})
watch(search, debounce(function (value) {

    router.get('/timesheets', { search: value, selectedMonth: props.selectedMonth, employee_id: props.filters.employee_id, selectedYear: props.selectedYear, selectedOffice: props.filters.selectedOffice }, {
        preserveState: true,
        replace: true
    });

}, 500));
watch(selected, debounce(function (value) {
    router.get('/timesheets', { search: props.filters.search, employee_id: value.id, page: props.table_data.current_page, selectedMonth: props.selectedMonth, selectedYear: props.selectedYear, selectedOffice: props.filters.selectedOffice }, {
        preserveState: true,
        replace: true
    });
    // time_records_1.value = props.time_records;
    // selected.value = $props.table_data.data['id', 129] ;
}, 0));
watch(selectedMonth, debounce(function (value) {
    router.get('/timesheets', { search: props.filters.search, employee_id: props.filters.employee_id, selectedMonth: value.id, selectedYear: props.selectedYear, selectedOffice: props.filters.selectedOffice }, {
        preserveState: true,
        replace: true
    });
    // selected.value = $props.table_data.data['id', 129] ;
}, 0));

watch(selectedYear, debounce(function (value) {
    router.get('/timesheets', { search: props.filters.search, employee_id: props.filters.employee_id, selectedYear: value, selectedMonth: props.selectedMonth, selectedOffice: props.filters.selectedOffice }, {
        preserveState: true,
        replace: true
    });
    // selected.value = $props.table_data.data['id', 129] ;
}, 0));

watch(selectedOffice, debounce(function (value) {

    router.get('/timesheets', {   selectedYear: props.selectedYear, selectedMonth: props.selectedMonth, selectedOffice: value.id }, {
        preserveState: true,
        replace: true,
    });
    search.value = '';
}, 0));
// onMounted(()=>{
// // router.visit('/submittedclearances', { page: 11 }, { preserveState: true,preserveScroll: false  }) 
// increment();
// })

const isOpen = ref(props.open);

function closeModal() {
    isOpen.value = false
}
// function openModal() {
//   isOpen.value = true
// }
function generatePdf() {
    const url = route('generate-pdf', { search: props.filters.search, employee_id: props.filters.employee_id, selectedYear: props.selectedYear, selectedMonth: props.selectedMonth, selectedOffice: props.filters.selectedOffice })
    window.location.href = url

    //     axios.get('/generate-pdf',
    //   { data: props.filters },
    //   { responseType: 'blob' })
    //   .then(res => {
    //     let blob = new Blob([res.data], { type: res.headers['content-type'] });
    //     let link = document.createElement('a');
    //     link.href = window.URL.createObjectURL(blob);
    //     link.download = item.slice(item.lastIndexOf('/')+1);
    //     link.click()
    //   }).catch(err => {})
}

const dialogVisible = ref(false);
const transactionDate = ref('')
const amin = ref('')
const amout = ref('')
const pmout = ref('')
const pmin = ref('')
const otin = ref('')
const otout = ref('')

let form = {
    id:'',
    employee_id:'',
    transactionDate: '',
    amin : '',
    amout: '',
    pmin : '',
    pmout : '',
    otin : '',
    otout : '',
    aminIsEnable : '',
    amoutIsEnable: '',
    pminIsEnable : '',
    pmoutIsEnable : '',
    otinIsEnable : '',
    otoutIsEnable : '',
};
const openModal = (time_record) => {
    form.id = time_record.id;
    form.employee_id = props.employee.id;
    form.transactionDate = time_record.transactionDate;
    form.amin = time_record.amin;
    form.amout = time_record.amout;
    form.pmin = time_record.pmin;
    form.pmout = time_record.pmout;
    form.otin = time_record.otin;
    form.otout = time_record.otout;
    form.aminIsEnable = time_record.amin ? false : true;
    form.amoutIsEnable = time_record.amout ? false : true;
    form.pminIsEnable = time_record.pmin ? false : true;
    form.pmoutIsEnable = time_record.pmout ? false : true;
    form.otinIsEnable = time_record.otin ? false : true;
    form.otoutIsEnable = time_record.otout ? false : true;
    dialogVisible.value = true
}

const time_records_1 = computed(() => props.table_data.data);
let submit = () =>{
 console.log(form);
 axios.post('update-timesheet', { form })
    .then(response => {
        console.log(response.data); // Access the data from the response
        time_records_1.value = response.data; 
        router.reload();
    })
    .catch(error => {
        console.error('Error updating timesheet:', error);
    });
 dialogVisible.value = false

    
}
</script>

<template>
    <AppLayout title="Employees">

        <el-dialog v-model="dialogVisible" title="Tips" width="500" :show-close="false" class="rounded-lg ">
            <template #header="{ close, titleId, titleClass }">
                <div class="my-header">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between  border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit Time Record
                        </h3>
                        <button @click="close" type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                </div>
            </template>
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg  dark:bg-gray-700">

                    <!-- Modal body -->
                    <form @submit.prevent="submit">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input :value="employee.name" disabled type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type product name" required="">
                            </div>
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Transaction Date</label>
                                <input v-model="form.transactionDate" disabled type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type product name" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time
                                    In Morning </label>
                                <input type="time" id="time"
                                    class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                                    focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:border-slate-200 disabled:border-red-600 disabled:shadow-none"
                                     :disabled="form.amin != '' && form.amin !== 'SAT' && form.amin !== 'SUN'"  v-model="form.amin" />

                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="category"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time Out
                                    Morning</label>
                                <input type="time" id="time"
                                class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                                    focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:border-slate-200 disabled:border-red-600 disabled:shadow-none"
                                     :disabled="form.amout != '' && form.amout !== 'SAT' && form.amout !== 'SUN'"  v-model="form.amout" />

                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time
                                    In Afternoon</label>
                                <input type="time" id="time"
                                class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                                    focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:border-slate-200 disabled:border-red-600 disabled:shadow-none"
                                     :disabled="form.pmin != '' && form.pmin !== 'SAT' && form.pmin !== 'SUN'" v-model="form.pmin" />

                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="category"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time Out
                                    Afternoon</label>
                                <input type="time" id="time"
                                class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                                    focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:border-slate-200 disabled:border-red-600 disabled:shadow-none"
                                     :disabled="form.pmout != '' && form.pmout !== 'SAT' && form.pmout !== 'SUN'"  v-model="form.pmout" />

                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time
                                    In OT</label>
                                <input type="time" id="time"
                                class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                                    focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:border-slate-200 disabled:border-red-600 disabled:shadow-none"
                                      v-model="form.otin"/>

                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="category"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time Out OT</label>
                                <input type="time" id="time"
                                class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                                    focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:border-slate-200 disabled:border-red-600 disabled:shadow-none"
                                     v-model="form.otout" />

                            </div>
                            <div class="col-span-2">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                                <textarea id="description" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write remarks here"></textarea>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white mr-2 inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Delete Record
                        </button>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Update Record
                        </button>
                    </form>
                </div>
            </div>

        </el-dialog>
        <div class="mb-4">
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                            <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center ">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Employee
                                Leave Requests
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>


        <div class="flex flex-col mt-4">
            <div class="">
                <div class="grid grid-cols-12 gap-3 mb-4">
                    
                    <div class=" rounded   dark:bg-gray-800 col-span-12 md:col-span-12">
                        <h1
                            class="text-xl font-semibold text-white sm:text-2xl dark:text-white  bg-gradient-to-l from-indigo-950 via-blue-800 to-blue-800 py-2 px-4 rounded mb-3 shadow-md">
                            Employee Leave Requests</h1>

                        <!-- <TimeRecordList :products = "time_records"/> -->




                        <div class="sm:flex">
                            
                            <div
                                class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0" v-if="props.employee">
                                        <img class="w-8 h-8" src="/images/profile_male2.png" alt="Profile"
                                            v-if="props.employee.gender == 'Male'">
                                        <img class="w-8 h-8" src="/images/profile_female.png" alt="Profile"
                                            v-if="props.employee.gender == 'Female'">


                                    </div>
                                    <div class="flex-1 min-w-0 ms-4" v-if="props.employee">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ employee.name }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{ employee.position }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">


                                
<button  @click="openModal()" type="button" class="group block max-w-xs mx-auto rounded-lg p-4 pr-12 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-1 hover:bg-sky-500 hover:ring-sky-500 mr-2 my-2">
  <div class="flex items-center space-x-3">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 stroke-sky-500 group-hover:stroke-white">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
</svg>
 
    <h3 class="text-slate-900 group-hover:text-white text-sm font-semibold">New Leave Request</h3>
  </div>
  <!-- <p class="text-slate-500 group-hover:text-white text-sm">Create a new leave.</p> -->
</button>
<a href="#" class="group block max-w-xs mx-auto rounded-lg p-4 pr-12 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-1 hover:bg-sky-500 hover:ring-sky-500 mr-2 my-2">
  <div class="flex items-center space-x-3">
 
  <svg class="h-6 w-6 stroke-red-500 group-hover:stroke-white" fill="white" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
    <h3 class="text-slate-900 group-hover:text-white text-sm font-semibold">Export PDF</h3>
  </div>
  <!-- <p class="text-slate-500 group-hover:text-white text-sm">Create a new leave.</p> -->
</a>

<a href="#" class="group block max-w-xs mx-auto rounded-lg p-4 pr-12 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-1 hover:bg-sky-500 hover:ring-sky-500 mr-2 my-2">
  <div class="flex items-center space-x-3"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 stroke-green-500 group-hover:stroke-white">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
</svg>

    <h3 class="text-slate-900 group-hover:text-white text-sm font-semibold">XLS</h3>
  </div>
  <!-- <p class="text-slate-500 group-hover:text-white text-sm">Create a new leave.</p> -->
</a>
                            </div>
                        </div>
                        <div class="inline-block min-w-full mt-2 pr-1">
                            <div class="overflow-hidden shadow">

                                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                                    <thead class="bg-white dark:bg-gray-700">
                                        <tr>

                                            <th scope="col"
                                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">

                                            </th> 
                                            <th scope="col"
                                                class="text-left py-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Employee
                                            </th>
                                          
                                            <th scope="col"
                                                class="text-center  py-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Status
                                            </th>
                                            <th scope="col"
                                                class="text-left py-4  text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                               Details
                                            </th>
                                            <th scope="col"
                                                class="text-left py-4  text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Created
                                            </th>
                                            <th scope="col"
                                                class="text-center py-4  text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Actioned By
                                            </th>
                                           


                                        
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                                        <tr :v-model="item" v-for="employee in time_records_1"
                                            :key="employee.date" class="hover:bg-gray-100 dark:hover:bg-gray-700">

                                            <!-- <td
                                                class="max-w-sm p-2 overflow-hidden text-sm font-black text-gray-800 truncate xl:max-w-xs dark:text-gray-400">
                                            </td> -->
                                            <td></td>

                                            <td
                                                class="max-w-sm p-2 overflow-hidden text-left text-sm font-black text-gray-800 truncate xl:max-w-xs dark:text-gray-400">
                                                {{ employee.employee }}</td>
                                 
                                                <td
                                                class="max-w-sm p-2 overflow-hidden text-center text-sn font-black text-gray-800 truncate xl:max-w-xs dark:text-gray-400 text-wrap">
                                            
                                                <button type="button" class="inline-flex items-center px-5 py-1 text-sm font-medium text-center text-white bg-cyan-500 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    {{ employee.status }}
                                                </button>


                                                </td>
                                            <td
                                                class="max-w-sm py-2 overflow-hidden text-left text-sm font-black text-gray-800 truncate xl:max-w-xs dark:text-gray-400 text-wrap">
                                                <div class="">
                                                    <div class="text-base font-semibold">{{ employee.description }}</div>
                                                    <div class="font-normal text-gray-500">{{ employee.type }} - {{ employee.date_commenced }} to {{ employee.date_completed }} ({{ employee.duration }} days)</div>
                                                </div>      
                                            </td>
                                            <td
                                                class="max-w-sm py-2 overflow-hidden text-left text-sm font-normal text-gray-800 truncate xl:max-w-xs dark:text-gray-400 text-wrap">
                                                {{ employee.created_at}} ({{ employee.when}})</td>

                                            <td
                                                class="max-w-sm p-2 overflow-hidden text-center text-sm font-black text-gray-800 truncate xl:max-w-xs dark:text-gray-400 text-wrap">
                                                {{ employee.pmout }}</td>
                                         
                                           


                                            <td></td>

                                            <td class="p-1 space-x-2 whitespace-nowrap">
                                                <!-- <CardListItemModal /> -->
                                                <!-- <button type="button" @click="openModal"
                                                    class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">

                                                    <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                    
                                                    Edit
                                                </button> -->
                                                <button @click="openModal(time_record)"
                                                    class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                                                    type="button">
                                                    <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                    
                                                    Edit
                                                </button>


                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                                <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto 
                                                overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center 
                                                items-center w-full  md:inset-0 h-[calc(100%-1rem)] max-h-full"
                                    v-if="employee">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Edit Time Record
                                                </h3>
                                                <button @click="toggleModal" type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form class="p-4 md:p-5">
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                        <input :value="employee.name" disabled type="text" name="name"
                                                            id="name"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Type product name" required="">
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="price"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time
                                                        In Morning</label>
                                                    <input type="time" id="time"
                                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        min="09:00" max="18:00" :value="amin" />

                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="category"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time
                                                        Out Morning</label>
                                                    <input type="time" id="time"
                                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        min="09:00" max="18:00" :value="amout" />

                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="price"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time
                                                        In Afternoon</label>
                                                    <input type="time" id="time"
                                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        min="09:00" max="18:00" :value="pmin" />

                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="category"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time
                                                        Out Afternoon</label>
                                                    <input type="time" id="time"
                                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        min="09:00" max="18:00" :value="pmout" />

                                                </div>

                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="price"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time
                                                        In OT</label>
                                                    <input type="time" id="time"
                                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        min="09:00" max="18:00" value="00:00" />

                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="category"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time
                                                        Out OT</label>
                                                    <input type="time" id="time"
                                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        min="09:00" max="18:00" value="00:00" />

                                                </div>
                                                <div class="col-span-2">
                                                    <label for="description"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                                                    <textarea id="description" rows="4"
                                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Write product description here"></textarea>
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="text-white mr-2 inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Delete Record
                                            </button>
                                            <button type="submit"
                                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Update Record
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


</AppLayout></template>
 