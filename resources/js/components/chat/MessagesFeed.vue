<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li
                v-for="message in messages"
                :class="
                    `message${message.to == contact.id ? ' sent' : ' recieved'}`
                "
                :key="message.id"
            >
                <div class="text">
                    {{ message.text }}
                </div>
            </li>
        </ul>
    </div>
</template>

<script>

//window.contact_list = new PerfectScrollbar('.contacts-list');
export default {
    props: {
        contact: {
            type: Object
        },
        messages: {
            type: Array,
            required: true
        }
    },
    methods: {
        scrollToBottom() {
            window.chat_feed.update();
            this.$refs.feed.scrollTop = 0;
            setTimeout(() => {
                this.$refs.feed.scrollTop =
                    this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            }, 50);
        }
    },
    watch: {
        contact(contact) {
            this.scrollToBottom();
        },
        messages(messages) {
            this.scrollToBottom();
        }
    },
    mounted(){
        window.chat_feed = new PerfectScrollbar('.feed');
    },
};
</script>

<style lang="scss" scoped>
.feed {
    height: 100%;
    background-color: rgb(243, 243, 243);
    overflow-y: hidden;
    position: relative;

    ul {
        list-style-type: none;
        padding: 5px;
        margin-bottom: 0;

        li {
            &.message {
                margin: 10px 0;
                width: 100%;

                .text {
                    max-width: 200px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                }

                &.recieved {
                    text-align: right;
                    .text {
                        background-color: #b2b2b2;
                    }
                }

                &.sent {
                    text-align: left;
                    .text {
                        background-color: #81c4f9;
                    }
                }
            }
        }
    }
}
</style>
