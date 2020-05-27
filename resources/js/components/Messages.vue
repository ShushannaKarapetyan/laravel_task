<template>
    <div class="messages">
        <div class="container">
            <div class="col-md-6">
                <h2>{{ project.name }}</h2>
                <ul>
                    <li v-for="message in project.messages"
                        class="alert alert-info"
                        :class="{'right': (message.user_id === authUser.id)}"
                        v-html="message.body"
                    >
                    </li>
                </ul>
                <button class="btn btn-default btn-send"
                        :class="{'m-bottom':activeParticipant}"
                        @click="save">
                    <img src="/images/send.png" width="20">
                </button>
                <editor ref="toastuiEditor"
                        @change="tagParticipants"
                        height="150px"/>
                <span v-if="activeParticipant">{{ activeParticipant.name }} is typing...</span>
            </div>
        </div>
    </div>
</template>

<script>
    import 'tui-editor/dist/tui-editor.css';
    import 'tui-editor/dist/tui-editor-contents.css';
    import 'codemirror/lib/codemirror.css';
    import Editor from '@toast-ui/vue-editor/src/Editor.vue'

    export default {
        name: "Messages",

        components: {
            'editor': Editor
        },

        data() {
            return {
                project: {},
                projectId: window.location.pathname.split('/')[2],
                activeParticipant: false,
                typingTimer: false,
                authUser: '',
                editorText: ''
            }
        },

        computed: {
            channel() {
                return window.Echo.private(`messages.${this.projectId}`);
            }
        },

        created() {
            axios.get(`/projects/${this.projectId}`)
                .then(response => {
                    this.project = response.data.project;
                    this.authUser = response.data.user;
                })
                .catch(error => console.log(error));

            this.channel
                .listen("MessageSent", ({message}) => this.addMessage(message))
                .listenForWhisper("typing", this.flashActiveParticipant);
        },

        methods: {
            flashActiveParticipant(event) {
                this.activeParticipant = event;

                if (this.typingTimer)
                    clearTimeout(this.typingTimer);

                this.typingTimer = setTimeout(() => {
                    this.activeParticipant = false;
                }, 5000)
            },

            tagParticipants() {
                /*return window.Echo.private(`messages.${this.projectId}`)*/
                this.channel
                    .whisper("typing", {name: this.authUser.name});
            },

            save() {
                this.editorText = this.$refs.toastuiEditor.invoke('getHtml');

                axios.post(`/projects/${this.project.id}/messages`, {body: this.editorText})
                    .then(response => response.data)
                    .then(this.addMessage)
                    .catch(error => console.log(error));
            },

            addMessage(message) {
                this.project.messages.push(message);
                this.editorText = '';
            },
        }
    }
</script>

<style scoped>
    .messages {
        margin: 50px 0 50px 0
    }

    ul {
        list-style: none;
        padding: 0;
    }

    .right {
        text-align: right;
    }

    .btn-send {
        position: absolute;
        z-index: 100;
        bottom: -5px;
    }

    .btn-send:focus {
        box-shadow: none;
    }

    .m-bottom {
        bottom: 15px;
    }

    .te-mode-switch-section {
        height: 25px;
    }
</style>
