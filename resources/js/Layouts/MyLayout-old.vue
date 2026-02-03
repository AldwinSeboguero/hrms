 
       
<template>
    <Head :title="title" />
     
    
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-0  transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
        
        
        <div class="px-6 pt-2 max-w-sm mx-auto text-white bg-gradient-to-r from-indigo-950 via-blue-800 to-blue-800  shadow-lg flex items-center space-x-4 pb-3">
            
             <!-- <div class="shrink-0"> 
             <svg class="h-10 w-10  text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                         </svg>
             </div> -->
        <div>
             <div class="text-md font-medium text-white font-black text-balance">{{ $page.props.auth.user.name }}</div>
             <p class="text-sm text-white-500 text-balance">{{ $page.props.auth.user.email}}</p>
             </div>
          </div>
        <div class="h-full px-3 pb-4 pt-4 overflow-y-auto bg-white dark:bg-gray-800">
        
          <ul class="space-y-2 font-medium">
             <li >
                <a :href="route('dashboard')" :active="route().current('dashboard')" class=" inline-flex items-center px-4 py-3   text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group"  :class="{ 'bg-blue-50 text-blue-950':  route().current('dashboard') }" aria-current="page">
                    
                    <svg class="w-4 h-4 me-2 text-blue-900 active:text-red-500"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                    </svg>
    
                    <h2>Dashboard</h2>
                </a>
               
             </li>
           
             <li>
                <a :href="route('employees.index')"  :active="route().current('employees.index')"  class="inline-flex items-center px-4 py-3  text-gray-800  text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group"  :class="{ 'bg-blue-50 text-blue-950':  route().current('employees.index') }" aria-current="page">
                 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"  class="w-4 h-4 me-2  text-gray-800" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                    </svg>
    
                    Employees
                </a>
             </li>
             <li>
              <a :href="route('timesheets.index')"  :active="route().current('timesheets.index')"  class="inline-flex items-center px-4 py-3  text-gray-800  text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group"  :class="{ 'bg-blue-50 text-blue-950':  route().current('timesheets.index') }" aria-current="page">
                 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2  text-gray-800">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                    </svg>
    
                    Timesheets
                </a>
             </li>
                <!-- <li>
              <a :href="route('timesheets.index')"  :active="route().current('timesheets.index')"  class="hidden inline-flex items-center px-4 py-3  text-gray-800  text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group"  :class="{ 'bg-blue-50 text-blue-950':  route().current('timesheets.index') }" aria-current="page">
                 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2  text-gray-800">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                    </svg>
    
                    Daily Time Record
                </a>
             </li> -->
             <li>
              <a type="button" active="true"
                class="inline-flex items-center px-4 py-3  text-gray-800  text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group" 
                aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2  text-gray-800">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                    </svg>
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Leave & Time-Off </span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
                </a>
                <ul id="dropdown-example" class="py-2 space-y-2"  :class="{ 'hidden':  !route().current('leave.request') }" >
                      <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Summary</a>
                      </li>
                      <li>
                        <a  :href="route('leave.request')"
                        :active="route().current('leave.request')"  
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 "
                        :class="{ 'bg-blue-50 text-blue-950':  route().current('leave.request') }"
                        >
                          <span class="flex-1  whitespace-nowrap">Requests</span>
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>

                        </a>
                      </li>
                      <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Disapproved Requests 

                        </a> 
                      </li>
                      <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Leave Cards</a>
                      </li>
                </ul>
             </li>
             <li>
                <a href="#" class="inline-flex items-center px-4 py-3  text-gray-800  text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group"  :class="{ 'bg-blue-50 text-blue-950':  route().current('approvedrequests') }" aria-current="page">
                     
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2  text-gray-800">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                    </svg>
    
                    Payroll Management
                </a>
             </li>
             <li>
                <a :href="route('performance.index')"  :active="route().current('performance.index')"  class="inline-flex items-center px-4 py-3  text-gray-800  text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group"  :class="{ 'bg-blue-50 text-blue-950':  route().current('performance.index') }" aria-current="page">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2  text-gray-800">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                    </svg>
                    Performanace Management
                </a>
             </li>
             <li>
                <a href="#" class="inline-flex items-center px-4 py-3  text-gray-800  text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group"  :class="{ 'bg-blue-50 text-blue-950':  route().current('deficiencies') }" aria-current="page">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2  text-gray-800">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
    
                    Reward Management
                </a>
             </li>
             <li>
                <a href="#" class="inline-flex items-center px-4 py-3  text-gray-800  text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group"  :class="{ 'bg-blue-50 text-blue-950':  route().current('users') }" aria-current="page">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2  text-gray-800">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
    
                    Training and Development
                </a>
             </li>
             <li>
                <a href="#" class="inline-flex items-center px-4 py-3  text-gray-800  text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group"  :class="{ 'bg-blue-50 text-blue-950':  route().current('settings') }" aria-current="page">
                     <svg id="Layer_1" data-name="Layer 1" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 me-2  text-gray-800"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 80.26"><defs></defs><title>hiring</title><path class="cls-1" d="M93.28,30.93c2.84,6,14.31,6.32,16.87-.42,7.78,5,12.78,4.05,12.73,15.08H93.4a32.33,32.33,0,0,1-4.48,10.62l14,15.24-9.65,8.81L79.77,65.43A32.32,32.32,0,0,1,30.28,45.29H0c.87-11.23,3-9.86,12.57-15.85,2.64,6.87,15.34,7.32,18.13,0l.15.09A32.51,32.51,0,0,1,39,15.68,32.31,32.31,0,0,1,93.28,30.93ZM51.42,37.1a6.78,6.78,0,0,1-3.18-2c5-1.88,2.27-10.19,3.73-14.4,1.89-5.47,8.88-7.34,12.78-4.14,3-.32,6.14,1.25,6.8,6,.55,3.95-1.4,10.73,3.15,12.91a7.47,7.47,0,0,1-3.48,1.68,36,36,0,0,1-5.49.61v1.65l1.92,3.06-6.18,4.83L55.3,42.47l1.37-2.93V37.76a23.15,23.15,0,0,1-5.25-.66Zm19.75,7.95a15,15,0,0,0-2.86-4.44C79.42,44.91,78.44,42,80.74,51c.21.82.45,1.74.72,2.77-9,11.55-30.44,11.55-40,0,.28-1,.52-2,.73-2.82,2.26-8.88,1.24-6,12.49-10.32a14.78,14.78,0,0,0-2.86,4.44L54.72,45l6.59,5.27L68.23,45l2.94.07Zm11-26.81a28.67,28.67,0,0,0-40.57,0,29,29,0,0,0,0,40.58A28.69,28.69,0,1,0,82.16,18.24ZM15.55,28.9A4.13,4.13,0,0,1,16,27.42,6,6,0,0,1,13.6,23h-.13a1.75,1.75,0,0,1-.86-.22,2.39,2.39,0,0,1-.94-1.15c-.44-1-.78-3.64.32-4.39l-.21-.13,0-.3c0-.53-.06-1.17-.07-1.84,0-2.48-.09-5.48-2.08-6.08l-.85-.26L9.32,8a32.83,32.83,0,0,1,5-5.06A12.65,12.65,0,0,1,20.08.09,7,7,0,0,1,25.7,1.66a10.21,10.21,0,0,1,1.5,1.51A6.37,6.37,0,0,1,31.7,5.8a9.05,9.05,0,0,1,1.46,3,10.23,10.23,0,0,1,.4,3.35,8.07,8.07,0,0,1-2.34,5.43,1.65,1.65,0,0,1,.73.19,1.81,1.81,0,0,1,.64,2.22c-.22.67-.49,1.46-.75,2.12-.31.89-.77,1.05-1.66,1-.05,2.19-1.06,3.28-2.43,4.57l.31,1.08c-.86,4.19-10,4.64-12.51.23ZM95.91,30a3.85,3.85,0,0,1,.4-1.39,5.67,5.67,0,0,1-2.23-4.14H94a1.63,1.63,0,0,1-.8-.22,2.17,2.17,0,0,1-.89-1.08c-.41-.94-.73-3.41.3-4.12l-.2-.13,0-.27c0-.5,0-1.11-.06-1.74,0-2.33-.08-5.15-2-5.71l-.8-.25.53-.65a29.85,29.85,0,0,1,4.69-4.76,11.9,11.9,0,0,1,5.43-2.64,6.55,6.55,0,0,1,5.28,1.48,10,10,0,0,1,1.41,1.42,6,6,0,0,1,4.23,2.47,8.72,8.72,0,0,1,1.38,2.78,9.83,9.83,0,0,1,.37,3.15,7.62,7.62,0,0,1-2.2,5.1,1.53,1.53,0,0,1,.68.18,1.69,1.69,0,0,1,.61,2.08c-.21.64-.47,1.37-.71,2-.29.84-.72,1-1.56.91,0,2.06-1,3.08-2.28,4.29l.29,1c-.82,3.94-9.43,4.37-11.76.22Z"/></svg>
                 
                    Recruitment
                </a>
             </li>

                    <li>
              <a type="button" active="true"
                class="inline-flex items-center px-4 py-3  text-gray-800  text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group" 
                aria-controls="dropdown-event" data-collapse-toggle="dropdown-event">
                 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2  text-gray-800">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
</svg>

                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Events </span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
                </a>
                <ul id="dropdown-event" class="py-2 space-y-2"  :class="{ 'hidden':  !route().current('event.list') && !route().current('event.scanner') && !route().current('event.attendance') }" >
                    
                       <li>
                        <a  :href="route('event.list')"
                        :active="route().current('event.list')"  
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 "
                        :class="{ 'bg-blue-50 text-blue-950':  route().current('event.list') }"
                        >
                          <span class="flex-1  whitespace-nowrap">List of Events</span>

                        </a>
                      </li>
                          <li>
                        <a  :href="route('event.attendance')"
                        :active="route().current('event.attendance')"  
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 "
                        :class="{ 'bg-blue-50 text-blue-950':  route().current('event.attendance') }"
                        >
                          <span class="flex-1  whitespace-nowrap">Generate Attendance</span>

                        </a>
                      </li>
                      <li>
                        <a  :href="route('event.scanner')"
                        :active="route().current('event.scanner')"  
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 "
                        :class="{ 'bg-blue-50 text-blue-950':  route().current('event.scanner') }"
                        >
                          <span class="flex-1  whitespace-nowrap">Scanner</span>

                        </a>
                      </li>
                       
                </ul>
             </li>
             <!-- <li>
                <a href="#" class="inline-flex items-center px-4 py-3  text-gray-800  text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group"  :class="{ 'bg-blue-50 text-blue-950':  route().current('settings') }" aria-current="page">
                     
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2  text-gray-800" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                    </svg>
    
                    Benefits
                </a>
             </li> -->
                <li>
                <a 
                :href="route('settings.index')"
                        :active="route().current('settings.index')"  
                 class="inline-flex items-center px-4 py-3  text-gray-800  text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group"  :class="{ 'bg-blue-50 text-blue-950':  route().current('settings') }" aria-current="page">
                     
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2  text-gray-800" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                    </svg>
    
                    Settings
                </a>
             </li>
             
             <li>
                <button   @click="logout" class="inline-flex items-center px-4 py-3  text-gray-800  text-md font-black font-sans rounded-lg active w-full dark:bg-blue-600 hover:bg-gray-100 dark:hover:bg-gray-700 group" aria-current="page">
                     
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2  text-gray-800">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
    
                    Logout
                </button>
             </li>
          </ul>
       </div>
    </aside>
    
    <div class="px-4 sm:ml-64">
        


        <nav class="top-0  bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
      <div class="px-3 py-2 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
          <div class="flex items-center justify-start rtl:justify-end">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 mr-1">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
             </button> 
            <a href="https://hrms.parsu.edu.ph" class=" flex items-center space-x-4">
    
              <div class="">
                <img class="h-12 w-12" :src="logo" alt="ChitChat Logo">
            </div>
              <div>
                <div class="text-sm md:text-xl text-blue-950 font-black font-sans uppercase">Partido State University</div>
                <p class="text-slate-500 text-xs md:text-sm ">Human Resource Management System</p>
            </div>
            </a> 
          </div>
          <div class="flex items-center hidden">
              <div class="flex items-center ms-3"> 
    
                <div>
                  <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                  </button>
                </div>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                  <div class="px-4 py-3" role="none">
                    <p class="text-sm text-gray-900 dark:text-white" role="none">
                      {{$page.props.auth.user.name}}
                    </p>
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                      {{$page.props.auth.user.email}}
                    </p>
                  </div>
                  <ul class="py-1" role="none">
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                    </li>
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                    </li>
                   
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
        </div>
      </div>
    </nav>
    <!-- 
    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
             </button>
            <a href="https://flowbite.com" class=" flex items-center space-x-4">
    
                <div class="">
                    <img class="h-10 w-10" src="https://parsu.edu.ph/images/logo/NewPSUlogo.png" alt="ChitChat Logo">
                </div>
                <div>
                    <div class="text-md text-blue-950 font-black font-sans uppercase">Partido State University</div>
                    <p class="text-slate-500">Online Student Clearance System</p>
                </div>
            </a> -->
            
       <!-- <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-6"> -->
       <div class="p-4  mt-1 ">

        <main>
             <div class="mt-2">
                <slot />
            </div>   

        </main>
       </div>
    </div>
    
    </template>
    
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