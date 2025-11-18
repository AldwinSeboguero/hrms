<template>
  <!-- <header class="bg-white ">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-4 pl-1 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
            <div class="mx-6 px-2 py-1">
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
      </div>
      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = true">
          <span class="sr-only">Open main menu</span>
          <Bars3Icon class="size-6" aria-hidden="true" />
        </button>
      </div>
	  
      <PopoverGroup class="hidden lg:flex lg:gap-x-12 ">
        <a href="#" class="text-sm/6 font-semibold text-gray-900">HOME</a>

        <Popover class="relative">

          <PopoverButton class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900">
            SERVICES
            <ChevronDownIcon class="size-5 flex-none text-gray-400" aria-hidden="true" />
          </PopoverButton>

          <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="translate-y-0" leave-to-class="opacity-0 translate-y-1">
            <PopoverPanel class="absolute left-1/2 z-10 mt-3 w-screen max-w-md -translate-x-1/2 overflow-hidden rounded-3xl bg-white shadow-lg outline-1 outline-gray-900/5">
              <div class="p-4">
                <div v-for="item in products" :key="item.name" class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                  <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                    <component :is="item.icon" class="size-6 text-gray-600 group-hover:text-indigo-600" aria-hidden="true" />
                  </div>
                  <div class="flex-auto">
                    <a :href="item.href" class="block font-semibold text-gray-900">
                      {{ item.name }}
                      <span class="absolute inset-0" />
                    </a>
                    <p class="mt-1 text-gray-600">{{ item.description }}</p>
                  </div>
                </div>
              </div>
              <div class="grid grid-cols-2 divide-x divide-gray-900/5 bg-gray-50">
                <a v-for="item in callsToAction" :key="item.name" :href="item.href" class="flex items-center justify-center gap-x-2.5 p-3 text-sm/6 font-semibold text-gray-900 hover:bg-gray-100">
                  <component :is="item.icon" class="size-5 flex-none text-gray-400" aria-hidden="true" />
                  {{ item.name }}
                </a>
              </div>
            </PopoverPanel>
          </transition>
        </Popover>

        <a href="#" class="text-sm/6 font-semibold text-gray-900">ABOUT US</a> 
        <a href="#" class="text-sm/6 font-semibold text-gray-900">CAREERS</a>
        <a href="#" class="text-sm/6 font-semibold text-gray-900">NEWS</a>

      </PopoverGroup>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a :href="route('login')" class="text-sm/6 font-semibold text-gray-900">{{ $page.props.auth.user ? 'Home' : 'Log in'}}  <span aria-hidden="true">&rarr;</span></a>
      </div>
    </nav>
    <Dialog class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
      <div class="fixed inset-0 z-50" />
      <DialogPanel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <a href="#" class="-m-1.5 p-1.5">
               <div class="text-sm text-blue-950 font-black font-sans uppercase">Partido State University</div>
        <p class="text-slate-500 text-xs">Human Resource Management System</p>
          </a>
          <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
            <span class="sr-only">Close menu</span>
            <XMarkIcon class="size-6" aria-hidden="true" />
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <Disclosure as="div" class="-mx-3" v-slot="{ open }">
                <DisclosureButton class="flex w-full items-center justify-between rounded-lg py-2 pr-3.5 pl-3 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">
                  SERVICES
                  <ChevronDownIcon :class="[open ? 'rotate-180' : '', 'size-5 flex-none']" aria-hidden="true" />
                </DisclosureButton>
                <DisclosurePanel class="mt-2 space-y-2">
                  <DisclosureButton v-for="item in [...products, ...callsToAction]" :key="item.name" as="a" :href="item.href" class="block rounded-lg py-2 pr-3 pl-6 text-sm/7 font-semibold text-gray-900 hover:bg-gray-50">{{ item.name }}</DisclosureButton>
                </DisclosurePanel>
              </Disclosure>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">ABOUT US</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">CAREERS</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">NEWS</a>
            </div>
			
            <div class="py-6">
              <a  :href="route('login')"  class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Log in</a>
            </div>
          </div>
        </div>
      </DialogPanel>
    </Dialog>
    
  </header>  -->


<!-- component -->
<header class="fixed w-full z-100">
	<nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 pt-4">
		<div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
			<a href="#" class="flex items-center">
 
    <div class="">
        <img class="h-12 w-12 object-contain" :src="logo" alt="ParSU Logo">
    </div>
    <div class="ml-4">
        <div class="text-sm text-blue-950 font-black font-sans uppercase">Partido State University</div>
        <p class="text-slate-500 text-xs">Human Resource Management System</p>
    </div> 
			</a>
			<div class="flex items-center lg:order-2">
 

				<a :href="route('login')"  
					class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">Login</a>
				<button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
<span class="sr-only">Open main menu</span>
 <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
<svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
</button>
			</div>
			<div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
				<ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
					<li>
						<a href="#"
							class="block py-2 pl-3 pr-4 text-white bg-purple-700 rounded lg:bg-transparent lg:text-purple-700 lg:p-0 dark:text-white"
							aria-current="page">Home</a>
					</li>
           <Popover class="relative">

          <PopoverButton class="flex items-center gap-x-1 py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">
            Services
            <ChevronDownIcon class="size-5 flex-none text-gray-400" aria-hidden="true" />
          </PopoverButton>

          <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="translate-y-0" leave-to-class="opacity-0 translate-y-1">
            <PopoverPanel class="absolute left-1/2 z-10 mt-3 w-screen max-w-md -translate-x-1/2 overflow-hidden rounded-3xl bg-white shadow-lg outline-1 outline-gray-900/5">
              <div class="p-4">
                <div v-for="item in products" :key="item.name" class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                  <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                    <component :is="item.icon" class="size-6 text-gray-600 group-hover:text-indigo-600" aria-hidden="true" />
                  </div>
                  <div class="flex-auto">
                    <a :href="item.href" class="block font-semibold text-gray-900">
                      {{ item.name }}
                      <span class="absolute inset-0" />
                    </a>
                    <p class="mt-1 text-gray-600">{{ item.description }}</p>
                  </div>
                </div>
              </div>
              <div class="grid grid-cols-2 divide-x divide-gray-900/5 bg-gray-50">
                <a v-for="item in callsToAction" :key="item.name" :href="item.href" class="flex items-center justify-center gap-x-2.5 p-3 text-sm/6 font-semibold text-gray-900 hover:bg-gray-100">
                  <component :is="item.icon" class="size-5 flex-none text-gray-400" aria-hidden="true" />
                  {{ item.name }}
                </a>
              </div>
            </PopoverPanel>
          </transition>
        </Popover>
					<li>
						<a href="#"
							class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">About Us</a>
					</li>
					<li>
						<a href="#"
							class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Careers</a>
					</li>
					<li>
						<a href="#"
							class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">News</a>
					</li>
 
				 
				</ul>
			</div>
		</div>
	</nav>
</header>

<section class="bg-white dark:bg-gray-900 pt-10">
	<div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
		<div class="mr-auto place-self-center lg:col-span-7">
			<h1
				class="max-w-2xl mb-4 text-4xl font-bold leading-none tracking-tight text-heading md:text-5xl xl:text-3xl dark:text-white
        text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
				Empowering Excellence in  <br>Human Resource Management.</h1>
				<p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
          At Partido State University, we believe that effective human resource management is vital for fostering a productive academic environment.
           The HRMO is dedicated to support our faculty and staff through comprehensive HR services designed to enhance individual and organizational performance. </p>
				<div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
					<a href="https://github.com/themesberg/landwind" target="_blank"
						class="inline-flex items-center justify-center w-full px-5 py-3 text-sm font-medium text-center text-gray-900 border border-gray-200 rounded-lg sm:w-auto hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
						<img :src="sevices" class="size-8 mr-2"/> View All Services
					</a>
					<!-- <a href="https://www.figma.com/community/file/1125744163617429490" target="_blank"
						class="inline-flex items-center justify-center w-full px-5 py-3 mb-2 mr-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:w-auto focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
						<svg class="w-4 h-4 mr-2" id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 300"
							width="1667" height="2500">
						
							<title>Figma.logo</title>
							<desc>Created using Figma</desc>
							<path id="path0_fill" class="st0"
								d="M50 300c27.6 0 50-22.4 50-50v-50H50c-27.6 0-50 22.4-50 50s22.4 50 50 50z" />
							<path id="path1_fill" class="st1"
								d="M0 150c0-27.6 22.4-50 50-50h50v100H50c-27.6 0-50-22.4-50-50z" />
							<path id="path1_fill_1_" class="st2"
								d="M0 50C0 22.4 22.4 0 50 0h50v100H50C22.4 100 0 77.6 0 50z" />
							<path id="path2_fill" class="st3"
								d="M100 0h50c27.6 0 50 22.4 50 50s-22.4 50-50 50h-50V0z" />
							<path id="path3_fill" class="st4"
								d="M200 150c0 27.6-22.4 50-50 50s-50-22.4-50-50 22.4-50 50-50 50 22.4 50 50z" />
						</svg> Get Figma file
					</a> -->
				</div>
		</div>
		<div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
		 

<figure class="relative max-w-sm transition-all duration-300 cursor-pointer filter blue hover:grayscale-0 z-0">
  <a href="#" class="z-0">
    <img class="rounded " :src="homeicon"  alt="image description">
  </a>
  <figcaption class="absolute px-4 text-lg text-white bottom-6">
      <!-- <p>Do you want to get notified when a new component is added to Flowbite?</p> -->
  </figcaption>
</figure>

</div>
		</div>
</section>
<section class="bg-gray-50 dark:bg-gray-900 py-8">
	<h2 class="max-w-screen-xl px-4 pb-4 mx-auto mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Campuses</h2>
    <div class="max-w-screen-xl px-4 pb-4 mx-auto lg:pb-4 overflow-x-auto  overflow-hidden">
        <div class="flex space-x-6 text-gray-500 dark:text-gray-400">
            <article class="bg-neutral-primary-soft block w-64   border border-default rounded-xl shadow-xs flex-shrink-0 overflow-hidden">
                <a href="#">
                    <img class="rounded-top-xl h-48 object-cover" :src="campus1" alt="Beautiful view of Caramoan"/>
                </a>
				<div class="px-6">
  <a href="#">
                    <h5 class="mt-6 mb-2 text-2xl font-semibold tracking-tight text-heading">Caramoan</h5>
                </a>
                <p class="mb-6 text-body">An idyllic destination that promotes tranquility and nature appreciation.</p>
                <a href="#" class="inline-flex items-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-xl text-sm px-4 py-2.5 mb-4 focus:outline-none">
                    Read more
                </a>
				</div>
              
            </article>
            <article class="bg-neutral-primary-soft block w-64 overflow-hidden border border-default rounded-xl shadow-xs flex-shrink-0">
                <a href="#">
                    <img class="  h-48 object-cover" :src="campus2" alt="Serene view of Goa"/>
                </a>
                	<div class="px-6">

					<a href="#">
                    <h5 class="mt-6 mb-2 text-2xl font-semibold tracking-tight text-heading">Goa</h5>
                </a>
                <p class="mb-6 text-body">A perfect blend of culture and relaxation, surrounded by stunning beaches.</p>
                <a href="#" class=" inline-flex items-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-xl text-sm px-4 py-2.5 focus:outline-none">
                    Read more
                </a>
				</div>
            </article>
            <article class="bg-neutral-primary-soft block w-64 overflow-hidden border border-default rounded-xl shadow-xs flex-shrink-0">
                <a href="#">
                    <img class=" h-48 object-cover" :src="campus3" alt="Lush countryside view of Sagñay"/>
                </a>
                	<div class="px-6">

					<a href="#">
                    <h5 class="mt-6 mb-2 text-2xl font-semibold tracking-tight text-heading">Sagñay</h5>
                </a>
                <p class="mb-6 text-body">Experience the beauty of rural landscapes and vibrant culture.</p>
                <a href="#" class=" inline-flex items-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-xl text-sm px-4 py-2.5 focus:outline-none">
                    Read more
                </a>
				</div>
            </article>
            <article class="bg-neutral-primary-soft block w-64 overflow-hidden border border-default rounded-xl shadow-xs flex-shrink-0">
                <a href="#">
                    <img class="  h-48 object-cover" :src="campus4" alt="Scenic view at Salogon"/>
                </a>
                	<div class="px-6">

					<a href="#">
                    <h5 class="mt-6 mb-2 text-2xl font-semibold tracking-tight text-heading">Salogon</h5>
                </a>
                <p class="mb-6 text-body">A hidden gem known for its natural beauty and warm community.</p>
                <a href="#" class=" inline-flex items-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-xl text-sm px-4 py-2.5 focus:outline-none">
                    Read more
                </a>
				</div>
            </article>
            <article class="bg-neutral-primary-soft block w-64 overflow-hidden border border-default rounded-xl shadow-xs flex-shrink-0">
                <a href="#">
                    <img class="  h-48 object-cover" :src="campus5" alt="Vibrant town of San Jose"/>
                </a>
                	<div class="px-6">

					<a href="#">
                    <h5 class="mt-6 mb-2 text-2xl font-semibold tracking-tight text-heading">San Jose</h5>
                </a>
                <p class="mb-6 text-body">Dive into a vibrant community filled with rich history and culture.</p>
                <a href="#" class=" inline-flex items-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-xl text-sm px-4 py-2.5 focus:outline-none">
                    Read more
                </a>
				</div>
            </article>
            <article class="bg-neutral-primary-soft block w-64 overflow-hidden border border-default rounded-xl shadow-xs flex-shrink-0">
                <a href="#">
                    <img class="  h-48 object-cover" :src="campus6" alt="Beautiful landscapes of Lagonoy"/>
                </a>
                	<div class="px-6">

					<a href="#">
                    <h5 class="mt-6 mb-2 text-2xl font-semibold tracking-tight text-heading">Lagonoy</h5>
                </a>
                <p class="mb-6 text-body">A tranquil setting perfect for nature lovers and adventure seekers.</p>
                <a href="#" class=" inline-flex items-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-xl text-sm px-4 py-2.5 focus:outline-none">
                    Read more
                </a>
				</div>
            </article>
            <article class="bg-neutral-primary-soft block w-64 overflow-hidden border border-default rounded-xl shadow-xs flex-shrink-0">
                <a href="#">
                    <img class="  h-48 object-cover" :src="campus7" alt="Charming village of Tinambac"/>
                </a>
                	<div class="px-6">

					<a href="#">
                    <h5 class="mt-6 mb-2 text-2xl font-semibold tracking-tight text-heading">Tinambac</h5>
                </a>
                <p class="mb-6 text-body">Discover the charm of rural life in this picturesque village.</p>
                <a href="#" class=" inline-flex items-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-xl text-sm px-4 py-2.5 focus:outline-none">
                    Read more
                </a>
				</div>
            </article>
        </div>
    </div>
</section>

<section class="bg-white dark:bg-gray-900">
	<div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-24 lg:px-6">
		<div class="max-w-screen-md mx-auto mb-8 text-center lg:mb-12">
			<h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Designed for business
				teams like yours</h2>
			<p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">Here at Landwind we focus on markets
				where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
		</div>
		<div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">

			<div
				class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
				<h3 class="mb-4 text-2xl font-semibold">Announcements</h3>
				<p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Best option for personal use & for
					your next project.</p>
				<div class="flex items-baseline justify-center my-8">
					<span class="mr-2 text-5xl font-extrabold">$29</span>
					<span class="text-gray-500 dark:text-gray-400">/month</span>
				</div>

				<ul role="list" class="mb-8 space-y-4 text-left">
					<li class="flex items-center space-x-3">

						<svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
								clip-rule="evenodd"></path>
						</svg>
						<span>Individual configuration</span>
					</li>
					<li class="flex items-center space-x-3">

						<svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
								clip-rule="evenodd"></path>
						</svg>
						<span>No setup, or hidden fees</span>
					</li>
					<li class="flex items-center space-x-3">

						<svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
								clip-rule="evenodd"></path>
						</svg>
						<span>Team size: <span class="font-semibold">1 developer</span></span>
					</li>
					<li class="flex items-center space-x-3">

						<svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
								clip-rule="evenodd"></path>
						</svg>
						<span>Premium support: <span class="font-semibold">6 months</span></span>
					</li>
					<li class="flex items-center space-x-3">

						<svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
								clip-rule="evenodd"></path>
						</svg>
						<span>Free updates: <span class="font-semibold">6 months</span></span>
					</li>
				</ul>
				<a href="#"
					class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-purple-900">Get
					started</a>
			</div>

			<div
				class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
				<h3 class="mb-4 text-2xl font-semibold">Upcoming Events</h3>
				
 
 
<ul class=" ">
    <li class="flex items-center">
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path fill-rule="evenodd" d="M6 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3H6Zm1.5 1.5a.75.75 0 0 0-.75.75V16.5a.75.75 0 0 0 1.085.67L12 15.089l4.165 2.083a.75.75 0 0 0 1.085-.671V5.25a.75.75 0 0 0-.75-.75h-9Z" clip-rule="evenodd" />
</svg> <strong><span class="mc_db">
May 29, 2023</span> <span>–</span> <span class="mc_de">May 31, 2023</span>, All day</strong> <br/>Mental Health Specialized Skills Training</li>
   
</ul>

<li class="past-event mc_general mc-mc_upcoming_18 upcoming-event mc_general past-event multidate mc_rel_general">
	<strong><span class="mc_db">
May 29, 2023</span> <span>–</span> <span class="mc_de">May 31, 2023</span>, All day</strong> <br>Mental Health Specialized Skills Training</li>

<li class="past-event mc_general mc-mc_upcoming_17 upcoming-event mc_general past-event multidate mc_rel_general"><strong><span class="mc_db">May 8, 2023</span> <span>–</span> <span class="mc_de">May 11, 2023</span>, All day</strong> <br>Pre-retirement Counseling &amp; Seminar</li>

<li class="past-event mc_general mc-mc_upcoming_15 upcoming-event mc_general past-event mc_rel_general"><strong><span class="mc_db">April 26, 2023</span> <span>–</span> <span class="mc_de">April 27, 2023</span>, All day</strong> <br>Handling Grieving and Bereaved Individuals</li>
 
			</div>

			<div
				class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
				<h3 class="mb-4 text-2xl font-semibold">Latest News</h3>
				<p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Best for large scale uses and extended
					redistribution rights.</p>
				<div class="flex items-baseline justify-center my-8">
					<span class="mr-2 text-5xl font-extrabold">$499</span>
					<span class="text-gray-500 dark:text-gray-400">/month</span>
				</div>

				<ul  class="mb-8 space-y-4 text-left list-disc list-inside">
					<li class="flex items-center space-x-3">

						<svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
								clip-rule="evenodd"></path>
						</svg>
						<span>Individual configuration</span>
					</li>
					<li class="flex items-center space-x-3">

						<svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
								clip-rule="evenodd"></path>
						</svg>
						<span>No setup, or hidden fees</span>
					</li>
					<li class="flex items-center space-x-3">

						<svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
								clip-rule="evenodd"></path>
						</svg>
						<span>Team size: <span class="font-semibold">100+ developers</span></span>
					</li>
					<li class="flex items-center space-x-3">

						<svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
								clip-rule="evenodd"></path>
						</svg>
						<span>Premium support: <span class="font-semibold">36 months</span></span>
					</li>
					<li class="flex items-center space-x-3">

						<svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
								clip-rule="evenodd"></path>
						</svg>
						<span>Free updates: <span class="font-semibold">36 months</span></span>
					</li>
				</ul>
				<a href="#"
					class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-purple-900">Get
					started</a>
			</div>
		</div>
	</div>
</section>


<section class="bg-white dark:bg-gray-800">
	<div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-24 lg:px-6">

		<div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-16">
			<div class="text-gray-500 sm:text-lg dark:text-gray-400">
				<h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Work with tools
					you already use</h2>
				<p class="mb-8 font-light lg:text-xl">Deliver great service experiences fast - without the complexity of
					traditional ITSM solutions. Accelerate critical development work, eliminate toil, and deploy changes
					with ease.</p>

				<ul role="list" class="pt-8 space-y-5 border-t border-gray-200 my-7 dark:border-gray-700">
					<li class="flex space-x-3">

						<svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400" fill="currentColor"
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
								clip-rule="evenodd"></path>
						</svg>
						<span class="text-base font-medium leading-tight text-gray-900 dark:text-white">Continuous integration and deployment</span>
					</li>
					<li class="flex space-x-3">

						<svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400" fill="currentColor"
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
								clip-rule="evenodd"></path>
						</svg>
						<span class="text-base font-medium leading-tight text-gray-900 dark:text-white">Development workflow</span>
					</li>
					<li class="flex space-x-3">

						<svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400" fill="currentColor"
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
								clip-rule="evenodd"></path>
						</svg>
						<span class="text-base font-medium leading-tight text-gray-900 dark:text-white">Knowledge management</span>
					</li>
				</ul>
				<p class="mb-8 font-light lg:text-xl">Deliver great service experiences fast - without the complexity of
					traditional ITSM solutions.</p>
			</div>
			<img class="hidden w-full mb-4 rounded-lg lg:mb-0 lg:flex" src="https://demo.themesberg.com/landwind/images/feature-1.png" alt="dashboard feature image">
</div>

			<div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-16">
				<img class="hidden w-full mb-4 rounded-lg lg:mb-0 lg:flex" src="https://demo.themesberg.com/landwind/images/feature-2.png" alt="feature image 2">
				<div class="text-gray-500 sm:text-lg dark:text-gray-400">
					<h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">We invest in
						the world’s potential</h2>
					<p class="mb-8 font-light lg:text-xl">Deliver great service experiences fast - without the
						complexity of traditional ITSM solutions. Accelerate critical development work, eliminate toil,
						and deploy changes with ease.</p>

					<ul role="list" class="pt-8 space-y-5 border-t border-gray-200 my-7 dark:border-gray-700">
						<li class="flex space-x-3">

							<svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400" fill="currentColor"
								viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
									clip-rule="evenodd"></path>
							</svg>
							<span class="text-base font-medium leading-tight text-gray-900 dark:text-white">Dynamic reports and dashboards</span>
						</li>
						<li class="flex space-x-3">

							<svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400" fill="currentColor"
								viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
									clip-rule="evenodd"></path>
							</svg>
							<span class="text-base font-medium leading-tight text-gray-900 dark:text-white">Templates for everyone</span>
						</li>
						<li class="flex space-x-3">

							<svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400" fill="currentColor"
								viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
									clip-rule="evenodd"></path>
							</svg>
							<span class="text-base font-medium leading-tight text-gray-900 dark:text-white">Development workflow</span>
						</li>
						<li class="flex space-x-3">

							<svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400" fill="currentColor"
								viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
									clip-rule="evenodd"></path>
							</svg>
							<span class="text-base font-medium leading-tight text-gray-900 dark:text-white">Limitless business automation</span>
						</li>
						<li class="flex space-x-3">

							<svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400" fill="currentColor"
								viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
									clip-rule="evenodd"></path>
							</svg>
							<span class="text-base font-medium leading-tight text-gray-900 dark:text-white">Knowledge management</span>
						</li>
					</ul>
					<p class="font-light lg:text-xl">Deliver great service experiences fast - without the complexity of
						traditional ITSM solutions.</p>
				</div>
			</div>
		</div>
</section>


<section class="bg-white dark:bg-gray-900">
	<div
		class="items-center max-w-screen-xl px-4 py-8 mx-auto lg:grid lg:grid-cols-4 lg:gap-16 xl:gap-24 lg:py-24 lg:px-6">
		<div class="col-span-2 mb-8">
			<p class="text-lg font-medium text-purple-600 dark:text-purple-500">Trusted Worldwide</p>
			<h2 class="mt-3 mb-4 text-3xl font-extrabold tracking-tight text-gray-900 md:text-3xl dark:text-white">
				Trusted by over 600 million users and 10,000 teams</h2>
			<p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Our rigorous security and compliance
				standards are at the heart of all we do. We work tirelessly to protect you and your customers.</p>
			<div class="pt-6 mt-6 space-y-4 border-t border-gray-200 dark:border-gray-700">
				<div>
					<a href="#"
						class="inline-flex items-center text-base font-medium text-purple-600 hover:text-purple-800 dark:text-purple-500 dark:hover:text-purple-700">
						Explore Legality Guide
						<svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"
							xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
								clip-rule="evenodd"></path>
						</svg>
					</a>
				</div>
				<div>
					<a href="#"
						class="inline-flex items-center text-base font-medium text-purple-600 hover:text-purple-800 dark:text-purple-500 dark:hover:text-purple-700">
						Visit the Trust Center
						<svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"
							xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
								clip-rule="evenodd"></path>
						</svg>
					</a>
				</div>
			</div>
		</div>
		<div class="col-span-2 space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0">
			<div>
				<svg class="w-10 h-10 mb-2 text-purple-600 md:w-12 md:h-12 dark:text-purple-500" fill="currentColor"
					viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd"
						d="M2 5a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm14 1a1 1 0 11-2 0 1 1 0 012 0zM2 13a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2zm14 1a1 1 0 11-2 0 1 1 0 012 0z"
						clip-rule="evenodd"></path>
				</svg>
				<h3 class="mb-2 text-2xl font-bold dark:text-white">99.99% uptime</h3>
				<p class="font-light text-gray-500 dark:text-gray-400">For Landwind, with zero maintenance downtime</p>
			</div>
			<div>
				<svg class="w-10 h-10 mb-2 text-purple-600 md:w-12 md:h-12 dark:text-purple-500" fill="currentColor"
					viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
					</path>
				</svg>
				<h3 class="mb-2 text-2xl font-bold dark:text-white">600M+ Users</h3>
				<p class="font-light text-gray-500 dark:text-gray-400">Trusted by over 600 milion users around the world
				</p>
			</div>
			<div>
				<svg class="w-10 h-10 mb-2 text-purple-600 md:w-12 md:h-12 dark:text-purple-500" fill="currentColor"
					viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd"
						d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
						clip-rule="evenodd"></path>
				</svg>
				<h3 class="mb-2 text-2xl font-bold dark:text-white">100+ countries</h3>
				<p class="font-light text-gray-500 dark:text-gray-400">Have used Landwind to create functional websites
				</p>
			</div>
			<div>
				<svg class="w-10 h-10 mb-2 text-purple-600 md:w-12 md:h-12 dark:text-purple-500" fill="currentColor"
					viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
					</path>
				</svg>
				<h3 class="mb-2 text-2xl font-bold dark:text-white">5+ Million</h3>
				<p class="font-light text-gray-500 dark:text-gray-400">Transactions per day</p>
			</div>
		</div>
	</div>
</section>


<section class="bg-gray-50 dark:bg-gray-800">
	<div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-24 lg:px-6">
		<figure class="max-w-screen-md mx-auto">
			<svg class="h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none"
				xmlns="http://www.w3.org/2000/svg">
				<path
					d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
					fill="currentColor" />
			</svg>
			<blockquote>
				<p class="text-xl font-medium text-gray-900 md:text-2xl dark:text-white">"The Partido State University commits to provide quality instruction, responsive research and needs-based extension services for global competitiveness and satisfaction of its clients, stakeholders, regulatory bodies, and other service providers through continual improvement of the quality management system."</p>
			</blockquote>
			<figcaption class="flex items-center justify-center mt-6 space-x-3">
				<!-- <img class="w-6 h-6 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png" alt="profile picture"> -->
				<div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
					<div class="pr-3 font-medium text-gray-900 dark:text-white">ISO 9001:2015 </div>
					<div class="pl-3 text-sm font-light text-gray-500 dark:text-gray-400">Quality Policy</div>
				</div>
			</figcaption>
		</figure>
	</div>
</section>





<section class="bg-white dark:bg-gray-900">
	<div class="max-w-screen-xl px-4 pb-8 mx-auto lg:pb-24 lg:px-6 ">
		<h2
			class="mb-6 text-3xl font-extrabold tracking-tight text-center text-gray-900 lg:mb-8 lg:text-3xl dark:text-white">
			Frequently asked questions</h2>
		<div class="max-w-screen-md mx-auto">
			<div id="accordion-flush" data-accordion="collapse"
				data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
				data-inactive-classes="text-gray-500 dark:text-gray-400">
				<h3 id="accordion-flush-heading-1">
					<button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-900 bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
<span>Can I use Landwind in open-source projects?</span>
<svg data-accordion-icon="" class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
 </button>
				</h3>
				<div id="accordion-flush-body-1" class="" aria-labelledby="accordion-flush-heading-1">
					<div class="py-5 border-b border-gray-200 dark:border-gray-700">
						<p class="mb-2 text-gray-500 dark:text-gray-400">Landwind is an open-source library of
							interactive components built on top of Tailwind CSS including buttons, dropdowns, modals,
							navbars, and more.</p>
						<p class="text-gray-500 dark:text-gray-400">Check out this guide to learn how to <a href="#"
								class="text-purple-600 dark:text-purple-500 hover:underline">get started</a> and start
							developing websites even faster with components on top of Tailwind CSS.</p>
					</div>
				</div>
				<h3 id="accordion-flush-heading-2">
					<button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-2" aria-expanded="false" aria-controls="accordion-flush-body-2">
<span>Is there a Figma file available?</span>
<svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
</button>
				</h3>
				<div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
					<div class="py-5 border-b border-gray-200 dark:border-gray-700">
						<p class="mb-2 text-gray-500 dark:text-gray-400">Landwind is first conceptualized and designed
							using the Figma software so everything you see in the library has a design equivalent in our
							Figma file.</p>
						<p class="text-gray-500 dark:text-gray-400">Check out the <a href="#"
								class="text-purple-600 dark:text-purple-500 hover:underline">Figma design system</a>
							based on the utility classes from Tailwind CSS and components from Landwind.</p>
					</div>
				</div>
				<h3 id="accordion-flush-heading-3">
					<button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-3" aria-expanded="false" aria-controls="accordion-flush-body-3">
<span>What are the differences between Landwind and Tailwind UI?</span>
<svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
</button>
				</h3>
				<div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
					<div class="py-5 border-b border-gray-200 dark:border-gray-700">
						<p class="mb-2 text-gray-500 dark:text-gray-400">The main difference is that the core components
							from Landwind are open source under the MIT license, whereas Tailwind UI is a paid product.
							Another difference is that Landwind relies on smaller and standalone components, whereas
							Tailwind UI offers sections of pages.</p>
						<p class="mb-2 text-gray-500 dark:text-gray-400">However, we actually recommend using both
							Landwind, Landwind Pro, and even Tailwind UI as there is no technical reason stopping you
							from using the best of two worlds.</p>
						<p class="mb-2 text-gray-500 dark:text-gray-400">Learn more about these technologies:</p>
						<ul class="pl-5 text-gray-500 list-disc dark:text-gray-400">
							<li><a href="#" class="text-purple-600 dark:text-purple-500 hover:underline">Landwind
									Pro</a></li>
							<li><a href="#" class="text-purple-600 dark:text-purple-500 hover:underline">Tailwind UI</a>
							</li>
						</ul>
					</div>
				</div>
				<h3 id="accordion-flush-heading-4">
					<button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-4" aria-expanded="false" aria-controls="accordion-flush-body-4">
<span>What about browser support?</span>
<svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
</button>
				</h3>
				<div id="accordion-flush-body-4" class="hidden" aria-labelledby="accordion-flush-heading-4">
					<div class="py-5 border-b border-gray-200 dark:border-gray-700">
						<p class="mb-2 text-gray-500 dark:text-gray-400">The main difference is that the core components
							from Landwind are open source under the MIT license, whereas Tailwind UI is a paid product.
							Another difference is that Landwind relies on smaller and standalone components, whereas
							Tailwind UI offers sections of pages.</p>
						<p class="mb-2 text-gray-500 dark:text-gray-400">However, we actually recommend using both
							Landwind, Landwind Pro, and even Tailwind UI as there is no technical reason stopping you
							from using the best of two worlds.</p>
						<p class="mb-2 text-gray-500 dark:text-gray-400">Learn more about these technologies:</p>
						<ul class="pl-5 text-gray-500 list-disc dark:text-gray-400">
							<li><a href="#" class="text-purple-600 dark:text-purple-500 hover:underline">Landwind
									Pro</a></li>
							<li><a href="#" class="text-purple-600 dark:text-purple-500 hover:underline">Tailwind UI</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="bg-gray-50 dark:bg-gray-800">
	<div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16 lg:px-6">
		<div class="max-w-screen-sm mx-auto text-center">
			<h2 class="mb-4 text-3xl font-extrabold leading-tight tracking-tight text-gray-900 dark:text-white">Start
				your free trial today</h2>
			<p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg">Try Landwind Platform for 30 days. No
				credit card required.</p>
			<a href="#"
				class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">Free
				trial for 30 days</a>
		</div>
	</div>
</section>

<footer class="bg-white dark:bg-gray-800">
	<div class="max-w-screen-xl p-4 py-6 mx-auto lg:py-16 md:p-8 lg:p-10">
		<div class="grid grid-cols-2 gap-8 md:grid-cols-3 lg:grid-cols-5">
			<div>
				<h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Company</h3>
				<ul class="text-gray-500 dark:text-gray-400">
					<li class="mb-4">
						<a href="#" class=" hover:underline">About</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Careers</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Brand Center</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Blog</a>
					</li>
				</ul>
			</div>
			<div>
				<h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Help center</h3>
				<ul class="text-gray-500 dark:text-gray-400">
					<li class="mb-4">
						<a href="#" class="hover:underline">Discord Server</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Twitter</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Facebook</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Contact Us</a>
					</li>
				</ul>
			</div>
			<div>
				<h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h3>
				<ul class="text-gray-500 dark:text-gray-400">
					<li class="mb-4">
						<a href="#" class="hover:underline">Privacy Policy</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Licensing</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Terms</a>
					</li>
				</ul>
			</div>
			<div>
				<h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Company</h3>
				<ul class="text-gray-500 dark:text-gray-400">
					<li class="mb-4">
						<a href="#" class=" hover:underline">About</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Careers</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Brand Center</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Blog</a>
					</li>
				</ul>
			</div>
			<div>
				<h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Download</h3>
				<ul class="text-gray-500 dark:text-gray-400">
					<li class="mb-4">
						<a href="#" class="hover:underline">iOS</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Android</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Windows</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">MacOS</a>
					</li>
				</ul>
			</div>
		</div>
		<hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">
		<div class="text-center">
			<a href="#"
				class="flex items-center justify-center mb-5 text-2xl font-semibold text-gray-900 dark:text-white">
				<img src="https://demo.themesberg.com/landwind/images/logo.svg" class="h-6 mr-3 sm:h-9" alt="Landwind Logo" />
Landwind
</a>
				<span class="block text-sm text-center text-gray-500 dark:text-gray-400">© 2021-2022 Landwind™. All Rights Reserved. Built with <a href="#" target="_blank" class="text-purple-600 hover:underline dark:text-purple-500">Flowbite</a> and <a href="#" target="_blank" class="text-purple-600 hover:underline dark:text-purple-500">Tailwind CSS</a>.
</span>
				<ul class="flex justify-center mt-5 space-x-5">
					<li>
						<a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path fill-rule="evenodd"
									d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
									clip-rule="evenodd" /></svg>
						</a>
					</li>
					<li>
						<a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path fill-rule="evenodd"
									d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
									clip-rule="evenodd" /></svg>
						</a>
					</li>
					<li>
						<a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path
									d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
								</svg>
						</a>
					</li>
					<li>
						<a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path fill-rule="evenodd"
									d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
									clip-rule="evenodd" /></svg>
						</a>
					</li>
					<li>
						<a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path fill-rule="evenodd"
									d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
									clip-rule="evenodd" /></svg>
						</a>
					</li>
				</ul>
		</div>
	</div>
</footer>
 

</template>

<script setup>
import { ref, computed, watch, reactive, onMounted } from 'vue'

import logo from '@/Images/psu_logo.png';
import psu from '@/Images/486575578_1149828820487521_8969542889143746598_n.jpg';
import sevices from '@/Images/services.svg';
import homeicon from '@/Images/home_icon.svg';
import campus1 from '@/Images/Caramoan2.jpg';
import campus2 from '@/Images/goa.jpg';
import campus3 from '@/Images/lagonoy.jpg';
import campus4 from '@/Images/sagnay.jpg';
import campus5 from '@/Images/salogon.jpg';
import campus6 from '@/Images/sanjose.jpg';
import campus7 from '@/Images/tinambac.jpg';





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