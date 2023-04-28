<script setup>
defineProps({
    group: {
        type: Object
    },
    week: {
        type: String
    }
})
</script>

<template>
    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">Week {{ week }}</div>
        <ul role="list" class="divide-y divide-gray-200">
            <li class="py-3 sm:py-4" v-for="(match, id) in group">
                <div class="flex items-center space-x-4">
                    <p class="text-md font-medium text-gray-900 truncate">
                        {{ match[0] }} - {{ match[1]}}
                    </p>
                </div>
            </li>
        </ul>
    </div>
</template>
