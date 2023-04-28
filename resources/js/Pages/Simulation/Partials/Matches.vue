<script setup>
defineProps({
    matches: {
        type: Object
    },
    week: {
        type: String
    }
});
</script>

<template>
    <table class="w-full text-left">
        <thead class="bg-gray-700 text-white">
        <tr>
            <th>Week {{ week }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(match, index) in matches">
            <td>{{ match.home_team_name }} - {{ match.away_team_name }}</td>
        </tr>
        </tbody>
    </table>
</template>
