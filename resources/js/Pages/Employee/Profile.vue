<script setup>
// import AppLayout from '@/Layouts/MyLayout.vue';
import AppLayout from '@/Layouts/AdminLayout.vue';
import { router, usePage, Link, Head, usePoll } from '@inertiajs/vue3'
import { ref, computed, watch, reactive, onMounted } from 'vue'
const { props } = usePage();
import profileMale from '../../../images/profile_male2.png';

const employee = {
  name: 'Aldwin Seboguero',
  position: 'Information System Analyst I',
}
</script>
<style lang="css" scoped>
.after-effect {
  position: relative;
  display: inline-block;
  --tw-gradient-from: #fa5252;
  --tw-gradient-to: rgba(250, 82, 82, 0);
  --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
  --tw-gradient-to: #dd2476;
  font-family: Roboto Slab, serif;
  font-size: 2.5rem;
  font-weight: 700;
}

.after-effect,
.after-effect::after {
  transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
}

.after-effect::after {
  position: absolute;
  top: 50%;
  height: .125rem;
  --tw-translate-y: -50%;
  border-radius: .375rem;
  background-image: linear-gradient(to right, var(--tw-gradient-stops));
  --tw-content: "";
  content: var(--tw-content);
}

.socialbtn {
  display: flex;
  height: 2.5rem;
  width: 2.5rem;
  align-items: center;
  justify-content: center;
  border-radius: .5rem;
  --tw-bg-opacity: 1;
  background-color: rgb(243 246 246/var(--tw-bg-opacity));
  --tw-gradient-from: #fa5252;
  --tw-gradient-to: rgba(250, 82, 82, 0);
  --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
  --tw-gradient-to: #dd2476;
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
  transition-duration: .3s;
  transition-timing-function: cubic-bezier(.4, 0, .2, 1);
}
</style>
<template>
  <AppLayout title="My Profile">


    <div class="container grid grid-cols-12 md:gap-12 justify-between">
      <div class="col-span-12 lg:col-span-4 lg:h-screen lg:sticky  top-20">

        <div class="bg-white  rounded shadow-xl w-full md:full overflow-hidden">
          
          <div class="h-[140px] bg-gradient-to-r from-cyan-500 to-blue-500"></div>
          <div class="px-5 py-2 flex flex-col gap-3 pb-6">
            <div class="h-[90px] shadow-md w-[90px] rounded-full border-4 overflow-hidden -mt-14 border-white bg-white">
              <img :src="profileMale" class="w-full h-full rounded-full object-center object-cover">
            </div>
            <div class="">
              <h3 class="text-xl text-slate-900 relative font-bold leading-6">{{ props.employee.full_name }}</h3>
              <p class="text-sm text-gray-600">{{ props.employee.position }}</p>
              <!-- <p class="text-sm text-gray-600">@daddasoft</p> -->
            </div>

            <div class="flex gap-4 flex-wrap">
              <!-- <span class="rounded-sm bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-800">Developer</span>
      <span class="rounded-sm bg-green-100 px-3 py-1 text-xs font-medium text-green-800">Design</span>
      <span class="rounded-sm bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800">Managements</span>
      <span class="rounded-sm bg-indigo-100 px-3 py-1 text-xs font-medium text-indigo-800">Projects</span>
       -->
              <div class="flex justify-center space-x-3"><a href="https://www.facebook.com/" target="_blank"
                  rel="noopener noreferrer"><span
                    class="socialbtn text-[#1773EA] transition-all duration-300 ease-in-out dark:hover:text-white dark:bg-[#212425] hover:text-white hover:bg-gradient-to-r from-[#FA5252] to-[#DD2476]"><svg
                      stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 320 512" height="1em"
                      width="1em" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                      </path>
                    </svg></span></a><a href="https://twitter.com/" target="_blank" rel="noopener noreferrer"><span
                    class="socialbtn text-[#1C9CEA] transition-all duration-300 ease-in-out dark:hover:text-white dark:bg-[#212425] hover:text-white hover:bg-gradient-to-r from-[#FA5252] to-[#DD2476]"><svg
                      stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em"
                      width="1em" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                      </path>
                    </svg></span></a><a href="https://dribbble.com/" target="_blank" rel="noopener noreferrer"><span
                    class="socialbtn text-[#e14a84] transition-all duration-300 ease-in-out dark:hover:text-white dark:bg-[#212425] hover:text-white hover:bg-gradient-to-r from-[#FA5252] to-[#DD2476]"><svg
                      stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em"
                      width="1em" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M256 8C119.252 8 8 119.252 8 256s111.252 248 248 248 248-111.252 248-248S392.748 8 256 8zm163.97 114.366c29.503 36.046 47.369 81.957 47.835 131.955-6.984-1.477-77.018-15.682-147.502-6.818-5.752-14.041-11.181-26.393-18.617-41.614 78.321-31.977 113.818-77.482 118.284-83.523zM396.421 97.87c-3.81 5.427-35.697 48.286-111.021 76.519-34.712-63.776-73.185-116.168-79.04-124.008 67.176-16.193 137.966 1.27 190.061 47.489zm-230.48-33.25c5.585 7.659 43.438 60.116 78.537 122.509-99.087 26.313-186.36 25.934-195.834 25.809C62.38 147.205 106.678 92.573 165.941 64.62zM44.17 256.323c0-2.166.043-4.322.108-6.473 9.268.19 111.92 1.513 217.706-30.146 6.064 11.868 11.857 23.915 17.174 35.949-76.599 21.575-146.194 83.527-180.531 142.306C64.794 360.405 44.17 310.73 44.17 256.323zm81.807 167.113c22.127-45.233 82.178-103.622 167.579-132.756 29.74 77.283 42.039 142.053 45.189 160.638-68.112 29.013-150.015 21.053-212.768-27.882zm248.38 8.489c-2.171-12.886-13.446-74.897-41.152-151.033 66.38-10.626 124.7 6.768 131.947 9.055-9.442 58.941-43.273 109.844-90.795 141.978z">
                      </path>
                    </svg></span></a><a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><span
                    class="socialbtn text-[#0072b1] transition-all duration-300 ease-in-out dark:hover:text-white dark:bg-[#212425] hover:text-white hover:bg-gradient-to-r from-[#FA5252] to-[#DD2476]"><svg
                      stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="1em"
                      width="1em" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z">
                      </path>
                    </svg></span></a></div>
            </div>
            <!-- <div class="flex gap-2"><button type="button" class="inline-flex w-auto cursor-pointer select-none appearance-none items-center justify-center space-x-1 rounded border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-800 transition hover:border-gray-300 active:bg-white hover:bg-gray-100 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Send Message</button><button type="button" class="inline-flex w-auto cursor-pointer select-none appearance-none items-center justify-center space-x-1 rounded border border-gray-200 bg-blue-700 px-3 py-2 text-sm font-medium text-white transition hover:border-blue-300 hover:bg-blue-600 active:bg-blue-700 focus:blue-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300">Add to projects</button></div> -->
            <h4 class="text-md font-medium leading-3 mt-2">My Information</h4>
            <div class="flex flex-col gap-1">
                 
             
              <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                <div class="leading-3">
                  <p class=" text-sm text-slate-500 text-slate-700">Gender</p>
                </div>
                <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.gender }}</p>
              </div>
              
              <!-- <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                <div class="leading-3">
                  <p class=" text-sm text-slate-500 text-slate-700">Civil Status</p>
                </div>
                <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.gender }}</p>
              </div> -->
              <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                <div class="leading-3">
                  <p class=" text-sm text-slate-500 text-slate-700">Born</p>
                </div>
                <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.date_of_birth }}</p>
              </div>
              <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                <div class="leading-3">
                  <p class=" text-sm text-slate-500 text-slate-700">Age</p>
                </div>
                <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.age }}</p>
              </div>
              <!-- <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                <div class="leading-3">
                  <p class=" text-sm text-slate-500 text-slate-700">Start Date</p>
                </div>
                <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.start_date }}</p>
              </div>
              <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                <div class="leading-3">
                  <p class=" text-sm text-slate-500 text-slate-700">Employed For</p>
                </div>
                <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.employment_duration }}</p>
              </div> -->
              <!-- <div class="flex items-center gap-3 px-2 py-3 bg-white rounded border w-full "> 
        <div class="leading-3">
          <p class=" text-sm font-bold text-slate-700">Ui Designer</p><span class="text-xs text-slate-600">5 years</span>
        </div>
        <p class="text-sm text-slate-500 self-start ml-auto">As Ui Designer on Front Page</p>
      </div> -->
            </div>


          </div>
        </div>
      </div>
      <div class="col-span-12 lg:col-span-8">
        <header
          class="lg:w-full h-[124px] lg:mt-0 mt-4 lg:block p-[30px] ml-auto mb-10 rounded-[16px] bg-white dark:bg-[#111111] shadow-xl w-full md:full">
          <nav class=" lg:block overflow-x-auto pb-4">
            <ul class="flex">
              <a class="w-full h-20 rounded-[10px] cursor-pointer font-poppins bg-[#F3F6F6] font-medium mx-2.5  px-2  text-xtiny text-gray-lite dark:text-[#A6A6A6] justify-center flex flex-col items-center transition-all duration-300 ease-in-out dark:hover:text-white dark:bg-[#212425] hover:text-white hover:bg-gradient-to-r from-[#FA5252] to-[#DD2476] lg:text-white lg:dark:text-white lg:bg-gradient-to-r from-[#FA5252] to-[#DD2476]"
                href="/home-box-layout/home">
                <span class="text-xl mb-1">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M946.5 505L560.1 118.8l-25.9-25.9a31.5 31.5 0 0 0-44.4 0L77.5 505a63.9 63.9 0 0 0-18.8 46c.4 35.2 29.7 63.3 64.9 63.3h42.5V940h691.8V614.3h43.4c17.1 0 33.2-6.7 45.3-18.8a63.6 63.6 0 0 0 18.7-45.3c0-17-6.7-33.1-18.8-45.2zM568 868H456V664h112v204zm217.9-325.7V868H632V640c0-22.1-17.9-40-40-40H432c-22.1 0-40 17.9-40 40v228H238.1V542.3h-96l370-369.7 23.1 23.1L882 542.3h-96.1z">
                    </path>
                  </svg>
                </span>
                Home
              </a>
              <a class="w-full h-20 rounded-[10px] cursor-pointer font-poppins bg-[#F3F6F6] font-medium mx-2.5  px-2  text-xtiny text-gray-lite dark:text-[#A6A6A6] justify-center flex flex-col items-center transition-all duration-300 ease-in-out dark:hover:text-white dark:bg-[#212425] hover:text-white hover:bg-gradient-to-r from-[#FA5252] to-[#DD2476]"
                href="/home-box-layout/resume">
                <span class="text-xl mb-1">
                  <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M6 6C6 5.44772 6.44772 5 7 5H17C17.5523 5 18 5.44772 18 6C18 6.55228 17.5523 7 17 7H7C6.44771 7 6 6.55228 6 6Z"
                      fill="currentColor"></path>
                    <path
                      d="M6 10C6 9.44771 6.44772 9 7 9H17C17.5523 9 18 9.44771 18 10C18 10.5523 17.5523 11 17 11H7C6.44771 11 6 10.5523 6 10Z"
                      fill="currentColor"></path>
                    <path
                      d="M7 13C6.44772 13 6 13.4477 6 14C6 14.5523 6.44771 15 7 15H17C17.5523 15 18 14.5523 18 14C18 13.4477 17.5523 13 17 13H7Z"
                      fill="currentColor"></path>
                    <path
                      d="M6 18C6 17.4477 6.44772 17 7 17H11C11.5523 17 12 17.4477 12 18C12 18.5523 11.5523 19 11 19H7C6.44772 19 6 18.5523 6 18Z"
                      fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M2 4C2 2.34315 3.34315 1 5 1H19C20.6569 1 22 2.34315 22 4V20C22 21.6569 20.6569 23 19 23H5C3.34315 23 2 21.6569 2 20V4ZM5 3H19C19.5523 3 20 3.44771 20 4V20C20 20.5523 19.5523 21 19 21H5C4.44772 21 4 20.5523 4 20V4C4 3.44772 4.44771 3 5 3Z"
                      fill="currentColor"></path>
                  </svg>
                </span>
                Attachments
              </a>

              <a class="w-full h-20 rounded-[10px] cursor-pointer font-poppins bg-[#F3F6F6] font-medium mx-2.5  px-2  text-xtiny text-gray-lite dark:text-[#A6A6A6] justify-center flex flex-col items-center transition-all duration-300 ease-in-out dark:hover:text-white dark:bg-[#212425] hover:text-white hover:bg-gradient-to-r from-[#FA5252] to-[#DD2476]"
                href="/home-box-layout/contact">
                <span class="text-xl mb-1">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <path fill="none" d="M0 0h24v24H0z"></path>
                      <path
                        d="M3 2h16.005C20.107 2 21 2.898 21 3.99v16.02c0 1.099-.893 1.99-1.995 1.99H3V2zm4 2H5v16h2V4zm2 16h10V4H9v16zm2-4a3 3 0 0 1 6 0h-6zm3-4a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm8-6h2v4h-2V6zm0 6h2v4h-2v-4z">
                      </path>
                    </g>
                  </svg>
                </span>
                Contact
              </a>
              <a class="w-full h-20 rounded-[10px] cursor-pointer font-poppins bg-[#F3F6F6] font-medium mx-2.5  px-2  text-xtiny text-gray-lite dark:text-[#A6A6A6] justify-center flex flex-col items-center transition-all duration-300 ease-in-out dark:hover:text-white dark:bg-[#212425] hover:text-white hover:bg-gradient-to-r from-[#FA5252] to-[#DD2476]"
                href="/home-box-layout/contact">
                <span class="text-xl mb-1">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <path fill="none" d="M0 0h24v24H0z"></path>
                      <path
                        d="M3 2h16.005C20.107 2 21 2.898 21 3.99v16.02c0 1.099-.893 1.99-1.995 1.99H3V2zm4 2H5v16h2V4zm2 16h10V4H9v16zm2-4a3 3 0 0 1 6 0h-6zm3-4a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm8-6h2v4h-2V6zm0 6h2v4h-2v-4z">
                      </path>
                    </g>
                  </svg>
                </span>
                Assets
              </a>
              <a class="w-full h-20 rounded-[10px] cursor-pointer font-poppins bg-[#F3F6F6] font-medium mx-2.5  px-2  text-xtiny text-gray-lite dark:text-[#A6A6A6] justify-center flex flex-col items-center transition-all duration-300 ease-in-out dark:hover:text-white dark:bg-[#212425] hover:text-white hover:bg-gradient-to-r from-[#FA5252] to-[#DD2476]"
                href="/home-box-layout/contact">
                <span class="text-xl mb-1">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <path fill="none" d="M0 0h24v24H0z"></path>
                      <path
                        d="M3 2h16.005C20.107 2 21 2.898 21 3.99v16.02c0 1.099-.893 1.99-1.995 1.99H3V2zm4 2H5v16h2V4zm2 16h10V4H9v16zm2-4a3 3 0 0 1 6 0h-6zm3-4a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm8-6h2v4h-2V6zm0 6h2v4h-2v-4z">
                      </path>
                    </g>
                  </svg>
                </span>
                Trainings
              </a>
              <a class="w-full h-20 rounded-[10px] cursor-pointer font-poppins bg-[#F3F6F6] font-medium mx-2.5  px-2  text-xtiny text-gray-lite dark:text-[#A6A6A6] justify-center flex flex-col items-center transition-all duration-300 ease-in-out dark:hover:text-white dark:bg-[#212425] hover:text-white hover:bg-gradient-to-r from-[#FA5252] to-[#DD2476]"
                href="/home-box-layout/contact">
                <span class="text-xl mb-1">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <path fill="none" d="M0 0h24v24H0z"></path>
                      <path
                        d="M3 2h16.005C20.107 2 21 2.898 21 3.99v16.02c0 1.099-.893 1.99-1.995 1.99H3V2zm4 2H5v16h2V4zm2 16h10V4H9v16zm2-4a3 3 0 0 1 6 0h-6zm3-4a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm8-6h2v4h-2V6zm0 6h2v4h-2v-4z">
                      </path>
                    </g>
                  </svg>
                </span>
                Innovation
              </a>
              <a class="w-full h-20 rounded-[10px] cursor-pointer font-poppins bg-[#F3F6F6] font-medium mx-2.5  px-2  text-xtiny text-gray-lite dark:text-[#A6A6A6] justify-center flex flex-col items-center transition-all duration-300 ease-in-out dark:hover:text-white dark:bg-[#212425] hover:text-white hover:bg-gradient-to-r from-[#FA5252] to-[#DD2476]"
                href="/home-box-layout/works">
                <span class="text-xl mb-1">
                  <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                    stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                    </path>
                    <polyline points="7.5 4.21 12 6.81 16.5 4.21"></polyline>
                    <polyline points="7.5 19.79 7.5 14.6 3 12"></polyline>
                    <polyline points="21 12 16.5 14.6 16.5 19.79"></polyline>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                  </svg>
                </span>
                Extensions
              </a>
              <a class="w-full h-20 rounded-[10px] cursor-pointer font-poppins bg-[#F3F6F6] font-medium mx-2.5 px-2 text-xtiny text-gray-lite dark:text-[#A6A6A6] justify-center flex flex-col items-center transition-all duration-300 ease-in-out dark:hover:text-white dark:bg-[#212425] hover:text-white hover:bg-gradient-to-r from-[#FA5252] to-[#DD2476]"
                href="/home-box-layout/blogs">
                <span class="text-xl mb-1">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M162.4 196c4.8-4.9 6.2-5.1 36.4-5.1 27.2 0 28.1.1 32.1 2.1 5.8 2.9 8.3 7 8.3 13.6 0 5.9-2.4 10-7.6 13.4-2.8 1.8-4.5 1.9-31.1 2.1-16.4.1-29.5-.2-31.5-.8-10.3-2.9-14.1-17.7-6.6-25.3zm61.4 94.5c-53.9 0-55.8.2-60.2 4.1-3.5 3.1-5.7 9.4-5.1 13.9.7 4.7 4.8 10.1 9.2 12 2.2 1 14.1 1.7 56.3 1.2l47.9-.6 9.2-1.5c9-5.1 10.5-17.4 3.1-24.4-5.3-4.7-5-4.7-60.4-4.7zm223.4 130.1c-3.5 28.4-23 50.4-51.1 57.5-7.2 1.8-9.7 1.9-172.9 1.8-157.8 0-165.9-.1-172-1.8-8.4-2.2-15.6-5.5-22.3-10-5.6-3.8-13.9-11.8-17-16.4-3.8-5.6-8.2-15.3-10-22C.1 423 0 420.3 0 256.3 0 93.2 0 89.7 1.8 82.6 8.1 57.9 27.7 39 53 33.4c7.3-1.6 332.1-1.9 340-.3 21.2 4.3 37.9 17.1 47.6 36.4 7.7 15.3 7-1.5 7.3 180.6.2 115.8 0 164.5-.7 170.5zm-85.4-185.2c-1.1-5-4.2-9.6-7.7-11.5-1.1-.6-8-1.3-15.5-1.7-12.4-.6-13.8-.8-17.8-3.1-6.2-3.6-7.9-7.6-8-18.3 0-20.4-8.5-39.4-25.3-56.5-12-12.2-25.3-20.5-40.6-25.1-3.6-1.1-11.8-1.5-39.2-1.8-42.9-.5-52.5.4-67.1 6.2-27 10.7-46.3 33.4-53.4 62.4-1.3 5.4-1.6 14.2-1.9 64.3-.4 62.8 0 72.1 4 84.5 9.7 30.7 37.1 53.4 64.6 58.4 9.2 1.7 122.2 2.1 133.7.5 20.1-2.7 35.9-10.8 50.7-25.9 10.7-10.9 17.4-22.8 21.8-38.5 3.2-10.9 2.9-88.4 1.7-93.9z">
                    </path>
                  </svg>
                </span>
                Researches
              </a>
            </ul>
          </nav>
        </header>
        <div class="lg:rounded-2xl bg-white dark:bg-[#111111] w-full md:full border border-gray-200 ">
            <div class="m-6">
            <div
              class="relative flex    w-full flex-col rounded-b-[10px]   bg-white   dark:border-[#ffffff33] dark:!bg-navy-800 dark:text-white dark:shadow-none">
              <div
                class="flex h-fit w-full items-center justify-between   px-4 pb-[20px] pt-1   dark:!bg-navy-700 dark:shadow-none">
                <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                  <div
                    class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-900 sm:text-xs lg:text-xl">
                    Contact Details
                  </div>
                </th>
              </div>
            </div>
            <div class=" ">


              <div class="grid w-full grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div class="flex flex-col items-center gap-3 px-8 py-6 bg-white rounded-3xl shadow-md">
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                      <path
                        d="M31.9904 13.965L22.4166 4.40166C21.6057 3.60976 20.5294 3.16817 19.4104 3.16817C18.2914 3.16817 17.2151 3.60976 16.4041 4.40166L6.8304 13.9017C6.40502 14.283 6.0629 14.7524 5.82645 15.279C5.58999 15.8056 5.46454 16.3776 5.45831 16.9575V30.5425C5.47456 31.6946 5.93476 32.793 6.73808 33.5973C7.5414 34.4016 8.62236 34.846 9.74415 34.8333H28.9225C30.0443 34.846 31.1252 34.4016 31.9285 33.5973C32.7319 32.793 33.1921 31.6946 33.2083 30.5425V16.9575C33.2071 16.4009 33.0989 15.85 32.8899 15.3365C32.6809 14.823 32.3752 14.3569 31.9904 13.965ZM18.47 6.68166C18.7058 6.46025 19.0138 6.33747 19.3333 6.33747C19.6528 6.33747 19.9608 6.46025 20.1966 6.68166L28.5833 15.0417L20.1504 23.4017C19.9146 23.6231 19.6066 23.7459 19.2871 23.7459C18.9675 23.7459 18.6596 23.6231 18.4237 23.4017L10.0833 15.0417L18.47 6.68166ZM30.125 30.5425C30.1052 30.8533 29.9688 31.144 29.7445 31.3537C29.5203 31.5633 29.2256 31.6755 28.9225 31.6667H9.74415C9.44102 31.6755 9.14636 31.5633 8.9221 31.3537C8.69785 31.144 8.56147 30.8533 8.54165 30.5425V17.9708L14.7854 24.1458L12.2262 26.6792C11.9391 26.9758 11.7779 27.3771 11.7779 27.7954C11.7779 28.2137 11.9391 28.615 12.2262 28.9117C12.3695 29.066 12.5417 29.1891 12.7324 29.2734C12.9232 29.3578 13.1286 29.4017 13.3362 29.4025C13.7332 29.4009 14.1142 29.2421 14.4 28.9592L17.1287 26.2675C17.8065 26.6928 18.5853 26.9179 19.3796 26.9179C20.1738 26.9179 20.9527 26.6928 21.6304 26.2675L24.3591 28.9592C24.6449 29.2421 25.026 29.4009 25.4229 29.4025C25.6306 29.4017 25.8359 29.3578 26.0267 29.2734C26.2174 29.1891 26.3896 29.066 26.5329 28.9117C26.82 28.615 26.9812 28.2137 26.9812 27.7954C26.9812 27.3771 26.82 26.9758 26.5329 26.6792L23.9583 24.1458L30.125 17.9708V30.5425Z"
                        fill="#DD2476" />
                    </svg>
                  </span>
                  <p class="text-2xl font-extrabold text-dark-grey-900">Email</p>
                  <p class="text-base leading-7 text-dark-grey-600">Contact me at</p>
                  <a class="text-lg font-bold text-purple-blue-500 text-wrap"
                    href="mailto: hello@loopple.com">{{ props.employee.email_address }} </a>
                </div>
                <div class="flex flex-col items-center gap-3 px-8 py-6 bg-white rounded-3xl shadow-md">
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                      <path
                        d="M30.4237 20.5833C30.0846 20.5833 29.73 20.4725 29.3908 20.3933C28.7045 20.2357 28.0297 20.0294 27.3712 19.7758C26.656 19.5086 25.8699 19.5225 25.164 19.8148C24.4582 20.1071 23.8826 20.6572 23.5479 21.3592L23.2087 22.0875C21.7115 21.2154 20.3283 20.1513 19.0925 18.9208C17.8944 17.6516 16.8583 16.231 16.0092 14.6933L16.7183 14.3608C17.4018 14.0171 17.9374 13.4259 18.222 12.701C18.5067 11.9761 18.5202 11.1687 18.26 10.4342C18.0151 9.7518 17.8143 9.05363 17.6587 8.34417C17.5817 7.99584 17.52 7.63167 17.4737 7.28334C17.2865 6.16807 16.7177 5.1581 15.8698 4.4353C15.0219 3.7125 13.9506 3.32439 12.8487 3.34084H8.20832C7.55657 3.33996 6.91201 3.48056 6.31687 3.75343C5.72174 4.02629 5.18948 4.42526 4.75498 4.92417C4.31148 5.43662 3.98125 6.04161 3.78698 6.69756C3.59271 7.35351 3.53901 8.04489 3.62957 8.72417C4.4676 15.3142 7.39927 21.4362 11.97 26.1408C16.5508 30.8351 22.5117 33.846 28.9283 34.7067C29.1284 34.7224 29.3294 34.7224 29.5296 34.7067C30.6664 34.7084 31.7641 34.28 32.6129 33.5033C33.0987 33.0571 33.4871 32.5105 33.7528 31.8992C34.0185 31.288 34.1554 30.626 34.1546 29.9567V25.2067C34.1463 24.1126 33.7705 23.0551 33.0907 22.2127C32.411 21.3704 31.4689 20.7948 30.4237 20.5833ZM31.1791 30.0833C31.1786 30.3043 31.1331 30.5227 31.0455 30.7245C30.9579 30.9263 30.8301 31.107 30.6704 31.255C30.5014 31.4131 30.3004 31.5306 30.0817 31.5991C29.8631 31.6676 29.6323 31.6852 29.4062 31.6508C23.6532 30.8792 18.3066 28.1865 14.19 23.9875C10.0698 19.756 7.4252 14.2458 6.66665 8.31251C6.63316 8.08028 6.65037 7.84332 6.71702 7.61877C6.78368 7.39422 6.89813 7.1877 7.05207 7.01417C7.19794 6.84816 7.3764 6.71577 7.57569 6.62571C7.77499 6.53565 7.99059 6.48997 8.20832 6.49167H12.8333C13.1897 6.48273 13.5381 6.6009 13.8192 6.82607C14.1002 7.05124 14.2967 7.3695 14.375 7.72667C14.375 8.15417 14.5137 8.59751 14.6062 9.025C14.7844 9.85446 15.0214 10.6694 15.3154 11.4633L13.1571 12.5083C12.7861 12.6832 12.4978 13.0021 12.3554 13.395C12.2012 13.7805 12.2012 14.2129 12.3554 14.5983C14.5742 19.4794 18.3945 23.4029 23.1471 25.6817C23.5224 25.84 23.9434 25.84 24.3187 25.6817C24.7013 25.5354 25.0118 25.2393 25.1821 24.8583L26.1533 22.6417C26.9487 22.9395 27.7624 23.1828 28.5891 23.37C28.99 23.465 29.4217 23.5442 29.8379 23.6075C30.1857 23.6879 30.4956 23.8897 30.7148 24.1784C30.934 24.467 31.0491 24.8248 31.0404 25.1908L31.1791 30.0833ZM22.0833 3.16667C21.7287 3.16667 21.3587 3.16667 21.0042 3.16667C20.5953 3.20237 20.217 3.40341 19.9524 3.72558C19.6879 4.04776 19.5588 4.46466 19.5935 4.88459C19.6283 5.30451 19.824 5.69306 20.1377 5.96476C20.4514 6.23645 20.8574 6.36903 21.2662 6.33334H22.0833C24.5366 6.33334 26.8893 7.33423 28.6241 9.11582C30.3588 10.8974 31.3333 13.3138 31.3333 15.8333C31.3333 16.1183 31.3333 16.3875 31.3333 16.6725C31.2991 17.0902 31.4276 17.5048 31.6906 17.8253C31.9536 18.1459 32.3296 18.3463 32.7362 18.3825H32.8596C33.2455 18.3841 33.618 18.237 33.9034 17.9702C34.1889 17.7035 34.3665 17.3364 34.4012 16.9417C34.4012 16.5775 34.4012 16.1975 34.4012 15.8333C34.4012 12.4767 33.104 9.25725 30.7943 6.88225C28.4847 4.50724 25.3516 3.17087 22.0833 3.16667ZM25.1667 15.8333C25.1667 16.2533 25.3291 16.656 25.6182 16.9529C25.9073 17.2499 26.2994 17.4167 26.7083 17.4167C27.1172 17.4167 27.5093 17.2499 27.7984 16.9529C28.0876 16.656 28.25 16.2533 28.25 15.8333C28.25 14.1536 27.6003 12.5427 26.4438 11.355C25.2873 10.1673 23.7188 9.50001 22.0833 9.50001C21.6744 9.50001 21.2823 9.66682 20.9932 9.96375C20.7041 10.2607 20.5417 10.6634 20.5417 11.0833C20.5417 11.5033 20.7041 11.906 20.9932 12.2029C21.2823 12.4999 21.6744 12.6667 22.0833 12.6667C22.9011 12.6667 23.6853 13.0003 24.2636 13.5942C24.8418 14.188 25.1667 14.9935 25.1667 15.8333Z"
                        fill="#DD2476" />
                    </svg>
                  </span>
                  <p class="text-2xl font-extrabold text-dark-grey-900">Phone</p>
                  <p class="text-base leading-7 text-dark-grey-600">Reach out to me by phone</p>
                  <a class="text-lg font-bold text-purple-blue-500"
                    href="tel:+516-486-5135">{{ props.employee.contact }}</a>
                </div>
                <div class="flex flex-col items-center gap-3 px-8 py-6 bg-white rounded-3xl shadow-md">
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                      <path
                        d="M31.7091 15.2475C31.4927 12.9341 30.6966 10.7177 29.3984 8.81412C28.1003 6.91054 26.3443 5.38464 24.3014 4.38503C22.2585 3.38541 19.9984 2.94614 17.7412 3.10998C15.4839 3.27383 13.3065 4.03522 11.4208 5.32C9.8008 6.43252 8.44083 7.89972 7.43858 9.6162C6.43633 11.3327 5.81667 13.2558 5.62413 15.2475C5.43524 17.2261 5.67758 19.2231 6.33355 21.0936C6.98953 22.9641 8.04269 24.6611 9.41663 26.0617L17.5875 34.4692C17.7308 34.6176 17.9013 34.7354 18.0892 34.8157C18.277 34.8961 18.4785 34.9375 18.682 34.9375C18.8856 34.9375 19.0871 34.8961 19.2749 34.8157C19.4628 34.7354 19.6333 34.6176 19.7766 34.4692L27.9166 26.0617C29.2906 24.6611 30.3437 22.9641 30.9997 21.0936C31.6557 19.2231 31.898 17.2261 31.7091 15.2475ZM25.7583 23.8292L18.6666 31.1125L11.575 23.8292C10.5298 22.7557 9.72928 21.4578 9.23081 20.0288C8.73233 18.5997 8.54834 17.075 8.69204 15.5642C8.83668 14.0301 9.31143 12.5482 10.082 11.2256C10.8525 9.90299 11.8996 8.77278 13.1475 7.91666C14.7831 6.80079 16.703 6.20555 18.6666 6.20555C20.6302 6.20555 22.5502 6.80079 24.1858 7.91666C25.4299 8.76947 26.4747 9.89469 27.245 11.2115C28.0154 12.5283 28.4922 14.0039 28.6412 15.5325C28.7896 17.0484 28.6079 18.5793 28.1093 20.0142C27.6107 21.4491 26.8076 22.7522 25.7583 23.8292ZM18.6666 9.5C17.2945 9.5 15.9532 9.91787 14.8124 10.7008C13.6715 11.4837 12.7823 12.5965 12.2572 13.8984C11.7321 15.2003 11.5947 16.6329 11.8624 18.015C12.1301 19.3971 12.7908 20.6667 13.7611 21.6631C14.7313 22.6596 15.9674 23.3382 17.3132 23.6131C18.6589 23.888 20.0538 23.7469 21.3215 23.2076C22.5892 22.6684 23.6726 21.7551 24.4349 20.5834C25.1972 19.4117 25.6041 18.0342 25.6041 16.625C25.6001 14.7366 24.8678 12.9268 23.5677 11.5915C22.2675 10.2562 20.5053 9.50418 18.6666 9.5ZM18.6666 20.5833C17.9043 20.5833 17.1592 20.3512 16.5254 19.9162C15.8916 19.4813 15.3976 18.8631 15.1058 18.1398C14.8141 17.4165 14.7378 16.6206 14.8865 15.8528C15.0352 15.0849 15.4023 14.3796 15.9413 13.826C16.4803 13.2724 17.1671 12.8955 17.9147 12.7427C18.6623 12.59 19.4373 12.6684 20.1416 12.968C20.8458 13.2676 21.4477 13.7749 21.8712 14.4259C22.2947 15.0768 22.5208 15.8421 22.5208 16.625C22.5208 17.6748 22.1147 18.6816 21.3919 19.424C20.6691 20.1663 19.6888 20.5833 18.6666 20.5833Z"
                        fill="#DD2476" />
                    </svg>
                  </span>
                  <p class="text-2xl font-extrabold text-dark-grey-900">Location</p>
                  <p class="text-base leading-7 text-dark-grey-600">Find me at my Home</p>
                  <a class="text-lg font-bold text-purple-blue-500" target="_blank"
                    href="https://goo.gl/maps/QcWzYETAh4FS3KTD7">{{ props.employee.address }}</a>
                </div>
              </div>
            </div>
          </div>
          <div class="m-6">

            <div
              class="relative flex    w-full flex-col rounded-b-[10px]   bg-white bg-clip-border   dark:border-[#ffffff33] dark:!bg-navy-800 dark:text-white dark:shadow-none">
              <div
                class="flex h-fit w-full items-center justify-between   px-4 pb-[20px] pt-4   dark:!bg-navy-700 dark:shadow-none">
                <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                  <div
                    class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-900 sm:text-xs lg:text-xl">
                    Employment Details
                  </div>
                </th>

              </div>


              <div class="grid gap-4 grid-cols-12">
                <div class="col-span-12 sm:col-span-12">
                  <div class="flex flex-col gap-1">
                     <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">Emp. Status</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.employment_status }}</p>
                    </div> 
                    <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">Employee Code</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.employee_code }}</p>
                    </div>
                    <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">College/Office/Unit</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.division }}</p>
                    </div>
                    <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">Location</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.location }}</p>
                    </div>
                    <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">Type</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.employee_type }}</p>
                    </div>
                   
                    <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">Start Date</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.start_date }}</p>
                    </div>
                    <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">Employed For</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.employment_duration }}</p>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-span-12 sm:col-span-6">
                  <div class="flex flex-col gap-1">
                    <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">Employee Code</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.employee_code }}</p>
                    </div>
                    <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">College/Office/Unit</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.division }}</p>
                    </div>
                    <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">Location</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.location }}</p>
                    </div>
                    <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">Type</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.employee_type }}</p>
                    </div>
                    <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">Emp. Status</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.employment_status }}</p>
                    </div> 
                    <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">Start Date</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.start_date }}</p>
                    </div>
                    <div class="flex items-center gap-2 px-2 py-3 bg-white rounded border w-full ">
                      <div class="leading-3">
                        <p class=" text-sm text-slate-500 text-slate-700">Employed For</p>
                      </div>
                      <p class="text-sm font-bold  self-start ml-auto">{{ props.employee.employment_duration }}</p>
                    </div>
                  </div>
                </div> -->

              </div>
            </div>
          </div>
        
          <div class="m-6">

            <div
              class="relative flex    w-full flex-col rounded-b-[10px]   bg-white bg-clip-border   dark:border-[#ffffff33] dark:!bg-navy-800 dark:text-white dark:shadow-none">
              <div
                class="flex h-fit w-full items-center justify-between   px-4 pb-[20px] pt-4 shadow-2xl shadow-gray-100 dark:!bg-navy-700 dark:shadow-none">
                <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                  <div
                    class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-900 sm:text-xs lg:text-xl">
                    Education Background
                  </div>
                </th>

              </div>
              <div class="w-full overflow-x-scroll px-4 md:overflow-x-hidden">
                <table role="table" class="w-full min-w-[500px] overflow-x-scroll">
                  <thead>
                    <tr role="row">
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          TYPE
                        </div>
                      </th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          Degree
                        </div>
                      </th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          INSTITUTION
                        </div>
                      </th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          DATE COMMENCED
                        </div>
                      </th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          DATE COMPLETED
                        </div>
                      </th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          STATUS
                        </div>
                      </th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          ACTION
                        </div>
                      </th>
                    </tr>
                  </thead>
                  <tbody role="rowgroup" class="px-4">

                    <tr role="row">
                      <td class="py-3 text-sm" role="cell">
                        <div class="flex items-center gap-2">

                          <p class="text-sm font-medium text-navy-700 dark:text-white">
                            Bachelor Degree
                          </p>
                        </div>
                      </td>

                      <td class="py-3 text-sm" role="cell">
                        <p class="text-md font-medium text-gray-600 dark:text-white">
                          BS in Computer Science
                        </p>
                      </td>
                      <td class="py-3 text-sm" role="cell">
                        <p class="text-md font-medium text-gray-600 dark:text-white">
                          Partido State University
                        </p>
                      </td>
                      <td class="py-3 text-sm" role="cell">
                        <p class="text-md font-medium text-gray-600 dark:text-white">
                          2013
                        </p>
                      </td>
                      <td class="py-3 text-sm" role="cell">
                        <p class="text-md font-medium text-gray-600 dark:text-white">
                          2017
                        </p>
                      </td>
                      <td class="py-3 text-sm" role="cell">
                        <p class="text-md font-medium text-gray-600 dark:text-white">
                          Completed
                        </p>
                      </td>
                      <td class="py-3 text-sm" role="cell">
                        <div class="mx-2 flex font-bold">
                          <div class="h-2 w-16 rounded-full bg-gray-200 dark:bg-navy-700">
                            <div
                              class="flex h-full items-center justify-center rounded-md bg-brand-500 dark:bg-brand-400"
                              style="width: 30%"></div>
                          </div>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="m-6">


            <div
              class="relative flex    w-full flex-col rounded-b-[10px]   bg-white bg-clip-border   dark:border-[#ffffff33] dark:!bg-navy-800 dark:text-white dark:shadow-none">
              <div
                class="flex h-fit w-full items-center justify-between   px-4 pb-[20px] pt-4 shadow-2xl shadow-gray-100 dark:!bg-navy-700 dark:shadow-none">
                <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                  <div
                    class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-900 sm:text-xs lg:text-xl">
                    Time Off/Leave Balances
                  </div>
                </th>
              </div>
              <div class="w-full overflow-x-scroll px-4 md:overflow-x-hidden">
                <table role="table" class="w-full min-w-[500px] overflow-x-scroll">
                  <thead>
                    <tr role="row">
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          Time Off/Leave Type
                        </div>
                      </th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          Allowance
                        </div>
                      </th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          Balance
                        </div>
                      </th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          Planned
                        </div>
                      </th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          Available
                        </div>
                      </th>

                    </tr>
                  </thead>
                  <tbody role="rowgroup" class="px-4">
                    <tr role="row">
                      <td class="py-3 text-sm" role="cell">
                        <div class="flex items-center gap-2">

                          <p class="text-sm font-medium text-navy-700 dark:text-white">
                            Annual Leave
                          </p>
                        </div>
                      </td>
                      <td class="py-3 text-sm" role="cell">
                        <p class="text-md font-medium text-gray-600 dark:text-white">
                          100.00
                        </p>
                      </td>
                      <td class="py-3 text-sm" role="cell">
                        <div class="mx-2 flex font-bold">
                          <div class="h-2 w-16 rounded-full bg-gray-200 dark:bg-navy-700">
                            <div
                              class="flex h-full items-center justify-center rounded-md bg-brand-500 dark:bg-brand-400"
                              style="width: 30%"></div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr role="row">
                      <td class="py-3 text-sm" role="cell">
                        <div class="flex items-center gap-2">

                          <p class="text-sm font-medium text-navy-700 dark:text-white">
                            Sick Leave
                          </p>
                        </div>
                      </td>
                      <td class="py-3 text-sm" role="cell">
                        <p class="text-md font-medium text-gray-600 dark:text-white">
                          20.00
                        </p>
                      </td>
                      <td class="py-3 text-sm" role="cell">
                        <div class="mx-2 flex font-bold">
                          <div class="h-2 w-16 rounded-full bg-gray-200 dark:bg-navy-700">
                            <div
                              class="flex h-full items-center justify-center rounded-md bg-brand-500 dark:bg-brand-400"
                              style="width: 30%"></div>
                          </div>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="m-6">
            <div
              class="relative flex    w-full flex-col rounded-b-[10px]   bg-white bg-clip-border   dark:border-[#ffffff33] dark:!bg-navy-800 dark:text-white dark:shadow-none">
              <div
                class="flex h-fit w-full items-center justify-between   px-4 pb-[20px] pt-4 shadow-2xl shadow-gray-100 dark:!bg-navy-700 dark:shadow-none">
                <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                  <div
                    class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-900 sm:text-xs lg:text-xl">
                    Recent Leave Requests
                  </div>
                </th>
              </div>
              <div class="w-full overflow-x-scroll px-4 md:overflow-x-hidden">
                <table role="table" class="w-full min-w-[500px] overflow-x-scroll">
                  <thead>
                    <tr role="row">
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          Description
                        </div>
                      </th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          From
                        </div>
                      </th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          To
                        </div>
                      </th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" style="cursor: pointer">
                        <div
                          class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs">
                          Status
                        </div>
                      </th>

                    </tr>
                  </thead>
                  <tbody role="rowgroup" class="px-4">
                    <tr role="row">
                      <td class="py-3 text-sm" role="cell">
                        <div class="flex items-center gap-2">

                          <p class="text-sm font-medium text-navy-700 dark:text-white">
                            Annual Leave
                          </p>
                        </div>
                      </td>
                      <td class="py-3 text-sm" role="cell">
                        <p class="text-md font-medium text-gray-600 dark:text-white">
                          100.00
                        </p>
                      </td>
                      <td class="py-3 text-sm" role="cell">
                        <div class="mx-2 flex font-bold">
                          <div class="h-2 w-16 rounded-full bg-gray-200 dark:bg-navy-700">
                            <div
                              class="flex h-full items-center justify-center rounded-md bg-brand-500 dark:bg-brand-400"
                              style="width: 30%"></div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr role="row">
                      <td class="py-3 text-sm" role="cell">
                        <div class="flex items-center gap-2">

                          <p class="text-sm font-medium text-navy-700 dark:text-white">
                            Sick Leave
                          </p>
                        </div>
                      </td>
                      <td class="py-3 text-sm" role="cell">
                        <p class="text-md font-medium text-gray-600 dark:text-white">
                          20.00
                        </p>
                      </td>
                      <td class="py-3 text-sm" role="cell">
                        <div class="mx-2 flex font-bold">
                          <div class="h-2 w-16 rounded-full bg-gray-200 dark:bg-navy-700">
                            <div
                              class="flex h-full items-center justify-center rounded-md bg-brand-500 dark:bg-brand-400"
                              style="width: 30%"></div>
                          </div>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div data-aos="fade" class="aos-init aos-animate">
            <!-- <div class="pt-12 md:py-12 px-10 sm:px-10 md:px-10 lg:px-14">
              <h2 class="after-effect after:left-52">About Me</h2>
              <div class="lg:grid grid-cols-12 md:gap-10 pt-4 md:pt-[30px] items-center">
                <div class="col-span-12 space-y-2.5">
                  <div class="lg:mr-16">
                    <p class="text-gray-lite dark:text-color-910 leading-7">I'm Creative Director and UI/UX Designer
                      from Sydney, Australia, working in web development and print media. I enjoy turning complex
                      problems into simple, beautiful and intuitive designs.</p>
                    <p class="text-gray-lite leading-7 mt-2.5 dark:text-color-910">My aim is to bring across your
                      message and identity in the most creative way. I created web design for many famous brand
                      companies.</p>
                  </div>
                </div>
              </div>
            </div>
            <section class="pb-12 px-10  sm:px-5 md:px-10 lg:px-14">
              <h3 class="text-[35px] dark:text-white font-medium pb-5 pt-5">What I do!</h3>
              <div class="grid gap-8 grid-cols-1 md:grid-cols-2 xl:grid-cols-2">
                <div class="about-box dark:bg-transparent rounded-xl p-4" style="background: rgb(252, 244, 255);">
                  <img alt="icon" srcset="/images/icons/icon-1.svg 1x, /images/icons/icon-1.svg 2x"
                    src="/images/icons/icon-1.svg" width="40" height="40" decoding="async" data-nimg="1"
                    class="w-10 h-10 object-contain block" loading="lazy" style="color: transparent;">
                  <div class=" break-all">
                    <h3 class="dark:text-white text-xl font-semibold">UI/UX Design</h3>
                    <p class="leading-8 text-gray-lite dark:text-[#A6A6A6]">Lorem ipsum dolor sit amet, consectetuer
                      adipiscing elit, sed diam euismod volutpat.</p>
                  </div>
                </div>
                <div class="about-box dark:bg-transparent rounded-xl p-4" style="background: rgb(254, 250, 240);">
                  <img alt="icon" srcset="/images/icons/icon-2.svg 1x, /images/icons/icon-2.svg 2x"
                    src="/images/icons/icon-2.svg" width="40" height="40" decoding="async" data-nimg="1"
                    class="w-10 h-10 object-contain block" loading="lazy" style="color: transparent;">
                  <div class="space-y-2 break-all">
                    <h3 class="dark:text-white text-xl font-semibold">App Development</h3>
                    <p class="leading-8 text-gray-lite dark:text-[#A6A6A6]">Lorem ipsum dolor sit amet, consectetuer
                      adipiscing elit, sed diam euismod volutpat.</p>
                  </div>
                </div>
                <div class="about-box dark:bg-transparent rounded-xl p-4" style="background: rgb(252, 244, 255);">
                  <img alt="icon" srcset="/images/icons/icon-3.svg 1x, /images/icons/icon-3.svg 2x"
                    src="/images/icons/icon-3.svg" width="40" height="40" decoding="async" data-nimg="1"
                    class="w-10 h-10 object-contain block" loading="lazy" style="color: transparent;">
                  <div class="space-y-2 break-all">
                    <h3 class="dark:text-white text-xl font-semibold">Photography</h3>
                    <p class="leading-8 text-gray-lite dark:text-[#A6A6A6]">Lorem ipsum dolor sit amet, consectetuer
                      adipiscing elit, sed diam euismod volutpat.</p>
                  </div>
                </div>
                <div class="about-box dark:bg-transparent rounded-xl p-4" style="background: rgb(255, 244, 244);">
                  <img alt="icon" srcset="/images/icons/icon-4.svg 1x, /images/icons/icon-4.svg 2x"
                    src="/images/icons/icon-4.svg" width="40" height="40" decoding="async" data-nimg="1"
                    class="w-10 h-10 object-contain block" loading="lazy" style="color: transparent;">
                  <div class="space-y-2 break-all">
                    <h3 class="dark:text-white text-xl font-semibold">Management</h3>
                    <p class="leading-8 text-gray-lite dark:text-[#A6A6A6]">Lorem ipsum dolor sit amet, consectetuer
                      adipiscing elit, sed diam euismod volutpat.</p>
                  </div>
                </div>
                <div class="about-box dark:bg-transparent rounded-xl p-4" style="background: rgb(255, 240, 248);">
                  <img alt="icon" srcset="/images/icons/icon-5.svg 1x, /images/icons/icon-5.svg 2x"
                    src="/images/icons/icon-5.svg" width="40" height="40" decoding="async" data-nimg="1"
                    class="w-10 h-10 object-contain block" loading="lazy" style="color: transparent;">
                  <div class="space-y-2 break-all">
                    <h3 class="dark:text-white text-xl font-semibold">Web Development</h3>
                    <p class="leading-8 text-gray-lite dark:text-[#A6A6A6]">Lorem ipsum dolor sit amet, consectetuer
                      adipiscing elit, sed diam euismod volutpat.</p>
                  </div>
                </div>
              </div>
            </section> -->
            <!-- <section class="px-2 sm:px-5 md:px-10 lg:px-14 mb-10">
                <h3 class="text-[35px] dark:text-white font-medium pb-5">My Client!</h3>
                <div class="bg-[#F8FBFB] dark:bg-[#0D0D0D] max-w-full h-auto py-10 rounded-xl">
                    <div class="overflow-hidden">
                        <div class="slick-slider slick-initialized" dir="ltr">
                            <div class="slick-list">
                                <div class="slick-track" style="width: 2482px; opacity: 1; transform: translate3d(-1606px, 0px, 0px); transition: transform 2000ms linear;">
                                    <div data-index="-5" tabindex="-1" class="slick-slide slick-cloned" aria-hidden="true" style="width: 146px;">
                                        <div>
                                            <img alt="brand" tabindex="-1" srcset="/images/slider/brand-2.png 1x, /images/slider/brand-2.png 2x" src="/images/slider/brand-2.png" width="150" height="50" decoding="async" data-nimg="1" class="overflow-hidden brand-img" loading="lazy" style="color: transparent; width: 100%; display: inline-block;">
                                        </div>
                                    </div>
                                    <div data-index="-4" tabindex="-1" class="slick-slide slick-cloned" aria-hidden="true" style="width: 146px;">
                                        <div>
                                            <img alt="brand" tabindex="-1" srcset="/images/slider/brand-3.png 1x, /images/slider/brand-3.png 2x" src="/images/slider/brand-3.png" width="150" height="50" decoding="async" data-nimg="1" class="overflow-hidden brand-img" loading="lazy" style="color: transparent; width: 100%; display: inline-block;">
                                        </div>
                                    </div>
                                    <div data-index="-3" tabindex="-1" class="slick-slide slick-cloned" aria-hidden="true" style="width: 146px;">
                                        <div>
                                            <img alt="brand" tabindex="-1" srcset="/images/slider/brand-4.png 1x, /images/slider/brand-4.png 2x" src="/images/slider/brand-4.png" width="150" height="50" decoding="async" data-nimg="1" class="overflow-hidden brand-img" loading="lazy" style="color: transparent; width: 100%; display: inline-block;">
                                        </div>
                                    </div>
                                    <div data-index="-2" tabindex="-1" class="slick-slide slick-cloned" aria-hidden="true" style="width: 146px;">
                                        <div>
                                            <img alt="brand" tabindex="-1" srcset="/images/slider/brand-5.png 1x, /images/slider/brand-5.png 2x" src="/images/slider/brand-5.png" width="150" height="50" decoding="async" data-nimg="1" class="overflow-hidden brand-img" loading="lazy" style="color: transparent; width: 100%; display: inline-block;">
                                        </div>
                                    </div>
                                    <div data-index="-1" tabindex="-1" class="slick-slide slick-cloned" aria-hidden="true" style="width: 146px;">
                                        <div>
                                            <img alt="brand" tabindex="-1" srcset="/images/slider/brand-1.png 1x, /images/slider/brand-1.png 2x" src="/images/slider/brand-1.png" width="150" height="50" decoding="async" data-nimg="1" class="overflow-hidden brand-img" loading="lazy" style="color: transparent; width: 100%; display: inline-block;">
                                        </div>
                                    </div>
                                    <div data-index="0" class="slick-slide slick-active slick-current" tabindex="-1" aria-hidden="false" style="outline: none; width: 146px;">
                                        <div>
                                            <img alt="brand" tabindex="-1" srcset="/images/slider/brand-1.png 1x, /images/slider/brand-1.png 2x" src="/images/slider/brand-1.png" width="150" height="50" decoding="async" data-nimg="1" class="overflow-hidden brand-img" loading="lazy" style="color: transparent; width: 100%; display: inline-block;">
                                        </div>
                                    </div>
                                    <div data-index="1" class="slick-slide slick-active" tabindex="-1" aria-hidden="false" style="outline: none; width: 146px;">
                                        <div>
                                            <img alt="brand" tabindex="-1" srcset="/images/slider/brand-2.png 1x, /images/slider/brand-2.png 2x" src="/images/slider/brand-2.png" width="150" height="50" decoding="async" data-nimg="1" class="overflow-hidden brand-img" loading="lazy" style="color: transparent; width: 100%; display: inline-block;">
                                        </div>
                                    </div>
                                    <div data-index="2" class="slick-slide slick-active" tabindex="-1" aria-hidden="false" style="outline: none; width: 146px;">
                                        <div>
                                            <img alt="brand" tabindex="-1" srcset="/images/slider/brand-3.png 1x, /images/slider/brand-3.png 2x" src="/images/slider/brand-3.png" width="150" height="50" decoding="async" data-nimg="1" class="overflow-hidden brand-img" loading="lazy" style="color: transparent; width: 100%; display: inline-block;">
                                        </div>
                                    </div>
                                    <div data-index="3" class="slick-slide slick-active" tabindex="-1" aria-hidden="false" style="outline: none; width: 146px;">
                                        <div>
                                            <img alt="brand" tabindex="-1" srcset="/images/slider/brand-4.png 1x, /images/slider/brand-4.png 2x" src="/images/slider/brand-4.png" width="150" height="50" decoding="async" data-nimg="1" class="overflow-hidden brand-img" loading="lazy" style="color: transparent; width: 100%; display: inline-block;">
                                        </div>
                                    </div>
                                    <div data-index="4" class="slick-slide slick-active" tabindex="-1" aria-hidden="false" style="outline: none; width: 146px;">
                                        <div>
                                            <img alt="brand" tabindex="-1" srcset="/images/slider/brand-5.png 1x, /images/slider/brand-5.png 2x" src="/images/slider/brand-5.png" width="150" height="50" decoding="async" data-nimg="1" class="overflow-hidden brand-img" loading="lazy" style="color: transparent; width: 100%; display: inline-block;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->

          </div>
        </div>
      </div>
    </div>
  </AppLayout>

</template>