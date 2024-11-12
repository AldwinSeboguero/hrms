<script setup>
import AppLayout from '@/Layouts/MyLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { ref, onMounted } from 'vue';
import { initFlowbite } from 'flowbite'
import ApexCharts from 'apexcharts';
const props = defineProps({
    EmployeeCount: String,
    MaleCount: String,
    FemaleCount: String,
    EmployementStat: Array,
    PositionStat: Object,
    Location: Object,




})
onMounted(() => {
    initFlowbite();
    if (document.getElementById("donut-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());
        chart.render();

        // Get all the checkboxes by their class name
        const checkboxes = document.querySelectorAll('#devices input[type="checkbox"]');

        // Function to handle the checkbox change event
        function handleCheckboxChange(event, chart) {
            const checkbox = event.target;
            if (checkbox.checked) {
                switch (checkbox.value) {
                    case 'desktop':
                        chart.updateSeries([15.1, 22.5, 4.4, 8.4]);
                        break;
                    case 'tablet':
                        chart.updateSeries([25.1, 26.5, 1.4, 3.4]);
                        break;
                    case 'mobile':
                        chart.updateSeries([45.1, 27.5, 8.4, 2.4]);
                        break;
                    default:
                        chart.updateSeries([55.1, 28.5, 1.4, 5.4]);
                }

            } else {
                chart.updateSeries([35.1, 23.5, 2.4, 5.4]);
            }
        }

        // Attach the event listener to each checkbox
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', (event) => handleCheckboxChange(event, chart));
        });
    }

})

const getChartOptions = () => {
    return {
        series: props.EmployementStat,
        colors: ["#1C64F2", "#16BDCA", "#FDBA8C", "#B84694", "#E74114", "#E74694"],
        chart: {
            height: 320,
            width: "100%",
            type: "donut",
        },
        stroke: {
            colors: ["transparent"],
            lineCap: "",
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: 20,
                        },
                        total: {
                            showAlways: true,
                            show: true,
                            label: "Total Employee",
                            fontFamily: "Inter, sans-serif",
                            formatter: function (w) {
                                const sum = w.globals.seriesTotals.reduce((a, b) => {
                                    return a + b
                                }, 0)
                                return sum
                            },
                        },
                        value: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: -20,
                            formatter: function (value) {
                                return value
                            },
                        },
                    },
                    size: "80%",
                },
            },
        },
        grid: {
            padding: {
                top: -2,
            },
        },
        labels: ["Permanent", "Temporary", "Casual", "Job Order", "COS", "Part-Timer"],
        dataLabels: {
            enabled: false,
        },
        legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value
                },
            },
        },
        xaxis: {
            labels: {
                formatter: function (value) {
                    return value
                },
            },
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
        },
    }
}



</script>
<script>
export default {
    data() {

        return {
            time: '',
            date: ''
        };
    },
    methods: {
        updateTime() {
            const now = new Date();
            let hours = now.getHours();
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12; // Convert to 12-hour format
            hours = hours ? String(hours).padStart(2, '0') : '12'; // The hour '0' should be '12'
            this.time = `${hours}:${minutes}:${seconds} ${ampm}`;
        },
        updateDate() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            this.date = now.toLocaleDateString('en-US', options);

        }
    },
    created() {
        this.updateTime();
        this.updateDate();
        setInterval(this.updateDate, 1000);

        setInterval(this.updateTime, 1000);
    }

};
</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-1">
            <div class="mx-auto">
                <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg ">
                    <div class="grid grid-cols-1  lg:grid-cols-1 gap-4">
                        <div class=" border-gray-300 rounded-lg dark:border-gray-6006">


                            <h1 class=" text-2xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-4xl">
                                <span
                                    class="text-transparent bg-clip-text bg-gradient-to-r to-blue-800 from-blue-600">Hi,
                                    {{
                                        $page.props.auth.user.name }}!</span>
                            </h1>
                            <div></div>
                            <h1
                                class="text-left text-5xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl">
                                <span class="text-transparent bg-clip-text bg-gradient-to-r to-blue-800 from-blue-600">
                                    {{ time }}
                            <p class="text-lg font-bold text-gray-500 lg:text-xl dark:text-gray-400">{{ date }}</p>

                                </span>
                            </h1>

                        </div>

                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

                        <div class=" rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-36 mt-4">
                            <div
                                class="flex items-center justify-between p-4 bg-white  border-b-4 border-green-500 rounded-lg shadow-lg sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800 transition-transform transform hover:scale-105">
                                <div class="w-full">
                                    <h3 class="text-base font-semibold text-gray-600 dark:text-gray-400">Total Employees
                                    </h3>
                                    <span
                                        class="text-3xl font-bold leading-none text-gray-900 sm:text-4xl dark:text-white">{{
                                            EmployeeCount }}</span>
                                    <span class="flex items-center mt-2 text-gray-500 dark:text-gray-400 font-italic">
                                        <em>Active (non-terminated) employees</em>
                                    </span>
                                </div>
                                <div class="flex-shrink-0">
                                    <img class="h-20" src="images/Employees.png" alt="Female Logo">

                                </div>
                            </div>
                        </div>
                        <div class=" rounded-lg border-gray-300 dark:border-gray-600 h-100 md:h-36 mt-4">
                            <div
                                class="flex items-center justify-between p-4 bg-white border-b-4 border-pink-500 rounded-lg shadow-lg sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800 transition-transform transform hover:scale-105">
                                <div class="w-full">
                                    <h3 class="text-base font-semibold text-gray-600 dark:text-gray-400">Female
                                        Employees
                                    </h3>
                                    <span
                                        class="text-3xl font-bold leading-none text-gray-900 sm:text-4xl dark:text-white">{{
                                            FemaleCount }}</span>
                                    <span class="flex items-center mt-2 text-gray-500 dark:text-gray-400 font-italic">
                                        <em>Active (non-terminated) employees</em>
                                    </span>
                                </div>
                                <div class="flex-shrink-0">
                                    <img class="h-20" src="images/Female.png" alt="Female Logo">

                                </div>
                            </div>
                        </div>
                        <div class=" rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-36 mt-4 mb-4">
                            <div
                                class="flex items-center justify-between p-4 bg-white border-b-4 border-indigo-500 rounded-lg shadow-lg sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800 transition-transform transform hover:scale-105">
                                <div class="w-full">
                                    <h3 class="text-base font-semibold text-gray-600 dark:text-gray-400">Male Employees
                                    </h3>
                                    <span
                                        class="text-3xl font-bold leading-none text-gray-900 sm:text-4xl dark:text-white">{{
                                            MaleCount }}</span>
                                    <span class="flex items-center mt-2 text-gray-500 dark:text-gray-400 font-italic">
                                        <em>Active (non-terminated) employees</em>
                                    </span>
                                </div>
                                <div class="flex-shrink-0">
                                    <img class="h-20" src="images/Male.png" alt="Male Logo">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-4   gap-4 mb-4 h-3/4">
                        <div class=" rounded-lg max-w-sm ">

                            <div class="  bg-white rounded-lg border dark:bg-gray-800 p-4 md:p-6  shadow-xl ">

                                <div class="flex justify-between mb-3">
                                    <div class="flex justify-center items-center">
                                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">
                                            Employment
                                            status Overview</h5>
                                        <svg data-popover-target="chart-info" data-popover-placement="bottom"
                                            class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                                        </svg>
                                        <div data-popover id="chart-info" role="tooltip"
                                            class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                            <div class="p-3 space-y-2">
                                                <h3 class="font-semibold text-gray-900 dark:text-white">Activity growth
                                                    -
                                                    Incremental</h3>
                                                <p>Report helps navigate cumulative growth of community activities.
                                                    Ideally, the
                                                    chart should have a growing trend, as stagnating chart signifies a
                                                    significant decrease of community activity.</p>
                                                <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3>
                                                <p>For each date bucket, the all-time volume of activities is
                                                    calculated. This
                                                    means that activities in period n contain all activities up to
                                                    period n,
                                                    plus the activities generated by your community in period.</p>
                                                <a href="#"
                                                    class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read
                                                    more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 6 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                                    </svg></a>
                                            </div>
                                            <div data-popper-arrow></div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" data-tooltip-target="data-tooltip"
                                            data-tooltip-placement="bottom"
                                            class="hidden sm:inline-flex items-center justify-center text-gray-500 w-8 h-8 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm"><svg
                                                class="w-3.5 h-3.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                                            </svg><span class="sr-only">Download data</span>
                                        </button>
                                        <div id="data-tooltip" role="tooltip"
                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            Download CSV
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex" id="devices">
                                        <div class="flex items-center me-4">
                                            <input id="desktop" type="checkbox" value="desktop"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="desktop"
                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">All</label>
                                        </div>
                                        <div class="flex items-center me-4">
                                            <input id="tablet" type="checkbox" value="tablet"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="tablet"
                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">San
                                                Jose</label>
                                        </div>
                                        <div class="flex items-center me-4">
                                            <input id="mobile" type="checkbox" value="mobile"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="mobile"
                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Lagonoy</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Donut Chart -->
                                <div class="py-6" id="donut-chart"></div>

                                <div
                                    class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                                    <div class="flex justify-between items-center pt-5">
                                        <!-- Button -->
                                        <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                                            data-dropdown-placement="bottom"
                                            class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                                            type="button">
                                            Last 7 days
                                            <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                        <div id="lastDaysdropdown"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="dropdownDefaultButton">
                                                <li>
                                                    <a href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                                        7 days</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                                        30 days</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                                        90 days</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="#"
                                            class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                                            ES analysis
                                            <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="rounded-lg border-gray-300 dark:border-gray-600  md:col-span-3 ">

                            <div
                                class="relative overflow-x-auto overflow-y-auto  p-6 bg-white border border-gray-200 rounded-lg shadow-xl dark:bg-gray-800 dark:border-gray-700 h-full ">
                                <div
                                    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                                    <div>
                                    </div>
                                    <label for="table-search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                            </svg>
                                        </div>
                                        <input type="text" id="table-search-users"
                                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Search for positions">
                                    </div>
                                </div>
                                <table class="text-left w-full">
                                    <thead
                                        class="flex  w-full text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr class="flex w-full mb-4">


                                            <th scope="col" class="px-6 py-3 p-4 w-1/2">
                                                Name
                                            </th>
                                            <th scope="col" class="text-center p-4 w-1/4" v-for="({ name }, index) in $props.Location"
                                            :key="id">
                                                {{name}}
                                            </th>
                                            
                                            <th scope="col" class="text-center p-4 w-1/4">
                                                Total
                                            </th>

                                        </tr>
                                    </thead>
                                    <!-- Remove the nasty inline CSS fixed height on production and replace it with a CSS class — this is just for demonstration purposes! -->
                                    <tbody
                                        class="bg-grey-light flex flex-col items-center justify-between overflow-y-scroll w-full"
                                        style="height: 50vh;">
                                        <tr v-for="({ position, count,location }, index) in $props.PositionStat"
                                            :key="position.id"
                                            class=" flex w-full  bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="p-4 w-1/2 font-bold">{{ position }}</td>
                                            <td class="p-4 w-1/4 text-center " v-for="({ id, count }, index1) in location"
                                            :key="id"> {{ count }}</td>
                                            <td class="p-4 w-1/4 text-center">{{ count }}</td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>


                    </div>
                    <div
                        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4 mt-7 md:mt-1">
                    </div>

                    <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72">
                        </div>
                        <div
                            class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72">
                        </div>
                        <div
                            class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72">
                        </div>
                        <div
                            class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
