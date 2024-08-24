<script>
import Editor from '@tinymce/tinymce-vue'
import useTheme from "@/Composables/Theme/useTheme.js";

export default {
    name: "FormEditor",

    components: {
        Editor
    },

    props: {
        modelValue: {
            type: String
        }
    },

    setup() {
        const {isDark} = useTheme();

        return {
            isDark
        }
    },

    emits: {
        'update:modelValue': null
    },

    computed: {
        value: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', value)
            }
        },
    },

    methods: {
        editorSetup(editor) {
            editor.on('init', () => {
                const container = editor.getContainer();
                const uiContainer = document.querySelector('.tox.tox-tinymce-aux');
                if (uiContainer === null) return;
                container?.parentNode?.appendChild(uiContainer);
            });
        },
    }
}
</script>

<template>
    <editor
        ref="editor"
        v-model="value"
        api-key="6n3bih3og5hk6dfsanz3eza6pfi2u6gm6sg75igtucoolp4o"
        :init="{
            selector: 'div',
            toolbar_mode: 'sliding',
            menubar: 'edit insert view table tools',
            plugins: 'autoresize anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange formatpainter pageembed linkchecker a11ychecker tinymcespellchecker  powerpaste advtable advcode editimage advtemplate mentions tinycomments tableofcontents footnotes autocorrect inlinecss markdown',
            tinycomments_mode: 'embedded',
            height: 200,
            min_height: 100,
            max_height: 500,
            setup: this.editorSetup,
            skin: isDark ? 'oxide-dark' : 'oxide',
            content_css: isDark ? 'dark' : 'default'
        }"
    />
</template>
