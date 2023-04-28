<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import FixtureCard from './Partials/FixtureCard.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    groups: {
        type: Object
    }
})

const form = useForm({});

const startSimulation = () => {
    form.get(route('simulation.index'));
}
</script>

<template>
    <Head title="Fixtures" />

    <div class="flex items-stretch justify-center">
        <span class="text-xl mt-5">Generated Fixtures</span>
    </div>

    <div class="flex flex-wrap items-start flex-wrap space-x-4 mt-5">
        <div class="max-w-sm rounded overflow-hidden shadow-lg" v-for="(group, key) in groups">
            <FixtureCard :group="group" :week="key" />
        </div>
    </div>

    <div class="mt-5 py-2 px-4">
        <PrimaryButton @click="startSimulation">Start Simulation</PrimaryButton>
    </div>
</template>
