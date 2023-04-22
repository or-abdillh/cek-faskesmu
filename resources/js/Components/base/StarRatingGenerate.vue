<template>
    <section class="text-xs">
        <!-- render solid star -->
        <template v-for="star in props?.rate" :key="star">
            <i class="fa-solid fa-star text-yellow-400"></i>
        </template>
        <!-- render transparent star -->
        <template v-if="5 - props.rate > 0" v-for="diff in 5 - props.rate" :key="diff">
            <i class="fa-regular fa-star text-yellow-200"></i>
        </template>
    </section>
</template>

<script setup>

const props = defineProps({
    rate: {
        type: Number,
        default: 1
    }
})

</script>