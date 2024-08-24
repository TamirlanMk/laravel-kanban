<script>
import TextInput from "@/Components/TextInput.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import DialogModal from "@/Components/DialogModal.vue";
import {router} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import {route} from "../../../../../../vendor/tightenco/ziggy/src/js/index.js";
import InputError from "@/Components/InputError.vue";

export default {
    components: {InputError, AppButton, TextInput, InputLabel, DialogModal},

    props: {
        column: {
            type: Object,
        },
        confirmText: {
            type: String,
            default: ''
        }
    },

    data() {
        return {
            confirm: null,
            confirmError: null
        };
    },

    computed: {
        isConfirmed() {
            return this.confirm === this.confirmText
        }
    },

    methods: {
        async open() {
            this.$refs.modal.open();

            await this.$nextTick()

            this.$refs.confirmInput.focus()
        },
        close() {
            this.confirm = null

            this.$refs.modal.close();
        },
        deleteColumn() {
            if (!this.isConfirmed) {
                return;
            }

            router.delete(route('columns.delete', {
                board_column: this.column.id
            }), {
                onSuccess: () => {
                    this.close()
                },
                onError: () => {
                    this.close()
                },
            });
        }
    }
}
</script>

<template>
    <dialog-modal ref="modal">
        <template #title>
            Delete column
        </template>

        <template #content>
            <div class="mt-4">
                <input-label class="select-none">
                    Type name of column for delete: {{ confirmText }}
                </input-label>
                <text-input
                    v-model="confirm"
                    ref="confirmInput"
                    type="text"
                    class="mt-1 block w-3/4"
                    :placeholder="confirmText"
                    @keydown.enter="deleteColumn"
                />
                <input-error :message="confirmError" class="mt-2"/>
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
                variant="danger"
                class="ms-3"
                :disabled="!isConfirmed"
                @click="deleteColumn"
            >
                Delete
            </app-button>
        </template>
    </dialog-modal>
</template>
