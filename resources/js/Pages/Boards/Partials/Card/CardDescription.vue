<script>
import {router} from "@inertiajs/vue3";
import FormEditor from "@/Components/Form/FormEditor.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {ListMinusIcon} from "lucide-vue-next";
import FadeInTransition from "@/Components/Transitions/FadeInTransition.vue";

export default {
    name: "CardDescription",

    components: {FadeInTransition, ListMinusIcon, InputLabel, AppButton, FormEditor},

    emits: {
        update: null
    },

    props: {
        card: {
            type: Object
        }
    },

    data() {
        return {
            description: '',
            isEditing: false
        };
    },

    methods: {
        showForm() {
            this.isEditing = true;
            this.description = this.card.description;
        },

        hideForm() {
            this.isEditing = false;
        },

        save() {
            this.$emit('update', {
                description: this.description
            })

            this.isEditing = false;
        }
    }
}
</script>

<template>
    <div class="mt-3">
        <div class="flex items-center gap-4">
            <input-label class="font-semibold !text-[18px] text-gray-800 dark:text-gray-200  flex items-start">
                <list-minus-icon class="inline-block mr-2"/>
                Description
            </input-label>

            <app-button
                v-if="!isEditing"
                size="sm"
                variant="info"
                @click="showForm"
            >
                Edit
            </app-button>
        </div>

        <fade-in-transition :is-group="true">
            <div v-show="isEditing" class="mt-3 relative">
                <form-editor
                    v-model="description"
                />

                <div class="flex items-center justify-end mt-3">
                    <app-button
                        size="sm"
                        variant="info"
                        @click="hideForm"
                    >
                        Cancel
                    </app-button>

                    <app-button
                        size="sm"
                        class="ms-3"
                        variant="success"
                        @click="save"
                    >
                        Save
                    </app-button>
                </div>
            </div>
            <div v-show="!isEditing" class="mt-3" v-html="card?.description ?? 'Description is empty'"/>
        </fade-in-transition>
    </div>
</template>
