<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex">
                        <!-- Left side: List of Users -->
                        <div class="w-1/4 p-4 border-r">
                            <UsersList
                                :users=users
                                :auth-user=authUser
                                @selected-user="openChat"
                            ></UsersList>
                        </div>

                        <!-- Right side: Chat Box -->
                        <div class="w-3/4 p-4">
                            <ChatMessage
                                v-if="toUser"
                                :from-user="fromUser"
                                :to-user="toUser"
                                :messages="messages"
                            ></ChatMessage>
                            <div v-else class="text-xl font-semibold text-gray-500 text-center mt-4">
                                Select a user to start chatting with
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import ChatMessage from "@/Components/ChatMessage.vue";
import UsersList from "@/Components/UsersList.vue";
export default {
    components: {
        ChatMessage,
        UsersList
    },
    props: {
        users: Array,
        authUser: Object,
    },
    data() {
        return {
            fromUser: null,
            toUser: null,
            messages: []
        }
    },
    methods: {
        openChat({ toUser }) {
            this.fromUser = this.authUser;
            this.toUser = toUser;
            this.fetchMessages();
        },
        fetchMessages() {
            axios.get(`/chat-messages/${this.fromUser.id}/${this.toUser.id}`)
                .then((response) => {
                    this.messages = response.data;
                    //console.log(this.messages);
                })
                .catch((error) => {
                    //console.error('Error fetching messages:', error);
                });
        },
    },
}
</script>
