<template>
    <section>
        <template v-for="activity in props.activities" :key="activity.id">
            <section class="bg-slate-50 text-gray-700 border-b border-gray-200 pb-4 mb-4 px-4 flex gap-4 items-center">
                <section><i class="fa-solid fa-user"></i></section>
                <section>
                    <small>{{ activity.timestamp }}</small>
                    <p>{{ activity.description }}</p>
                </section>
            </section>
        </template>
    </section>
</template>

<script setup>

const props = defineProps({
    activities: Array
})

</script>