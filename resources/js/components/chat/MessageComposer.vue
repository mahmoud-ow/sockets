<template>
    <div class="composer">
        <textarea
            v-model="message"
            @keydown.enter="send"
            placeholder="Message ... "
        ></textarea>
    </div>
</template>

<script>
export default {
    data() {
        return {
            message: ""
        };
    },
    methods: {
        send(e) {
            e.preventDefault();
            if (this.message == "") {
                return;
            }
            this.$emit("send", this.message);
            this.message = "";
        }
    }
};
</script>

<style lang="scss" scoped>
.composer {
    padding: 5px;

    textarea {
        width: 100%;
        height: 100%;
        resize: none;
        border-radius: 3px;
        border: 1px solid lightgray;
    }
}
</style>
