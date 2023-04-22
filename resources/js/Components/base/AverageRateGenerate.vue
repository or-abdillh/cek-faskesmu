<template>
    <section>
        <!-- Solid star -->
        <template v-for="star in parseInt( props.average.split('.')[0] )" :key="star">
            <i class="fa-solid fa-star text-yellow-400"></i>
        </template>
        <!-- half star -->
        <span v-if="parseInt( props.average.split('.')[1] ) >= 5">
            <i class="fa-solid fa-star-half text-yellow-400"></i>
            <template v-for="star in 5 - ( parseInt( props.average.split('.')[0] ) + 1 )">
                <i class="fa-regular fa-star text-yellow-200"></i>
            </template>
        </span>
        <!-- transparent star -->
        <template v-else v-for="star in 5 - parseInt( props.average.split('.')[0] )">
            <i class="fa-regular fa-star text-yellow-200"></i>
        </template>
    </section>
</template>

<script setup>

const props = defineProps({
    average: Number
})

</script>