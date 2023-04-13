<template>
    <NavigationBar></NavigationBar>
    <main>
        <slot />
    </main>
    <Footer></Footer>
</template>

<script setup>

import NavigationBar from '@/Components/base/NavigationBar.vue'
import Footer from '@/Components/base/Footer.vue'

</script>