<template>
    <NavigationBar></NavigationBar>
    <main>
        <slot />
    </main>
</template>

<script setup>

import NavigationBar from '@/Components/base/NavigationBar.vue'

</script>