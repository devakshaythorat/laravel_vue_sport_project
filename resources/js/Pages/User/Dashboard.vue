<template>
    <Head title="Dashboard"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div tabindex="0" class="focus:outline-none">
                <div class="mx-auto container ">
                    <div class="flex flex-wrap  items-center lg:justify-between justify-center pb-10 mt-16">
                        <div v-for="sport in sports" :key="sport.id" tabindex="0"
                             class="focus:outline-none my-2 mx-2 w-72 xl:mb-0 mb-8">
                            <div class="sm:rounded-lg bg-blue-200  dark:bg-gray-800">
                                <div class="flex items-center justify-between px-4 pt-4">
                                    <div>
                                        <img class="dark:bg-white focus:outline-none"
                                             src="https://tuk-cdn.s3.amazonaws.com/can-uploader/4-by-2-col-grid-svg1.svg"
                                             alt="bookmark"/>
                                    </div>

                                    <div class="bg-yellow-200 py-1.5 px-6 rounded-full">

                                        <div v-if="sport.users.length">
                                            <div v-for="user in sport.users" :key="user.id">
                                                <button @click="unsub(sport.id)"
                                                        v-if="(user.pivot.user_id == $page.props.auth.user.id)"
                                                        class="focus:outline-none text-xs text-yellow-700">Unsubscribe
                                                </button>
                                            </div>
                                        </div>
                                        <button @click="sub(sport.id)"
                                                class="focus:outline-green-800 border-green-700 text-xs text-black-700"
                                                v-else>Subscribe
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex items-center">
                                        <h2 tabindex="0"
                                            class="focus:outline-none text-lg dark:text-white font-semibold">
                                            {{ sport.title }}</h2>
                                    </div>
                                    <p tabindex="0"
                                       class="focus:outline-none text-xs text-gray-600 dark:text-gray-200 mt-2">
                                        {{ sport.description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<!--<script>-->
<!--import AuthenticatedLayout from '@/Layouts/User/AuthenticatedLayout.vue';-->
<!--import {Head} from '@inertiajs/inertia-vue3';-->
<!--import {Inertia} from "@inertiajs/inertia";-->
<!--import {createToaster} from "@meforma/vue-toaster";-->

<!--export default {-->
<!--    components: {-->
<!--        AuthenticatedLayout, Head-->
<!--    },-->
<!--    props: {sports: Object},-->
<!--    setup() {-->
<!--        const toaster = createToaster({ /* options */});-->
<!--        const sub = (id) => {-->
<!--            Inertia.get('/user/subscribe/' + id);-->
<!--            toaster.success(`Sport Subscribed Successfully`, {position: "top-right"});-->
<!--        }-->
<!--        const unsub = (id) => {-->
<!--            Inertia.get('/user/unsubscribe/' + id);-->
<!--            toaster.error(`Sport Unsubscribed Successfully`, {position: "top-right"});-->
<!--        }-->
<!--        return {-->
<!--            sub, unsub-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

<script setup>
import AuthenticatedLayout from '@/Layouts/User/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import {createToaster} from "@meforma/vue-toaster";

const props = defineProps({sports: Object});
const toaster = createToaster({ /* options */});
const sub = (id) => {
    Inertia.get('/user/subscribe/' + id);
    toaster.success(`Sport Subscribed Successfully`, {position: "top-right"});
}
const unsub = (id) => {
    Inertia.get('/user/unsubscribe/' + id);
    toaster.error(`Sport Unsubscribed Successfully`, {position: "top-right"});
}
</script>
