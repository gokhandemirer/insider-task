<script setup>
import { Head } from '@inertiajs/vue3';
import TeamList from "@/Components/TeamList.vue";

defineProps({
    teams: {
        type: Array,
        required: true
    }
});

const createFixtures = () => {
    // do something
}
</script>

<template>
    <Head title="Home" />

    <div class="flex justify-center">
        <div class="px-4 py-2 m-2">
            <TeamList :teams="teams" :onCreateFixtures="createFixtures" />
        </div>
    </div>
</template>
