<script setup>
import AppLayout from '@/Layouts/MyLayout.vue';
import { Dropdown, Modal } from 'flowbite'
import { router, usePage, Link, Head, usePoll } from '@inertiajs/vue3'
import { ref, computed, watch, reactive, onMounted } from 'vue'
import debounce from 'lodash/debounce'
import { initFlowbite } from 'flowbite'
import Position from './Settings/Position.vue'
import WorkSchedule from './Settings/WorkSchedule.vue'
import UserTab from './Settings/User.vue'
import SessionTab from './Settings/Session.vue'



// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();

})

const { props } = usePage();


// usePoll(2000, {
//     onStart() {
//         // getLeaveStat();

//         // computeLeaveBalance();

//     },
//     onFinish() {
//         // console.log('Polling request finished')
//     }
// })


function closeModal() {
    isOpen.value = false
}
const dialogVisible = ref(false);

const form = reactive({
    id: '',

});
const openModal = () => {


    dialogVisible.value = true;

}


const openUpdateModal = (formData) => {




    dialogVisible.value = true;

} 
</script>

<template>
    <AppLayout title="Leaves & Time-off">



        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab"
                        data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">Work Schedules</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="position-tab"
                        data-tabs-target="#position" type="button" role="tab" aria-controls="position"
                        aria-selected="false">Positions</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="user-tab" data-tabs-target="#user"
                        type="button" role="tab" aria-controls="user" aria-selected="false">Users</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="session-tab" data-tabs-target="#session"
                        type="button" role="tab" aria-controls="session" aria-selected="false">Sessions</button>
                </li>
            </ul>
        </div>
        <div id="position-tab-content">
            <div class="hidden   rounded-lg" id="position" role="tabpanel" aria-labelledby="position-tab">
                <Position />
            </div>
        </div>
        <div id="default-tab-content">
            <div class="hidden  rounded-lg" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                <WorkSchedule />

            </div>
            <div
             class="hidden  rounded-lg  " id="user" role="tabpanel"
                aria-labelledby="user-tab">
                <UserTab />
            </div>
                  <div class="hidden   rounded-lg  " id="session" role="tabpanel"
                aria-labelledby="session-tab">
                <SessionTab />
            </div>
            <div class="hidden  rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel"
                aria-labelledby="settings-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>.
                    Clicking
                    another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to
                    control the
                    content visibility and styling.</p>

            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel"
                aria-labelledby="contacts-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>.
                    Clicking
                    another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to
                    control the
                    content visibility and styling.</p>
            </div>
        </div>


    </AppLayout>
</template>