<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <div class="flex flex-col items-center mb-6">
                <Link href="/">
                    <ApplicationLogo class="w-48 fill-current text-gray-500" />
                </Link>
            </div>

            <slot />
        </div>
    </div>
</template>
