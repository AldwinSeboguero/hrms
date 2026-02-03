 
       
<template>
    <Head :title="title" />
     
    
<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
    <div class="fixed top-0 left-0 z-40  h-screen pt-0  transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700">
        <!-- Loading screen -->
        <!-- <div
          x-ref="loading"
          class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-indigo-800"
        >
          Loading.....
        </div> -->

        <!-- Sidebar -->
        <div class="flex flex-shrink-0 transition-all h-full">
            <div
                v-if="isSidebarOpen"
                @click="isSidebarOpen = false"
                class="fixed inset-0 z-10 bg-black bg-opacity-50 lg:hidden"
            ></div>
            <div v-if="isSidebarOpen" class="fixed inset-y-0 z-10 w-16 bg-white"></div>

            <!-- Mobile bottom bar -->
            <nav aria-label="Options" class="fixed h-full inset-x-0 bottom-0 flex flex-row-reverse items-center justify-between px-4 py-2 bg-white border-t border-indigo-100 sm:hidden shadow-t rounded-t-3xl">
                <!-- Menu button -->
                <button
                    @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
                    class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                    :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
                >
                    <span class="sr-only">Toggle sidebar</span>
                    <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </button>

                <!-- Logo -->
                <a href="#">
                    <img class="w-10 h-auto" src="https://raw.githubusercontent.com/kamona-ui/dashboard-alpine/main/public/assets/images/logo.png" alt="K-UI" />
                </a>

                <!-- User avatar button -->
                <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
                    <button
                        @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})"
                        class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                    >
                        <img class="w-8 h-8 rounded-lg shadow-md" src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4" alt="Ahmed Kamel" />
                        <span class="sr-only">User menu</span>
                    </button>
                    <div
                        v-if="isOpen"
                        @click.away="isOpen = false"
                        @keydown.escape="isOpen = false"
                        x-ref="userMenu"
                        tabindex="-1"
                        class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 bottom-14 focus:outline-none"
                        role="menu"
                        aria-orientation="vertical"
                        aria-label="user menu"
                    >
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Your Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
                    </div>
                </div>
            </nav>

            <!-- Left mini bar -->
            <nav aria-label="Options" class="z-20 flex-col items-center flex-shrink-0 hidden w-16 py-4 bg-white border-r-2 border-indigo-100 shadow-md sm:flex rounded-tr-3xl rounded-br-3xl">
                <!-- Logo -->
                <div class="flex-shrink-0 py-4">
                    <a href="#">
                        <img class="w-10 h-auto" src="https://raw.githubusercontent.com/kamona-ui/dashboard-alpine/main/public/assets/images/logo.png" alt="K-UI" />
                    </a>
                </div>
                <div class="flex flex-col items-center flex-1 p-2 space-y-4">
                    <!-- Menu button -->
                    <button
                        @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
                        class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                        :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
                    >
                        <span class="sr-only">Toggle sidebar</span>
                        <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>
                    <!-- Messages button -->
                    <button
                        @click="(isSidebarOpen && currentSidebarTab == 'messagesTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'messagesTab'"
                        class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                        :class="(isSidebarOpen && currentSidebarTab == 'messagesTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
                    >
                        <span class="sr-only">Toggle message panel</span>
                        <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </button>
                    <!-- Notifications button -->
                    <button
                        @click="(isSidebarOpen && currentSidebarTab == 'notificationsTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'notificationsTab'"
                        class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                        :class="(isSidebarOpen && currentSidebarTab == 'notificationsTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
                    >
                        <span class="sr-only">Toggle notifications panel</span>
                        <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                </div>

                <!-- User avatar -->
                <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
                    <button
                        @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})"
                        class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                    >
                        <img class="w-10 h-10 rounded-lg shadow-md" src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4" alt="Ahmed Kamel" />
                        <span class="sr-only">User menu</span>
                    </button>
                    <div
                        v-if="isOpen"
                        @click.away="isOpen = false"
                        @keydown.escape="isOpen = false"
                        x-ref="userMenu"
                        tabindex="-1"
                        class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 bottom-14 focus:outline-none"
                        role="menu"
                        aria-orientation="vertical"
                        aria-label="user menu"
                    >
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Your Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
                    </div>
                </div>
            </nav>

            <div
                x-transition:enter="transform transition-transform duration-300"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition-transform duration-300"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                v-if="isSidebarOpen"
                class="fixed inset-y-0 left-0 z-10 flex-shrink-0 w-64 bg-white border-r-2 border-indigo-100 shadow-lg sm:left-16 rounded-tr-3xl rounded-br-3xl sm:w-72 lg:static lg:w-64"
            >
                <nav v-if="currentSidebarTab == 'linksTab'" aria-label="Main" class="flex flex-col h-full">
                    <!-- Logo -->
                    <div class="flex items-center justify-center flex-shrink-0 py-10">
                        <a href="#">
                            <img class="w-24 h-auto" src="https://raw.githubusercontent.com/kamona-ui/dashboard-alpine/main/public/assets/images/logo.png" alt="K-UI" />
                        </a>
                    </div>

                    <!-- Links -->
                    <div class="flex-1 px-4 space-y-2 overflow-hidden hover:overflow-auto">
                        <a href="#" class="flex items-center w-full space-x-2 text-white bg-indigo-600 rounded-lg">
                            <span aria-hidden="true" class="p-2 bg-indigo-700 rounded-lg">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </span>
                            <span>Home</span>
                        </a>
                        <a href="#" class="flex items-center space-x-2 text-indigo-600 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white">
                            <span aria-hidden="true" class="p-2 transition-colors rounded-lg group-hover:bg-indigo-700 group-hover:text-white">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <span>Pages</span>
                        </a>
                    </div>

                    <div class="flex-shrink-0 p-4 mt-10">
                        <div class="hidden p-2 space-y-6 bg-gray-100 rounded-lg md:block">
                            <img aria-hidden="true" class="-mt-10" src="https://raw.githubusercontent.com/kamona-ui/dashboard-alpine/52b4b4abb92ef251f6610be416038b48209d7a81/public/assets/images/undraw_web_developer_p3e5.svg" />
                            <p class="text-sm text-indigo-600">
                                Use our <span class="text-base text-indigo-700">Premium</span> features now! <br />
                            </p>
                            <button class="w-full px-4 py-2 text-center text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-100">
                                Upgrade to pro
                            </button>
                        </div>

                        <button class="w-full px-4 py-2 text-center text-white transition-colors bg-indigo-600 rounded-lg md:hidden hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-100">
                            Upgrade to pro
                        </button>
                    </div>
                </nav>

                <section v-if="currentSidebarTab == 'messagesTab'" class="px-4 py-6">
                    <h2 class="text-xl">Messages</h2>
                </section>

                <section v-if="currentSidebarTab == 'notificationsTab'" class="px-4 py-6">
                    <h2 class="text-xl">Notifications</h2>
                </section>
            </div>
        </div>

        <div class="flex flex-col flex-1">
            <header class="relative flex items-center justify-between flex-shrink-0 p-4">
                <form action="#" class="flex-1">
                    <!--  -->
                </form>
                <div class="items-center hidden ml-4 sm:flex">
                    <button
                        @click="isSettingsPanelOpen = true"
                        class="p-2 mr-4 text-gray-400 bg-white rounded-lg shadow-md hover:text-gray-600 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"
                    >
                        <span class="sr-only">Settings</span>
                        <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3 .35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>

                    <!-- Github link -->
                    <a href="https://github.com/kamona-ui/dashboard-alpine" target="_blank" class="p-2 text-white bg-black rounded-lg shadow-md hover:text-gray-200 focus:outline-none focus:ring focus:ring-black focus:ring-offset-gray-100 focus:ring-offset-2">
                        <span class="sr-only">github link</span>
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.026,2c-5.509,0-9.974,4.465-9.974,9.974c0,4.406,2.857,8.145,6.821,9.465 c0.499,0.09,0.679-0.217,0.679-0.481c0-0.237-0.008-0.865-0.011-1.696c-2.775,0.602-3.361-1.338-3.361-1.338 c-0.452-1.152-1.107-1.459-1.107-1.459c-0.905-0.619,0.069-0.605,0.069-0.605c1.002,0.07,1.527,1.028,1.527,1.028 c0.89,1.524,2.336,1.084,2.902,0.829c0.091-0.645,0.351-1.085,0.635-1.334c-2.214-0.251-4.542-1.107-4.542-4.93 c0-1.087,0.389-1.979,1.024-2.675c-0.101-0.253-0.446-1.268,0.099-2.64c0,0,0.837-0.269,2.742,1.021 c0.798-0.221,1.649-0.332,2.496-0.336c0.849,0.004,1.701,0.115,2.496,0.336c1.906-1.291,2.742-1.021,2.742-1.021 c0.545,1.372,0.203,2.387,0.099,2.64c0.64,0.696,1.024,1.587,1.024,2.675c0,3.833-2.33,4.675-4.552,4.922 c0.355,0.308,0.675,0.916,0.675,1.846c0,1.334-0.012,2.41-0.012,2.737c0,0.267,0.178,0.577,0.687,0.479 C19.146,20.115,22,16.379,22,11.974C22,6.465,17.535,2,12.026,2z"></path>
                        </svg>
                    </a>
                </div>

                <!-- Mobile sub header button -->
                <button @click="isSubHeaderOpen = !isSubHeaderOpen" class="p-2 text-gray-400 bg-white rounded-lg shadow-md sm:hidden hover:text-gray-600 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4">
                    <span class="sr-only">More</span>
                    <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </button>

                <!-- Mobile sub header -->
                <div x-transition:enter="transform transition-transform" x-transition:enter-start="translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="transform transition-transform" x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-full opacity-0" v-if="isSubHeaderOpen" @click.away="isSubHeaderOpen = false" class="absolute flex items-center justify-between p-2 bg-white rounded-md shadow-lg sm:hidden top-16 left-5 right-5">
                    <!-- Settings button -->
                    <button @click="isSettingsPanelOpen = true; isSubHeaderOpen = false" class="p-2 text-gray-400 bg-white rounded-lg shadow-md hover:text-gray-600 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4">
                        <span class="sr-only">Settings</span>
                        <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>

                    <!-- Messages button -->
                    <button @click="isSidebarOpen = true; currentSidebarTab = 'messagesTab'; isSubHeaderOpen = false" class="p-2 text-gray-400 bg-white rounded-lg shadow-md hover:text-gray-600 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4">
                        <span class="sr-only">Toggle message panel</span>
                        <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </button>

                    <!-- Notifications button -->
                    <button @click="isSidebarOpen = true; currentSidebarTab = 'notificationsTab'; isSubHeaderOpen = false" class="p-2 text-gray-400 bg-white rounded-lg shadow-md hover:text-gray-600 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4">
                        <span class="sr-only">Toggle notifications panel</span>
                        <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>

                    <!-- Github link -->
                    <a href="https://github.com/kamona-ui/dashboard-alpine" target="_blank" class="p-2 text-white bg-black rounded-lg shadow-md hover:text-gray-200 focus:outline-none focus:ring focus:ring-black focus:ring-offset-gray-100 focus:ring-offset-2">
                        <span class="sr-only">github link</span>
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.026,2c-5.509,0-9.974,4.465-9.974,9.974c0,4.406,2.857,8.145,6.821,9.465 c0.499,0.09,0.679-0.217,0.679-0.481c0-0.237-0.008-0.865-0.011-1.696c-2.775,0.602-3.361-1.338-3.361-1.338 c-0.452-1.152-1.107-1.459-1.107-1.459c-0.905-0.619,0.069-0.605,0.069-0.605c1.002,0.07,1.527,1.028,1.527,1.028 c0.89,1.524,2.336,1.084,2.902,0.829c0.091-0.645,0.351-1.085,0.635-1.334c-2.214-0.251-4.542-1.107-4.542-4.93 c0-1.087,0.389-1.979,1.024-2.675c-0.101-0.253-0.446-1.268,0.099-2.64c0,0,0.837-0.269,2.742,1.021 c0.798-0.221,1.649-0.332,2.496-0.336c0.849,0.004,1.701,0.115,2.496,0.336c1.906-1.291,2.742-1.021,2.742-1.021 c0.545,1.372,0.203,2.387,0.099,2.64c0.64,0.696,1.024,1.587,1.024,2.675c0,3.833-2.33,4.675-4.552,4.922 c0.355,0.308,0.675,0.916,0.675,1.846c0,1.334-0.012,2.41-0.012,2.737c0,0.267,0.178,0.577,0.687,0.479 C19.146,20.115,22,16.379,22,11.974C22,6.465,17.535,2,12.026,2z" />
                        </svg>
                    </a>
                </div>
            </header>

        </div>
    </div>

         
    <!-- Panels -->
    
    <!-- Settings Panel -->
    <!-- Backdrop -->
    <div
        v-if="isSettingsPanelOpen"
        class="fixed inset-0 bg-black bg-opacity-50"
        @click="isSettingsPanelOpen = false"
        aria-hidden="true"
    ></div>
    <!-- Panel -->
    <section
        x-transition:enter="transform transition-transform duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition-transform duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        v-if="isSettingsPanelOpen"
        class="fixed inset-y-0 right-0 w-64 bg-white border-l border-indigo-100 rounded-l-3xl"
    >
        <div class="px-4 py-8">
            <h2 class="text-lg font-semibold">Settings</h2>
        </div>
    </section>

    <!-- Author links -->
    <div class="fixed flex items-center space-x-4 bottom-20 right-5 sm:bottom-5">
        <a href="https://twitter.com/ak_kamona" target="_blank" class="transition-transform transform hover:scale-125">
            <span class="sr-only">Twitter</span>
            <svg aria-hidden="true" class="w-8 h-8 text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M19.633,7.997c0.013,0.175,0.013,0.349,0.013,0.523c0,5.325-4.053,11.461-11.46,11.461c-2.282,0-4.402-0.661-6.186-1.809 c0.324,0.037,0.636,0.05,0.973,0.05c1.883,0,3.616-0.636,5.001-1.721c-1.771-0.037-3.255-1.197-3.767-2.793 c0.249,0.037,0.499,0.062,0.761,0.062c0.361,0,0.724-0.05,1.061-0.137c-1.847-0.374-3.23-1.995-3.23-3.953v-0.05 c0.537,0.299,1.16,0.486,1.82,0.511C3.534,9.419,2.823,8.184,2.823,6.787c0-0.748,0.199-1.434,0.548-2.032 c1.983,2.443,4.964,4.04,8.306,4.215c-0.062-0.3-0.1-0.611-0.1-0.923c0-2.22,1.796-4.028,4.028-4.028 c1.16,0,2.207,0.486,2.943,1.272c0.91-0.175,1.782-0.512,2.556-0.973c-0.299,0.935-0.936,1.721-1.771,2.22 c0.811-0.088,1.597-0.312,2.319-0.624C21.104,6.712,20.419,7.423,19.633,7.997z" />
            </svg>
        </a>
        <a href="https://github.com/Kamona-WD" target="_blank" class="transition-transform transform hover:scale-125">
            <span class="sr-only">Github</span>
            <svg aria-hidden="true" class="w-8 h-8 text-black" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.026,2c-5.509,0-9.974,4.465-9.974,9.974c0,4.406,2.857,8.145,6.821,9.465 c0.499,0.09,0.679-0.217,0.679-0.481c0-0.237-0.008-0.865-0.011-1.696c-2.775,0.602-3.361-1.338-3.361-1.338 c-0.452-1.152-1.107-1.459-1.107-1.459c-0.905-0.619,0.069-0.605,0.069-0.605c1.002,0.07,1.527,1.028,1.527,1.028 c0.89,1.524,2.336,1.084,2.902,0.829c0.091-0.645,0.351-1.085,0.635-1.334c-2.214-0.251-4.542-1.107-4.542-4.93 c0-1.087,0.389-1.979,1.024-2.675c-0.101-0.253-0.446-1.268,0.099-2.64c0,0,0.837-0.269,2.742,1.021 c0.798-0.221,1.649-0.332,2.496-0.336c0.849,0.004,1.701,0.115,2.496,0.336c1.906-1.291,2.742-1.021,2.742-1.021 c0.545,1.372,0.203,2.387,0.099,2.64c0.64,0.696,1.024,1.587,1.024,2.675c0,3.833-2.33,4.675-4.552,4.922 c0.355,0.308,0.675,0.916,0.675,1.846c0,1.334-0.012,2.41-0.012,2.737c0,0.267,0.178,0.577,0.687,0.479 C19.146,20.115,22,16.379,22,11.974C22,6.465,17.535,2,12.026,2z" />
            </svg>
        </a>
    </div>
    </div>
  
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
    

const isSubHeaderOpen = ref(false);
const isSettingsPanelOpen = ref(false);
const isSidebarOpen = ref(false);

const toggleSubHeader = () => {
  isSubHeaderOpen.value = !isSubHeaderOpen.value;
};

const toggleSettingsPanel = () => {
  isSettingsPanelOpen.value = !isSettingsPanelOpen.value;
};

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
};

const closeSettingsPanel = () => {
  isSettingsPanelOpen.value = false;
};

const closeSidebar = () => {
  isSidebarOpen.value = false;
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