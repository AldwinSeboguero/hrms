<script setup>
import { router, usePage, Link, Head, usePoll } from '@inertiajs/vue3'
import { ref, computed, watch, reactive, onMounted } from 'vue'
import debounce from 'lodash/debounce'
import { initFlowbite } from 'flowbite'
import { Dropdown } from 'flowbite'

// initialize components based on data attribute selectors

// usePoll(2000, {
//     onStart() {


//     },
//     onFinish() {
//         // console.log('Polling request finished')
//     }
// })


const { props } = usePage();
const data = ref({});
const pagination = ref({});

const work_days = ref({});

const loading = ref(true);
const search = ref('');


// Function to fetch users from the API
const getData = async (page) => {
    loading.value = true;
    try {
        const response = await axios.get(`/summary-rating-ipcr?page=${page}`);
        data.value = response.data.data; // Assuming this is an array
        pagination.value = response.data.pagination;

        // Ensure `data` contains the correct structure
        // Assuming each item in data has a 'value' and 'link'
        links.value = data.value.map(item => ({
            value: item.name, // Adjust this to match your API response structure
            link: item.link    // Adjust as necessary
        }));

    } catch (error) {
        console.error('Error fetching data:', error);
        links.value = []; // Reset links if there's an error
    } finally {
        loading.value = false;
    }
};


const searchName = async (search) => {
    loading.value = true;
    try {
        const response = await axios.get(`/summary-rating-ipcr?search=${search}`);
        data.value = response.data.data;
        pagination.value = response.data.pagination;
    } catch (error) {
        console.error('Error fetching summary-rating:', error);
    } finally {
        loading.value = false;
    }
};

const clearSearch = () => {
    search.value = ''; // Clear the input
    searchName('');
};


const dialogVisible = ref(false);
const dialogDeleteVisible = ref(false);



const form = reactive({
    id: '',
    employee_id: '',
    year: '',
    numerical_rating: '',

    adjectival_rating: '',

    comment_and_recommendation: '',

});
const openModal = () => {
    form.id = '';
    form.employee_id = '';
    form.year = selectedYear;
    form.numerical_rating = '';

    form.adjectival_rating = '';

    form.comment_and_recommendation = '';

    dialogVisible.value = true;

}

const employeeName = ref('');
const openUpdateModal = (formData) => {
    form.id = formData.id;
    form.employee_id = formData.employee_id;
    form.year = formData.year;
    form.numerical_rating = formData.numerical_rating;

    form.adjectival_rating = formData.adjectival_rating;

    form.comment_and_recommendation = formData.comment_and_recommendation;

    employeeName.value = formData.name;
    dialogVisible.value = true;

}

const saveData = async () => {
    try {


        const response = await axios.post('/summary-rating-ipcr', { data: form });
        data.value = response.data.data;
           form.id = '';
            form.employee_id = '';
            form.year = selectedYear;
            form.numerical_rating = '';

            form.adjectival_rating = '';

            form.comment_and_recommendation = '';
        // dialogVisible.value = false;

    } catch (error) {
        console.error('Error updating summary-rating:', error);
    }


};

const state = ref('');
const links = ref([]);

const loadAll = () => {
    return [
        { value: 'vue', link: 'https://github.com/vuejs/vue' },
        { value: 'element', link: 'https://github.com/ElemeFE/element' },
        { value: 'cooking', link: 'https://github.com/ElemeFE/cooking' },
        { value: 'mint-ui', link: 'https://github.com/ElemeFE/mint-ui' },
        { value: 'vuex', link: 'https://github.com/vuejs/vuex' },
        { value: 'vue-router', link: 'https://github.com/vuejs/vue-router' },
        { value: 'babel', link: 'https://github.com/babel/babel' },
    ];
};

const getEmployee = async (search) => {
    loading.value = true;
    try {
        const response = await axios.get(`/getemployees?search=${search}`);

        // Map the fetched data to the required format
        links.value = response.data.data.map(item => ({
            value: item.name, // Ensure the API returns name and link
            link: item.id,  // Adjust as necessary
            code: item.code
        }));
    } catch (error) {
        console.error('Error fetching data:', error);
        links.value = []; // Reset links if there's an error
    } finally {
        loading.value = false;
    }
};

let timeout;
const querySearchAsync = (queryString, cb) => {
    clearTimeout(timeout);
    timeout = setTimeout(async () => {
        // You may choose to fetch employees based on the query string
        await getEmployee(queryString); // Ensure it fetches with the current query
        const results = links.value.filter(createFilter(queryString)); // filter the results
        cb(results);
    }, 100);
};

const createFilter = (queryString) => {
    return (item) => {
        return item.value.toLowerCase().includes(queryString.toLowerCase());
    };
};

const handleSelect = (item) => {
    console.log(item.link);
    form.employee_id = item.link
};
const checkMaxValue = () => {
    // Parse input as a float number
    const rating1 = parseFloat(form.numerical_rating);

    // Check if the rating exceeds the maximum allowed value
    if (rating1 > 5) {
        form.numerical_rating = 5; // Set it back to the maximum
    } else if (rating1 < 0) {
        form.numerical_rating = 0; // Optional: Handle minimum value
    }
    updateAdjectivalRating();
};
const updateAdjectivalRating = () => {
    const rating = form.numerical_rating;

    if (rating >= 5) {
        form.adjectival_rating = 'Outstanding';
    } else if (rating >= 4.00) {
        form.adjectival_rating = 'Very Satisfactory';
    } else if (rating >= 3.00) {
        form.adjectival_rating = 'Satisfactory';
    } else if (rating >= 2.00) {
        form.adjectival_rating = 'Unsatisfactory';
    } else if (rating >= 1.00) {
        form.adjectival_rating = 'Poor';
    } else {
        form.adjectival_rating = ''; // Clear if no valid rating is found
    }
}; const years = computed(() => {
    const startYear = 2024;
    const endYear = 2034;
    return Array.from({ length: endYear - startYear + 1 }, (_, i) => startYear + i);
});
let selectedYear = ref(props.selectedYear)

const fetchSummaryRating = debounce(async (value) => {
    loading.value = true; // Set loading state
    try {
        const response = await axios.get(`/summary-rating-ipcr?year=${value}`);
        data.value = response.data.data; // Update data
        pagination.value = response.data.pagination; // Update pagination
    } catch (error) {
        console.error('Error fetching summary-rating:', error);
    } finally {
        loading.value = false; // Reset loading state
    }
}, 300); // Adjust debounce time as needed (e.g., 300ms)

watch(selectedYear, (newValue) => {
    if (newValue) {
        fetchSummaryRating(newValue); // Call the debounced function
    }
});
onMounted(() => {
    initFlowbite();
    getData(1);
    getEmployee('');

})

</script>

<template>
    <el-dialog v-model="dialogVisible" title="Tips" width="400" :show-close="false" class="rounded-lg   w-1/4 ">
        <template #header="{ close, titleId, titleClass }">
            <div class="my-header">
                <div class="flex items-center justify-between p-2 md:p-3 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ form.id ? "Edit" : "Add" }} Rating
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

        <div class="relative px-4 pb-4 w-full max-w-2xl  ">
            <!-- Modal header -->

            <!-- Modal body -->
            <form class=" " @submit.prevent="submit">
                <div class="grid gap-4 mb-4 grid-cols-6">
                    <div class="col-span-6 ars">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee</label>
                        <el-autocomplete v-model="state" :fetch-suggestions="querySearchAsync"
                            popper-class="my-autocomplete" placeholder="Please input" clearable @select="handleSelect"
                            v-if="!form.id">

                            <template #default="{ item }">
                                <div class="name">{{ item.value }}</div>
                                <span class="addr">{{ item.code }}</span>


                            </template>
                            <template #loading>
                                <el-icon class="is-loading">
                                    <svg class="circular" viewBox="0 0 20 20">
                                        <g class="path2 loading-path" stroke-width="0"
                                            style="animation: none; stroke: none">
                                            <circle r="3.375" class="dot1" rx="0" ry="0" />
                                            <circle r="3.375" class="dot2" rx="0" ry="0" />
                                            <circle r="3.375" class="dot4" rx="0" ry="0" />
                                            <circle r="3.375" class="dot3" rx="0" ry="0" />
                                        </g>
                                    </svg>
                                </el-icon>
                            </template>
                        </el-autocomplete>
                        <input v-else v-model="employeeName" required type="text" disabled
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">


                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                        <input v-model="form.year" required type="number"
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numerical
                            Rating</label>
                        <input v-model="form.numerical_rating" required type="number" min="0" max="5" step="0.1"
                            @input="checkMaxValue"
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adjectival
                            Rating</label>
                        <input v-model="form.adjectival_rating" required type="text" disabled
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comment and
                            Recommendation</label>
                        <textarea v-model="form.comment_and_recommendation" type="text"
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                </textarea>
                    </div>




                </div>
                <!-- Modal body -->

                <button @click="saveData" v-if="form.id"
                    class="mt-1 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                    UPDATE RATING</button>

                <button @click="saveData" v-else
                    class="mt-1 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                    ADD NEW RATING</button>

            </form>







        </div>

    </el-dialog>


    <div class="px-4 pb-4 w-full">
        <div class="flex flex-col">
            <div class="grid grid-cols-1 gap-3 mb-4">
                <div class="flex flex-wrap justify-center gap-2 ml-auto space-x-2 sm:space-x-3">
                    <button @click="openModal" type="button"
                        class="w-full sm:w-auto group block rounded-lg p-4 bg-white ring-1 ring-slate-900/5 shadow-lg hover:bg-sky-500 hover:ring-sky-500">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 stroke-sky-500 group-hover:stroke-white" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                            </svg>
                            <h3 class="text-slate-900 group-hover:text-white text-sm font-semibold">New Rating</h3>
                        </div>
                    </button>

                    <button
                        class="w-full sm:w-auto group block rounded-lg p-4 bg-white ring-1 ring-slate-900/5 shadow-lg hover:bg-sky-500 hover:ring-sky-500">
                        <div class="flex items-center space-x-3">
                            <svg class="h-6 w-6 stroke-red-500  group-hover:stroke-white" fill="white"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <h3 class="text-slate-900 group-hover:text-white text-sm font-semibold">Export PDF</h3>
                        </div>
                    </button>

                    <button
                        class="w-full sm:w-auto group block rounded-lg p-4 bg-white ring-1 ring-slate-900/5 shadow-lg hover:bg-sky-500 hover:ring-sky-500">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-6 w-6 stroke-green-500   group-hover:stroke-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
                            </svg>
                            <h3 class="text-slate-900 group-hover:text-white text-sm font-semibold">XLS</h3>
                        </div>
                    </button>
                </div>
                <div class="overflow-auto shadow p-4">
                    <div class="flex  w-full">
                        <select v-model="selectedYear"
                            class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-sm ps-10   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Select year</option>
                            <option v-for="year in years" :key="year" :value="year">{{ year }}</option>

                        </select>

                        <label for="simple-search" class="sr-only">Search</label>


                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-4 h-4 text-gray-500 dark:text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                </svg>

                            </div>
                            <input clearable @change="searchName(search)" v-model="search" type="text"
                                id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search Employee Name..." required />
                            <button v-if="search" @click="clearSearch"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-red-500 text-bold ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                                        clip-rule="evenodd" />
                                </svg>


                            </button>
                        </div>

                        <button @click="searchName(search)"
                            class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>

                    </div>
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-white dark:bg-gray-700">

                            <tr>

                                <th scope="col"
                                    class="text-left py-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Name
                                </th>
                                <th scope="col"
                                    class="text-left py-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Office
                                </th>

                                <th scope="col"
                                    class="text-left  py-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Year
                                </th>
                                <th scope="col"
                                    class="text-left  py-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Numerical Rating
                                </th>
                                <th scope="col"
                                    class="text-left  py-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Adjectival Rating
                                </th>
                                <th scope="col"
                                    class="text-left  py-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Comment & Recommendation
                                </th>
                                <th scope="col"
                                    class="text-left  py-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Type
                                </th>
                                <th scope="col"
                                    class="text-center py-4  text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Action
                                </th>




                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            <tr v-for="data in data" :key="data.id" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-2 text-sm font-black text-gray-800 uppercase ">{{ data.name }}</td>
                                <td class="p-2 text-sm font-black text-gray-800">{{ data.office }}</td>
                                <td class="p-2 text-sm font-black text-gray-800">{{ data.year }}</td>
                                <td class="p-2 text-sm font-black text-gray-800">{{ data.numerical_rating }}</td>
                                <td class="p-2 text-sm font-black text-gray-800 uppercase">{{ data.adjectival_rating }}</td>
                                <td class="p-2 text-sm font-black text-gray-800 uppercase">{{ data.comment_and_recommendation }}
                                </td>
                                <td class="p-2 text-sm font-black text-gray-800 uppercase">{{ data.type }}</td>
                                <td class="p-2 flex space-x-2">
                                    <button @click="openUpdateModal(data)"
                                        class="flex items-center justify-center px-3 py-1 text-sm text-gray-900 bg-white border rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 dark:bg-gray-800 dark:text-gray-400">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <div class="flex flex-col items-left mt-4">
                                <span class="text-sm text-gray-700 dark:text-gray-400">
                                    Showing <span class="font-semibold text-gray-900 dark:text-white">{{
                                        pagination.from
                                        }}</span> to <span class="font-semibold text-gray-900 dark:text-white">{{
                                            pagination.to
                                        }}</span>
                                    of
                                    <span class="font-semibold text-gray-900 dark:text-white">{{
                                        pagination.total }}</span>
                                    Entries
                                </span>
                                <div class="inline-flex mt-2 xs:mt-0">
                                    <!-- Buttons -->
                                    <button v-if="(pagination.current_page - 1) >= 1"
                                        @click="getusers(pagination.current_page - 1)"
                                        class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                                        </svg>
                                        Prev
                                    </button>
                                    <button v-if="(pagination.current_page + 1) <= pagination.last_page"
                                        @click="getusers(pagination.current_page + 1)"
                                        class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        Next
                                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>




</template>


<style>
.my-autocomplete .el-input__inner {
    border: 10px solid red;
}

.my-autocomplete .el-autocomplete-suggestion li {
    line-height: normal;
    padding: 7px;
    margin-left: 10px;
}

.my-autocomplete li .name {
    text-overflow: ellipsis;
    overflow: hidden;
}

.my-autocomplete li .addr {
    font-size: 12px;
    color: #b4b4b4;
}

.my-autocomplete li .highlighted .addr {
    color: #ddd;
}

.demo-autocomplete {
    display: flex;
    flex-wrap: wrap;

}

.demo-block {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.demo-title {
    font-size: 0.875rem;
    color: var(--el-text-color-secondary);
    min-height: 2.5em;
    display: flex;
    align-items: center;
}

@media screen and (max-width: 768px) {
    .demo-autocomplete {
        gap: 1rem;
    }

    .demo-block {
        width: 100%;
    }
}

.circular {
    display: inline;
    height: 30px;
    width: 30px;
    animation: loading-rotate 2s linear infinite;
}

.path {
    animation: loading-dash 1.5s ease-in-out infinite;
    stroke-dasharray: 90, 150;
    stroke-dashoffset: 0;
    stroke-width: 2;
    stroke: var(--el-color-primary);
    stroke-linecap: round;
}

.loading-path .dot1 {
    transform: translate(3.75px, 3.75px);
    fill: var(--el-color-primary);
    animation: custom-spin-move 1s infinite linear alternate;
    opacity: 0.3;
}

.loading-path .dot2 {
    transform: translate(calc(100% - 3.75px), 3.75px);
    fill: var(--el-color-primary);
    animation: custom-spin-move 1s infinite linear alternate;
    opacity: 0.3;
    animation-delay: 0.4s;
}

.loading-path .dot3 {
    transform: translate(3.75px, calc(100% - 3.75px));
    fill: var(--el-color-primary);
    animation: custom-spin-move 1s infinite linear alternate;
    opacity: 0.3;
    animation-delay: 1.2s;
}

.loading-path .dot4 {
    transform: translate(calc(100% - 3.75px), calc(100% - 3.75px));
    fill: var(--el-color-primary);
    animation: custom-spin-move 1s infinite linear alternate;
    opacity: 0.3;
    animation-delay: 0.8s;
}

@keyframes loading-rotate {
    to {
        transform: rotate(360deg);
    }
}

@keyframes loading-dash {
    0% {
        stroke-dasharray: 1, 200;
        stroke-dashoffset: 0;
    }

    50% {
        stroke-dasharray: 90, 150;
        stroke-dashoffset: -40px;
    }

    100% {
        stroke-dasharray: 90, 150;
        stroke-dashoffset: -120px;
    }
}

@keyframes custom-spin-move {
    to {
        opacity: 1;
    }
}

.my-autocomplete li {
    color: var(--el-text-color-regular);
    cursor: pointer;
    font-size: var(--el-font-size-base);
    line-height: 0px;
    list-style: none;
    margin: 0;
    overflow: hidden;
    padding: 0 20px;
    text-align: left;
    text-overflow: ellipsis;
    white-space: nowrap
}

.custom-autocomplete :deep(.el-input__inner) {
    border-color: #409eff;
    box-shadow: 0 0 0 1px #409eff inset;
    padding-left: 140px;
    /* Adjust padding if you add a prefix icon */
}
</style>