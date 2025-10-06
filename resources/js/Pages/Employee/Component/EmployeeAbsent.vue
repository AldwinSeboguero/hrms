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
usePoll(2000, {
    onStart() {
        getLeaveStat();

        computeLeaveBalance();

    },
    onFinish() {
        // console.log('Polling request finished')
    }
})


const { props } = usePage(); 
 
 
const dialogVisible = ref(false); 
const dialogDeleteVisible = ref(false); 
const availableVL = ref('0'); 
const availableSL = ref('0'); 
const total_leave_request = ref(''); 
const total_vless = ref(''); 
const total_sless = ref(''); 

const pendingRequest = ref(''); 
const disapprovedRequest = ref('');  



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
     vearned : availableVL.value ,
        searned : availableSL.value ,
        vless : '',
        sless : '',
});
const openModal = () => {  
    form.id = '';
    form.leave_type_id = '';
    form.leave_status_id = 2;

    form.employee_id = props.employee.id; 
    form.description = '';

    form.date_commenced = '';
    form.date_completed = ''; 
    form.remarks = ''; 
    form.duration = '';
    form.days_with_pay = '';
    form.days_without_pay = '';
    form.position = props.employee.position;
    form.salary = '';
    form.credit_to = '',
    form.vearned = '',
        form.searned = '',
        form.vless = '',
        form.sless = '',

dialogVisible.value = true;

}


const openUpdateModal = (formData) => {
    form.id = formData.id;
    form.leave_type_id = formData.type_id;
    form.leave_status_id = formData.status_id;

    form.employee_id = formData.employee_id;
    form.description = formData.description;

    form.date_commenced = formData.date_commenced;
    form.date_completed = formData.date_completed; 
    form.remarks = formData.remarks; 
    form.duration = formData.duration; 
    form.days_with_pay = formData.days_with_pay; 
    form.days_without_pay = formData.days_without_pay; 
    form.position = props.employee.position;

    form.salary = formData.salary; 
    form.credit_to = formData.credit_to;
    form.vearned = formData.vearned
        form.searned = formData.searned
        form.vless = formData.vless
        form.sless = formData.sless
        form.status = formData.status



    dialogVisible.value = true;

}

const openDeleteModal = (formData) => {
    form.id = formData.id;
    form.leave_type_id = formData.type_id;
    form.leave_status_id = formData.status_id;

    form.employee_id = formData.employee_id;
    form.description = formData.description;

    form.date_commenced = formData.date_commenced;
    form.date_completed = formData.date_completed; 
    form.remarks = formData.remarks; 
    form.duration = formData.duration; 
    form.days_with_pay = formData.days_with_pay; 
    form.days_without_pay = formData.days_without_pay; 
    form.position = formData.position; 
    form.salary = formData.salary;  
    form.credit_to = formData.credit_to;
    

        form.vearned = formData.vearned
        form.searned = formData.searned
        form.total_vless = formData.total_vless
        form.total_sless = formData.total_sless




    dialogDeleteVisible.value = true;

}


const getRoles = (roles) =>{
            if (!roles || roles.length === 0) return '';
            return roles.map(role => role.name).join(', '); // Assuming 'role.name' gives you the role title
        }

        const handleDateChange= (event) =>{
      // Clear date_completed if iscurrent is true
      
    };
    const employee_positions = ref(props.leave_data.data)
    const leave_data = ref(props.leave_data.data)

const submit = async () => {
    try {
     
        const response = await axios.post('/save-leave', { employeePositionData: form });
        leave_data.value = response.data.employee_position_salaries.data; 
            dialogVisible.value = false;
      
    } catch (error) {
        console.error('Error updating Positions:', error);
    } 
    // toastMessage.value = 'response.props.message'; 

};
const approved = async () => {
    try {
        form.leave_status_id = 2
        const response = await axios.post('/save-leave', { employeePositionData: form });
        leave_data.value = response.data.employee_position_salaries.data; 
            dialogVisible.value = false;
      
    } catch (error) {
        console.error('Error updating Positions:', error);
    } 
    // toastMessage.value = 'response.props.message'; 

};
const disapproved = async () => {
    try {
        form.leave_status_id = 1
        const response = await axios.post('/save-leave', { employeePositionData: form });
        leave_data.value = response.data.employee_position_salaries.data; 
            dialogVisible.value = false;
      
    } catch (error) {
        console.error('Error updating Positions:', error);
    } 
    // toastMessage.value = 'response.props.message'; 

};

const confirmDeletion = async () => {
    try {
     
        const response = await axios.post('/delete-leave', { employeePositionData: form });
        leave_data.value = response.data.employee_position_salaries.data;  
        dialogDeleteVisible.value = false;
    } catch (error) {
        console.error('Error updating Positions:', error);
    } 
    // toastMessage.value = 'response.props.message'; 

};

const getLeaveStat = async () => {
    
    // toastMessage.value = 'response.props.message'; 

};
 

// watch('form.date_commenced', function (value) {
//     console.log('Error updating Positions:', value);
// });
const setDateCompleted = async () => {
   form.date_completed = form.date_commenced;
   form.duration = "1.000";

};
const setDuration = async () => {
    if (form.date_commenced && form.date_completed) {
        const startDate = new Date(form.date_commenced);
        const endDate = new Date(form.date_completed);
        let totalWeekdays = 0;

        // Loop through the date range
        for (let date = startDate; date <= endDate; date.setDate(date.getDate() + 1)) {
          const day = date.getDay();
          // Check if the day is not Saturday (6) or Sunday (0)
          if (day !== 0 && day !== 6) {
            totalWeekdays++;
          }
        }

        // Update duration in the form
        form.duration = Math.max(totalWeekdays, 0).toFixed(3); // Set duration and ensure it's non-negative
      } else {
        form.duration = 0; // Reset duration if either date is not set
      }

};
const setWithPay = async () => { 

     form.vless = form.credit_to =='Vacation Leave' ? form.days_with_pay : 0 ;
     form.sless = form.credit_to =='Sick Leave' ? form.days_with_pay : 0 ;



};

const computeLeaveBalance = async () => { 
const monthlyVacationLeave = 1.25; // Vacation leave accrued each month
      const monthlySickLeave = 1.25;      // Sick leave accrued each month 
      if (props.employee.start_date) {
        const startDate = new Date(props.employee.start_date);
        const currentDate = new Date();
        
        // Calculate the number of months of service
        let monthsOfService = 0;

        // Calculate month difference
        monthsOfService = (currentDate.getFullYear() - startDate.getFullYear()) * 12 + (currentDate.getMonth() - startDate.getMonth());

        // Ensure the value is non-negative
        
        monthsOfService = Math.max(monthsOfService, 0);

        const parseDecimal = (value) => {
            // Ensure the value is a number, fallback to 0 if not a valid number
            const parsedValue = parseFloat(value);
            return isNaN(parsedValue) ? 0 : parsedValue; // Return 0 if parsing fails
        };
        try {
     
            const response = await axios.post('/stat-leave', { employee_id: props.employee.id });
            total_vless.value = response.data.total_vless;  
            total_leave_request.value = response.data.total_leave_request;  
            total_sless.value = response.data.total_sless;  
            availableVL.value =  (monthsOfService * monthlyVacationLeave)- parseDecimal(total_vless.value);
            availableSL.value = (monthsOfService * monthlySickLeave) - parseDecimal(total_sless.value);
            form.vearned =  availableVL.value;
            form.searned =  availableSL.value;

            // dialogDeleteVisible.value = false;
        } catch (error) {
            console.error('Error updating Positions:', error);
        } 
        // Calculate available vacation leave and sick leave
    

      } 
};

</script>

<template>

<div class="px-4 pb-4 w-full">
    <div class="grid grid-cols-12 gap-4">

      <div class="col-span-12 sm:col-span-6 md:col-span-3">
        <div class="flex flex-row bg-white shadow-sm rounded p-4">
          <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-green-100 text-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
</svg>
 </div>
          <div class="flex flex-col flex-grow ml-4">
            <div class="text-sm text-gray-500">Available Vacation Leave</div>
            <div class="font-bold text-lg">{{availableVL}}</div>
          </div>
        </div>
      </div>
      <div class="col-span-12 sm:col-span-6 md:col-span-3">
        <div class="flex flex-row bg-white shadow-sm rounded p-4">
          <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-orange-100 text-orange-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
</svg>
  </div>
          <div class="flex flex-col flex-grow ml-4">
            <div class="text-sm text-gray-500">Available Sick Leave</div>
            <div class="font-bold text-lg">{{availableSL}}</div>
          </div>
        </div>
      </div>
      <div class="col-span-12 sm:col-span-6 md:col-span-2">
        <div class="flex flex-row bg-white shadow-sm rounded p-4">
          <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-blue-100 text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
</svg>
 </div>
          <div class="flex flex-col flex-grow ml-4">
            <div class="text-xs text-gray-500">Total  Requests</div>
            <div class="font-bold text-lg">{{total_leave_request}}</div>
          </div>
        </div>
      </div>
      <div class="col-span-12 sm:col-span-6 md:col-span-2">
        <div class="flex flex-row bg-white shadow-sm rounded p-4">
          <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-orange-100 text-orange-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
</svg>
  </div>
          <div class="flex flex-col flex-grow ml-4">
            <div class="text-xs text-gray-500">Pending </div>
            <div class="font-bold text-lg">{{props.total_request_approved}}</div>
          </div>
        </div>
      </div>
      <div class="col-span-12 sm:col-span-6 md:col-span-2">
        <div class="flex flex-row bg-white shadow-sm rounded p-4">
          <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-red-100 text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
</svg>
   </div>
          <div class="flex flex-col flex-grow ml-4">
            <div class="text-xs text-gray-500">Disapproved</div>
            <div class="font-bold text-lg">{{props.total_request_disapproved}}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <h1
        class="text-xl font-semibold text-white sm:text-2xl dark:text-white  bg-gradient-to-l from-indigo-950 via-blue-800 to-blue-800 py-2 px-4 rounded mb-3 shadow-md">
        Absenses/Leaves</h1>



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
                    placeholder="Search for leaves">
            </div>
        </div>
        
<div class="mb-4">
      <div class=" mx-auto  ">

 
          <!-- <p class="error">{{ error }}</p> -->
           
         

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
                
              <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                  <tr> 
                    <th scope="col" class="px-6 py-3 ">
                      DETAILS
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                      CREATED
                    </th> 
                    <th scope="col" class="px-6 py-3 ">
                      DURATION
                    </th>
                    <th scope="col" class="px-6 py-3  bg-gray-50 dark:bg-gray-800">
                      WPAY
                    </th>
                    <th scope="col" class="px-6 py-3">
                      WOPAY
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                      STATUS
                    </th>
                    
                    <th scope="col" class="px-6 py-3">
                      REMARKS
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                      ACTION
                    </th>
                  </tr>
                </thead>
                <tbody> 
                  <tr class="border-b border-gray-200 dark:border-gray-700 " v-for="(data, index) in leave_data"
                    :key="data.id" :value="data.id">
                    <th scope="row"
                      class="px-6 py-4 font-medium text-black-800 whitespace-nowrap text-wrap  dark:text-white ">
                      <div class="">
                        <div class="text-base font-semibold">{{ data.description }}</div>
                        <div class="font-normal text-gray-500">{{ data.type }} - {{ data.date_commenced }} to {{ data.date_completed }} ({{ data.duration }} days)</div>
                    </div>     
                      
                    </th>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                        {{ data.date_commenced.toUpperCase() }}
                    </td> 
                    <td class="px-6 py-4">
                        {{ data.duration }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                        {{ data.days_with_pay }}
                    </td>
                    <td class="px-6 py-4">
                        {{ data.days_without_pay }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                        <button type="button" class="inline-flex items-center px-5 py-1 text-sm font-medium text-center text-white bg-cyan-500 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ data.status.toUpperCase() }}
                        </button>
                       
                    </td>
                      <td class="px-6 py-4"> 
                        {{ data.vearned }} -     {{ data.searned }}
                    </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
    <div class="flex space-x-2"> <!-- Flex container with spacing between buttons -->
        <button @click="openUpdateModal(data)" class="flex p-2.5 bg-green-500 rounded-xl hover:rounded-2xl hover:bg-yellow-600 transition-all duration-300 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </button>

        <button @click="openDeleteModal(data)" class="flex p-2.5 bg-red-500 rounded-xl hover:rounded-2xl hover:bg-yellow-600 transition-all duration-300 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                <path fill-rule="evenodd" d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.133 2.845a.75.75 0 0 1 1.06 0l1.72 1.72 1.72-1.72a.75.75 0 1 1 1.06 1.06l-1.72 1.72 1.72 1.72a.75.75 0 1 1-1.06 1.06L12 15.685l-1.72 1.72a.75.75 0 1 1-1.06-1.06l1.72-1.72-1.72-1.72a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</td>
            
                  </tr>

                </tbody>
              </table>
            </div>




 
 
      </div>
      
    </div>

 
        <el-dialog v-model="dialogVisible" title="Tips" width="700" :show-close="false" class="rounded-lg ">
            <template #header="{ close, titleId, titleClass }">
                <div class="my-header">
                    <div class="flex items-center justify-between p-2 md:p-3 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ form.id ? "Edit" : "Add"}} Leave
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
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Leave Type</label>
                                        <select   v-model="form.leave_type_id"  required  id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <option></option>
                                            <option v-for="data in props.leave_types" :key="data.id" :value="data.id">{{ data.name }} </option>

                                        </select>
                                    </div>
                                    
                                    <!-- <div class="col-span-4 sm:col-span-2">
                                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Absence Status</label>
                                        <select   v-model="form.leave_status_id"  required  id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <option></option>
                                            <option v-for="data in props.leave_statuses" :key="data.id" :value="data.id">{{ data.name }} </option>

                                        </select>
                                    </div> -->
                                    <div class="col-span-4">
                                        
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                        
                                        <input v-model="form.description" required  type="text" name="name" id="name"
                                    class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                     >
                                     </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Commenced</label>
                                        <input  datepicker v-model="form.date_commenced" @input="setDateCompleted"
                                    type="date" 
                                    id="dateCommenced" 
                                    class=" border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                                        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:border-slate-200 disabled:border-red-600 disabled:shadow-none"
                                  
                                />  </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        
                                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Completed</label>
                                        
                                        <input   v-model="form.date_completed" datepicker
                                        :disabled="form.iscurrent" 
                                         @input="setDuration"
                                    type="date" 
                                    id="dateCompleted" 
                                    class=" border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                                        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:border-slate-200 disabled:border-red-600 disabled:shadow-none"
                                 
                                />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duration</label>
                                        <input v-model="form.duration"  type="number" name="price" id="price" step="0.001" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="0.000" required="">
                                    </div> 
                                   
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Days with pay</label>
                                        <input v-model="form.days_with_pay" @change="setWithPay"  type="number" name="price" id="price" step="0.001" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="0.000" >
                                    </div> 
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Credit To</label>
                                        <select   v-model="form.credit_to" @change="setWithPay"  required  id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <option></option>
                                            <option value="Vacation Leave">Vacation Leave </option>
                                            <option value="Sick Leave">Sick Leave </option> 

                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Days without pay</label>
                                        <input v-model="form.days_without_pay" type="number" name="price" id="price" step="0.001" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="0.000" >
                                    </div> 
                                    
                                    <div class="col-span-3">
                                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                                        <textarea v-model="form.remarks" id="description" rows="6" class="block   w-full text-sm text-gray-900  rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write remark here"></textarea>                    
                                    </div><div class="col-span-3">
                                        <label for="description" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Leave Credits</label>
                                        
                                        <table class="text-xs w-full text-left rtl:text-right text-gray-600 dark:text-gray-400">
                                            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                            <tr> 
                                                <th scope="col" class="px-2 py-1">
                                                
                                                </th>
                                                <th scope="col" class="px-2 py-1 text-center bg-gray-50 dark:bg-gray-800">
                                                Vacation Leave
                                                </th> 
                                                <th scope="col" class="px-2 py-1  text-center">
                                                Sick Leave
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody> 
                                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                                        <th scope="row"
                                                        class="px-3 py-2 text-center font-medium text-black-800 italic whitespace-nowrap  dark:text-white ">
                                                           Total Earned
                                                        </th>
                                                        <td class="px-3 py-2 bg-gray-50 text-center dark:bg-gray-800">
                                                            {{ availableVL }}
                                                        </td> 
                                                        <td class="px-3 py-2 text-center">
                                                            {{ availableSL }}
                                                        </td> 
                                                
                                                    </tr>
                                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                                        <th scope="row"
                                                        class="px-3 py-2 text-center font-medium text-black-800 italic whitespace-nowrap  dark:text-white ">
                                                           Less this application
                                                        </th>
                                                        <td class="px-3 py-2 bg-gray-50 text-center dark:bg-gray-800">
                                                            {{ form.vless }}
                                                        </td> 
                                                        <td class="px-3 py-2 text-center">
                                                            {{ form.sless}}

                                                        </td> 
                                                
                                                    </tr>
                                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                                        <th scope="row"
                                                        class="px-3 py-2 text-center font-medium text-black-800 italic whitespace-nowrap  dark:text-white ">
                                                           Balance
                                                        </th>
                                                        <td class="px-3 py-2 bg-gray-50 text-center dark:bg-gray-800">
                                                            {{ form.credit_to =='Vacation Leave' ? availableVL-form.days_with_pay : availableVL }}
                                                        </td> 
                                                        <td class="px-3 py-2 text-center">
                                                            {{ form.credit_to == 'Sick Leave' ? availableSL-form.days_with_pay : availableSL }}

                                                        </td> 
                                                
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                  <!-- Modal body -->

                        <button @click="approved" v-if="form.status == 'Pending'"
                            class="mt-1 w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            
                            APPROVE LEAVE</button>

                            <button @click="disapproved" v-else
                            class="mt-1 w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            
                            DISAPPROVED LEAVE</button>
                        <button type="submit" v-if="form.id"
                            class="mt-1 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            
                            UPDATE LEAVE</button>

                            <button type="submit" v-else
                            class="mt-1 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            
                            ADD NEW LEAVE</button>

                    </form> 
                  

                  
                 
                 

 
            </div>

        </el-dialog>

        <el-dialog v-model="dialogDeleteVisible" title="Confirm Deletion" width="500" :show-close="false" class="rounded-lg ">
    <template #header="{ close, titleId, titleClass }">
        <div class="my-header">
            <div class="flex items-center justify-between p-2 md:p-3 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Confirm Deletion of Record
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
 

    <div class="relative px-4 w-full max-w-2xl max-h-full">
        <!-- Confirmation message -->
        <p class="mt-4 text-gray-700 dark:text-gray-300">
            Are you sure you want to delete this record? This action cannot be undone.
        </p>
        
        <form @submit.prevent="confirmDeletion">
            <!-- Delete confirmation buttons -->
            <div class="flex justify-between mt-4">
                <button 
                    type="button" 
                    @click="close"
                    class="w-full mr-2 text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                    Cancel
                </button>

                <button 
                    type="submit" 
                    class="w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-700">
                    Delete Record
                </button>
            </div>
        </form>
    </div>
</template>
</el-dialog>
    </div>


</template>