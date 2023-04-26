<script setup>
defineProps({
    text: {
        type: String,
        required: true
    }
});
</script>

<template>
    <li>
        <div class="flex items-center space-x-4">
            <p class="text-md font-medium text-gray-900 truncate">
                {{ text }}
            </p>
        </div>
    </li>
</template>
