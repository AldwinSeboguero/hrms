 <script setup>
    import { ref } from 'vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import ApplicationMark from '@/Components/ApplicationMark.vue';
    import Banner from '@/Components/Banner.vue';
    import Dropdown from '@/Components/Dropdown.vue';
    import DropdownLink from '@/Components/DropdownLink.vue';
    import NavLink from '@/Components/NavLink.vue';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
    import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
    import { ChevronDownIcon } from '@heroicons/vue/20/solid'
    import { onMounted,onUpdated } from 'vue'
    import logo from '../../images/psu_logo.png';
    import { 
        initAccordions, 
        initCarousels, 
        initCollapses, 
        initDials, 
        initDismisses, 
        initDrawers, 
        initDropdowns, 
        initModals, 
        initPopovers, 
        initTabs, 
        initTooltips } from 'flowbite'
        import ApexCharts from 'apexcharts'

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

    // initialize components based on data attribute selectors
    onMounted(() => {
        initAccordions();
        initCarousels();
        initCollapses();
        initDials();
        initDismisses();
        initDrawers();
        initDropdowns();
        initModals();
        initPopovers();
        initTabs();
        initTooltips();
    //     const chart = new ApexCharts(document.getElementById("column-chart"), options);
    //   chart.render();
    })
    onUpdated(() =>{
     
    })
    const logout = () => {
        router.post(route('logout'));
    };
    
    
    const options = {
      colors: ["#1A56DB", "#FDBA8C"],
      series: [
        {
          name: "Organic",
          color: "#1A56DB",
          data: [
            { x: "Mon", y: 231 },
            { x: "Tue", y: 122 },
            { x: "Wed", y: 63 },
            { x: "Thu", y: 421 },
            { x: "Fri", y: 122 },
            { x: "Sat", y: 323 },
            { x: "Sun", y: 111 },
          ],
        },
        {
          name: "Social media",
          color: "#FDBA8C",
          data: [
            { x: "Mon", y: 232 },
            { x: "Tue", y: 113 },
            { x: "Wed", y: 341 },
            { x: "Thu", y: 224 },
            { x: "Fri", y: 522 },
            { x: "Sat", y: 411 },
            { x: "Sun", y: 243 },
          ],
        },
      ],
      chart: {
        type: "bar",
        height: "320px",
        fontFamily: "Inter, sans-serif",
        toolbar: {
          show: false,
        },
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "70%",
          borderRadiusApplication: "end",
          borderRadius: 8,
        },
      },
      tooltip: {
        shared: true,
        intersect: false,
        style: {
          fontFamily: "Inter, sans-serif",
        },
      },
      states: {
        hover: {
          filter: {
            type: "darken",
            value: 1,
          },
        },
      },
      stroke: {
        show: true,
        width: 0,
        colors: ["transparent"],
      },
      grid: {
        show: false,
        strokeDashArray: 4,
        padding: {
          left: 2,
          right: 2,
          top: -14
        },
      },
      dataLabels: {
        enabled: false,
      },
      legend: {
        show: false,
      },
      xaxis: {
        floating: false,
        labels: {
          show: true,
          style: {
            fontFamily: "Inter, sans-serif",
            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
          }
        },
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false,
        },
      },
      yaxis: {
        show: false,
      },
      fill: {
        opacity: 1,
      },
    }
    
    if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
      
    }


    
    
    </script>

<template>
    <div class="w-full h-full">
         <!-- component -->
<aside class="ml-[-100%] fixed z-10 top-0 pb-3 px-6 w-full flex flex-col justify-between h-screen border-r bg-white transition duration-300 md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]">
    <div>
        <div class="-mx-6 px-6 py-4">
           <a href="https://hrms.parsu.edu.ph" class="flex items-center space-x-4">
    <div class="">
        <img class="h-12 w-12 object-contain" :src="logo" alt="ParSU Logo">
    </div>
    <div>
        <div class="text-sm text-blue-950 font-black font-sans uppercase">Partido State University</div>
        <p class="text-slate-500 text-xs">Human Resource Management System</p>
    </div>
</a>
        </div>

       

        <ul class="space-y-2 tracking-wide mt-8">
            <!-- <label class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400">admission</label> -->
            <li>
                 <a :href="route('user.dashboard')"  :active="route().current('user.dashboard')" 
                class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group" 
                :class="{ 'rounded-xl text-white bg-gradient-to-r from-sky-600 to-cyan-400':  route().current('user.dashboard') }">
                    <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                        <path d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z" class="fill-current text-cyan-400 dark:fill-slate-600"></path>
                        <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z"class="fill-current text-gray-300 group-hover:text-cyan-300" :class="{ 'text-cyan-300':  route().current('dashboard') }"></path>
                        <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z" class="fill-current text-gray-600 group-hover:text-cyan-600" :class="{ 'text-cyan-600':  route().current('dashboard') }"></path>
                    </svg>
                    <span class="-mr-1 font-medium" :class="{ 'group-hover:text-white':  route().current('user.dashboard') }">Home</span>
                </a>
            </li>
            <li>
                <a  
                :href="route('user.profile')"  :active="route().current('user.profile')"    
                class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group"
                :class="{ 'rounded-xl text-white bg-gradient-to-r from-sky-600 to-cyan-400 ':  route().current('user.profile') }">
                    <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600"
                     :class="{ 'text-white group-hover:text-white':  route().current('user.profile') }" 
                    opacity="0.5" d="M14 4H10C6.22876 4 4.34315 4 3.17157 5.17157C2 6.34315 2 8.22876 2 12C2 15.7712 2 17.6569 3.17157 18.8284C4.34315 20 6.22876 20 10 20H14C17.7712 20 19.6569 20 20.8284 18.8284C22 17.6569 22 15.7712 22 12C22 8.22876 22 6.34315 20.8284 5.17157C19.6569 4 17.7712 4 14 4Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600"
                     :class="{ 'text-white group-hover:text-white':  route().current('user.profile') }" 
                    d="M13.25 9C13.25 8.58579 13.5858 8.25 14 8.25H19C19.4142 8.25 19.75 8.58579 19.75 9C19.75 9.41421 19.4142 9.75 19 9.75H14C13.5858 9.75 13.25 9.41421 13.25 9Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600"
                     :class="{ 'text-white group-hover:text-white':  route().current('user.profile') }" 
                    d="M14.25 12C14.25 11.5858 14.5858 11.25 15 11.25H19C19.4142 11.25 19.75 11.5858 19.75 12C19.75 12.4142 19.4142 12.75 19 12.75H15C14.5858 12.75 14.25 12.4142 14.25 12Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600"
                     :class="{ 'text-white group-hover:text-white':  route().current('user.profile') }" 
                    d="M15.25 15C15.25 14.5858 15.5858 14.25 16 14.25H19C19.4142 14.25 19.75 14.5858 19.75 15C19.75 15.4142 19.4142 15.75 19 15.75H16C15.5858 15.75 15.25 15.4142 15.25 15Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600"
                     :class="{ 'text-white group-hover:text-white':  route().current('user.profile') }" 
                    d="M9 11C10.1046 11 11 10.1046 11 9C11 7.89543 10.1046 7 9 7C7.89543 7 7 7.89543 7 9C7 10.1046 7.89543 11 9 11Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600"
                     :class="{ 'text-white group-hover:text-white':  route().current('user.profile') }" 
                    d="M9 17C13 17 13 16.1046 13 15C13 13.8954 11.2091 13 9 13C6.79086 13 5 13.8954 5 15C5 16.1046 5 17 9 17Z" fill="#1C274C"/>
                    </svg>
                    <span class="group-hover:text-gray-700" 
                      :class="{ 'group-hover:text-white ':  route().current('user.profile') }"
                      >My Profile</span>
                </a>
            </li>
            
            <li>
                <a :href="route('user.dtr')"  :active="route().current('user.dtr')" 
                class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group" 
                :class="{ 'rounded-xl text-white bg-gradient-to-r from-sky-600 to-cyan-400':  route().current('user.dtr') }">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300" :class="{ 'text-cyan-300':  route().current('employeeTimesheets.index') }" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" />
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" :class="{ 'text-cyan-600':  route().current('employeeTimesheets.index') }" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                    </svg> -->

                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" :class="{ 'text-white group-hover:text-white':  route().current('user.dtr') }"  d="M12.7915 2H11.2089C9.67059 2 8.90146 2 8.35306 2.43992C7.80465 2.87983 7.6378 3.63065 7.30411 5.13228L7.23936 5.42365C8.21852 5 9.59408 5 12.0001 5C14.4062 5 15.7818 5 16.761 5.42373L16.6962 5.13228C16.3625 3.63065 16.1957 2.87983 15.6473 2.43992C15.0989 2 14.3297 2 12.7915 2Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" :class="{ 'text-white group-hover:text-white':  route().current('user.dtr') }"  d="M7.23926 18.5763C8.21842 19 9.594 19 12.0001 19C14.4062 19 15.7817 19 16.7609 18.5763L16.6961 18.8677C16.3624 20.3693 16.1956 21.1202 15.6472 21.5601C15.0988 22 14.3297 22 12.7914 22H11.2088C9.6705 22 8.90137 22 8.35297 21.5601C7.80456 21.1202 7.63771 20.3693 7.30401 18.8677L7.23926 18.5763Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" :class="{ 'text-white group-hover:text-white':  route().current('user.dtr') }"  opacity="0.5" d="M6.77772 18.3259C7.78661 19 9.19108 19 12 19C14.8089 19 16.2134 19 17.2223 18.3259C17.659 18.034 18.034 17.659 18.3259 17.2223C19 16.2134 19 14.8089 19 12C19 9.19108 19 7.78661 18.3259 6.77772C18.034 6.34096 17.659 5.96596 17.2223 5.67412C16.2134 5 14.8089 5 12 5C9.19108 5 7.78661 5 6.77772 5.67412C6.34096 5.96596 5.96596 6.34096 5.67412 6.77772C5 7.78661 5 9.19108 5 12C5 14.8089 5 16.2134 5.67412 17.2223C5.96596 17.659 6.34096 18.034 6.77772 18.3259Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" :class="{ 'text-white group-hover:text-white':  route().current('user.dtr') }"  fill-rule="evenodd" clip-rule="evenodd" d="M12 8.25C12.4142 8.25 12.75 8.58579 12.75 9V11.7576L14.5198 13.4594C14.8184 13.7465 14.8277 14.2213 14.5406 14.5198C14.2535 14.8184 13.7787 14.8277 13.4802 14.5406L11.4802 12.6175C11.3331 12.4761 11.25 12.2809 11.25 12.0769V9C11.25 8.58579 11.5858 8.25 12 8.25Z" fill="#1C274C"/>
                        </svg>
                    <span class="group-hover:text-gray-700" :class="{ 'group-hover:text-white':  route().current('user.dtr') }">Daily Time Record</span>
                </a>
            </li>
            <li>
                <a :href="route('user.leave')" :active="route().current('user.leave')"  
                class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group"
                :class="{ 'rounded-xl text-white bg-gradient-to-r from-sky-600 to-cyan-400':  route().current('user.leave') }">
       

                     <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600"  :class="{ 'text-white group-hover:text-white':  route().current('user.leave') }" fill-rule="evenodd" clip-rule="evenodd" d="M10.75 2H12.75C15.5784 2 16.9926 2 17.8713 2.87868C18.75 3.75736 18.75 5.17157 18.75 8V16C18.75 18.8284 18.75 20.2426 17.8713 21.1213C16.9926 22 15.5784 22 12.75 22H10.75C7.92157 22 6.50736 22 5.62868 21.1213C4.75 20.2426 4.75 18.8284 4.75 16V8C4.75 5.17157 4.75 3.75736 5.62868 2.87868C6.50736 2 7.92157 2 10.75 2ZM8 13C8 12.5858 8.33579 12.25 8.75 12.25H14.75C15.1642 12.25 15.5 12.5858 15.5 13C15.5 13.4142 15.1642 13.75 14.75 13.75H8.75C8.33579 13.75 8 13.4142 8 13ZM8 9C8 8.58579 8.33579 8.25 8.75 8.25H14.75C15.1642 8.25 15.5 8.58579 15.5 9C15.5 9.41421 15.1642 9.75 14.75 9.75H8.75C8.33579 9.75 8 9.41421 8 9ZM8 17C8 16.5858 8.33579 16.25 8.75 16.25H11.75C12.1642 16.25 12.5 16.5858 12.5 17C12.5 17.4142 12.1642 17.75 11.75 17.75H8.75C8.33579 17.75 8 17.4142 8 17Z" fill="#1C274C"/>
                    <g opacity="0.5">
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600"  :class="{ 'text-white group-hover:text-white':  route().current('user.leave') }" fill-rule="evenodd" clip-rule="evenodd" d="M1.75 4.25C2.16421 4.25 2.5 4.58579 2.5 5V19C2.5 19.4142 2.16421 19.75 1.75 19.75C1.33579 19.75 1 19.4142 1 19V5C1 4.58579 1.33579 4.25 1.75 4.25Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600"  :class="{ 'text-white group-hover:text-white':  route().current('user.leave') }" fill-rule="evenodd" clip-rule="evenodd" d="M21.75 4.25C22.1642 4.25 22.5 4.58579 22.5 5V19C22.5 19.4142 22.1642 19.75 21.75 19.75C21.3358 19.75 21 19.4142 21 19V5C21 4.58579 21.3358 4.25 21.75 4.25Z" fill="#1C274C"/>
                    </g>
                    </svg>

                    <span class="group-hover:text-gray-700" :class="{ 'group-hover:text-white':  route().current('user.leave') }">Leave & Time-Off</span>
                </a>
            </li>
            <li>
                <a  :href="route('user.directory')"  type="button" 
                    class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group cursor-not-allowed"  
                    disabled>
                    <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M15.5 7.5C15.5 9.433 13.933 11 12 11C10.067 11 8.5 9.433 8.5 7.5C8.5 5.567 10.067 4 12 4C13.933 4 15.5 5.567 15.5 7.5Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" opacity="0.4" d="M19.5 7.5C19.5 8.88071 18.3807 10 17 10C15.6193 10 14.5 8.88071 14.5 7.5C14.5 6.11929 15.6193 5 17 5C18.3807 5 19.5 6.11929 19.5 7.5Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" opacity="0.4" d="M4.5 7.5C4.5 8.88071 5.61929 10 7 10C8.38071 10 9.5 8.88071 9.5 7.5C9.5 6.11929 8.38071 5 7 5C5.61929 5 4.5 6.11929 4.5 7.5Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M18 16.5C18 18.433 15.3137 20 12 20C8.68629 20 6 18.433 6 16.5C6 14.567 8.68629 13 12 13C15.3137 13 18 14.567 18 16.5Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" opacity="0.4" d="M22 16.5C22 17.8807 20.2091 19 18 19C15.7909 19 14 17.8807 14 16.5C14 15.1193 15.7909 14 18 14C20.2091 14 22 15.1193 22 16.5Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" opacity="0.4" d="M2 16.5C2 17.8807 3.79086 19 6 19C8.20914 19 10 17.8807 10 16.5C10 15.1193 8.20914 14 6 14C3.79086 14 2 15.1193 2 16.5Z" fill="#1C274C"/>
                        </svg>
                        <span class="group-hover:text-gray-700">Directory</span>
                </a>
            </li>

                 <li>
                <a :href="route('user.orgchart')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M7.42598 18H20C19.9965 18.9296 19.9784 19.6228 19.8866 20.1706C19.7773 20.8228 19.5774 21.1682 19.2709 21.4142C18.9643 21.6602 18.5339 21.8206 17.7211 21.9083C16.8844 21.9986 15.7754 22 14.1854 22H9.75461C8.1646 22 7.05566 21.9986 6.21896 21.9083C5.40616 21.8206 4.97573 21.6602 4.66916 21.4142C4.36259 21.1682 4.16271 20.8228 4.05343 20.1706C4.04522 20.1216 4.03761 20.0714 4.03053 20.02C3.99045 19.7288 3.97041 19.5831 4.09696 19.2397C4.22351 18.8964 4.27837 18.8425 4.38811 18.7347C4.71351 18.4151 5.15982 18.1785 5.67321 18.0681C5.96352 18.0057 6.34236 18 7.42598 18Z" fill="#1C274D"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" opacity="0.5" d="M4.72718 2.73332C5.03258 2.42535 5.46135 2.22456 6.27103 2.11478C7.10452 2.00177 8.2092 2 9.7931 2H14.2069C15.7908 2 16.8955 2.00177 17.729 2.11478C18.5387 2.22456 18.9674 2.42535 19.2728 2.73332C19.5782 3.0413 19.7773 3.47368 19.8862 4.2902C19.9982 5.13073 20 6.24474 20 7.84202L20 18H7.42598C6.34236 18 5.96352 18.0057 5.67321 18.0681C5.15982 18.1785 4.71351 18.4151 4.38811 18.7347C4.27837 18.8425 4.22351 18.8964 4.09696 19.2397C4.02435 19.4367 4 19.5687 4 19.7003V7.84202C4 6.24474 4.00176 5.13073 4.11382 4.2902C4.22268 3.47368 4.42179 3.0413 4.72718 2.73332Z" fill="#1C274D"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M7.25 7C7.25 6.58579 7.58579 6.25 8 6.25H16C16.4142 6.25 16.75 6.58579 16.75 7C16.75 7.41421 16.4142 7.75 16 7.75H8C7.58579 7.75 7.25 7.41421 7.25 7Z" fill="#1C274D"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M8 9.75C7.58579 9.75 7.25 10.0858 7.25 10.5C7.25 10.9142 7.58579 11.25 8 11.25H13C13.4142 11.25 13.75 10.9142 13.75 10.5C13.75 10.0858 13.4142 9.75 13 9.75H8Z" fill="#1C274D"/>
                    </svg>
                    <span class="group-hover:text-gray-700">Org. Chart</span>
                </a>
            </li>
                 <li>
                <a :href="route('user.calendar')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M6.94028 2C7.35614 2 7.69326 2.32421 7.69326 2.72414V4.18487C8.36117 4.17241 9.10983 4.17241 9.95219 4.17241H13.9681C14.8104 4.17241 15.5591 4.17241 16.227 4.18487V2.72414C16.227 2.32421 16.5641 2 16.98 2C17.3958 2 17.733 2.32421 17.733 2.72414V4.24894C19.178 4.36022 20.1267 4.63333 20.8236 5.30359C21.5206 5.97385 21.8046 6.88616 21.9203 8.27586L22 9H2.92456H2V8.27586C2.11571 6.88616 2.3997 5.97385 3.09665 5.30359C3.79361 4.63333 4.74226 4.36022 6.1873 4.24894V2.72414C6.1873 2.32421 6.52442 2 6.94028 2Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" opacity="0.5" d="M21.9995 14.0001V12.0001C21.9995 11.161 21.9963 9.66527 21.9834 9H2.00917C1.99626 9.66527 1.99953 11.161 1.99953 12.0001V14.0001C1.99953 17.7713 1.99953 19.6569 3.1711 20.8285C4.34267 22.0001 6.22829 22.0001 9.99953 22.0001H13.9995C17.7708 22.0001 19.6564 22.0001 20.828 20.8285C21.9995 19.6569 21.9995 17.7713 21.9995 14.0001Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M18 17C18 17.5523 17.5523 18 17 18C16.4477 18 16 17.5523 16 17C16 16.4477 16.4477 16 17 16C17.5523 16 18 16.4477 18 17Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M18 13C18 13.5523 17.5523 14 17 14C16.4477 14 16 13.5523 16 13C16 12.4477 16.4477 12 17 12C17.5523 12 18 12.4477 18 13Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M13 17C13 17.5523 12.5523 18 12 18C11.4477 18 11 17.5523 11 17C11 16.4477 11.4477 16 12 16C12.5523 16 13 16.4477 13 17Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M13 13C13 13.5523 12.5523 14 12 14C11.4477 14 11 13.5523 11 13C11 12.4477 11.4477 12 12 12C12.5523 12 13 12.4477 13 13Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M8 17C8 17.5523 7.55228 18 7 18C6.44772 18 6 17.5523 6 17C6 16.4477 6.44772 16 7 16C7.55228 16 8 16.4477 8 17Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M8 13C8 13.5523 7.55228 14 7 14C6.44772 14 6 13.5523 6 13C6 12.4477 6.44772 12 7 12C7.55228 12 8 12.4477 8 13Z" fill="#1C274C"/>
                    </svg>
                    <span class="group-hover:text-gray-700">Calendar</span>
                </a>
            </li>
            <li>
                <a :href="route('user.performances')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                    </svg>
                    <span class="group-hover:text-gray-700">Performances</span>
                </a>
            </li>
            <li>
                <a :href="route('user.expenses')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                    </svg>
                    <span class="group-hover:text-gray-700">Expenses</span>
                </a>
            </li>
                 <li>
                <a :href="route('user.forms')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path  class="fill-current text-gray-600 group-hover:text-cyan-600" opacity="0.5" d="M2 6.94975C2 6.06722 2 5.62595 2.06935 5.25839C2.37464 3.64031 3.64031 2.37464 5.25839 2.06935C5.62595 2 6.06722 2 6.94975 2C7.33642 2 7.52976 2 7.71557 2.01738C8.51665 2.09229 9.27652 2.40704 9.89594 2.92051C10.0396 3.03961 10.1763 3.17633 10.4497 3.44975L11 4C11.8158 4.81578 12.2237 5.22367 12.7121 5.49543C12.9804 5.64471 13.2651 5.7626 13.5604 5.84678C14.0979 6 14.6747 6 15.8284 6H16.2021C18.8345 6 20.1506 6 21.0062 6.76946C21.0849 6.84024 21.1598 6.91514 21.2305 6.99383C22 7.84935 22 9.16554 22 11.7979V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V6.94975Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M20 6.23751C19.9992 5.94016 19.9949 5.76263 19.9746 5.60842C19.7974 4.26222 18.7381 3.2029 17.3919 3.02567C17.1969 3 16.9647 3 16.5003 3H9.98828C10.1042 3.10392 10.2347 3.23445 10.45 3.44975L11.0003 4C11.8161 4.81578 12.2239 5.22367 12.7124 5.49543C12.9807 5.64471 13.2653 5.7626 13.5606 5.84678C14.0982 6 14.675 6 15.8287 6H16.2024C17.9814 6 19.1593 6 20 6.23751Z" fill="#1C274C"/>
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" clip-rule="evenodd" d="M12.25 10C12.25 9.58579 12.5858 9.25 13 9.25H18C18.4142 9.25 18.75 9.58579 18.75 10C18.75 10.4142 18.4142 10.75 18 10.75H13C12.5858 10.75 12.25 10.4142 12.25 10Z" fill="#1C274C"/>
                    </svg>
                    <span class="group-hover:text-gray-700">Forms</span>
                </a>
            </li>
                 <li>
                <a :href="route('user.library')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600"  fill-rule="evenodd" clip-rule="evenodd" d="M8.67239 7.54199H15.3276C18.7024 7.54199 20.3898 7.54199 21.3377 8.52882C22.2855 9.51565 22.0625 11.0403 21.6165 14.0895L21.1935 16.9811C20.8437 19.3723 20.6689 20.5679 19.7717 21.2839C18.8745 21.9999 17.5512 21.9999 14.9046 21.9999H9.09536C6.44881 21.9999 5.12553 21.9999 4.22834 21.2839C3.33115 20.5679 3.15626 19.3723 2.80648 16.9811L2.38351 14.0895C1.93748 11.0403 1.71447 9.51565 2.66232 8.52882C3.61017 7.54199 5.29758 7.54199 8.67239 7.54199ZM8 18.0001C8 17.5859 8.3731 17.2501 8.83333 17.2501H15.1667C15.6269 17.2501 16 17.5859 16 18.0001C16 18.4143 15.6269 18.7501 15.1667 18.7501H8.83333C8.3731 18.7501 8 18.4143 8 18.0001Z" fill="#1C274C"/>
                    <g opacity="0.4">
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600"  d="M8.51005 2.00001H15.4901C15.7226 1.99995 15.9009 1.99991 16.0567 2.01515C17.1645 2.12352 18.0712 2.78958 18.4558 3.68678H5.54443C5.92895 2.78958 6.8357 2.12352 7.94352 2.01515C8.09933 1.99991 8.27757 1.99995 8.51005 2.00001Z" fill="#1C274C"/>
                    </g>
                    <g opacity="0.7">
                    <path class="fill-current text-gray-600 group-hover:text-cyan-600"  d="M6.31069 4.72266C4.92007 4.72266 3.7798 5.56241 3.39927 6.67645C3.39134 6.69967 3.38374 6.72302 3.37646 6.74647C3.77461 6.6259 4.18898 6.54713 4.60845 6.49336C5.68882 6.35485 7.05416 6.35492 8.64019 6.35501L8.75863 6.35501L15.5323 6.35501C17.1183 6.35492 18.4837 6.35485 19.564 6.49336C19.9835 6.54713 20.3979 6.6259 20.796 6.74647C20.7887 6.72302 20.7811 6.69967 20.7732 6.67645C20.3927 5.56241 19.2524 4.72266 17.8618 4.72266H6.31069Z" fill="#1C274C"/>
                    </g>
                    </svg>
                    <span class="group-hover:text-gray-700">Library</span>
                </a>
            </li>
                 <li>
                <a :href="route('user.news')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" clip-rule="evenodd" d="M15.6021 2.42216C15.3823 2.20239 15.1058 2.21205 14.9542 2.23217C14.8108 2.25119 14.6391 2.30006 14.4755 2.34661L14.3495 2.38242L14.2471 2.31779C14.1085 2.23026 13.9596 2.13623 13.8272 2.07867C13.6778 2.01375 13.4257 1.93989 13.1608 2.07911C12.901 2.21567 12.8154 2.46014 12.7801 2.61571C12.7479 2.75726 12.7341 2.93427 12.7211 3.10261L12.7111 3.23012L12.7103 3.24075L12.5987 3.33259C12.4654 3.44226 12.3271 3.55608 12.229 3.66333C12.125 3.77695 11.9648 3.99043 12.0055 4.28767C12.0476 4.59506 12.2702 4.75445 12.4093 4.83159C12.5353 4.90144 12.701 4.96261 12.8556 5.01961L12.9644 5.05983L13.0046 5.1687C13.0616 5.3232 13.1228 5.489 13.1927 5.61495C13.2698 5.75405 13.4292 5.97665 13.7366 6.01874C14.0338 6.05944 14.2473 5.8992 14.3609 5.79528C14.4682 5.69717 14.582 5.55884 14.6917 5.42554L14.7835 5.31397L14.7941 5.31313L14.9216 5.30319C15.09 5.29011 15.267 5.27635 15.4085 5.24417C15.5641 5.2088 15.8086 5.12329 15.9451 4.86346C16.0844 4.59857 16.0105 4.34645 15.9456 4.19709C15.888 4.06467 15.794 3.9158 15.7065 3.77723L15.6418 3.67478L15.6776 3.54877C15.7242 3.38517 15.7731 3.21343 15.7921 3.07009C15.8122 2.91841 15.8219 2.64192 15.6021 2.42216Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M10.1867 2.16087C10.5401 2.37692 10.6515 2.83856 10.4354 3.19196C10.2786 3.44841 10.3179 3.77888 10.5305 3.99142L10.6283 4.0893C11.217 4.67795 11.4341 5.54273 11.1932 6.3396C11.0733 6.7361 10.6548 6.96036 10.2583 6.84051C9.86176 6.72066 9.6375 6.30208 9.75735 5.90558C9.83823 5.638 9.76534 5.34762 9.56768 5.14996L9.4698 5.05208C8.76728 4.34955 8.6374 3.25725 9.15561 2.40958C9.37166 2.05618 9.83329 1.94483 10.1867 2.16087Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M21.4091 13.5812C21.0474 13.4231 20.6268 13.4895 20.3314 13.7514C19.5221 14.469 18.3445 14.5883 17.4078 14.0475L17.195 13.9246C16.8362 13.7175 16.7133 13.2588 16.9204 12.9001C17.1275 12.5414 17.5862 12.4185 17.945 12.6256L18.1578 12.7484C18.5353 12.9664 19.01 12.9184 19.3362 12.6291C20.069 11.9793 21.1126 11.8145 22.0101 12.2068L22.3015 12.3343C22.6811 12.5002 22.8542 12.9424 22.6883 13.3219C22.5223 13.7015 22.0801 13.8746 21.7006 13.7087L21.4091 13.5812Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M12.9163 7.17885C12.7068 6.96938 12.3672 6.96938 12.1577 7.17885C11.9483 7.38832 11.9483 7.72793 12.1577 7.9374C12.3672 8.14687 12.7068 8.14687 12.9163 7.9374C13.1257 7.72793 13.1257 7.38832 12.9163 7.17885Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" clip-rule="evenodd" d="M22.5242 8.86414C22.7801 9.41805 22.6074 10.0469 22.1403 10.514C21.8694 10.7849 21.5064 10.9076 21.1831 10.9651C20.8524 11.0239 20.5029 11.0251 20.1966 11.0055C19.8874 10.9857 19.6038 10.9434 19.3988 10.9066C19.2957 10.888 19.2112 10.8707 19.1516 10.8577C19.1218 10.8512 19.0982 10.8458 19.0815 10.8419L19.0617 10.8372L19.0559 10.8358L19.0541 10.8354L19.053 10.8351C18.8729 10.7905 18.7323 10.65 18.6877 10.4699L19.1731 10.3498C18.6877 10.4699 18.6875 10.4688 18.6875 10.4688L18.687 10.4669L18.6856 10.4611L18.6809 10.4414C18.677 10.4247 18.6716 10.401 18.6652 10.3712C18.6522 10.3116 18.6348 10.2271 18.6163 10.1241C18.5795 9.91904 18.5372 9.63547 18.5174 9.32622C18.4978 9.01998 18.4989 8.67041 18.5578 8.33971C18.6152 8.01645 18.7379 7.65343 19.0088 7.38256C19.476 6.91542 20.1048 6.74276 20.6587 6.99861C21.0789 7.19269 21.3522 7.58546 21.4551 8.06776C21.9374 8.17068 22.3302 8.44397 22.5242 8.86414Z" fill="#1C274C"/>
                        <g opacity="0.5">
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M17.69 4.74357C18.0962 4.8248 18.3596 5.21992 18.2784 5.62609L18.1344 6.34603C17.9362 7.33684 17.2224 8.14551 16.2638 8.46504C15.8159 8.61435 15.4823 8.99222 15.3897 9.4552L15.2457 10.1751C15.1645 10.5813 14.7693 10.8447 14.3632 10.7635C13.957 10.6822 13.6936 10.2871 13.7748 9.88096L13.9188 9.16103C14.117 8.17021 14.8308 7.36154 15.7894 7.04201C16.2374 6.89271 16.5709 6.51484 16.6635 6.05185L16.8075 5.33192C16.8887 4.92575 17.2839 4.66233 17.69 4.74357Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M6.92859 3.96277C7.13805 3.7533 7.47767 3.7533 7.68714 3.96277C7.89661 4.17223 7.89661 4.51185 7.68714 4.72132C7.47767 4.93079 7.13805 4.93079 6.92859 4.72132C6.71912 4.51185 6.71912 4.17223 6.92859 3.96277Z" fill="#1C274C"/>
                        </g>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" opacity="0.7" d="M19.817 15.3353C19.6076 15.1259 19.2679 15.1259 19.0585 15.3353C18.849 15.5448 18.849 15.8844 19.0585 16.0939C19.2679 16.3033 19.6076 16.3033 19.817 16.0939C20.0265 15.8844 20.0265 15.5448 19.817 15.3353Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" opacity="0.2" d="M17.1581 10.1791C17.3675 9.96961 17.7072 9.96961 17.9166 10.1791C18.1261 10.3885 18.1261 10.7282 17.9166 10.9376C17.7072 11.1471 17.3675 11.1471 17.1581 10.9376C16.9486 10.7282 16.9486 10.3885 17.1581 10.1791Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" opacity="0.5" d="M4.01207 15.7618L5.70156 10.6933C6.46758 8.39525 6.85059 7.24623 7.75684 7.03229C8.6631 6.81835 9.51953 7.67478 11.2324 9.38764L14.6114 12.7666C16.3242 14.4795 17.1807 15.3359 16.9667 16.2422C16.7528 17.1484 15.6038 17.5314 13.3057 18.2975L8.23724 19.987L8.23723 19.987C5.47182 20.9088 4.08912 21.3697 3.35924 20.6398C2.62936 19.9099 3.09026 18.5272 4.01207 15.7618Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M8.8001 7.50424L8.85072 7.25922C8.45761 7.02857 8.111 6.94867 7.75679 7.03229C7.61235 7.06638 7.4812 7.12423 7.35967 7.2067L8.05611 7.35058C7.57757 7.25172 7.41498 7.21808 7.35967 7.2067C7.34804 7.2146 7.3364 7.22279 7.32494 7.23114L7.31964 7.25736C7.31242 7.29328 7.30199 7.34575 7.28885 7.41325C7.26258 7.54824 7.22547 7.74345 7.18165 7.98662C7.09406 8.47264 6.97937 9.15184 6.87078 9.92573C6.65564 11.4589 6.45638 13.4179 6.55904 14.9834C6.62115 15.9306 6.81822 17.1057 6.9941 18.0238C7.08286 18.4872 7.16784 18.8933 7.23066 19.1838C7.26209 19.3291 7.28803 19.4457 7.30619 19.5264L7.32733 19.6195L7.333 19.6441L7.33493 19.6525C7.33494 19.6526 7.33512 19.6533 8.0656 19.4833L7.33493 19.6525L7.47191 20.2412C7.71447 20.1612 7.96933 20.0762 8.23717 19.987L8.90132 19.7656L8.79453 19.3066L8.78944 19.2845L8.76953 19.1968C8.75221 19.1199 8.7272 19.0075 8.69676 18.8667C8.63584 18.585 8.55336 18.1909 8.46732 17.7416C8.29357 16.8346 8.11155 15.7351 8.05582 14.8852C7.96377 13.4814 8.1436 11.6495 8.35623 10.1342C8.46152 9.38377 8.57288 8.72427 8.65787 8.25265C8.70034 8.017 8.73615 7.82867 8.76123 7.69981C8.77376 7.63539 8.78361 7.58587 8.79026 7.55277L8.79777 7.51563L8.7996 7.50665L8.8001 7.50424Z" fill="#1C274C"/>
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M13.0393 18.3863L11.6162 18.8606L11.5238 18.5826L12.2356 18.3461C11.5238 18.5826 11.5239 18.5827 11.5238 18.5826L11.5229 18.5798L11.5209 18.5738L11.5138 18.552C11.5077 18.5333 11.499 18.5064 11.4881 18.472C11.4663 18.4031 11.4354 18.3042 11.3986 18.1811C11.325 17.9354 11.227 17.5917 11.1288 17.1985C10.9367 16.4293 10.7274 15.407 10.7274 14.5552C10.7274 13.7034 10.9367 12.6811 11.1288 11.9119C11.227 11.5187 11.325 11.175 11.3986 10.9293C11.4354 10.8062 11.4663 10.7073 11.4881 10.6384C11.499 10.604 11.5077 10.5771 11.5138 10.5584L11.5209 10.5366L11.5229 10.5305L11.5235 10.5287C11.5235 10.5287 11.5238 10.5278 12.2356 10.7643L11.5238 10.5278L11.7355 9.89084L12.9224 11.0777C12.921 11.0824 12.9194 11.0872 12.9178 11.0922C12.8982 11.154 12.8698 11.245 12.8356 11.3594C12.767 11.5886 12.6755 11.9095 12.5841 12.2753C12.3971 13.0241 12.2274 13.8973 12.2274 14.5552C12.2274 15.2131 12.3971 16.0863 12.5841 16.8351C12.6755 17.2009 12.767 17.5218 12.8356 17.751C12.8698 17.8654 12.8982 17.9564 12.9178 18.0182C12.9276 18.0491 12.9352 18.0727 12.9403 18.0881L12.9458 18.1052L12.9471 18.109L13.0393 18.3863Z" fill="#1C274C"/>
                        </svg>
                    <span class="group-hover:text-gray-700">News</span>
                </a>
            </li>
        
        </ul>
    </div>

    <div class="px-6 -mx-6 pt-4 flex justify-between items-center border-t">
        <button @click="logout" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="group-hover:text-gray-700">Logout</span>
        </button>
    </div>
</aside>
<div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
    <div class="sticky z-10 top-0 h-16 border-b bg-white lg:py-2.5">
        <div class="px-6 flex items-center justify-between space-x-4 2xl:container">
      
            <button class="w-12 h-16 -mr-2 border-r lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
                  <h5  class="text-xl text-[#232325] font-bold uppercase lg:block " 
            style="font-family: -apple-system,system-ui,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,sans-serif;"
            >{{ title }}</h5>
            <div class="flex space-x-4">
                <!--search bar -->
                <div hidden class="md:block">
                    <div class="relative flex items-center text-gray-400 focus-within:text-cyan-400">
                        <span class="absolute left-4 h-6 flex items-center pr-3 border-r border-gray-300">
                        <svg xmlns="http://ww50w3.org/2000/svg" class="w-4 fill-current" viewBox="0 0 35.997 36.004">
                            <path id="Icon_awesome-search" data-name="search" d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z"></path>
                        </svg>
                        </span>
                        <input type="search" name="leadingIcon" id="leadingIcon" placeholder="Search here" class="w-full pl-14 pr-4 py-2.5 rounded-xl text-sm text-gray-600 outline-none border border-gray-300 focus:border-cyan-300 transition">
                    </div>
                </div>
                <!--/search bar -->
                <button aria-label="search" class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200 md:hidden">
                    <svg xmlns="http://ww50w3.org/2000/svg" class="w-4 mx-auto fill-current text-gray-600" viewBox="0 0 35.997 36.004">
                        <path id="Icon_awesome-search" data-name="search" d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z"></path>
                    </svg>
                </button>
                <button aria-label="chat" class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-auto text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                </button>
                <button aria-label="notification" class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-auto text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


    <!-- <div class="px-6 pt-6 2xl:container">
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <div class="md:col-span-2 lg:col-span-1" >
                <div class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white">
                    <svg class="w-40 m-auto opacity-75" viewBox="0 0 146 146" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M73.1866 5.7129C81.999 5.7129 90.725 7.44863 98.8666 10.821C107.008 14.1933 114.406 19.1363 120.637 25.3675C126.868 31.5988 131.811 38.9964 135.184 47.138C138.556 55.2796 140.292 64.0057 140.292 72.818C140.292 81.6304 138.556 90.3565 135.184 98.4981C131.811 106.64 126.868 114.037 120.637 120.269C114.406 126.5 107.008 131.443 98.8666 134.815C90.725 138.187 81.999 139.923 73.1866 139.923C64.3742 139.923 55.6481 138.187 47.5066 134.815C39.365 131.443 31.9674 126.5 25.7361 120.269C19.5048 114.037 14.5619 106.64 11.1895 98.4981C7.81717 90.3565 6.08144 81.6304 6.08144 72.818C6.08144 64.0057 7.81717 55.2796 11.1895 47.138C14.5619 38.9964 19.5048 31.5988 25.7361 25.3675C31.9674 19.1363 39.365 14.1933 47.5066 10.821C55.6481 7.44863 64.3742 5.7129 73.1866 5.7129L73.1866 5.7129Z" stroke="#e4e4f2" stroke-width="4.89873"/>
                        <path d="M73.5 23.4494C79.9414 23.4494 86.3198 24.7181 92.2709 27.1831C98.222 29.6482 103.629 33.2612 108.184 37.816C112.739 42.3707 116.352 47.778 118.817 53.7291C121.282 59.6802 122.551 66.0586 122.551 72.5C122.551 78.9414 121.282 85.3198 118.817 91.2709C116.352 97.222 112.739 102.629 108.184 107.184C103.629 111.739 98.222 115.352 92.2709 117.817C86.3198 120.282 79.9414 121.551 73.5 121.551C67.0586 121.551 60.6802 120.282 54.7291 117.817C48.778 115.352 43.3707 111.739 38.816 107.184C34.2612 102.629 30.6481 97.222 28.1831 91.2709C25.7181 85.3198 24.4494 78.9414 24.4494 72.5C24.4494 66.0586 25.7181 59.6802 28.1831 53.7291C30.6481 47.778 34.2612 42.3707 38.816 37.816C43.3707 33.2612 48.778 29.6481 54.7291 27.1831C60.6802 24.7181 67.0586 23.4494 73.5 23.4494L73.5 23.4494Z" stroke="#e4e4f2" stroke-width="4.89873"/>
                        <path d="M73 24C84.3364 24 95.3221 27.9307 104.085 35.1225C112.848 42.3142 118.847 52.322 121.058 63.4406C123.27 74.5592 121.558 86.1006 116.214 96.0984C110.87 106.096 102.225 113.932 91.7515 118.27C81.278 122.608 69.6243 123.181 58.7761 119.89C47.9278 116.599 38.5562 109.649 32.258 100.223C25.9598 90.7971 23.1248 79.479 24.2359 68.1972C25.3471 56.9153 30.3357 46.3678 38.3518 38.3518" stroke="url(#paint0_linear_622:13617)" stroke-width="10" stroke-linecap="round"/>
                        <path d="M73 5.00001C84.365 5.00001 95.5488 7.84852 105.529 13.2852C115.509 18.7218 123.968 26.5732 130.131 36.1217C136.295 45.6702 139.967 56.6112 140.812 67.9448C141.657 79.2783 139.648 90.6429 134.968 101C130.288 111.357 123.087 120.375 114.023 127.232C104.96 134.088 94.3218 138.563 83.0824 140.248C71.8431 141.933 60.3606 140.775 49.6845 136.878C39.0085 132.981 29.4793 126.471 21.9681 117.942" stroke="url(#paint1_linear_622:13617)" stroke-width="10" stroke-linecap="round"/>
                        <path d="M9.60279 97.5926C6.37325 89.2671 4.81515 80.3871 5.01745 71.4595C5.21975 62.5319 7.1785 53.7316 10.7818 45.561C14.3852 37.3904 19.5626 30.0095 26.0184 23.8398C32.4742 17.6701 40.082 12.8323 48.4075 9.6028" stroke="url(#paint2_linear_622:13617)" stroke-width="10" stroke-linecap="round"/>
                        <path d="M73 5.00001C86.6504 5.00001 99.9849 9.10831 111.269 16.7904" stroke="url(#paint3_linear_622:13617)" stroke-width="10" stroke-linecap="round"/>
                        <circle cx="73.5" cy="72.5" r="29" fill="#e4e4f2" stroke="#e4e4f2"/>
                        <path d="M74 82.8332C68.0167 82.8332 63.1666 77.9831 63.1666 71.9998C63.1666 66.0166 68.0167 61.1665 74 61.1665C79.9832 61.1665 84.8333 66.0166 84.8333 71.9998C84.8333 77.9831 79.9832 82.8332 74 82.8332ZM74 80.6665C76.2985 80.6665 78.5029 79.7534 80.1282 78.1281C81.7535 76.5028 82.6666 74.2984 82.6666 71.9998C82.6666 69.7013 81.7535 67.4969 80.1282 65.8716C78.5029 64.2463 76.2985 63.3332 74 63.3332C71.7014 63.3332 69.497 64.2463 67.8717 65.8716C66.2464 67.4969 65.3333 69.7013 65.3333 71.9998C65.3333 74.2984 66.2464 76.5028 67.8717 78.1281C69.497 79.7534 71.7014 80.6665 74 80.6665ZM70.75 67.6665H77.25L79.9583 71.4582L74 77.4165L68.0416 71.4582L70.75 67.6665ZM71.8658 69.8332L70.8691 71.2307L74 74.3615L77.1308 71.2307L76.1341 69.8332H71.8658Z" fill="#6A6A9F"/>
                        <defs>
                        <linearGradient id="paint0_linear_622:13617" x1="45.9997" y1="19" x2="46.0897" y2="124.308" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E323FF"/>
                        <stop offset="1" stop-color="#7517F8"/>
                        </linearGradient>
                        <linearGradient id="paint1_linear_622:13617" x1="1.74103e-06" y1="8.70228e-06" x2="6.34739e-08" y2="140.677" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#4DFFDF"/>
                        <stop offset="1" stop-color="#4DA1FF"/>
                        </linearGradient>
                        <linearGradient id="paint2_linear_622:13617" x1="36.4997" y1="5.07257e-06" x2="36.6213" y2="142.36" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FFD422"/>
                        <stop offset="1" stop-color="#FF7D05"/>
                        </linearGradient>
                        <linearGradient id="paint3_linear_622:13617" x1="1.74103e-06" y1="8.70228e-06" x2="6.34739e-08" y2="140.677" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#4DFFDF"/>
                        <stop offset="1" stop-color="#4DA1FF"/>
                        </linearGradient>
                        </defs>
                    </svg>
                    <div>
                        <h5 class="text-xl text-gray-600 text-center">Global Activities</h5>
                        <div class="mt-2 flex justify-center gap-4">
                            <h3 class="text-3xl font-bold text-gray-700">$23,988</h3>
                            <div class="flex items-end gap-1 text-green-500">
                                <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                                </svg>
                                <span>2%</span>
                            </div>
                        </div>
                        <span class="block text-center text-gray-500">Compared to last week $13,988</span>
                    </div>
                    <table class="w-full text-gray-600">
                        <tbody>
                            <tr>
                                <td class="py-2">Tailored ui</td>
                                <td class="text-gray-500">896</td>
                                <td>
                                    <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.4" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="19" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="35" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="51" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <path d="M0 7C8.62687 7 7.61194 16 17.7612 16C27.9104 16 25.3731 9 34 9C42.6269 9 44.5157 5 51.2537 5C57.7936 5 59.3731 14.5 68 14.5" stroke="url(#paint0_linear_622:13631)" stroke-width="2" stroke-linejoin="round"/>
                                        <defs>
                                        <linearGradient id="paint0_linear_622:13631" x1="68" y1="7.74997" x2="1.69701" y2="8.10029" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#E323FF"/>
                                        <stop offset="1" stop-color="#7517F8"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                </td>   
                            </tr>
                            <tr>
                                <td class="py-2">Customize</td>
                                <td class="text-gray-500">1200</td>
                                <td>
                                    <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.4" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="19" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="35" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="51" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <path d="M0 12.929C8.69077 12.929 7.66833 9.47584 17.8928 9.47584C28.1172 9.47584 25.5611 15.9524 34.2519 15.9524C42.9426 15.9524 44.8455 10.929 51.6334 10.929C58.2217 10.929 59.3092 5 68 5" stroke="url(#paint0_linear_622:13640)" stroke-width="2" stroke-linejoin="round"/>
                                        <defs>
                                        <linearGradient id="paint0_linear_622:13640" x1="34" y1="5" x2="34" y2="15.9524" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#8AFF6C"/>
                                        <stop offset="1" stop-color="#02C751"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                </td>   
                            </tr>
                            <tr>
                                <td class="py-2">Other</td>
                                <td class="text-gray-500">12</td>
                                <td>
                                    <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.4" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="19" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="35" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="51" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <path d="M0 6C8.62687 6 6.85075 12.75 17 12.75C27.1493 12.75 25.3731 9 34 9C42.6269 9 42.262 13.875 49 13.875C55.5398 13.875 58.3731 6 67 6" stroke="url(#paint0_linear_622:13649)" stroke-width="2" stroke-linejoin="round"/>
                                        <defs>
                                        <linearGradient id="paint0_linear_622:13649" x1="67" y1="7.96873" x2="1.67368" y2="8.44377" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FFD422"/>
                                        <stop offset="1" stop-color="#FF7D05"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                </td>   
                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div>
            <div>
                <div class="h-full py-6 px-6 rounded-xl border border-gray-200 bg-white">
                    <h5 class="text-xl text-gray-700">Downloads</h5>
                    <div class="my-8">
                        <h1 class="text-5xl font-bold text-gray-800">64,5%</h1>
                        <span class="text-gray-500">Compared to last week $13,988</span>
                    </div>
                    <svg class="w-full" viewBox="0 0 218 69" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 67.5C27.8998 67.5 24.6002 15 52.5 15C80.3998 15 77.1002 29 105 29C132.9 29 128.6 52 156.5 52C184.4 52 189.127 63.8158 217.027 63.8158" stroke="url(#paint0_linear_622:13664)" stroke-width="3" stroke-linecap="round"/>
                        <path d="M0 67.5C27.2601 67.5 30.7399 31 58 31C85.2601 31 80.7399 2 108 2C135.26 2 134.74 43 162 43C189.26 43 190.74 63.665 218 63.665" stroke="url(#paint1_linear_622:13664)" stroke-width="3" stroke-linecap="round"/>
                        <defs>
                        <linearGradient id="paint0_linear_622:13664" x1="217.027" y1="15" x2="7.91244" y2="15" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#4DFFDF"/>
                        <stop offset="1" stop-color="#4DA1FF"/>
                        </linearGradient>
                        <linearGradient id="paint1_linear_622:13664" x1="218" y1="18.3748" x2="5.4362" y2="18.9795" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E323FF"/>
                        <stop offset="1" stop-color="#7517F8"/>
                        </linearGradient>
                        </defs>
                    </svg>
                    <table class="mt-6 -mb-2 w-full text-gray-600">
                        <tbody>
                            <tr>
                                <td class="py-2">From new users</td>
                                <td class="text-gray-500">896</td>
                                <td>
                                    <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.4" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="19" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="35" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="51" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <path d="M0 7C8.62687 7 7.61194 16 17.7612 16C27.9104 16 25.3731 9 34 9C42.6269 9 44.5157 5 51.2537 5C57.7936 5 59.3731 14.5 68 14.5" stroke="url(#paint0_linear_622:13631)" stroke-width="2" stroke-linejoin="round"/>
                                        <defs>
                                        <linearGradient id="paint0_linear_622:13631" x1="68" y1="7.74997" x2="1.69701" y2="8.10029" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#E323FF"/>
                                        <stop offset="1" stop-color="#7517F8"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                </td>   
                            </tr>
                            <tr>
                                <td class="py-2">From old users</td>
                                <td class="text-gray-500">1200</td>
                                <td>
                                    <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.4" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="19" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="35" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="51" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <path d="M0 12.929C8.69077 12.929 7.66833 9.47584 17.8928 9.47584C28.1172 9.47584 25.5611 15.9524 34.2519 15.9524C42.9426 15.9524 44.8455 10.929 51.6334 10.929C58.2217 10.929 59.3092 5 68 5" stroke="url(#paint0_linear_622:13640)" stroke-width="2" stroke-linejoin="round"/>
                                        <defs>
                                        <linearGradient id="paint0_linear_622:13640" x1="34" y1="5" x2="34" y2="15.9524" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#8AFF6C"/>
                                        <stop offset="1" stop-color="#02C751"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                </td>   
                            </tr>
                        </tbody>
                    </table>   
                </div>
            </div>
            <div>
                <div class="lg:h-full py-8 px-6 text-gray-600 rounded-xl border border-gray-200 bg-white">
                    <svg class="w-40 m-auto" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27.9985 2.84071C31.2849 2.84071 34.539 3.488 37.5752 4.74562C40.6113 6.00324 43.3701 7.84657 45.6938 10.1703C48.0176 12.4941 49.861 15.2529 51.1186 18.289C52.3762 21.3252 53.0235 24.5793 53.0235 27.8657C53.0235 31.152 52.3762 34.4061 51.1186 37.4423C49.861 40.4785 48.0176 43.2372 45.6938 45.561C43.3701 47.8848 40.6113 49.7281 37.5752 50.9857C34.539 52.2433 31.2849 52.8906 27.9985 52.8906C24.7122 52.8906 21.4581 52.2433 18.4219 50.9857C15.3857 49.7281 12.627 47.8848 10.3032 45.561C7.97943 43.2372 6.1361 40.4785 4.87848 37.4423C3.62086 34.4061 2.97357 31.152 2.97357 27.8657C2.97357 24.5793 3.62086 21.3252 4.87848 18.289C6.13611 15.2529 7.97943 12.4941 10.3032 10.1703C12.627 7.84656 15.3857 6.00324 18.4219 4.74562C21.4581 3.488 24.7122 2.84071 27.9985 2.84071L27.9985 2.84071Z" stroke="#e4e4f2" stroke-width="3"/>
                        <path d="M27.301 2.50958C33.0386 2.35225 38.6614 4.13522 43.26 7.57004C47.8585 11.0049 51.1637 15.8907 52.641 21.437C54.1182 26.9834 53.6811 32.8659 51.4002 38.133C49.1194 43.4001 45.1283 47.7437 40.0726 50.4611C35.0169 53.1785 29.1923 54.1108 23.541 53.1071C17.8897 52.1034 12.7423 49.2225 8.93145 44.9305C5.12062 40.6384 2.86926 35.1861 2.54159 29.4558C2.21391 23.7254 3.82909 18.0521 7.12582 13.3536" stroke="url(#paint0_linear_622:13696)" stroke-width="5" stroke-linecap="round"/>
                        <path d="M13.3279 30.7467C13.3912 29.48 13.8346 28.5047 14.6579 27.8207C15.4939 27.124 16.5896 26.7757 17.9449 26.7757C18.8696 26.7757 19.6612 26.9404 20.3199 27.2697C20.9786 27.5864 21.4726 28.0234 21.8019 28.5807C22.1439 29.1254 22.3149 29.746 22.3149 30.4427C22.3149 31.2407 22.1059 31.9184 21.6879 32.4757C21.2826 33.0204 20.7949 33.3877 20.2249 33.5777V33.6537C20.9596 33.8817 21.5296 34.287 21.9349 34.8697C22.3529 35.4524 22.5619 36.1997 22.5619 37.1117C22.5619 37.8717 22.3846 38.5494 22.0299 39.1447C21.6879 39.74 21.1749 40.2087 20.4909 40.5507C19.8196 40.88 19.0089 41.0447 18.0589 41.0447C16.6276 41.0447 15.4622 40.6837 14.5629 39.9617C13.6636 39.2397 13.1886 38.1757 13.1379 36.7697H15.7219C15.7472 37.3904 15.9562 37.8907 16.3489 38.2707C16.7542 38.638 17.3052 38.8217 18.0019 38.8217C18.6479 38.8217 19.1419 38.6444 19.4839 38.2897C19.8386 37.9224 20.0159 37.4537 20.0159 36.8837C20.0159 36.1237 19.7752 35.579 19.2939 35.2497C18.8126 34.9204 18.0652 34.7557 17.0519 34.7557H16.5009V32.5707H17.0519C18.8506 32.5707 19.7499 31.969 19.7499 30.7657C19.7499 30.221 19.5852 29.7967 19.2559 29.4927C18.9392 29.1887 18.4769 29.0367 17.8689 29.0367C17.2736 29.0367 16.8112 29.2014 16.4819 29.5307C16.1652 29.8474 15.9816 30.2527 15.9309 30.7467H13.3279ZM25.6499 37.9477C26.8659 36.9344 27.8349 36.092 28.5569 35.4207C29.2789 34.7367 29.8806 34.0274 30.3619 33.2927C30.8433 32.558 31.0839 31.836 31.0839 31.1267C31.0839 30.4807 30.9319 29.974 30.6279 29.6067C30.3239 29.2394 29.8553 29.0557 29.2219 29.0557C28.5886 29.0557 28.1009 29.271 27.7589 29.7017C27.4169 30.1197 27.2396 30.696 27.2269 31.4307H24.6429C24.6936 29.9107 25.1433 28.758 25.9919 27.9727C26.8533 27.1874 27.9426 26.7947 29.2599 26.7947C30.7039 26.7947 31.8123 27.181 32.5849 27.9537C33.3576 28.7137 33.7439 29.7207 33.7439 30.9747C33.7439 31.9627 33.4779 32.9064 32.9459 33.8057C32.4139 34.705 31.8059 35.4904 31.1219 36.1617C30.4379 36.8204 29.5449 37.6184 28.4429 38.5557H34.0479V40.7597H24.6619V38.7837L25.6499 37.9477Z" fill="currentColor"/>
                        <path d="M36.1948 28.8842C36.1948 29.4438 36.2557 29.8634 36.3775 30.1432C36.4992 30.423 36.6967 30.5628 36.9699 30.5628C37.5097 30.5628 37.7796 30.0033 37.7796 28.8842C37.7796 27.7717 37.5097 27.2155 36.9699 27.2155C36.6967 27.2155 36.4992 27.3537 36.3775 27.6302C36.2557 27.9067 36.1948 28.3247 36.1948 28.8842ZM38.456 28.8842C38.456 29.6347 38.3293 30.2024 38.0758 30.5875C37.8257 30.9693 37.457 31.1602 36.9699 31.1602C36.5091 31.1602 36.1504 30.9644 35.8936 30.5727C35.6402 30.181 35.5135 29.6182 35.5135 28.8842C35.5135 28.1371 35.6352 27.5742 35.8788 27.1957C36.1257 26.8172 36.4894 26.6279 36.9699 26.6279C37.4472 26.6279 37.8142 26.8238 38.0709 27.2155C38.3276 27.6071 38.456 28.1634 38.456 28.8842ZM40.5395 31.7774C40.5395 32.3402 40.6003 32.7615 40.7221 33.0413C40.8439 33.3178 41.043 33.456 41.3195 33.456C41.596 33.456 41.8001 33.3194 41.9317 33.0462C42.0634 32.7697 42.1292 32.3468 42.1292 31.7774C42.1292 31.2145 42.0634 30.7982 41.9317 30.5283C41.8001 30.2551 41.596 30.1185 41.3195 30.1185C41.043 30.1185 40.8439 30.2551 40.7221 30.5283C40.6003 30.7982 40.5395 31.2145 40.5395 31.7774ZM42.8056 31.7774C42.8056 32.5245 42.6789 33.0906 42.4254 33.4757C42.1753 33.8575 41.8067 34.0484 41.3195 34.0484C40.8521 34.0484 40.4917 33.8526 40.2383 33.4609C39.9881 33.0693 39.8631 32.5081 39.8631 31.7774C39.8631 31.0302 39.9849 30.4674 40.2284 30.0889C40.4753 29.7104 40.839 29.5211 41.3195 29.5211C41.7869 29.5211 42.1506 29.7153 42.4106 30.1037C42.6739 30.4888 42.8056 31.0467 42.8056 31.7774ZM41.5318 26.7316L37.5278 33.9497H36.8021L40.8061 26.7316H41.5318Z" fill="white"/>
                        <path d="M23.5776 18.4198H25.5424V22.8407H23.5776V18.4198ZM30.4545 16.455H32.4193V22.8407H30.4545V16.455ZM27.0161 13.5078H28.9809V22.8407H27.0161V13.5078Z" fill="#6A6A9F"/>
                        <defs>
                        <linearGradient id="paint0_linear_622:13696" x1="5.54791e-07" y1="42.0001" x2="54.6039" y2="41.9535" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E323FF"/>
                        <stop offset="1" stop-color="#7517F8"/>
                        </linearGradient>
                        </defs>
                    </svg>
                    <div class="mt-6">
                        <h5 class="text-xl text-gray-700 text-center">Ask to customize</h5>
                        <div class="mt-2 flex justify-center gap-4">
                            <h3 class="text-3xl font-bold text-gray-700">28</h3>
                            <div class="flex items-end gap-1 text-green-500">
                                <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                                </svg>
                                <span>2%</span>
                            </div>
                        </div>
                        <span class="block text-center text-gray-500">Compared to last week 13</span>
                    </div>
                    <table class="mt-6 -mb-2 w-full text-gray-600">
                        <tbody>
                            <tr>
                                <td class="py-2">Tailored ui</td>
                                <td class="text-gray-500">896</td>
                                <td>
                                    <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.4" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="19" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="35" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="51" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <path d="M0 7C8.62687 7 7.61194 16 17.7612 16C27.9104 16 25.3731 9 34 9C42.6269 9 44.5157 5 51.2537 5C57.7936 5 59.3731 14.5 68 14.5" stroke="url(#paint0_linear_622:13631)" stroke-width="2" stroke-linejoin="round"/>
                                        <defs>
                                        <linearGradient id="paint0_linear_622:13631" x1="68" y1="7.74997" x2="1.69701" y2="8.10029" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#E323FF"/>
                                        <stop offset="1" stop-color="#7517F8"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                </td>   
                            </tr>
                            <tr>
                                <td class="py-2">Customize</td>
                                <td class="text-gray-500">1200</td>
                                <td>
                                    <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.4" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="19" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="35" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="51" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <path d="M0 12.929C8.69077 12.929 7.66833 9.47584 17.8928 9.47584C28.1172 9.47584 25.5611 15.9524 34.2519 15.9524C42.9426 15.9524 44.8455 10.929 51.6334 10.929C58.2217 10.929 59.3092 5 68 5" stroke="url(#paint0_linear_622:13640)" stroke-width="2" stroke-linejoin="round"/>
                                        <defs>
                                        <linearGradient id="paint0_linear_622:13640" x1="34" y1="5" x2="34" y2="15.9524" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#8AFF6C"/>
                                        <stop offset="1" stop-color="#02C751"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                </td>   
                            </tr>
                            <tr>
                                <td class="py-2">Other</td>
                                <td class="text-gray-500">12</td>
                                <td>
                                    <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.4" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="19" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="35" width="14" height="21" rx="1" fill="#e4e4f2"/>
                                        <rect opacity="0.4" x="51" width="17" height="21" rx="1" fill="#e4e4f2"/>
                                        <path d="M0 6C8.62687 6 6.85075 12.75 17 12.75C27.1493 12.75 25.3731 9 34 9C42.6269 9 42.262 13.875 49 13.875C55.5398 13.875 58.3731 6 67 6" stroke="url(#paint0_linear_622:13649)" stroke-width="2" stroke-linejoin="round"/>
                                        <defs>
                                        <linearGradient id="paint0_linear_622:13649" x1="67" y1="7.96873" x2="1.67368" y2="8.44377" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FFD422"/>
                                        <stop offset="1" stop-color="#FF7D05"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                </td>   
                            </tr>
                        </tbody>
                    </table>   
                </div>
            </div>
        </div>
    </div> -->
<div class="px-6 pt-6 2xl:container">
    <slot/>
</div>

</div>
    </div>
</template>
