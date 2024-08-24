<script>
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

export default {
    name: "AddAttachmentForm",
    components: {TextInput, InputLabel},

    emits: {
        create: null
    },

    data() {
        return {
            form: useForm({
                caption: null,
                file: null,
            })
        };
    },

    methods: {
        create() {
            this.$emit('create', this.form.data())
        }
    }
}
</script>

<template>
    <div class="p-2">
        <input-label>
            Описание
        </input-label>

        <text-input v-model="form.file" type="file"/>
    </div>
</template>
