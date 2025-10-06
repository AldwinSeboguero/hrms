<script setup>
import { Dropdown,Modal } from 'flowbite'
import { router, usePage, Link, Head, usePoll } from '@inertiajs/vue3'
import { ref, computed, watch, reactive, onMounted } from 'vue' 
import debounce from 'lodash/debounce'
import { initFlowbite } from 'flowbite'

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
 
 
const dialogVisible = ref(false); 
const form = reactive({
    id: '',
    position_id: '',
    employee_id: '', // Ensure you have these fields as needed
     // Ensure you have these fields as needed
    date_commenced: '',
    date_completed: '',
    remuneration: '',
    per_type_id: '',
    remarks: '',
    iscurrent: false,
});
const openModal = () => { 
      // Clear the form fields
      form.id = '';
    form.position_id = '';
    form.employee_id = props.employee.id; 
    form.date_commenced = '';
    form.date_completed = '';
    form.remuneration = '';
    form.per_type_id = '';
    form.remarks = '';
    form.iscurrent = false; // Reset to default value

dialogVisible.value = true;

}


const openUpdateModal = (formData) => {
    form.id = formData.id;
    form.position_id = formData.position_id;
    form.employee_id = formData.employee_id;

    form.date_commenced = formData.date_commenced;
    form.date_completed = formData.date_completed;
    form.remuneration = formData.renumeration;
    form.per_type_id = formData.per_type_id;
    form.remarks = formData.remarks;
    form.iscurrent = formData.is_current ==1 ? true : false ;


    dialogVisible.value = true;

}


const getRoles = (roles) =>{
            if (!roles || roles.length === 0) return '';
            return roles.map(role => role.name).join(', '); // Assuming 'role.name' gives you the role title
        }

        const handleDateChange= (event) =>{
      // Clear date_completed if iscurrent is true
      if (this.form.iscurrent) {
        this.form.date_completed = ''; // Clear the value
      } else {
        this.form.date_completed = event.target.value; // Set the value normally
      }
    };
    const employee_assets = ref(props.employee_assets)
const submit = async () => {
    try {
     
        const response = await axios.post('/save-asset', { employeePositionData: form });
        employee_assets.value = response.data.employee_assets;
            dialogVisible.value = false;
      
    } catch (error) {
        console.error('Error updating Positions:', error);
    } 
    // toastMessage.value = 'response.props.message'; 

};
 
</script>

<template>
    <h1
        class="text-xl font-semibold text-white sm:text-2xl dark:text-white  bg-gradient-to-l from-indigo-950 via-blue-800 to-blue-800 py-2 px-4 rounded mb-3 shadow-md">
        Assets</h1>



    <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-6 pt-3">
        <div
            class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <div>
        
             
               <button   @click="openModal"  
               
               type="button" class="text-white bg-[#1da1f2] hover:bg-[#1da1f2]/90 focus:ring-4 focus:outline-none focus:ring-[#1da1f2]/50 font-bold rounded-lg text-sm px-5 py-2 ml-2 text-center inline-flex items-center dark:focus:ring-[#1da1f2]/55 me-2 mb-2">
                    <svg class="w-3 h-3  mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                    Add Record
                </button>
 

            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search-users"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for positions">
            </div>
        </div>
        
<div class="mb-4">
      <div class=" mx-auto  ">

 
          <!-- <p class="error">{{ error }}</p> -->
           
         

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
                
              <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                     NAME
                    </th>
                    <th scope="col" class="px-6 py-3">
                      DATE RELEASED
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                      DATE RETURNED
                    </th>
                    <th scope="col" class="px-6 py-3">
                      ASSET IDENTIFIER
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                      STATUS
                    </th>
                    <th scope="col" class="px-6 py-3">
                      REMARKS
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50">
                      ACTION
                    </th>
                  </tr>
                </thead>
                <tbody> 
                  <tr class="border-b border-gray-200 dark:border-gray-700" v-for="(data, index) in employee_assets"
                    :key="data.id" :value="data.id">
                        <th scope="row"
                      class="px-6 py-4 font-medium text-black-800 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                      {{ data.asset_type.toUpperCase() }}
                    </th>
                    <td scope="row"
                      class="px-6 py-4  ">
                      {{ data.date_released.toUpperCase() }}
                </td>
                    <td class="px-6 py-4 bg-gray-50">
                        {{ data.date_returned.toUpperCase() }}
                    </td>
                    <td class="px-6 py-4 ">
                        {{  data.asset_identifier.toUpperCase() }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50">
                        {{ data.asset_status.toUpperCase() }}
                    </td>
                
                      <td class="px-6 py-4">
                        {{ data.remarks.toUpperCase() }}
                    </td>
                    <td class="px-6 py-4  bg-gray-50 dark:bg-gray-800">
                        <button  @click="openUpdateModal(data)" class="flex p-2.5 bg-green-500 rounded-xl hover:rounded-2xl hover:bg-yellow-600 transition-all duration-300 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        </button>
                    </td>
            
                  </tr>

                </tbody>
              </table>
            </div>




 
 
      </div>
      
    </div>

 
        <el-dialog v-model="dialogVisible" title="Tips" width="500" :show-close="false" class="rounded-lg ">
            <template #header="{ close, titleId, titleClass }">
                <div class="my-header">
                    <div class="flex items-center justify-between p-2 md:p-3 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Add Position
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
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <input     v-model="form.iscurrent"  id="checked-checkbox" type="checkbox"  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Current Position</label>
                                        </div>
                                    <div class="col-span-2">
                                        
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        
                                        <select   v-model="form.position_id"  required  id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <option></option>
                                            <option v-for="data in props.positions" :key="data.id" :value="data.id">{{ data.name }} </option>

                                        </select> </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Commenced</label>
                                        <input  datepicker v-model="form.date_commenced"
                                    type="date" 
                                    id="dateCommenced" 
                                    class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                                        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:border-slate-200 disabled:border-red-600 disabled:shadow-none"
                                  
                                />  </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        
                                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Completed</label>
                                        
                                        <input   v-model="form.date_completed" datepicker
                                        :disabled="form.iscurrent" 
                                         @input="handleDateChange"
                                    type="date" 
                                    id="dateCompleted" 
                                    class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                                        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:border-slate-200 disabled:border-red-600 disabled:shadow-none"
                                 
                                />
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Renumeration</label>
                                        <input v-model="form.remuneration" type="number" name="price" id="price" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="30000" required="">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Per</label>
                                        <select   v-model="form.per_type_id"  required  id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <option></option>
                                            <option v-for="data in props.per_types" :key="data.id" :value="data.id">{{ data.name }} </option>

                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                                        <textarea v-model="form.remarks" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write remark here"></textarea>                    
                                    </div>
                                </div>
                                  <!-- Modal body -->

                        <button type="submit" v-if="form.id"
                            class="mt-4 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            
                            UPDATE POSITION</button>

                            <button type="submit" v-else
                            class="mt-4 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            
                            ADD NEW POSITION</button>

                    </form> 
                  

                  
                 
                 

 
            </div>

        </el-dialog>
    </div>


</template>