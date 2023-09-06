
<script setup>
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm } from "@inertiajs/vue3";

// Variables
const form = useForm({
    name: ''
})


// Methods
function createFolder()
{
    console.log("Create folder");
}

function closeModal() {
    emit('update:modelValue')
    form.clearErrors();
    form.reset()
}


// Props & Emits
const {modelValue} = defineProps({
    modelValue: Boolean
})
const emit = defineEmits(['update:modelValue'])


</script>

<template>
    <modal :show="modelValue" max-width="md">
        <div class="p-7">
            <h2 class="font-medium text-lg text-gray-800">Create New Folder</h2>
        </div>
        <div class="mt-7 p-1">
            <InputLabel for="folderName" value="Folder Name" class="sr-only"/>
            <TextInput  type="text" 
                        id="folderName"  v-model="form.name"
                        class="mt-1 block w-full"
                        :class="form.errors.name ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : ''"
                        placeholder="Folder Name"
                        @keyup.enter="createFolder"
            />
            <InputError :message="form.errors.name" class="mt-2"/>
        </div>
            <div class="mt-7 flex justify-end">
                <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                <PrimaryButton class="ml-3"
                               :class="{ 'opacity-25': form.processing }"
                               @click="createFolder" :disable="form.processing">
                    Submit
                </PrimaryButton>
            </div>
    </modal>

</template>