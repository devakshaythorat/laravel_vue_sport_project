<script setup>

import Topbar from '@/Layouts/Admin/Topbar.vue';
import Footer from '@/Layouts/Admin/Footer.vue';
import Sidebar from '@/Layouts/Admin/Sidebar.vue'

</script>

<template>
    <div>
        <Topbar/>
        <div class="min-h-screen bg-gray-100">
            <main>
                <slot/>
            </main>
        </div>
        <Footer/>
    </div>
</template>
