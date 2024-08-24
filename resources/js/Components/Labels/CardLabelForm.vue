<script>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import AppButton from "@/Components/Button/AppButton.vue";
import {createBoardLabel} from "@/Api/board/labels.js";
import InputError from "@/Components/InputError.vue";

export default {
    components: {InputError, AppButton, TextInput, InputLabel},

    emits: {
        create: null,
        close: null,
    },

    props: {
        boardId: {
            type: Number,
            required: true
        }
    },

    data() {
        return {
            form: useForm({
                name: '',
                color: '#1c60d0'
            })
        }
    },

    methods: {
        createLabel() {
            createBoardLabel(this.boardId, this.form.data())
                .then(newLabel => {
                    this.$emit('create', newLabel)
                })
                .catch(({response}) => {
                    if (response.status === 422) {
                        const errors = Object.entries(response.data.errors);

                        errors?.forEach(([field, values]) => {
                            this.form.setError(field, values[0]);
                        })
                    }
                })
        },
    }
}
</script>

<template>
    <div class="mt-3">
        <div>
            <input-label>Label Name</input-label>
            <text-input
                v-model="form.name"
                class="!px-2 !py-1 bg-white border border-gray-200 mt-0.5"
            />
            <input-error :message="form.errors.name" class="mt-2"/>
        </div>
        <div class="mt-2">
            <input-label>Label Color</input-label>
            <text-input
                v-model="form.color"
                type="color"
                class="h-10 !px-0.5 bg-white border border-gray-200 cursor-pointer mt-0.5"
                title="Choose your color"
            />
            <input-error :message="form.errors.color" class="mt-2"/>
        </div>
        <div class="flex justify-end mt-3">
            <app-button
                variant="info"
                size="xs"
                @click="$emit('close')"
            >
                Cancel
            </app-button>

            <app-button
                variant="success"
                size="xs"
                class="ms-3"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click="createLabel"
            >
                Create
            </app-button>
        </div>
    </div>
</template>
