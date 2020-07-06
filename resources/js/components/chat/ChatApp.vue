<template>
    <div class="chat-app">
        <Conversation
            :contact="selectedContact"
            :messages="messages"
            @new="saveNewMessage"
            :contacts="contacts"
        />
        <ContactsList
            :contacts="contacts"
            @selected="startConversationWith"
            ref="form"
        />
    </div>
</template>

<script>
import Conversation from "./Conversation";
import ContactsList from "./ContactsList";

export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            selectedContact: null,
            messages: [],
            contacts: []
        };
    },
    mounted() {
        //console.log(this.user);

        Echo.private(`messages.${this.user.id}`).listen("NewMessage", e => {
            this.handleIncoming(e.message);

            console.log( JSON.stringify(e) );
        });

        axios.get("/contacts").then(response => {
            this.contacts = response.data;
            //console.log( JSON.stringify(response.data) );
        });
    },
    updated: function() {
        this.$nextTick(function() {
            window.contact_list_ps = new PerfectScrollbar(".contacts-list", {
                wheelSpeed: 2,
                wheelPropagation: false,
                minScrollbarLength: 20
            });
        });
    },
    methods: {
        startConversationWith(contact) {
            $(".contacts-list-wrapper").removeClass("swing-in-top-fwd");
            $(".contacts-list-wrapper").addClass("swing-out-top-bck");
            $(".composer textarea").focus();

            this.updateUnreadCount(contact, true);

            axios.get(`/conversations/${contact.id}`).then(response => {
                this.messages = response.data;
                this.selectedContact = contact;
            });
        },
        saveNewMessage(message) {
            this.messages.push(message);
        },

        handleIncoming(message) {
            if (
                this.selectedContact &&
                message.from == this.selectedContact.id
            ) {
                this.saveNewMessage(message);
                return;
            }

            //this.updateUnreadCount(message.from_contact, false);
            // check contact existance ( add to contact list if not exist )
            /* var self = this;
            var found = 0;
            var viewContact = message.from_contact;
            this.contacts.forEach(function(contact) {
                if (contact.id == viewContact.id) {
                    found = 1;
                }
            });
            if (found == 0) {
                self.contacts.unshift(viewContact);
            } */

        },
        updateUnreadCount(contact, reset) {
            this.contacts = this.contacts.map(single => {
                if (single.id !== contact.id) {
                    return single;
                }
                if (reset) single.unread = 0;
                else single.unread += 1;
                return single;
            });
        }
    },
    components: { Conversation, ContactsList }
};
</script>

<style lang="scss" scoped>
.chat-app {
    display: flex;
    height: 400px;
    position: relative;
}
</style>
