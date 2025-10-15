<script setup>
 import AppLayout from '@/Layouts/UserLayout.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
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
    <AppLayout  >
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-1">
            <div class="mx-auto">
                <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg ">
                  
                  
                  
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
