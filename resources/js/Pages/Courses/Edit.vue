<template>
    <AuthenticatedLayout>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit course "{{originalName}}"</h2>
            </div>
        </header>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container mx-auto px-4 py-8">
                            <h1 class="text-2xl font-semibold mb-4">Edit Course</h1>

                            <form @submit.prevent="updateCourse" method="POST">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input v-model="course.name" type="text" id="name" class="mt-1 p-2 border rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:ring-indigo-500 block w-full sm:text-sm border-gray-300" />
                                </div>

                                <div class="mt-4">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea v-model="course.description" id="description" class="mt-1 p-2 border rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:ring-indigo-500 block w-full sm:text-sm border-gray-300"></textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="days" class="block text-gray-700">Days:</label>
                                    <input v-model="course.days" type="number" id="days" class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div class="mb-4">
                                    <label for="hours" class="block text-gray-700">Hours:</label>
                                    <input v-model="course.hours" type="number" id="hours" class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300 focus:ring-opacity-50">
                                        Update Course
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
export default {
    components: {AuthenticatedLayout},
    data() {
        return {
            originalName: '', // Initialize a variable to store the original course name
        };
    },
    mounted() {
        // Copy the original course name when the component is mounted
        this.originalName = this.course.name;
    },
    props: {
        course: Object, // Define the course prop to receive data from the controller
    },
    methods: {
        updateCourse() {
            // Perform the update action here
            // You can access course as this.course
            // Make an API request to update the course
        }
    }
};
</script>
