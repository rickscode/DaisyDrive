<script setup>
import Navigation from '@/Components/Navigation.vue';
import SearchForm from '@/Components/SearchForm.vue';
</script>

<template>
    <div class="h-screen bg-gray-70 flex w-full gap-4">
        <Navigation />      
    </div>

    <main class="flex flex-col flex-1 px-4 overflow-hidden">
        <div class="flex items-center justify-between w-full">
            <SearchForm />

        </div>

    </main>
</template>
