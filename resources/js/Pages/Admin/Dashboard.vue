<template>
    <Head title="Admin Dashboard"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <section class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
                    <div class="flex items-center p-8 bg-white shadow rounded-lg">
                        <div
                            class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d=""/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold">{{ dash.sports }}</span>
                            <span class="block text-gray-500">Sports</span>
                        </div>
                    </div>
                    <div class="flex items-center p-8 bg-white shadow rounded-lg">
                        <div
                            class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-full mr-6">
                            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d=""/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold">{{ dash.users }}</span>
                            <span class="block text-gray-500">Users</span>
                        </div>
                    </div>
                    <div class="flex items-center p-8 bg-white shadow rounded-lg">
                        <div
                            class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-red-100 rounded-full mr-6">
                            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d=""/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold">{{ dash.subUsers }}</span>
                            <span class="block text-gray-500">Subscribers</span>
                        </div>
                    </div>
                    <div class="flex items-center p-8 bg-white shadow rounded-lg">
                        <div
                            class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-orange-100 rounded-full mr-6">
                            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                 class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d=""/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold">{{ new Date().getHours() + " : " + new Date().getMinutes() }}</span>
                            <span class="block text-gray-500">Time</span>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import {Inertia} from '@inertiajs/inertia';
export default {
    props: {dash:Object},
    components: {
        AuthenticatedLayout,
        Head
    },

}
</script>
