<template>

    <section class=" py-4 bg-cover bg-center bg-no-repeat  bg-clip-padding backdrop-filter backdrop-blur-sm  " :style="{ backgroundImage: `url(${bgImage})` }">
          <div class="absolute inset-0 bg-black/20 backdrop-blur-sm"></div>
  
  <!-- Content -->
  <div class="relative z-10">
     <div class="flex flex-col items-center justify-center px-6 py-8 sm:py-0 sm:px-0 mx-auto md:h-screen lg:py-0">
            <div
                class="px-4 py-4 mb-4 w-full  bg-white rounded-lg  md:mt-0 sm:max-w-md shadow-lg flex items-center space-x-6 ">
                <div class="">
                    <div class="meteor"> <img class="h-12 w-12 animate-flip" src="images/psu_logo.png" alt="ChitChat Logo"></div>

                </div>
                <div>
                    <div class="text-sm md:text-xl text-blue-950 font-black font-sans uppercase">Partido State
                        University</div>
                    <p class="text-slate-500 text-xs md:text-sm ">Human Resource Management System</p>
                </div>
            </div>


            <div class="max-w-screen-xl md:px-106 pb-4 mx-auto lg:pb-4 py-4">
                <div class=" grid grid-cols-6 place-items-stretch gap-1 text-gray-500 dark:text-gray-400">
                    <div class="parent col-span-3 md:col-span-2 ">

 <div class="card bg-linear-to-r from-gray-400 to-gray-300 mx-auto">
                            <div class="glass px-2 place-content-center transition-transform transform hover:scale-105">
                                <div class="content flex flex-col items-center justify-center h-full w-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-size size-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
</svg>



                                    <span class="title text-blue-950 text-center">Employee Profile</span>
                                </div>
                            </div>
                        </div> 

                    
                    </div>
                    <div class="parent col-span-3 md:col-span-2">
                        <div class="card bg-linear-to-r from-gray-400 to-gray-300 mx-auto">
                                                      <div class="glass px-2 place-content-center transition-transform transform hover:scale-105">

                                <div class="content flex flex-col items-center justify-center h-full w-full">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-size size-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>


                                    <span class="title text-blue-950 text-center">Timesheets Managment </span>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div class="parent col-span-3 md:col-span-2">
                          <div class="card bg-linear-to-r from-gray-400 to-gray-300 mx-auto">
                                                  <div class="glass px-2 place-content-center transition-transform transform hover:scale-105">

                                <div class="content flex flex-col items-center justify-center h-full w-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-size size-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
</svg>


                                    <span class="title text-blue-950 text-center">Leave Management</span>
                                </div>
                            </div>
                        </div> 
                    </div>

                    

                    <div class="parent col-span-3 md:col-span-2">
                        <div class="card bg-linear-to-r from-gray-400 to-gray-300 mx-auto">
                                                    <div class="glass px-2 place-content-center transition-transform transform hover:scale-105">

                                <div class="content flex flex-col items-center justify-center h-full w-full">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-size size-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="m9 14.25 6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185ZM9.75 9h.008v.008H9.75V9Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008V13.5Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
</svg>



                                    <span class="title text-blue-950 text-center">Payroll Management </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="parent col-span-3  md:col-span-2">
                         <div class="card bg-linear-to-r from-gray-400 to-gray-300 mx-auto">
                                                       <div class="glass px-2 place-content-center transition-transform transform hover:scale-105">

                                <div class="content flex flex-col items-center justify-center h-full w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-size size-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
</svg>



                                    <span class="title text-blue-950 text-center">Recruitment Management </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="parent col-span-3 md:col-span-2">
                           <div class="card bg-linear-to-r from-gray-400 to-gray-300 mx-auto">
                                                       <div class="glass px-2 place-content-center transition-transform transform hover:scale-105">

                                <div class="content flex flex-col items-center justify-center h-full w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-size size-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
</svg>



                                    <span class="title text-blue-950 text-center">Performanace Management </span>
                                </div>
                            </div>
                        </div>
                       
                         
                    </div>

                    <div class="parent col-span-3 md:col-span-2">
                         <div class="card bg-linear-to-r from-gray-400 to-gray-300 mx-auto">
                                                   <div class="glass px-2 place-content-center transition-transform transform hover:scale-105">

                                <div class="content flex flex-col items-center justify-center h-full w-full">
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-size size-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
</svg>


                                    <span class="title text-blue-950 text-center">Training & Development</span>
                                </div>
                            </div>
                        </div>
                       
                    </div>

                    <div class="parent col-span-4 md:col-span-2">
                         <div class="card bg-linear-to-r from-gray-400 to-gray-300 mx-auto">
                                                       <div class="glass px-2 place-content-center transition-transform transform hover:scale-105">

                                <div class="content flex flex-col items-center justify-center h-full w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-size size-12 mb-2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75-1.5.75a3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0L3 16.5m15-3.379a48.474 48.474 0 0 0-6-.371c-2.032 0-4.034.126-6 .371m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.169c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 0 1 3 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 0 1 6 13.12M12.265 3.11a.375.375 0 1 1-.53 0L12 2.845l.265.265Zm-3 0a.375.375 0 1 1-.53 0L9 2.845l.265.265Zm6 0a.375.375 0 1 1-.53 0L15 2.845l.265.265Z" />
</svg>

                                    <span class="title text-blue-950 text-center">Events Managment</span>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                    <div class="parent col-span-3 md:col-span-2">
                        <div class="card bg-linear-to-r from-gray-400 to-gray-300 mx-auto">
                                                       <div class="glass px-2 bg-gradient-to-t from-indigo-950 via-blue-800 to-blue-800 place-content-center transition-transform transform hover:scale-105">

                                <div class="content flex flex-col items-center justify-center h-full w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="icon-size size-12 mb-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                    </svg>
                                    <span class="title text-blue-950 text-center">Reports</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
  </div>
        
      
    </section>


</template>

<script setup>
import { ref, computed, watch, reactive, onMounted } from 'vue'

import logo from '@/Images/psu_logo.png';
import psu from '@/Images/486575578_1149828820487521_8969542889143746598_n.jpg';
import sevices from '@/Images/services.svg';
import homeicon from '@/Images/home_icon.svg';
import campus1 from '@/Images/Caramoan.png';
import campus2 from '@/Images/goa.jpg';
import campus3 from '@/Images/Lagonoy.png';
import campus4 from '@/Images/Sagnay.png';
import campus5 from '@/Images/Salogon.png';
import campus6 from '@/Images/Sanjose.png';
import campus7 from '@/Images/Tinambac.png';
import bgImage from '@/Images/bg.jpg'; // Adjust the path if necessary






import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
} from '@headlessui/vue'
import {
    ArrowPathIcon,
    Bars3Icon,
    ChartPieIcon,
    CursorArrowRaysIcon,
    FingerPrintIcon,
    SquaresPlusIcon,
    XMarkIcon,
} from '@heroicons/vue/24/outline'
import { ChevronDownIcon, PhoneIcon, PlayCircleIcon } from '@heroicons/vue/20/solid'
import { initFlowbite } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
const products = [
    //   { name: 'Analytics', description: 'Get a better understanding of your traffic', href: '#', icon: ChartPieIcon },
    //   { name: 'Engagement', description: 'Speak directly to your customers', href: '#', icon: CursorArrowRaysIcon },
    //   { name: 'Security', description: 'Your customers’ data will be safe and secure', href: '#', icon: FingerPrintIcon },
    //   { name: 'Integrations', description: 'Connect with third-party tools', href: '#', icon: SquaresPlusIcon },
    //   { name: 'Automations', description: 'Build strategic funnels that will convert', href: '#', icon: ArrowPathIcon },
]
const callsToAction = [
    //   { name: 'Watch demo', href: '#', icon: PlayCircleIcon },
    //   { name: 'Contact sales', href: '#', icon: PhoneIcon },
]

const mobileMenuOpen = ref(false)
</script>
<style scoped>
.icon-size {

    /* Adjust size as needed */
    color: #474749;
    /* Tailwind CSS color for blue-950 */
    margin-bottom: 10px;
    /* Space between icon and title */
}

/* Include your existing styles here */
.parent {
    width: 140px;
    height: 160px;
}

.card {
    height: 100%;
    width: 100%;
    border-radius: 30px;
    transition: all 0.5s ease-in-out;
    transform-style: preserve-3d;
    box-shadow: rgba(5, 71, 17, 0) 40px 50px 25px -40px, rgba(5, 71, 17, 0.2) 0px 25px 25px -5px;
}

.glass {
    transform-style: preserve-3d;
    position: absolute;
    inset: 8px;
    border-radius: 25px;
    background: linear-gradient(0deg, rgba(255, 255, 255, 0.349) 0%, rgba(255, 255, 255, 0.815) 80%);
    transform: translate3d(0px, 0px, 25px);
    border-left: 1px solid white;
    border-bottom: 1px solid white;
    transition: all 0.5s ease-in-out;
}

.content {
    /* width: 100%; */
    transform: translate3d(0, 0, 26px);
}

.content .title {
    display: block;
    padding-top: 10px;
    font-weight: 900;
    font-size: 14px;
    color: #474749;
    /* Ensure the title color matches */
}

.content .text {
    display: block;
    /* color: rgba(0, 137, 78, 0.7647058824); */
    font-size: 15px;
    margin-top: 20px;
}

.bottom {
    padding: 10px 12px;
    transform-style: preserve-3d;
    position: absolute;
    bottom: 20px;
    left: 20px;
    right: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transform: translate3d(0, 0, 26px);
}

.bottom .view-more {
    display: flex;
    align-items: center;
    width: 40%;
    justify-content: flex-end;
    transition: all 0.2s ease-in-out;
}

.bottom .view-more:hover {
    transform: translate3d(0, 0, 10px);
}

.bottom .view-more .view-more-button {
    background: none;
    border: none;
    color: #00c37b;
    font-weight: bolder;
    font-size: 12px;
}

.bottom .view-more .svg {
    fill: none;
    stroke: #00c37b;
    stroke-width: 3px;
    max-height: 15px;
}

.bottom .social-buttons-container {
    display: flex;
    gap: 10px;
    transform-style: preserve-3d;
}

.bottom .social-buttons-container .social-button {
    width: 30px;
    aspect-ratio: 1;
    padding: 5px;
    background: rgb(255, 255, 255);
    border-radius: 50%;
    border: none;
    display: grid;
    place-content: center;
    box-shadow: rgba(5, 71, 17, 0.5) 0px 7px 5px -5px;
}

.bottom .social-buttons-container .social-button:first-child {
    transition: transform 0.2s ease-in-out 0.4s, box-shadow 0.2s ease-in-out 0.4s;
}

.bottom .social-buttons-container .social-button:nth-child(2) {
    transition: transform 0.2s ease-in-out 0.6s, box-shadow 0.2s ease-in-out 0.6s;
}

.bottom .social-buttons-container .social-button:nth-child(3) {
    transition: transform 0.2s ease-in-out 0.8s, box-shadow 0.2s ease-in-out 0.8s;
}

.bottom .social-buttons-container .social-button .svg {
    width: 15px;
    fill: #00894d;
}

.bottom .social-buttons-container .social-button:hover {
    background: black;
}

.bottom .social-buttons-container .social-button:hover .svg {
    /* fill: white; */
}

.bottom .social-buttons-container .social-button:active {
    background: rgb(255, 234, 0);
}

.bottom .social-buttons-container .social-button:active .svg {
    fill: black;
}

.logo {
    position: absolute;
    right: 0;
    top: 0;
    transform-style: preserve-3d;
}

.logo .circle {
    display: block;
    position: absolute;
    aspect-ratio: 1;
    border-radius: 50%;
    top: 0;
    right: 0;
    box-shadow: rgba(100, 100, 111, 0.2) -10px 10px 20px 0px;
    -webkit-backdrop-filter: blur(5px);
    backdrop-filter: blur(5px);
    /* background: rgba(0, 249, 203, 0.2); */
    transition: all 0.5s ease-in-out;
}

.logo .circle1 {
    width: 170px;
    transform: translate3d(0, 0, 20px);
    top: 8px;
    right: 8px;
}

.logo .circle2 {
    width: 140px;
    transform: translate3d(0, 0, 40px);
    top: 10px;
    right: 10px;
    -webkit-backdrop-filter: blur(1px);
    backdrop-filter: blur(1px);
    transition-delay: 0.4s;
}

.logo .circle3 {
    width: 110px;
    transform: translate3d(0, 0, 60px);
    top: 17px;
    right: 17px;
    transition-delay: 0.8s;
}

.logo .circle4 {
    width: 80px;
    transform: translate3d(0, 0, 80px);
    top: 23px;
    right: 23px;
    transition-delay: 1.2s;
}

.logo .circle5 {
    width: 50px;
    transform: translate3d(0, 0, 100px);
    top: 30px;
    right: 30px;
    display: grid;
    place-content: center;
    transition-delay: 1.6s;
}

.logo .circle5 .svg {
    width: 20px;
    /* fill: white; */
}

.parent:hover .card {
    /* transform: rotate3d(1, 1, 0, 30deg);
    box-shadow: rgba(5, 71, 17, 0.3) 30px 50px 25px -40px, rgba(5, 71, 17, 0.1) 0px 25px 30px 0px; */
}

.parent:hover .card .bottom .social-buttons-container .social-button {
    transform: translate3d(0, 0, 50px);
    box-shadow: rgba(5, 71, 17, 0.2) -5px 20px 10px 0px;
}

.parent:hover .card .logo .circle2 {
    transform: translate3d(0, 0, 60px);
}

.parent:hover .card .logo .circle3 {
    transform: translate3d(0, 0, 80px);
}

.parent:hover .card .logo .circle4 {
    transform: translate3d(0, 0, 100px);
}

.parent:hover .card .logo .circle5 {
    transform: translate3d(0, 0, 120px);
}
</style>
<style scoped>
.button1 {

    font-size: 16px;
    /* background: transparent; */
    border: none;
    position: relative;
    color: #f0f0f0;
    cursor: pointer;
    z-index: 1;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    transition: 0.3s ease-in-out;
}

.button1:hover {
    box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
}

.button1::after,
.button1::before {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    z-index: -99999;
    transition: all .4s;
}

.button1::before {
    transform: translate(0%, 0%);
    width: 100%;
    height: 100%;
    /* background-color: #4158D0; */
    /* background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%); */
    border-radius: 10px;
}

.button1::after {
    transform: translate(10px, 10px);
    /* width: 20px;
    height: 20px; */
    background: #6804da2f;
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border-radius: 50px;
}

.button1:hover::before {
    transform: translate(5%, 20%);
    width: 110%;
    height: 110%;
}

.button1:hover::after {
    border-radius: 10px;
    transform: translate(0, 0);
    width: 100%;
    height: 100%;
}

.button1:active::after {
    transition: 0s;
    transform: translate(0, 5%);
}
</style>