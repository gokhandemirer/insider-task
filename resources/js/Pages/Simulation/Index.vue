<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Matches from './Partials/Matches.vue';
import Predictions from './Partials/Predictions.vue';
import Table from './Partials/Table.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

defineProps({
    matches: {
        type: Object
    },
    week: {
        type: String
    },
    statistics: {
        type: Object
    }
})

const form = useForm({});

const playAll = () => {
    form.post(route('simulation.playAll'));
}

const playNext = () => {
    form.post(route('simulation.playNext'));
}

const reset = () => {
    form.post(route('simulation.reset'));
}
</script>

<template>
    <Head title="Simulation" />

    <div class="flex items-stretch justify-center">
        <span class="text-xl mt-5">Simulation</span>
    </div>

    <div class="flex flex-row mt-6 gap-3">
        <div class="basis-1/2">
            <Table :statistics="statistics" />
        </div>
        <div class="basis-1/4">
            <Matches :matches="matches" :week="week" />
        </div>
        <div class="basis-1/4">
            <Predictions :statistics="statistics" />
        </div>
    </div>

    <hr class="mt-5">

    <div class="flex flex-row mt-5 text-center">
        <div class="basis-1/2">
            <PrimaryButton @click="playAll">Play All Weeks</PrimaryButton>
        </div>
        <div class="basis-1/2">
            <PrimaryButton @click="playNext">Play Next Week</PrimaryButton>
        </div>
        <div class="basis-1/2">
            <DangerButton @click="reset">Reset Data</DangerButton>
        </div>
    </div>
</template>
