
<script setup>
import Modal from "@/Components/Modal.vue";

// Methods


// Props
const {modelValue} = defineProps({
    modelValue: Boolean
})
const emit = defineEmits(['update:modelValue'])


</script>

<template>
    <modal :show="modelValue">
        Show Modal
    </modal>

</template>