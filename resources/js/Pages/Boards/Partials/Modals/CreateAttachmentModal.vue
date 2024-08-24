<script>
import {useForm} from "@inertiajs/vue3";

import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import DialogModal from "@/Components/DialogModal.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import {storeCardAttachment} from "@/Api/card/attachment.js";

export default {
    components: {AppButton, InputError, TextInput, DialogModal},

    emits: {
        close: null,
        create: null,
    },

    props: {
        cardId: {
            type: Number
        }
    },

    data() {
        return {
            form: useForm({
                caption: '',
                file: null
            }),
            pending: false
        }
    },

    methods: {
        async open() {
            this.$refs.modal.open();

            await this.$nextTick();

            this.$refs.caption.focus();
        },

        close() {
            this.form.reset()
            this.form.clearErrors()
            this.$refs.modal.close();
        },

        async create() {
            this.pending = true;

            await storeCardAttachment(this.cardId, this.form.data())
                .then(() => {
                    this.$emit('create')
                    this.form.clearErrors()
                    this.form.reset()
                })
                .catch(({response}) => {
                    if (response.status === 422) {
                        const errors = Object.entries(response.data.errors);

                        errors?.forEach(([field, values]) => {
                            this.form.setError(field, values[0]);
                        })
                    }
                })
                .finally(() => {
                    this.pending = false;
                });
        }
    }
}
</script>

<template>
    <dialog-modal ref="modal" @close="$emit('close')">
        <template #title>
            Add new attachment
        </template>

        <template #content>
            <div class="mt-4">
                <text-input
                    v-model="form.caption"
                    ref="caption"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="Caption"
                    @keydown.enter="create"
                />

                <input-error :message="form.errors.caption" class="mt-2"/>
            </div>

            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file">
                    Upload file
                </label>
                <input
                    @input="form.file = $event.target.files[0]"
                    class="flex file:bg-indigo-400 file:border-none file:px-3 file:text-gray-50 text-base file:mr-4 file:h-9 w-full rounded-md shadow-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 file:focus:ring-indigo-500 dark:focus:ring-indigo-600"
                    id="file" type="file">

                <input-error :message="form.errors.file" class="mt-2"/>
            </div>
        </template>

        <template #footer>
            <app-button
                variant="info"
                @click="$emit('close')"
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
                Add
            </app-button>
        </template>
    </dialog-modal>
</template>
