<script>
import TextInput from "@/Components/TextInput.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import DialogModal from "@/Components/DialogModal.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";
import {route} from "../../../../../../vendor/tightenco/ziggy/src/js/index.js";

export default {
    components: {DialogModal, AppButton, InputError, TextInput},

    props: {
        column: {
            type: Object,
            required: false
        }
    },

    data() {
        return {
            form: useForm({
                'name': this.column?.name
            })
        };
    },

    computed: {
        isChanged() {
            return this.form.name !== this.column?.name
        }
    },

    watch: {
        async column() {
            this.form.name = this.column?.name

            await this.$nextTick();

            this.$refs.nameInput.focus();
        }
    },

    methods: {
        open() {
            this.$refs.modal.open();
        },

        close() {
            this.form.reset('name')
            this.$refs.modal.close();
        },

        updateColumn() {
            this.form.put(route('columns.update', {
                'board_column': this.column.id,
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
    <dialog-modal ref="modal">
        <template #title>
            Edit {{ column?.name }}
        </template>

        <template #content>
            <div class="mt-4">
                <text-input
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-3/4"
                    placeholder="Column name"
                    ref="nameInput"
                    @keydown.enter="updateColumn"
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
                :class="{ 'opacity-25': form.processing || !isChanged }"
                :disabled="form.processing || !isChanged"
                @click="updateColumn"
            >
                Save
            </app-button>
        </template>
    </dialog-modal>
</template>
