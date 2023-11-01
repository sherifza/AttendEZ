<template>
    <select
        :id="name"
        class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
        :name="name"
    >
        <option value="" disabled selected>Select an option</option> <!-- Add a placeholder option -->
        <option v-for="option in options" :value="option.id">{{ option.name }}</option>
    </select>
</template>

<script>
export default {
    props: {
        name: String,
        label: String,
        options: Array,
    },
};
</script>
