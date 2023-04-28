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
            <th>Championship Predictions</th>
            <th>%</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="({ name, championship_percentage }, index) in statistics">
            <td>{{ name }}</td>
            <td>{{ championship_percentage }}</td>
        </tr>
        </tbody>
    </table>
</template>
