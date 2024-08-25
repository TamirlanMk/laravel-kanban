<script>
import {PlusIcon, TrashIcon} from "lucide-vue-next";
import {deleteBoardLabel, getBoardLabels} from "@/Api/board/labels.js";

import AppLabel from "@/Components/Labels/AppLabel.vue";
import LabelList from "@/Components/Labels/LabelList.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import AppHeading from "@/Components/Heading/AppHeading.vue";
import AppDropdown from "@/Components/Dropdown/AppDropdown.vue";
import CardLabelForm from "@/Components/Labels/CardLabelForm.vue";
import FadeTransition from "@/Components/Transitions/FadeTransition.vue";
import InputError from "@/Components/InputError.vue";
import {addCardLabel} from "@/Api/card/labels.js";

export default {
    components: {
        InputError,
        FadeTransition,
        LabelList,
        PlusIcon,
        TrashIcon,

        AppButton,
        AppHeading,

        AppLabel,
        AppDropdown,
        CardLabelForm
    },

    emits: {
        labelAdded: null
    },

    props: {
        boardId: {
            type: Number
        },

        cardId: {
            type: Number
        }
    },

    data() {
        return {
            labels: [],
            showForm: false,
            isLoading: false,
            errorMessage: null
        }
    },

    methods: {
        loadLabels() {
            getBoardLabels(this.boardId)
                .then(data => {
                    this.labels = data;
                })
        },

        addLabel(label) {
            addCardLabel(this.cardId, label?.id)
                .then(() => {
                    this.$emit('labelAdded', label)
                })
                .catch(({response}) => {
                    if(response.status === 422) {
                        this.errorMessage = response.data.message;

                        setTimeout(() => {
                            this.errorMessage = null
                        }, 5000)
                    }
                })
        },

        deleteLabel(label) {
            deleteBoardLabel(label.id)
        },

        onCreateLabel(newLabel) {
            this.labels.push(newLabel);
            this.showForm = false;
        },

        onDropdownOpen() {
            this.loadLabels();
        },

        onDropdownClose() {
            this.labels = [];
            this.showForm = false;
        }
    }
}
</script>

<template>
    <app-dropdown
        class="z-50"
        align="right"
        @opened="onDropdownOpen"
        @closed="onDropdownClose"
    >
        <template #trigger>
            <app-button variant="info" class="w-full">
                Add Label
            </app-button>
        </template>
        <template #content>
            <div class="px-2 py-1">
                <div class="flex flex-row items-center justify-between">
                    <app-heading as="h4">
                        Labels
                    </app-heading>

                    <app-button
                        variant="info"
                        size="xs"
                        @click="showForm = true"
                    >
                        <plus-icon size="16"/>
                    </app-button>
                </div>
                <fade-transition mode="out-in">
                    <template v-if="!showForm">
                        <div>
                            <input-error :message="errorMessage"/>

                            <label-list
                                v-if="labels.length > 0"
                                class="mt-3"
                            >
                                <app-label
                                    v-for="label in labels"
                                    :color="label?.color"
                                    :key="label.id"
                                    @click.stop="addLabel(label)"
                                    class="cursor-pointer"
                                >
                                    <template #default>
                                        {{ label.name }}
                                    </template>

                                    <template #actions>
                                        <div class="flex flex-row ml-2">
                                            <button
                                                class="p-0 border-none"
                                                @click.stop="deleteLabel(label)"
                                            >
                                                <trash-icon size="12"/>
                                            </button>
                                        </div>
                                    </template>
                                </app-label>
                            </label-list>
                            <div v-else-if="!isLoading">
                                Labels empty
                            </div>
                        </div>
                    </template>

                    <template v-else>
                        <card-label-form
                            :board-id="boardId"
                            @create="onCreateLabel"
                            @close="showForm = false"
                        />
                    </template>
                </fade-transition>
            </div>
        </template>
    </app-dropdown>
</template>

