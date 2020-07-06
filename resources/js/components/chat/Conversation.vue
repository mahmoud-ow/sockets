<template>
    <div class="conversation">
        <h1>
            <div @click="openContactList()">
                <svg
                    width="1em"
                    height="1em"
                    viewBox="0 0 16 16"
                    class="bi bi-list"
                    fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
                    />
                </svg>
            </div>

            <div>{{ contact ? contact.username : "Select a Contact" }}</div>

            <div class="close-chat-widget">
                <svg
                    width="1em"
                    height="1em"
                    viewBox="0 0 16 16"
                    class="bi bi-x"
                    fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"
                    />
                    <path
                        fill-rule="evenodd"
                        d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"
                    />
                </svg>
            </div>
        </h1>
        <MessagesFeed :contact="contact" :messages="messages" />
        <MessageComposer @send="sendMessage" />
    </div>
</template>

<script>
import MessagesFeed from "./MessagesFeed";
import MessageComposer from "./MessageComposer";

export default {
    props: {
        contact: {
            type: Object,
            default: null
        },
        contacts: {
            type: Array,
            default: []
        },
        messages: {
            type: Array,
            default: []
        }
    },

    methods: {

        sendMessage(text) {
            
            var self = this;

            if (!this.contact) {
                return;
            }

            axios
                .post("/conversations/send", {
                    contact_id: this.contact.id,
                    text: text
                })
                .then(response => {
                    // emit the new reply
                    this.$emit("new", response.data);
                    
                    // check contact existance ( add to contact list if not exist )
                    var found = 0;
                    var viewContact = this.contact;
                    this.contacts.forEach(function(contact){
                        if( contact.id == viewContact.id ){
                            found = 1;
                        }
                    });
                    if( found == 0 ){
                        self.contacts.unshift(viewContact);
                    }


                });
                /* axios */
        },/* /sendMessage() */

        openContactList() {
            $(".contacts-list-wrapper").removeClass("swing-out-top-bck");
            $(".contacts-list-wrapper").addClass("swing-in-top-fwd");
            setTimeout(function(){
                window.contact_list_ps.update();
            }, 500);
        }
    },

    components: { MessagesFeed, MessageComposer }
};
</script>

<style lang="scss" scoped>
.conversation {
    flex: 5;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    h1 {
        margin: 0;
        border-bottom: 1px dashed lightgray;
        display: flex;

        > div {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        > div:nth-of-type(1),
        > div:nth-of-type(3) {
            width: 40px;
            font-size: 22px;
            cursor: pointer;
        }
        > div:nth-of-type(2) {
            width: 220px;
            font-size: 15px;
        }
    }
}
</style>
