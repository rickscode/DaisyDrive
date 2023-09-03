<script setup>
//Imports
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

//Uses
const form = useForm({
    search: ''
})


</script>

<template>
    <form class="w-[700px] h-[150px] flex items-center">
        <TextInput type="text" 
                    class="block w-full mr-2" 
                    v.model="form.search" 
                    autocomplete 
                    placeholder="Search Files And Folders" />
        </form>

</template>