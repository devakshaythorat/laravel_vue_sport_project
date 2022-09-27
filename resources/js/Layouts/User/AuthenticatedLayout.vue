<script setup>

import Topbar from '@/Layouts/User/Topbar.vue';
import Footer from '@/Layouts/User/Footer.vue';


</script>

<template>
    <div>
        <Topbar/>
        <div class="min-h-screen ">
            <main>
                <slot/>
            </main>
        </div>
        <Footer/>
    </div>
</template>
