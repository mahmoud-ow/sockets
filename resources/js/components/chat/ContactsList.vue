<template>
    <div class="contacts-list-wrapper">
        <div class="contacts-list-header">
            <div>المحادثات</div>
            <div class="close-chat-widget">
                <span class="sl-icon icon-close"></span>
            </div>
        </div>
        <div class="contacts-list">
            <ul>
                <li
                    v-for="contact in contacts"
                    :key="contact.id"
                    @click="selectContact(contact)"
                    :class="{ selected: contact == selected }"
                >
                    <div class="avatar">
                        <img
                            class="chat-widget-contact-list-profile-picture"
                            :src="contact.profile_image"
                            :alt="contact.name"
                        />
                    </div>
                    <div class="contact">
                        <p class="name">{{ contact.username }}</p>
                        <p class="email">{{ contact.email }}</p>
                    </div>
                    <span class="unread" v-if="contact.unread"
                        >{{ contact.unread }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import PerfectScrollbar from "perfect-scrollbar";
export default {
    props: {
        contacts: {
            type: Array,
            default: []
        }
    },

    data() {
        return {
            selected: this.contacts.length ? this.contacts[0] : null
        };
    },

    methods: {
        
        viewOpenChat(viewContact) {
            $("#chat-widget").addClass('active-chat-widget');
            this.selected = viewContact;
            this.$emit("selected", viewContact);
        },



        selectContact(contact) {
            this.selected = contact;
            this.$emit("selected", contact);
        }


    },
    computed: {
        sortedContacts() {
            return _.sortBy(this.contacts, [
                contact => {
                    if (contact == this.selected) {
                        //return Infinity;
                    }
                    return contact.unread;
                }
            ]);
        }
    },
    mounted() {
        
    }
};
</script>

<style lang="scss" scoped>

.contacts-list-wrapper{
    position: absolute;
    z-index: 1;
    max-height: 600px;
    width: 100%;
    height: 100%;
    padding: 0 0 2px 0;
}
.contacts-list {
    position: relative;
    width: 100%;
    height: calc( 100% - 40px );
    transition: all 0.3s ease;
    background-color: #fff;

    ul {
        list-style-type: none;
        padding-left: 0;
        margin-bottom: 0;

        li {
            display: flex;
            padding: 2px;
            border-bottom: 1px solid #ddd;
            height: 80px;
            position: relative;
            cursor: pointer;

            &.selected {
                // background-color: #dfdfdf;
            }

            span.unread {
                background-color: #82e0e8;
                position: absolute;
                right: 11px;
                top: 20px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 3px;
            }
        }

        > li:last-of-type,
        > li:nth-of-type(5) {
            border-bottom: none;
        }

        > li:nth-of-type(6) {
            border-top: 1px solid #ddd;
        }
        > li:nth-of-type(1),
        > li:nth-of-type(2),
        > li:nth-of-type(3),
        > li:nth-of-type(4) {
            border-bottom: 1px solid #ddd !important;
        }

        .avatar {
            flex: 1;
            display: flex;
            align-items: center;

            img {
                width: 35px;
                border-radius: 50px;
                margin: 0 auto;
            }
        }

        .contact {
            flex: 3;
            font-size: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;

            p {
                margin: 0;

                &.name {
                    font-weight: bold;
                }
            }
        }
    }
}

@-webkit-keyframes swing-out-top-bck {
    0% {
        -webkit-transform: rotateX(0deg);
        transform: rotateX(0deg);
        -webkit-transform-origin: top;
        transform-origin: top;
        opacity: 1;
    }
    100% {
        -webkit-transform: rotateX(-100deg);
        transform: rotateX(-100deg);
        -webkit-transform-origin: top;
        transform-origin: top;
        opacity: 0;
    }
}
@keyframes swing-out-top-bck {
    0% {
        -webkit-transform: rotateX(0deg);
        transform: rotateX(0deg);
        -webkit-transform-origin: top;
        transform-origin: top;
        opacity: 1;
    }
    100% {
        -webkit-transform: rotateX(-100deg);
        transform: rotateX(-100deg);
        -webkit-transform-origin: top;
        transform-origin: top;
        opacity: 0;
    }
}

.swing-out-top-bck {
    -webkit-animation: swing-out-top-bck 0.45s
        cubic-bezier(0.6, -0.28, 0.735, 0.045) both;
    animation: swing-out-top-bck 0.45s cubic-bezier(0.6, -0.28, 0.735, 0.045)
        both;
}
.swing-in-top-fwd {
    -webkit-animation: swing-in-top-fwd 0.5s
        cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
    animation: swing-in-top-fwd 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275)
        both;
}
@-webkit-keyframes swing-in-top-fwd {
    0% {
        -webkit-transform: rotateX(-100deg);
        transform: rotateX(-100deg);
        -webkit-transform-origin: top;
        transform-origin: top;
        opacity: 0;
    }
    100% {
        -webkit-transform: rotateX(0deg);
        transform: rotateX(0deg);
        -webkit-transform-origin: top;
        transform-origin: top;
        opacity: 1;
    }
}
@keyframes swing-in-top-fwd {
    0% {
        -webkit-transform: rotateX(-100deg);
        transform: rotateX(-100deg);
        -webkit-transform-origin: top;
        transform-origin: top;
        opacity: 0;
    }
    100% {
        -webkit-transform: rotateX(0deg);
        transform: rotateX(0deg);
        -webkit-transform-origin: top;
        transform-origin: top;
        opacity: 1;
    }
}
</style>
