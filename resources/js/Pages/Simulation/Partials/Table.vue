<script setup>
defineProps({
    statistics: {
        type: Object
    }
})
</script>

<template>
    <table class="w-full text-left">
        <thead class="bg-gray-700 text-white">
        <tr>
            <th>Team Name</th>
            <th>P</th>
            <th>W</th>
            <th>D</th>
            <th>L</th>
            <th>GD</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in statistics">
            <td>{{ item.name }}</td>
            <td>{{ item.played }}</td>
            <td>{{ item.won }}</td>
            <td>{{ item.drawn }}</td>
            <td>{{ item.lost }}</td>
            <td>{{ item.gd }}</td>
        </tr>
        </tbody>
    </table>
</template>
