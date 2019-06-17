
    
// resources/assets/js/components/ChatForm.vue

<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage1" @keyup.enter="sendMessage" v-if="recipient != 0">
        <label for="inviRecipientID" class="inviRecipientID"></label>
        <input maxlength="255" type="text" id="inviRecipientID" name="recipientid"disabled="disabled" v-bind:value="recipient">
        <span class="input-group-btn" v-if="recipient != 0">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                <i class="fa fa-location-arrow" aria-hidden="true"></i>
                Send
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['user','recipient'],
        data() {
            return {
                newMessage1: ''
            }
        },
                methods: {
            sendMessage() {
                    var date = new Date();
                    var timestamp = ' '+date.getHours()+':'+date.getMinutes();
                this.$emit('messagesent', {
                    
                    user: this.user,
                    message: this.newMessage1,
                    created_at: timestamp,
                    user_id: $('.userid').text(),
                    recipient_id: $('#inviRecipientID').val()
                });
                this.newMessage1 = ''
            }
        }    
    }
</script>