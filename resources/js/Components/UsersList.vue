<template>
    <h2 class="text-2xl mb-4">Users</h2>
    <div>
        <ul class="space-y-2">
            <li v-for="user in filteredUsers" :key="user.id"
                class="flex items-center bg-white p-2 rounded-lg cursor-default"
                @click="selectUser(user)"
                :style="{ backgroundColor: user.id === selectedUser?.id ? '#00c6ff' : 'transparent' ,
                  color: user.id === selectedUser?.id ? 'white' : 'black' ,
                  fontWeight: user.id === selectedUser?.id ? 'bolder' : 'normal' }"
            >
                <!-- You can display user information here -->
                <div class="w-4 h-4 rounded-full" :class="userChatStatusColor(user.chat_status)"></div>
                <span class="ml-2">{{ user.name }}</span>
            </li>
        </ul>
    </div>

</template>

<script>
export default {
    emits: ['selected-user'],
    props: {
        users: Array,
        authUser: Object
    },
    data() {
        return {
            selectedUser: null,
        };
    },
    created() {
/*        console.log('User:', this.authUser);
        console.log('Selected User:', this.selectedUser);*/
    },
    computed: {
        filteredUsers() {
            return this.users.filter((user) => user.id !== this.authUser.id);
        },
    },
    methods: {
        selectUser(user) {
            if (this.selectedUser?.id !== user?.id) {
                this.selectedUser = user;
                this.$emit('selected-user', {
                    toUser: this.selectedUser,
                });
            }
        },
        userChatStatusColor(chatStatus) {
            switch (chatStatus) {
                case 'Online':
                    return 'bg-green-500';
                case 'Away':
                    return 'bg-blue-500';
                case 'Busy':
                    return 'bg-red-500';
                default:
                    return 'bg-gray-500';
            }
        },
    },
};
</script>
