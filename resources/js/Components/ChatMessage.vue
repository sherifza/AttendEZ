<template>
    <div>
        <h2 class="text-2xl mb-4">Chat with {{ toUser['name'] }}</h2>
        <div class="border rounded-lg p-4 h-64 overflow-y-auto" ref="chatContainer">
            <!-- Chat messages go here -->
            <div class="mb-2">
                <div v-for="message in messages" :key="message.id" ref="chatContainer" class="chat-container">
                    <div :class="messageClass(message)" class="rounded-lg p-2 mb-2">
                        {{ message.message }}
                    </div>
                </div>
            </div>
        </div>
        <div class="flex mt-4">
            <input v-model="message" type="text" class="flex-1 border rounded-l-lg p-2" placeholder="Type a message...">
            <button @click="sendMessage" class="bg-blue-500 text-white rounded-r-lg px-4 hover:bg-blue-600 focus:outline-none">
                Send
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        fromUser: Object, // Assuming fromUser is an object
        toUser: Object,   // Assuming toUser is an object
        messages: Array
    },
    data() {
        return {
            message: ''
        };
    },
    mounted() {
        this.scrollToBottom();
    },
    methods: {
        sendMessage() {
            // Send a POST request to the /send-chat-message route
            axios.post('/send-chat-message', {
                to_user: this.toUser.id, // Use the recipient user's ID
                message: this.message,
            })
                .then(response => {
                    const newMessage = {
                        from_user: this.fromUser.id, // Set the sender's ID
                        to_user: this.toUser.id,     // Set the recipient's ID
                        message: this.message,      // Set the message text
                    };
                    this.messages.push(newMessage);

                    this.message = ''; // Clear the input field
                    this.scrollToBottom();
                })
                .catch(error => {
                    // Handle errors, e.g., display an error message
                    //console.error('Error sending message:', error);
                });
        },
        messageClass(message) {
            if (message.from_user === this.fromUser.id) {
                return 'bg-blue-500 text-white';
            } else  {
                return 'bg-indigo-50 text-gray-700 flex justify-end';
            }

        },
        scrollToBottom() {
            const container = this.$refs.chatContainer;
            if (container) {
                setTimeout(() => {
                    container.scrollTop = container.scrollHeight;
                }, 100);
            }
        },
    },
};
</script>
