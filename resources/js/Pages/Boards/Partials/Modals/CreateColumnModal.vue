<script>
import TextInput from "@/Components/TextInput.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import DialogModal from "@/Components/DialogModal.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";
import {route} from "../../../../../../vendor/tightenco/ziggy/src/js/index.js";

export default {
    components: {AppButton, InputError, TextInput, DialogModal},

    props: {
        boardId: {
            type: Number,
            required: true
        }
    },

    data() {
        return {
            form: useForm({
                name: ''
            })
        };
    },

    methods: {
        async open() {
            this.$refs.modal.open();

            await this.$nextTick();

            this.$refs.nameInput.focus();
        },

        close() {
            this.form.reset('name')

            this.$refs.modal.close();
        },

        createColumn() {
            this.form.post(route('boards.columns.store', {
                'board': this.boardId
            }), {
                onSuccess: () => {
                    this.close()
                },
                onError: () => {
                    this.$refs.nameInput.focus();
                }
            });

        }
    }
}
</script>

<template>
    <dialog-modal
        ref="modal"
        @close="close"
    >
        <template #title>
            Add new column
        </template>

        <template #content>
            <div class="mt-4">
                <text-input
                    v-model="form.name"
                    ref="nameInput"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="Column name"
                    @keydown.enter="createColumn"
                />

                <input-error :message="form.errors.name" class="mt-2"/>
            </div>
        </template>

        <template #footer>
            <app-button
                variant="info"
                @click="close"
            >
                Cancel
            </app-button>

            <app-button
                variant="success"
                class="ms-3"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click="createColumn"
            >
                Add
            </app-button>
        </template>
    </dialog-modal>
</template>
