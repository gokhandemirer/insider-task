<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TeamListItem from './TeamListItem.vue';

defineProps({
    title: {
        type: String,
        default: "Tournament Teams",
        required: false
    },
    teams: {
        type: Array,
        required: true
    }
});

defineEmits(['createFixtures']);
</script>

<template>
    <div class="w-full max-w-md p-4 bg-white sm:p-8">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900">{{ title }}</h5>
        </div>
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200">
                <TeamListItem :class="index !== teams.length - 1 ? 'py-3 sm:py-4' : 'pt-3 pb-0 sm:pt-4'"
                              v-for="({ name }, index) in teams"
                              :text="name"/>
            </ul>
        </div>
        <PrimaryButton class="mt-5 py-2 px-4" @click="$emit('createFixtures')">Create Fixtures</PrimaryButton>
    </div>
</template>
