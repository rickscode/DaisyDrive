<script setup>
// Imports
import {Link} from '@inertiajs/vue3'
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import CreateDropDown from "@/Components/app/CreateDropDown.vue";
import NavLink from '@/Components/NavLink.vue';


// Uses

// Refs

// Props & Emit

// Computed

// Methods

// Hooks

</script>

<template>
    <nav class="min-w-[200px]">
            <Link :href="route('myFiles')" class="h-[800] px-3 flex items-center gap-3">
                <ApplicationLogo
                    class="block h-9 w-auto fill-current text-gray-800"
                />

                DaisyDrive

            </Link>
        <div class="px-4">
            <CreateDropDown />
        </div>
        <div class="py-4">
            <NavLink :href="route('myFiles')" :active="$page.url == '/my-files'">My Saved Files</NavLink>
            <NavLink href="/">Files Shared By Me</NavLink>
            <NavLink href="/">Files Shared With Me</NavLink>
            <NavLink href="/">Deleted Files</NavLink>



        </div>
    </nav>
        
    
</template>