<script>
import {useForm} from "@inertiajs/vue3";
import {GripVerticalIcon, SendHorizontalIcon, CircleXIcon} from "lucide-vue-next";

export default {
    components: {
        CircleXIcon,
        GripVerticalIcon,
        SendHorizontalIcon
    },

    emits: {
        create: null,
        close: null
    },

    props: {
        cardId: {
            type: Number
        }
    },

    data() {
        return {
            form: useForm({
                name: ''
            }),
        }
    },

    mounted() {
        this.$refs.nameInput.focus();
    },

    methods: {
        createTodo() {
            if (!this.form.name) {
                this.$emit('close');
                return;
            }

            this.$emit('create', this.form.data());
        }
    }
}
</script>

<template>
    <div
        class="!mt-2 flex items-center shadow-sm border rounded-md cursor-pointer overflow-hidden ring-2 ring-indigo-400 pr-2.5">
        <div class="flex items-center mr-auto w-full text-base">
            <input
                v-model="form.name"
                ref="nameInput"
                type="text"
                class="border-none w-full focus:ring-0 bg-transparent"
                @blur="createTodo"
            >
        </div>

        <button
            class="mr-1 text-indigo-600 hover:text-indigo-800 transition"
            @click="createTodo"
        >
            <send-horizontal-icon size="18" class="inline-block "/>
        </button>
    </div>
</template>
