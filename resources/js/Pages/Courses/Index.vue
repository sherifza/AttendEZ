<template>
    <AuthenticatedLayout>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Courses
                </h2>
                <a :href=" createRoute "
                   class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300 focus:ring-opacity-50">
                    Create Course
                </a>
            </div>


        </header>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <table class="min-w-full border border-gray-200">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Days</th>
                                <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Hours</th>
                                <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="course in courses" :key="course.id" class="bg-white">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ course.name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ course.description }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ course.days }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ course.hours }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <a :href="route('courses.edit', course.id)" class="text-blue-500 hover:underline mr-2">Edit</a>
                                    <DeleteButton :course-id="course.id" :route-name="routeName"></DeleteButton>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteButton from "@/Components/DeleteButton.vue";
export default {
    components: {DeleteButton, AuthenticatedLayout},
    props: {
        courses: Array, // Define the courses prop to receive data from the parent component
        routeName: String, // Define the routeName prop for the delete button route
        createRoute: String,
    },
};
</script>
