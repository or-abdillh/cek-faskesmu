<template>
    <NavigationBar></NavigationBar>
    <Notifications width="50%" :pause-on-hover="true" position="bottom left">
    </Notifications>
    <main class="min-h-screen">
        <slot />
    </main>
    <GoToTopButton></GoToTopButton>
    <Footer></Footer>
</template>

<script setup>

import NavigationBar from '@/Components/base/NavigationBar.vue'
import Footer from '@/Components/base/Footer.vue'
import GoToTopButton from '@/Components/base/GoToTopButton.vue'

</script>