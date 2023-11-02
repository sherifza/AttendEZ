<template>
    <AuthenticatedLayout>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create new course</h2>
            </div>
        </header>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container mx-auto px-4 py-8">
                            <h2 class="text-2xl font-semibold mb-4">Create a New Course</h2>

                            <form @submit.prevent="createCourse" class="max-w-md mx-auto">
                                <input type="hidden" name="_token" :value="csrfToken">
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700">Course Name:</label>
                                    <input v-model="course.name" type="text" id="name" class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="block text-gray-700">Description:</label>
                                    <textarea v-model="course.description" id="description" class="form-textarea mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
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
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300 focus:ring-opacity-50">Create Course</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script >
import Swal from 'sweetalert2';

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
export default {
    components: {AuthenticatedLayout},
    props: {
        csrfToken: String, // Define the prop for CSRF token
    },
    data() {
        return {
            course: {
                name: '',
                description: '',
                days: 0,
                hours: 0
            }
        };
    },
    methods: {
        createCourse() {
            // Include the CSRF token in the data sent to the server
            const data = {
                ...this.course,
                _token: this.csrfToken, // Add the CSRF token
            };

            axios.post('/api/courses', data)
                .then((response) => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Course created successfully.',
                        icon: 'success',
                    }).then(() => {
                        // Redirect to the course index page
                        this.$inertia.visit(route('courses.index'));
                    });
                    // Handle a successful response here
                    console.log('Course created successfully');
                    // Optionally, you can navigate to another page or perform other actions after creating the course
                })
                .catch((error) => {
                    // Handle errors here, e.g., validation errors or server errors
                    console.error('Error creating the course', error);
                });
        }
    }
};
</script>
