<script setup>
import AppLayout from '@/Layouts/MyLayout.vue';
import { router, usePage, Link, Head, usePoll } from '@inertiajs/vue3'
import { ref, computed, watch, reactive, onMounted } from 'vue' 
import debounce from 'lodash/debounce'
import { initFlowbite } from 'flowbite'

import axios from 'axios';
// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();

})
// usePoll(2000, {
//     onStart() {
//         console.log('Polling request started')

//     },
//     onFinish() {
//         console.log('Polling request finished')
//     }
// })
const { props } = usePage();
let venue = ref(props.filters.venue);
let exam_date = ref(props.filters.exam_date);


watch(venue, debounce(function (value) {

    router.get('/exam/schedules', { venue: value, exam_date: props.filters.exam_date }, {

        replace: true
    });
}, 500));
watch(exam_date, function (value) {
    router.get('/exam/schedules', { exam_date: value, venue: props.filters.venue }, {
     
        replace: true
    });

});


let applicant1 = computed(() => props.applicants);
let scheduless = computed(() => props.schedules);
const dialogVisible = ref(false);
  
const applicantId = ref('');

let applicationDetails = reactive({
    applicant_id: applicantId,
    exam_schedule_id: props.schedules ? props.schedules[0].id : '',

    status: 'Pending',

})
 

const vieDetails = async (applicant) => {
    try {
        const response = await router.get('/gap/applicant/details', { applicantId: applicant.id });

    } catch (error) {
        console.error('Error updating timesheet:', error);
    }
 

};
const toastMessage = ref('');


const openModal = () => {
form.id = '';
form.name = ''; 
form.when = ''; 

form.venue = ''; 
dialogVisible.value = true;

}


const openUpdateModal = (formData) => {
  console.log(formData)

form.id = formData.id;
form.name = formData.name; 
form.when = formData.when; 

form.venue = formData.venue; 


dialogVisible.value = true;

}
let form = {
id: '',
name: '',
when: '',

venue: '',  



}; 
const submit = async () => {
try {
 
        await axios.post('/Event/List/Save', { data: form });
        dialogVisible.value = false;
  
} catch (error) {
    console.error('Error updating timesheet:', error);
}
router.visit(window.location.href, { status: props.filters.status, search: props.filters.search }, {
    only: ['Schools', 'schedules', 'filters'],
}) // Reload the page after successful submission
// toastMessage.value = 'response.props.message'; 

};

// const openParticipant = async () => {
// try {
 
//         await axios.get('/Event/List/Participant', { data: form });
//         dialogVisible.value = false;
  
// } catch (error) {
//     console.error('Error updating timesheet:', error);
// }
 
// };

const openParticipant = async (event) => {
    try {
        const response = await router.get('/Event/List/Participant', { event: event.id });

    } catch (error) {
        console.error('Error updating timesheet:', error);
    }
 

};
const disapprovedModalVisible = ref(false);
const messageModalVisible = ref(false);
const errorMessage = ref('');


let event = reactive({
    id: "",
   

})
const openDelete = (participantData) => {
    event.id = participantData.id
    // applicationDetails.uuid = applicantRecord.uuid;
    // event.venue_id = props.venue_id;
    // applicationDetails.status = 'Disapproved';
    disapprovedModalVisible.value = true;


} 
const deleteParticipant = async () => {
    // First, keep the error modal closed and clear any previous error message
    messageModalVisible.value = false; 
    errorMessage.value = ''; // Clear previous error messages

    try {
        // Wait for the deletion request to complete
        await axios.post('/Event/List/Delete', { data: event });
        
        // Close the confirmation modal on success
        disapprovedModalVisible.value = false;
        
        // Optionally, to reload the page or data
        router.visit(window.location.href, { 
            status: props.filters.status, 
            search: props.filters.search 
        }, {
            only: ['participants', 'schedules', 'filters'],
        });
        
    } catch (error) {
        // Set the error message if deletion fails
        errorMessage.value = error.response?.data?.error || error.message;

        // Open the error message modal
        messageModalVisible.value = true;
        
        console.error('Error deleting event:', errorMessage.value); // Log the error
    }
};
</script>
<style>
.checkbox:checked+.check-icon {
    display: flex;
}
</style>
<template>
    <AppLayout>

        <Head title="Applicants" />
         <el-dialog v-model="messageModalVisible" title="Tips" width="500" :show-close="false" class="rounded-lg ">
            <template #header="{ close, titleId, titleClass }">
                <div class="relative  w-full max-h-full">
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <button @click="close" type="button"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="popup-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{errorMessage}}</h3>
                      
                            <button @click="close" data-modal-hide="popup-modal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                Close</button>
                        </div>
                    </div>
                </div>
            </template>


        </el-dialog>
<!-- component -->
         <el-dialog v-model="disapprovedModalVisible" title="Tips" width="500" :show-close="false" class="rounded-lg ">
            <template #header="{ close, titleId, titleClass }">
                <div class="relative  w-full max-h-full">
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <button @click="close" type="button"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="popup-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want
                                to Delete this Event?</h3>
                            <button @click="deleteParticipant" data-modal-hide="popup-modal" type="button"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Yes, I'm sure
                            </button>
                            <button @click="close" data-modal-hide="popup-modal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                cancel</button>
                        </div>
                    </div>
                </div>
            </template>


        </el-dialog>
<el-dialog v-model="dialogVisible" title="Tips" width="500" :show-close="false" class="rounded-lg ">
            <template #header="{ close, titleId, titleClass }">
                <div class="my-header">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between  border-b border-dashed border-b-2  rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Event Schedule
                        </h3>


                        <button @click="close" type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                </div>
            </template>
            
            <div class="relative px-4 pb-4 w-full max-w-2xl max-h-full">
                
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg  dark:bg-gray-700">
                    <!-- component -->

                    <form @submit.prevent="submit">
                       
 
     
 
<div class="relative w-full mb-3">
      <input type="text" id="small_filled"  v-model="form.name"
        class="block rounded-t-lg px-2.5 pb-1.5 pt-4 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
      <label for="small_filled" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-3 scale-75 top-3 left-2.5 z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-3">
           Name
        </label>
    </div>


<div class="flex items-center space-x-2 text-black-400 text-sm mb-3">
    



    <div class="relative w-full">
      <input type="text" id="small_filled"  v-model="form.venue"
        class="block rounded-t-lg px-2.5 pb-1.5 pt-4 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
      
                  <label for="role" 
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                    Venue</label>
    </div>
</div>
                   <div class="flex items-center space-x-2 text-black-400 text-sm mb-3">
   

    <div class="relative w-full">
      <input type="text" id="small_filled"  v-model="form.when"
        class="block rounded-t-lg px-2.5 pb-1.5 pt-4 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
      <label for="small_filled" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-3 scale-75 top-3 left-2.5 z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-3">
           When
        </label>
    </div>
</div>
                 
                 


                    <!-- Modal body -->

                        <button type="submit" v-if="form.id"
                            class="mt-4 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            
                            UPDATE EVENT SCHEDULE</button>

                            <button type="submit" v-else
                            class="mt-4 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            
                            ADD EVENT SCHEDULE</button>

                    </form>
                </div>
            </div>

        </el-dialog>
<div class="m-2">
      <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">



        <div
          class="w-full  p-4 bg-white border-dotted border-2 border-gray-200 rounded-lg   sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">


          <p class="error">{{ error }}</p>
          <div class="bg-white rounded-lg   ">
            <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                <h3 class="text-lg font-bold mb-2 md:mb-0">
                    Event Schedules
                </h3>

                   <!-- Align the search input and button to the right -->
    <div class="flex items-center md:ml-auto">
      <div class="relative flex-1 md:flex-none w-full md:w-64">
                  <select id="venue" v-model="venue" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                   <option value="" disabled selected>Select a venue</option>
                   <option value="">All</option>
                   <option v-for="venue in props.venue" :key="venue.id" :value="venue.id">{{
                      venue.name }} 
                    </option>
</select>
  <label for="venue" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Select Venue</label>
                </div>
              </div>
        
     
          <button @click="openModal"
                class="focus:ring-2 w-32 focus:ring-offset-2 focus:ring-indigo-600 sm:mt-0 inline-flex items-center justify-center px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded ml-3">
            <p class="text-sm font-medium leading-none text-white">Add Event</p>
        </button>
    </div>
                


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
              <form class="max-w-full mx-auto">

                <div class="relative">
  
        <input type="date" id="small_filled"  v-model="exam_date"
        class="block rounded-t-lg px-2.5 pb-1.5 pt-4 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
        <label for="small_filled" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-3 scale-75 top-3 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-3 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
          Select Event Date
        </label>
      
                </div>
 
                </form>
              <div
                class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4 m-2 ">
                <div class="col-span-1">
                  <form class="max-w-full mx-auto mb-4 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 ">
                   



                 
                      <!-- component --> 
                      <a v-if="exam_id" @click="generatePdfWithScanned" href="#" class="text-white w-full font-semibold text-xs pr-4 my-auto mx-auto bg-gradient-to-r from-red-800 to-red-500 p-4 py-2 px-5 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                          class="h-5 w-5 inline-block mr-1">
                          <path fill-rule="evenodd"
                            d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 0 0 3 3h.27l-.155 1.705A1.875 1.875 0 0 0 7.232 22.5h9.536a1.875 1.875 0 0 0 1.867-2.045l-.155-1.705h.27a3 3 0 0 0 3-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0 0 18 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25ZM16.5 6.205v-2.83A.375.375 0 0 0 16.125 3h-8.25a.375.375 0 0 0-.375.375v2.83a49.353 49.353 0 0 1 9 0Zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 0 1-.374.409H7.232a.375.375 0 0 1-.374-.409l.526-5.784a.373.373 0 0 1 .333-.337 41.741 41.741 0 0 1 8.566 0Zm.967-3.97a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H18a.75.75 0 0 1-.75-.75V10.5ZM15 9.75a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V10.5a.75.75 0 0 0-.75-.75H15Z"
                            clip-rule="evenodd" />
                        </svg>
                        <span class="">PRINT SCANNED ATTENDANCE</span>
                      </a> 
                      <a v-if="exam_id" @click="generatePdf"  href="#"  class="text-white w-full font-semibold text-xs my-auto mx-auto bg-gradient-to-r from-red-800 to-red-500 p-4 py-2 px-5 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                          class="h-5 w-5 inline-block mr-1">
                          <path fill-rule="evenodd"
                            d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 0 0 3 3h.27l-.155 1.705A1.875 1.875 0 0 0 7.232 22.5h9.536a1.875 1.875 0 0 0 1.867-2.045l-.155-1.705h.27a3 3 0 0 0 3-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0 0 18 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25ZM16.5 6.205v-2.83A.375.375 0 0 0 16.125 3h-8.25a.375.375 0 0 0-.375.375v2.83a49.353 49.353 0 0 1 9 0Zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 0 1-.374.409H7.232a.375.375 0 0 1-.374-.409l.526-5.784a.373.373 0 0 1 .333-.337 41.741 41.741 0 0 1 8.566 0Zm.967-3.97a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H18a.75.75 0 0 1-.75-.75V10.5ZM15 9.75a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V10.5a.75.75 0 0 0-.75-.75H15Z"
                            clip-rule="evenodd" />
                        </svg>
                        <span class="">PRINT ATTENDANCE</span>
                      </a> 
                  </form>
                </div>


              </div>
              <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                      Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Venue
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                      When
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Total Participants
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody> 
                  <tr class="border-b border-gray-200 dark:border-gray-700" v-for="(schedule, index) in props.events.data"
                    :key="schedule.id" :value="schedule.id">
                    <th scope="row"
                      class="px-6 py-4 font-medium text-black-800 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                      {{ schedule.name }} 
                    </th>
                    <td class="px-6 py-4">
                      {{ schedule.venue.toUpperCase() }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                      {{ schedule.when }} 
                    </td>
                     <td class="px-6 py-4 text-center" style="width: 10px;">
                      {{ schedule.total_participant }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                

                                         <div class="flex">
                                            <button   @click="openUpdateModal(schedule)"
                                                class="middle none center mr-2 flex items-center justify-center rounded-lg bg-pink-500 p-3 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                data-ripple-light="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>

                                            </button>
                                             <button  @click="openParticipant(schedule)"
                                             class="middle none center flex items-center mr-2 justify-center rounded-lg p-3 font-sans text-xs font-bold uppercase text-pink-500 transition-all hover:bg-pink-500/10 active:bg-pink-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                data-ripple-dark="true">
                                                
                                               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
  <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
</svg>



                                        </button>
                                            <button  
                                                class="middle none center mr-2 flex items-center justify-center rounded-lg bg-gradient-to-tr from-pink-600 to-pink-400 p-3 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                data-ripple-light="true">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
  <path fill-rule="evenodd" d="M3 4.875C3 3.839 3.84 3 4.875 3h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 0 1 3 9.375v-4.5ZM4.875 4.5a.375.375 0 0 0-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 0 0 .375-.375v-4.5a.375.375 0 0 0-.375-.375h-4.5Zm7.875.375c0-1.036.84-1.875 1.875-1.875h4.5C20.16 3 21 3.84 21 4.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5a1.875 1.875 0 0 1-1.875-1.875v-4.5Zm1.875-.375a.375.375 0 0 0-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 0 0 .375-.375v-4.5a.375.375 0 0 0-.375-.375h-4.5ZM6 6.75A.75.75 0 0 1 6.75 6h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75A.75.75 0 0 1 6 7.5v-.75Zm9.75 0A.75.75 0 0 1 16.5 6h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75ZM3 14.625c0-1.036.84-1.875 1.875-1.875h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.035-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 0 1 3 19.125v-4.5Zm1.875-.375a.375.375 0 0 0-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 0 0 .375-.375v-4.5a.375.375 0 0 0-.375-.375h-4.5Zm7.875-.75a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm6 0a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75ZM6 16.5a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm9.75 0a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm-3 3a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm6 0a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Z" clip-rule="evenodd" />
</svg>


                                            </button>
                                           <button  @click="openDelete(schedule)"
                                             class="middle none center flex items-center mr-2 justify-center rounded-lg p-3 font-sans text-xs font-bold uppercase text-pink-500 transition-all hover:bg-pink-500/10 active:bg-pink-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                data-ripple-dark="true">
                                                
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
  <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
</svg>



                                        </button>

                                        </div>
                    </td>
                  </tr>

                </tbody>
                   <tfoot>
                                <tr>
                                    <td colspan="100%" class="text-center">
                                        <!-- Use colspan to ensure content is centered across all columns -->
                                        <div class="flex flex-col items-center mt-4">
                                            <!-- Help text -->
                                            <span class="text-sm text-gray-700 dark:text-gray-400">
                                                Showing <span class="font-semibold text-gray-900 dark:text-white">{{
                                                    props.events.from || 0 }}</span> to
                                                <span class="font-semibold text-gray-900 dark:text-white">{{
                                                    props.events.to || 0
                                                    }}</span> of
                                                <span class="font-semibold text-gray-900 dark:text-white">{{
                                                    props.events.total }}</span>
                                                Entries
                                            </span>
                                            <div class="inline-flex mt-2 xs:mt-0">
                                                <!-- Buttons -->
                                                <a v-if="props.events.links[0].url" :href="props.events.prev_page_url"
                                                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                                    <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                                                    </svg>
                                                    Prev
                                                </a>
                                                <a v-if="props.events.links[2].url" :href="props.events.next_page_url"
                                                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                                    Next
                                                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
              </table>
            </div>





          </div>

          <!-- <ul class="flex mt-4">
    <li>
      <a
        class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
        href="#"
        aria-label="Previous"
      >
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
</svg>

      </a>
    </li>
    <li>
      <a
        class="mx-1 flex h-9 w-9 items-center justify-center rounded-full bg-pink-500 p-0 text-sm text-white shadow-md transition duration-150 ease-in-out"
        href="#"
      >
        1
      </a>
    </li>
    <li>
      <a
        class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
        href="#"
      >
        2
      </a>
    </li>
    <li>
      <a
        class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
        href="#"
      >
        3
      </a>
    </li>
    <li>
      <a
        class="mx-1 flex h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
        href="#"
        aria-label="Next"
      >
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
</svg>

      </a>
    </li>
  </ul> -->
        </div>
      </div>
      
    </div>

    
   

    </AppLayout>
</template>
<script>function dropdownFunction(element) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    let list = element.parentElement.parentElement.getElementsByClassName("dropdown-content")[0];
    list.classList.add("target");
    for (i = 0; i < dropdowns.length; i++) {
        if (!dropdowns[i].classList.contains("target")) {
            dropdowns[i].classList.add("hidden");
        }
    }
    list.classList.toggle("hidden");
}</script>