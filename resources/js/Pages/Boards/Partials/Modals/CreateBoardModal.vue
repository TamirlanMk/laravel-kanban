<script>
import {useForm} from "@inertiajs/vue3";

import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import DialogModal from "@/Components/DialogModal.vue";
import AppButton from "@/Components/Button/AppButton.vue";

export default {
    components: {AppButton, InputError, TextInput, DialogModal},

    emits: {
        close: null,
        confirm: null,
    },

    data() {
        return {
            form: useForm({
                name: ''
            })
        }
    },

    methods: {
        async open() {
            this.$refs.modal.open();

            await this.$nextTick();

            this.$refs.name.focus();
        },
        close() {
            this.form.reset('name')

            this.$refs.modal.close();
        },
        create() {
            this.form.post(route('boards.store'), {
                onSuccess: () => {
                    this.close()
                },
                onError: () => {
                    this.close()
                }
            });
        }
    }
}
</script>

<template>
    <dialog-modal ref="modal">
        <template #title>
            Create new board
        </template>

        <template #content>
            <div class="mt-4">
                <text-input
                    v-model="form.name"
                    ref="name"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="Board name"
                    @keydown.enter="create"
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
                @click="create"
            >
                Create
            </app-button>
        </template>
    </dialog-modal>
</template>
