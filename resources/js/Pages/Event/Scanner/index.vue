<script setup>
import AppLayout from '@/Layouts/MyLayout.vue';
import { ref, computed, watch, reactive } from 'vue'
import Welcome from '@/Components/Welcome.vue';
import { router, usePage, Link, Head } from '@inertiajs/vue3'
import { onMounted, onUpdated } from 'vue'
import debounce from 'lodash/debounce'
import { initFlowbite } from 'flowbite'
import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'vue-qrcode-reader'
import logo from '../../../images/csc.png';
import logo2 from '../../../images/PRIME.png';
import logo3 from '../../../images/psu_logo.png';

// const props = defineProps({
//         Campuses : Object,
//         Courses : Object,
//         Schools : Object,
//         TrackStrand : Object,
//         Strands : Object,
//         CivilStatus : Object,
//         Gender : Object,
//         filters : Object,
//         } )
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
  initTooltips
} from 'flowbite'

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
})
const { props } = usePage();
const dialogVisible = ref(true);
const result = ref(null);
const loading = ref(false);
/*** detection handling ***/
const resulted = ref('')
const event_date_id = ref('')
const participants = ref('')
const participant_arrive_count = ref('')
const participant_count = ref('')




async function onDetect(detectedCodes) {
  console.log(detectedCodes[0]?.rawValue);

  // Set loading state if necessary
  loading.value = true;
  const rawValue = detectedCodes[0]?.rawValue;
  console.log(rawValue);
  console.log(detectedCodes);
  console.log(event_date_id.value);



  // Check if rawValue exists and remove the substring
  // const cleanedValue = rawValue ? rawValue.replace('https://hrms.parsu.edu.ph/examverification?exam=', '') : '';
  if (event_date_id.value == '') {
    dialogVisible.value = true;

  }

  else {
    try {
      const response = await axios.post('/Event/Scanner/GetPaticipantDetails', {
        participant_id: rawValue,
        event_id: event_date_id.value + '',
      });

      // Access the response data after awaiting
      resulted.value = response.data;

    } catch (error) {
      console.error('Error fetching data1:', error);
      resulted.value = null; // Handle error appropriately
    } finally {
      loading.value = false; // Reset loading state
    }
    try {
      const response = await axios.post('/Event/Scanner/GetPaticipants', {
        event_id: event_date_id.value,
      });

      // Access the response data after awaiting
      participants.value = response.data.participants;
      participant_count.value = response.data.participant_count;
      participant_arrive_count.value = response.data.participant_arrive_count;
      console.log(response.data.applicant);

    } catch (error) {
      console.error('Error fetching data:', error);
      resulted.value = null; // Handle error appropriately
    } finally {
      loading.value = false; // Reset loading state
    }
  }
}

/*** select camera ***/
const selectedConstraints = ref({ facingMode: 'environment' })
const defaultConstraintOptions = [
  { label: 'Rear Camera', constraints: { facingMode: 'environment' } },
  { label: 'Front Camera', constraints: { facingMode: 'user' } }
]
const constraintOptions = ref(defaultConstraintOptions)

async function onCameraReady() {
  const devices = await navigator.mediaDevices.enumerateDevices()
  const videoDevices = devices.filter(({ kind }) => kind === 'videoinput')

  constraintOptions.value = [
    ...defaultConstraintOptions,
    ...videoDevices.map(({ deviceId, label }) => ({
      label: `${label} (ID: ${deviceId})`,
      constraints: { deviceId }
    }))
  ]

  error.value = ''
}

/*** track functions ***/
function paintOutline(detectedCodes, ctx) {
  for (const detectedCode of detectedCodes) {
    const [firstPoint, ...otherPoints] = detectedCode.cornerPoints

    ctx.strokeStyle = 'red'
    ctx.beginPath()
    ctx.moveTo(firstPoint.x, firstPoint.y)
    for (const { x, y } of otherPoints) {
      ctx.lineTo(x, y)
    }
    ctx.lineTo(firstPoint.x, firstPoint.y)
    ctx.closePath()
    ctx.stroke()
  }
}

function paintBoundingBox(detectedCodes, ctx) {
  for (const detectedCode of detectedCodes) {
    const {
      boundingBox: { x, y, width, height }
    } = detectedCode

    ctx.lineWidth = 2
    ctx.strokeStyle = '#007bff'
    ctx.strokeRect(x, y, width, height)
  }
}

function paintCenterText(detectedCodes, ctx) {
  for (const detectedCode of detectedCodes) {
    const { boundingBox, rawValue } = detectedCode

    const centerX = boundingBox.x + boundingBox.width / 2
    const centerY = boundingBox.y + boundingBox.height / 2

    const fontSize = Math.max(12, (50 * boundingBox.width) / ctx.canvas.width)

    ctx.font = `bold ${fontSize}px sans-serif`
    ctx.textAlign = 'center'

    ctx.lineWidth = 3
    ctx.strokeStyle = '#35495e'
    ctx.strokeText(rawValue, centerX, centerY)

    ctx.fillStyle = '#5cb984'
    ctx.fillText(rawValue, centerX, centerY)
  }
}

const trackFunctionOptions = [
  { text: 'Nothing (default)', value: undefined },
  { text: 'Outline', value: paintOutline },
  { text: 'Centered Text', value: paintCenterText },
  { text: 'Bounding Box', value: paintBoundingBox }
]
const trackFunctionSelected = ref(trackFunctionOptions[1])

/*** barcode formats ***/
const barcodeFormats = ref({
  aztec: false,
  code_128: false,
  code_39: false,
  code_93: false,
  codabar: false,
  databar: false,
  databar_expanded: false,
  data_matrix: false,
  dx_film_edge: false,
  ean_13: false,
  ean_8: false,
  itf: false,
  maxi_code: false,
  micro_qr_code: false,
  pdf417: false,
  qr_code: true,
  rm_qr_code: false,
  upc_a: false,
  upc_e: false,
  linear_codes: false,
  matrix_codes: false
})

const selectedBarcodeFormats = computed(() => {
  return Object.keys(barcodeFormats.value).filter((format) => barcodeFormats.value[format])
})

/*** error handling ***/
const error = ref('')

function onError(err) {
  error.value = `[${err.name}]: `

  switch (err.name) {
    case 'NotAllowedError':
      error.value += 'You need to grant camera access permission'
      break
    case 'NotFoundError':
      error.value += 'No camera on this device'
      break
    case 'NotSupportedError':
      error.value += 'Secure context required (HTTPS, localhost)'
      break
    case 'NotReadableError':
      error.value += 'Is the camera already in use?'
      break
    case 'OverconstrainedError':
      error.value += 'Installed cameras are not suitable'
      break
    case 'StreamApiNotSupportedError':
      error.value += 'Stream API is not supported in this browser'
      break
    case 'InsecureContextError':
      error.value += 'Camera access is only permitted in secure context. Use HTTPS or localhost rather than HTTP.'
      break
    default:
      error.value += err.message
  }
}
watch(event_date_id, async function (value) {
  try {

    const response = await axios.post('/Event/Scanner/GetPaticipants', {
      event_id: value,
    });

    // Access the response data after awaiting
    participants.value = response.data.participants;
    participant_count.value = response.data.participant_count;
    participant_arrive_count.value = response.data.participant_arrive_count;
    dialogVisible.value = false;
    console.log(response.data.applicant);

  } catch (error) {
    console.error('Error fetching data:', error);
    resulted.value = null; // Handle error appropriately
  } finally {
    loading.value = false; // Reset loading state
  }

  // onDetect('5ea14f98-fb41-4e6a-b828-1db60371038b');
  // try {
  //   const response = await axios.post('/get-examinee-details', {
  //     exam_id: "5ea14f98-fb41-4e6a-b828-1db60371038b",
  //     exam_schedule_id: value,
  //   });

  //   // Access the response data after awaiting
  //   resulted.value = response.data;
  //   console.log(response.data.applicant);

  // } catch (error) {
  //   console.error('Error fetching data:', error);
  //   resulted.value = null; // Handle error appropriately
  // } finally {
  //   loading.value = false; // Reset loading state
  // }
});
</script>
<style scoped>
.error {
  font-weight: bold;
  color: red;
}

.barcode-format-checkbox {
  margin-right: 10px;
  white-space: nowrap;
  display: inline-block;
}
/* .bg-cover {
    position: relative;
    background-image: url('https://edms.parsu.edu.ph/images/konektify_hero_bg_v3.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
} */
.bg-cover::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at center, rgba(15, 23, 42, 0.4) 0%, rgba(15, 23, 42, 0.8) 100%);
    backdrop-filter: blur(4px);
    z-index: 1;
    pointer-events: none;
}
.glass-container {
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(20px) saturate(180%);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 2rem;
  width: 100%;
  max-width: 450px;
  padding: 2.5rem;
  position: relative;
  z-index: 20;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
  animation: fadeInScale 0.6s ease-out;
}
</style>

<template>
 

    <Head title="Registration" />
    <el-dialog v-model="dialogVisible" title="Tips" width="300" :show-close="false" class="rounded-lg ">
      <template #header="{ close, titleId, titleClass }">
        <div class="my-header">
          <!-- Modal header -->
          <div
            class="flex items-center justify-between    rounded-t dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
              Set Event Schedule
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

      <div class="relative pb-4 w-full max-w-2xl max-h-full">

        <!-- Modal content -->
        <div class="relative bg-white rounded-lg  dark:bg-gray-700">
          <!-- component -->



          <!-- Modal body -->
          <form class="max-w-full mx-auto">

            <div class="relative">
              <select v-model="event_date_id" id="exam-schedule"
                class="block rounded-xl px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">

                <option v-for="schedule in props.Schedules" :key="schedule.id" :value="schedule.id">{{
                  schedule.event_name }} - ({{ schedule.when }})
                </option>

              </select>
              <label for="floating_helper"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Select
                Event Schedule</label>
            </div>
            <p id="floating_helper_text" class="mt-2 text-xs text-gray-500 dark:text-gray-400">Remember, to select
              event schedule before scanning participant QRCODE .</p>


          </form>
        </div>
      </div>

    </el-dialog>

    <div class="h-screen w-full bg-[url(https://scontent.fmnl13-1.fna.fbcdn.net/v/t39.30808-6/486575578_1149828820487521_8969542889143746598_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=cc71e4&_nc_eui2=AeH-STpz7zhlT0yj0qhBvGuUHnw4rp45QmwefDiunjlCbAANDahnBEE2xPBLR1-jEzaV9prh-eKr5kCrsM4keDS-&_nc_ohc=DL4h7v1MvSMQ7kNvwF4wrgj&_nc_oc=AdmpRTrdsjxDoeUCVM9Ofl2CmjzWKUliH7I1DiVmWNra2B0eQ-DurkemLwM0C-zMTq8&_nc_zt=23&_nc_ht=scontent.fmnl13-1.fna&_nc_gid=lzmxfO4Tq1LB2X-in45Arw&oh=00_AfrZdBMWwVJEAq54AnHkBZVqGlH6QgrLaeO8UFxwi0Cbuw&oe=6977DBD7)] 
    bg-center bg-no-repeat  backdrop-filter backdrop-blur-xl bg-blue-100/10 bg-opacity-80 relative bg-cover flex items-center justify-center">

    <div class="max-w-full sm:px-6 lg:px-8 relative z-10 p-6 ">
        <!-- <div class="px-8 py-4 mb-4 w-full 
        bg-blue-900/20  bg-clip-padding backdrop-filter backdrop-blur-sm rounded-xl 
        md:mt-0 sm:max-w-md shadow-lg flex items-center space-x-6">
            <img class="h-12 w-12" :src="logo3" alt="PSU Logo">
            <div>
                <div class="text-[16px] font-black tracking-wide text-white uppercase leading-none whitespace-nowrap">Partido State University</div>
                <p class="text-slate-300 md:text-sm font-black text-xs">Human Resource Management System</p>
            </div>
        </div> -->

        <div class="w-full h-screen md:max-w-sm  bg-blue-900/20  bg-clip-padding backdrop-filter backdrop-blur-sm   rounded-xl shadow-xl sm:p-6 md:p-8 p-4">
            <div class="logo-container flex justify-center w-full px-4 mb-2">
                                          <img :src="logo3" alt="Logo 3" class="logo mx-2 h-15  " />
          
                                          <img :src="logo" alt="Logo 1" class="logo mx-1 h-16  " />
                                          <img :src="logo2" alt="Logo 2" class="logo mx-2 h-16  " />
                                      </div>     
          <h3 class="text-[16px] text-lg font-bold mb-2 text-center text-white uppercase">
                    Event scanner
                </h3>
          <form class="max-w-full mx-auto">
                <p class="mt-2 mb-2 text-xs text-white dark:text-gray-400">Remember, to select event schedule before scanning participant QRCODE.</p>

                <div class="relative">
                    <select v-model="event_date_id" id="exam-schedule" class="block mb-2 rounded-lg bg-white/80 px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 appearance-none border-0 border-b-2 border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option v-for="schedule in props.Schedules" :key="schedule.id" :value="schedule.id">{{ schedule.event_name }} - ({{ schedule.when }})</option>
                    </select>
                    <label for="exam-schedule" class="absolute text-sm text-gray-500 transition-transform duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Select Event Schedule</label>
                </div>
            </form>

            <p class="error text-xs">{{ error }}</p>

            <div class="flex justify-between py-3 px-4 bg-green-100/40 rounded-lg m-3" v-if="resulted">
                <div class="flex items-center space-x-4">
                    <div class="flex flex-col space-y-1">
                        <span class="text-xs md:text-xl text-blue-950 font-black font-sans uppercase">{{ resulted.name }}</span>
                        <span class="text-sm">Has arrived 🔥</span>
                    </div>
                </div>
                <div class="flex-none px-4 py-2 text-stone-600 text-xs md:text-sm">{{ resulted.date }}</div>
            </div>

            <div class="flex justify-center items-center mt-2   ">
                <div class="relative border-4 border-green-500 rounded-lg overflow-hidden shadow-lg">
                    <div class="absolute inset-0 flex justify-center items-center">
                        <div class="border-t-4 border-green-500 w-full h-8 absolute top-0 transform -translate-y-1/2">
                            <div class="animate-pulse h-full w-full bg-gray-900"></div>
                        </div>
                        <div class="border-b-4 border-green-500 w-full h-8 absolute bottom-0 transform translate-y-1/2">
                            <div class="animate-pulse h-full w-full bg-gray-900"></div>
                        </div>
                    </div>
                    <qrcode-stream :constraints="selectedConstraints" :track="trackFunctionSelected.value" :formats="selectedBarcodeFormats" @error="onError" @detect="onDetect" @camera-on="onCameraReady" class="w-1/2 max-h-64"></qrcode-stream>
                </div>
            </div>

            <div class=" rounded-lg shadow-md  mt-2">
                <h3 class="text-lg font-bold mb-2 text-center text-white">
                    Attendance Overview: <span class="text-blue-600">{{ participant_arrive_count }}</span> / <span class="text-white">{{ participant_count }}</span>
                </h3>

                <div class="relative flex-1 md:flex-none w-full  mb-4">
                    <input type="text" id="search" class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg w-full bg-gray-50 dark:bg-gray-700 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500" placeholder="Search...">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>

                <div class="relative overflow-auto max-h-32 shadow-md rounded-xl sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-2 text-[10px] bg-gray-50 dark:bg-gray-800">#</th>
                                <th scope="col" class="px-6 py-2 text-[10px] bg-gray-50">Name</th>
                                <th scope="col" class="px-6 py-2 text-[10px] bg-gray-50 dark:bg-gray-800">Date and Time Arrive</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr class="border-b " v-for="(participant, index) in participants" :key="participant.id" :value="participant.id">
                                <th scope="row" class="px-6 py-2  text-[10px]font-medium text-black-800 whitespace-nowrap transparent text-white">{{ index + 1 }}</th>
                                <td class="px-6 py-2 text-[10px] bg-transparent text-white">{{ participant.name.toUpperCase() }}</td>
                                <td class="px-6 py-2 text-[10px] bg-transparent text-white">{{ participant.date_time_arrive }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
 
</template>
