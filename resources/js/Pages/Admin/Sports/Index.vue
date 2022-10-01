<template>
    <Head title="Admin Sports"/>
    <AuthenticatedLayout>
        <div class="py-12 px-12 ">
            <div class="overflow-x-auto  relative shadow-md sm:rounded-lg">
                <div class="flex justify-between items-center py-4 bg-white dark:bg-gray-500 px-2  bg-gray-500">
                    <div>
                        <button @click="toggleForm()"
                                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-blue-400 text-white bg-blue-700 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                type="button">Add Sport
                        </button>
                    </div>
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="table-search-users" v-model="search"
                               class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Search for Sport">
                    </div>
                </div>

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50 bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Description
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Subscribed Users
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="sport in sports" :key="sport.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <th scope="row"
                            class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="pl-3">
                                <div class="text-base font-semibold">{{ sport.title }}</div>

                            </div>
                        </th>
                        <td class="py-4 px-6">
                            {{ sport.description }}
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center">
                                <div v-if="(sport.users.length > 0)"
                                     class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></div>
                                <div v-else class="h-2.5 w-2.5 rounded-full bg-red-400 mr-2"></div>
                                {{ sport.users.length }} <a href="#" type="button"
                                                            class="font-medium text-yellow-500 dark:text-yellow-500 hover:underline px-2"
                                                            @click="showUser(sport.id)">show </a>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <!-- Modal toggle -->
                            <a href="#" type="button" data-modal-toggle="SportModal" @click="toggleForm(sport.id)"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline px-2">Edit </a>
                            <a href="#" type="button" data-modal-toggle="SportModal"
                               class="font-medium text-red-500 dark:text-red-500 hover:underline px-2"
                               @click="deleteSport(sport.id)">Delete </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!-- Edit user modal -->
                <div id="SportModal" tabindex="-1" aria-hidden="true" v-if="formActive"
                     class=" bg-gray-700/50 overflow-y-auto overflow-x-auto fixed top-0 right-0 left-0 z-50 justify-center items-center p-4 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative w-full max-w-2xl mx-auto h-full md:h-auto">
                        <!-- Modal content -->
                        <form @submit.prevent="(sportId == null) ? addSport() : updateSport();"
                              class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex justify-between items-start p-4 rounded-t border-b bg-gray-500 dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 text-white">
                                    {{ (sportId == null) ? "Add Sport" : "Edit Sport" }}
                                </h3>
                                <button type="button" @click="toggleForm()"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="editUserModal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="first-name"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" name="first-name" id="first-name"
                                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               required="" v-model="formContent.title">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="last-name"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                        <input type="text" name="last-name" id="last-name"
                                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               required="" v-model="formContent.description">
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div
                                class="flex items-center justify-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                <button type="submit"
                                        class="text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div
            class=" z-40 fixed top-0 left-0 bg-gray-700/50 w-full h-full outline-none overflow-x-hidden overflow-y-auto"
            v-if="listActive" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableLabel"
            aria-hidden="true">
            <div class="sm:h-[calc(100%-3rem)] max-w-lg my-6 mx-auto relative w-auto pointer-events-none">
                <div
                    class="max-h-full overflow-hidden border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div
                        class="flex flex-shrink-0 items-center bg-gray-500 justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-white" id="exampleModalScrollableLabel">
                            Subscribed Users - {{ users.length }}
                        </h5>
                        <button type="button"
                                class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="flex-auto overflow-y-auto relative p-4">
                        <ul v-if="(users.length > 0)">
                            <li v-for="(user,index) in users" :key="index" class="border text-center">
                                {{ user.name }} - {{ user.email }}
                            </li>
                        </ul>
                        <ul v-else>
                            <li>No Subscribers Found</li>
                        </ul>
                    </div>
                    <div
                        class="flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                        <button type="button" @click="closeList()"
                                class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
                                data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<!--<script>-->
<!--import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';-->
<!--import {Head} from '@inertiajs/inertia-vue3';-->
<!--import {Inertia} from '@inertiajs/inertia';-->
<!--import {onMounted, ref, watch} from 'vue';-->
<!--import {createToaster} from "@meforma/vue-toaster";-->


<!--export default {-->
<!--    components: {-->
<!--        AuthenticatedLayout,-->
<!--        Head-->
<!--    },-->
<!--    props: {-->
<!--        sports: Object,-->
<!--        filters: Object-->
<!--    },-->
<!--    setup(props) {-->
<!--        const toaster = createToaster({ /* options */});-->
<!--        const sportId = ref(null);-->
<!--        const formActive = ref(false);-->
<!--        const listActive = ref(false);-->
<!--        const formContent = ref({})-->
<!--        const search = ref(props.filters.search);-->
<!--        const users = ref([]);-->
<!--        const toggleForm = (id = null) => {-->
<!--            formActive.value = !formActive.value;-->
<!--            sportId.value = null;-->
<!--            formContent.value = {};-->
<!--            if (id) {-->
<!--                sportId.value = id;-->
<!--                fetch('/admin/sports/' + id).then(res => res.json()).then(data => {-->
<!--                    formContent.value = data;-->
<!--                })-->
<!--            }-->
<!--        }-->
<!--        const addSport = () => {-->
<!--            if (formContent.value === {}) {-->
<!--                return false;-->
<!--            }-->
<!--            if (formContent.value) {-->
<!--                Inertia.post('/admin/sports', formContent.value,);-->
<!--                formContent.value = {};-->
<!--                formActive.value = false;-->
<!--                toaster.success(`Sport Added Successfully`, {position: "top-right"});-->
<!--            }-->
<!--        }-->
<!--        const updateSport = () => {-->
<!--            if (formContent.value === {}) {-->
<!--                return false;-->
<!--            }-->
<!--            Inertia.put('/admin/sports/' + sportId.value, formContent.value, {preserveState: true});-->
<!--            formContent.value = {};-->
<!--            formActive.value = false;-->
<!--            sportId.value = null;-->
<!--            toaster.info(`Sport Updated Successfully`, {position: "top-right"});-->
<!--        }-->
<!--        const deleteSport = id => {-->
<!--            Inertia.delete('/admin/sports/' + id);-->
<!--            toaster.error(`Sport Deleted Successfully`, {position: "top-right"});-->
<!--        }-->
<!--        const closeList = () => {-->
<!--            listActive.value = false;-->
<!--        }-->
<!--        const showUser = id => {-->
<!--            fetch('/admin/sports/' + id).then(res => res.json()).then(data => {-->
<!--                users.value = data;-->
<!--                listActive.value = true;-->
<!--            })-->
<!--        }-->
<!--        watch(search, value => {-->
<!--            Inertia.get('/admin/sports', {search: value}, {preserveState: true, replace: true})-->
<!--        })-->
<!--        return {-->
<!--            formActive,-->
<!--            toggleForm,-->
<!--            deleteSport,-->
<!--            addSport,-->
<!--            sportId,-->
<!--            formContent,-->
<!--            updateSport,-->
<!--            search,-->
<!--            showUser,-->
<!--            users,-->
<!--            listActive,-->
<!--            closeList-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import {Inertia} from '@inertiajs/inertia';
import {onMounted, ref, watch} from 'vue';
import {createToaster} from "@meforma/vue-toaster";

const props = defineProps({
    sports: Object,
    filters: Object
})
const toaster = createToaster({ /* options */});
const sportId = ref(null);
const formActive = ref(false);
const listActive = ref(false);
const formContent = ref({})
const search = ref(props.filters.search);
const users = ref([]);
const toggleForm = (id = null) => {
    formActive.value = !formActive.value;
    sportId.value = null;
    formContent.value = {};
    if (id) {
        sportId.value = id;
        fetch('/admin/sports/' + id).then(res => res.json()).then(data => {
            formContent.value = data;
        })
    }
}
const addSport = () => {
    if (formContent.value === {}) {
        return false;
    }
    if (formContent.value) {
        Inertia.post('/admin/sports', formContent.value,);
        formContent.value = {};
        formActive.value = false;
        toaster.success(`Sport Added Successfully`, {position: "top-right"});
    }
}
const updateSport = () => {
    if (formContent.value === {}) {
        return false;
    }
    Inertia.put('/admin/sports/' + sportId.value, formContent.value, {preserveState: true});
    formContent.value = {};
    formActive.value = false;
    sportId.value = null;
    toaster.info(`Sport Updated Successfully`, {position: "top-right"});
}
const deleteSport = id => {
    Inertia.delete('/admin/sports/' + id);
    toaster.error(`Sport Deleted Successfully`, {position: "top-right"});
}
const closeList = () => {
    listActive.value = false;
}
const showUser = id => {
    fetch('/admin/sports/' + id).then(res => res.json()).then(data => {
        users.value = data;
        listActive.value = true;
    })
}
watch(search, value => {
    Inertia.get('/admin/sports', {search: value}, {preserveState: true, replace: true})
})
</script>
