<template>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">Chat System</h2>
        <h2 class="text-lg font-semibold text-gray-800">{{ selectedStatus }}</h2>
        <div>
            <div class="relative inline-block text-left">
                <div class="flex items-center space-x-2">
                    <span class="w-4 h-4 rounded-full inline-block ml-4 mr-2" :class="statusColor"></span>
                    <select v-model="selectedStatus" @change="changeChatStatus"
                            class="block appearance-none w-36 md:w-44 bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded-md shadow-sm text-gray-700 text-sm leading-5 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-indigo-300"
                    >
                        <option value="Online">Online</option>
                        <option value="Away">Away</option>
                        <option value="Busy">Busy</option>
                        <option value="Offline">Offline</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: {
        authUser: Object,
    },
    data() {
        return {
            selectedStatus: null,
        };
    },
    computed: {
        statusColor() {
            switch (this.selectedStatus) {
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
    created() {
        this.selectedStatus = this.authUser['chat_status'];
        //console.log('Selected Status:', this.selectedStatus);
    },
    watch: {
        selectedStatus: function(newStatus, oldStatus) {
            //console.log('Selected Status has changed:', newStatus, oldStatus);
        }
    },

    methods: {
        changeChatStatus() {
            // Send an AJAX request to update the chat status
            //console.log('this.selectedStatus', this.selectedStatus);
            axios.post('/change-chat-status', { chat_status: this.selectedStatus })
                .then((response) => {
                    console.log('succeeded:', response);
                })
                .catch((error) => {
                    console.log('Error:', error);
                });
        },
    },

};
</script>
