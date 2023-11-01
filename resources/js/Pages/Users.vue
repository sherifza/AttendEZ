<template>
    <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users
        </h2>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <table class="min-w-full border border-gray-200">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users" :key="user.id" class="bg-white">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ user.name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ user.email }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ user.category ? user.category.name : '' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        users: Array, // Define the users prop to receive data from the server
    },
};
</script>
