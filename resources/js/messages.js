import Messages from "./components/Messages";
import Search from "./components/Search";
import 'tui-editor/dist/tui-editor.css';
import 'tui-editor/dist/tui-editor-contents.css';
import 'codemirror/lib/codemirror.css';

new Vue({
    el: '#app',
    name: 'App',
    components: {
        Messages,
        Search,
    },
});
