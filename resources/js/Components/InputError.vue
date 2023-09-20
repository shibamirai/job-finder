<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <!-- <p class="text-sm text-red-600"> -->
        <p class="text-red-500 text-xs mt-1">
            {{ message }}
        </p>
    </div>
</template>
