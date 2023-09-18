<script setup>
import Navigation from '@/Components/Navigation.vue';
import Flash from '@/Components/Flash.vue';
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <Navigation />        

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <slot />
        </div>
    </div>

    <Flash />
</template>
