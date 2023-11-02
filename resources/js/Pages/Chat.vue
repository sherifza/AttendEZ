<template>
    <AuthenticatedLayout>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <ChatStatusDropdown :auth-user="authUser"></ChatStatusDropdown>
            </div>
        </header>
        <ChatSystem :auth-user="authUser" :users="users"></ChatSystem>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ChatStatusDropdown from '@/Components/ChatStatusDropdown.vue';
import ChatSystem from '@/Components/ChatSystem.vue';
export default {
    components: {
        AuthenticatedLayout,
        ChatStatusDropdown,
        ChatSystem,
    },
    props: {
        authUser: Object, // Define the authUser prop
        users: Array, // Define the users prop
    },
};
</script>
