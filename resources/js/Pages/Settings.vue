
<script setup>
import AppLayout from '@/Layouts/MyLayout.vue';
import { Dropdown,Modal } from 'flowbite'
import { router, usePage, Link, Head, usePoll } from '@inertiajs/vue3'
import { ref, computed, watch, reactive, onMounted } from 'vue' 
import debounce from 'lodash/debounce'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
    
})
 
const { props } = usePage(); 
 

usePoll(2000, {
    onStart() {
        // getLeaveStat();

        // computeLeaveBalance();

    },
    onFinish() {
        // console.log('Polling request finished')
    }
})


function closeModal() {
    isOpen.value = false
} 
const dialogVisible = ref(false);   

const form = reactive({
    id: '',

});
const openModal = () => {  
   

dialogVisible.value = true;

}


const openUpdateModal = (formData) => {  

    


    dialogVisible.value = true;

} 
</script>

<template>
    <AppLayout title="Leaves & Time-off">

        

<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Work Schedules</button>
        </li>
     
    </ul>
</div>
<div id="default-tab-content">
    <div class="hidden p-4 rounded-lg" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        
        <el-dialog v-model="dialogVisible" title="Tips" width="840" :show-close="false" class="rounded-lg ">
            <template #header="{ close, titleId, titleClass }">
                <div class="my-header">
                    <div class="flex items-center justify-between p-2 md:p-3 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Add Work Schedule
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
                 <!-- Modal header -->
          
                            <!-- Modal body -->
                            <form class=" " @submit.prevent="submit">
                                <div class="grid gap-4 mb-4 grid-cols-6">
                                        <div class="col-span-6">
                                        
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                        
                                        <input v-model="form.description" required  type="text" name="name" id="name"
                                    class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                     >
                                     </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Schedule Type</label>
                                        <select   v-model="form.leave_type_id"  required  id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <option></option>
                                            <option v-for="data in props.leave_types" :key="data.id" :value="data.id">{{ data.name }} </option>

                                        </select>
                                    </div>
                             
                                
                                
                                    <div class="col-span-6 sm:col-span-6">
                                        
                                     <h2 class="text-2xl font-bold mb-4">Weekly Schedule Form</h2>
        <form>
            <table class="divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enabled</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time In AM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time Out AM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time In PM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time Out PM</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Monday</td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox" name="monday" class="form-checkbox"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="monday_time_in_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="monday_time_out_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="monday_time_in_pm" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="monday_time_out_pm" class="form-input"></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Tuesday</td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox" name="tuesday" class="form-checkbox"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="tuesday_time_in_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="tuesday_time_out_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="tuesday_time_in_pm" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="tuesday_time_out_pm" class="form-input"></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Wednesday</td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox" name="wednesday" class="form-checkbox"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="wednesday_time_in_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="wednesday_time_out_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="wednesday_time_in_pm" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="wednesday_time_out_pm" class="form-input"></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Thursday</td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox" name="thursday" class="form-checkbox"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="thursday_time_in_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="thursday_time_out_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="thursday_time_in_pm" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="thursday_time_out_pm" class="form-input"></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Friday</td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox" name="friday" class="form-checkbox"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="friday_time_in_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="friday_time_out_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="friday_time_in_pm" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="friday_time_out_pm" class="form-input"></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Saturday</td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox" name="saturday" class="form-checkbox"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="saturday_time_in_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="saturday_time_out_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="saturday_time_in_pm" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="saturday_time_out_pm" class="form-input"></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Sunday</td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox" name="sunday" class="form-checkbox"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="sunday_time_in_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="sunday_time_out_am" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="sunday_time_in_pm" class="form-input"></td>
                        <td class="px-6 py-4 whitespace-nowrap"><input type="time" name="sunday_time_out_pm" class="form-input"></td>
                    </tr>
                </tbody>
            </table> 
        </form>
                                    </div>
                                </div>
                                  <!-- Modal body -->

                        <button type="submit" v-if="form.id"
                            class="mt-1 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            
                            UPDATE LEAVE</button>

                            <button type="submit" v-else
                            class="mt-1 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            
                            ADD NEW LEAVE</button>

                    </form> 
                  

                  
                 
                 

 
            </div>

        </el-dialog>

        <div class="flex flex-col mt-4">
            <div class="">
                <div class="grid grid-cols-12 gap-3 mb-4">
                    
                    <div class=" rounded  col-span-12 md:col-span-12">
                      

                        <div>
                            
                        </div>

                        <div class="sm:flex">
                           
                            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">

<button  @click="openModal()" type="button" class="group block max-w-xs mx-auto rounded-lg p-4 pr-12 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-1 hover:bg-sky-500 hover:ring-sky-500 mr-2 my-2">
  <div class="flex items-center space-x-3">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 stroke-sky-500 group-hover:stroke-white">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
</svg>
 
    <h3 class="text-slate-900 group-hover:text-white text-sm font-semibold">New Work Schedule</h3>
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
                                <!-- <button @click="generatePdf" class="inline-flex items-center justify-center w-1/2 px-3 py-2 
                                    text-sm font-medium text-center 
                                    bg-red-600 text-white 
                                    border border-gray-300 rounded-lg hover:bg-red-700 focus:ring-4 
                                    focus:ring-red-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 
                                    dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                    <svg class="w-5 h-5 mr-2 -ml-1" fill="white" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Export
                                </button> -->
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
                                                Name
                                            </th>
                                          
                                            <th scope="col"
                                                class="text-center  py-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Type
                                            </th>
                                            <th scope="col"
                                                class="text-left py-4  text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                               Time Description
                                            </th>
                                            <th scope="col"
                                                class="text-left py-4  text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Status
                                            </th>
                                            <th scope="col"
                                                class="text-center py-4  text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Action
                                            </th>
                                           


                                        
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                                        <tr :v-model="item" v-for="employee in leave_data"
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
                                            
                                                <button type="button" 
                                                class="inline-flex items-center px-5 py-1 text-sm font-medium text-center text-white bg-green-500 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                :class="{ 'bg-orange-500':  employee.status == 'Pending' }">
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
                                                <button @click="openUpdateModal(employee)"
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

    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
    </div>
</div>


</AppLayout></template>
 