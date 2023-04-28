<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    useOutline: {
        type: Boolean,
        default: true
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input :class="{ 'border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500': useOutline }"
        class="bg-gray-100 rounded-md shadow-sm p-2" :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)" ref="input" />
</template>
