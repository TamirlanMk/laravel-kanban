<script>
import {router} from "@inertiajs/vue3";

import {AppWindowIcon, ArchiveIcon, TrashIcon} from 'lucide-vue-next';

import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import AppText from "@/Components/Typography/AppText.vue";
import Dropdown from "@/Components/Dropdown.vue";
import AppDropdown from "@/Components/Dropdown/AppDropdown.vue";
import AppHeading from "@/Components/Heading/AppHeading.vue";
import DialogModal from "@/Components/DialogModal.vue";

import ConfirmationModal from "@/Components/Modals/ConfirmationModal.vue";
import CardDescription from "@/Pages/Boards/Partials/Card/CardDescription.vue";
import Skeleton from "@/Components/Skeleton/SkeletonWrapper.vue";
import SkeletonText from "@/Components/Skeleton/SkeletonText.vue";
import CardAttachments from "@/Pages/Boards/Partials/Card/CardAttachments.vue";
import CardModalHeader from "@/Pages/Boards/Partials/Card/CardModalHeader.vue";
import CardTodo from "@/Components/Todo/CardTodo.vue";
import CardLabelForm from "@/Components/Labels/CardLabelForm.vue";
import CardLabelsDropdown from "@/Components/Labels/CardLabelsDropdown.vue";
import CardHeaderLabels from "@/Components/Labels/CardHeaderLabels.vue";

import SkeletonHeading from "@/Components/Skeleton/SkeletonHeading.vue";
import FadeInTransition from "@/Components/Transitions/FadeInTransition.vue";
import FadeTransition from "@/Components/Transitions/FadeTransition.vue";
import FadeOutTransition from "@/Components/Transitions/FadeOutTransition.vue";

import {route} from "../../../../../../vendor/tightenco/ziggy/src/js/index.js";
import {addCardLabel, removeCardLabel} from "@/Api/card/labels.js";
import {getCard, updateCard} from "@/Api/card/card.js";
import CardAttachmentsDropdown from "@/Components/Attachments/CardAttachmentsDropdown.vue";

export default {
    components: {
        CardAttachmentsDropdown,
        CardHeaderLabels,
        CardLabelsDropdown,
        CardLabelForm,
        CardTodo,
        CardModalHeader,
        CardAttachments,
        AppDropdown,
        Dropdown,
        FadeOutTransition,
        FadeTransition,
        FadeInTransition,
        AppText,
        AppHeading,
        InputLabel,
        AppButton,
        InputError,
        TextInput,
        TrashIcon,
        AppWindowIcon,
        ArchiveIcon,
        DialogModal,
        SkeletonHeading,
        SkeletonText,
        Skeleton,
        CardDescription,
        ConfirmationModal,
    },

    emits: {
        cardUpdated: null,
    },

    props: {
        cardId: {
            type: Number
        },
        column: {
            type: Object
        },
    },

    watch: {
        card: {
            handler(value) {
                if (value !== null) {
                    this.$emit('cardUpdated', value)
                }
                console.log('card updated:', value)
            },
            deep: true,
        },

        isLoading(v) {
            // console.log(v)
        }
    },

    data() {
        return {
            card: null,
            attachments: null,
            isShow: false,
            isLoading: true,
            editingDescription: false
        }
    },

    methods: {
        async open(load = true) {
            this.$refs.modal.open();

            await this.$nextTick();

            if (load) {
                await this.loadCard()
            }
        },

        async close(resetState = true) {
            this.$refs.modal.close();

            await this.$nextTick()

            if (resetState) {
                this.card = null;
            }
        },

        async loadCard() {
            this.isLoading = true;

            getCard(this.cardId).then((card) => {
                this.card = card;
                this.isLoading = false;
            });
        },

        update(data) {
            updateCard(this.cardId, data).then(card => {
                this.card = card;
            });
        },

        updateAttachmentsCount(attachments) {
            if (this.card) {
                this.card.attachments_count = attachments ? attachments?.length : 0;
            }
        },

        addTodo() {
            this.$refs.todos.openForm();
        },

        onAttachmentAdded(attachment) {
            this.$refs.attachments.add(attachment)
        },

        onLabelAdded(label) {
            let isAdded = this.card.labels.findIndex(item => item.id === label.id);

            if (isAdded < 0) {
                this.card.labels.push(label)
            }
        },

        onLabelRemove(label) {
            removeCardLabel(this.card?.id, label.id)
                .then(() => {
                    this.card.labels = [...this.card.labels?.filter(item => item.id !== label.id)]
                })
        },

        // Delete modal
        deleteCard() {
            this.close(false);
            this.$refs.deleteConfirmModal.open();
        },

        onConfirmDelete() {
            router.delete(route('cards.delete', {
                card: this.cardId
            }))

            this.$refs.deleteConfirmModal.close();
            this.close(true);
        },

        onCancelDelete() {
            this.$refs.deleteConfirmModal.close();
            this.open();
        }
    }
}
</script>

<template>
    <dialog-modal
        ref="modal"
        :min-height="'250'"
        max-width="4xl"
        @close="close"
    >
        <template #title v-if="!card">
            <div class="relative">
                <skeleton-heading/>

                <skeleton-heading size="h4" class="!w-40"/>
            </div>
        </template>

        <template #title v-else>
            <div>
                <card-modal-header
                    :card="card"
                    :column="column"
                    @deleteCard="deleteCard"
                />

                <card-header-labels
                    v-if="card?.labels?.length"
                    :labels="card.labels"
                    @labelRemoved="onLabelRemove"
                />
            </div>
        </template>

        <template #content v-if="!card">
            <div class="relative">
                <skeleton-text/>
            </div>
        </template>

        <template #content v-else>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-9">
                    <div class="space-y-10">
                        <card-description
                            :card="card"
                            @update="update"
                        />

                        <card-attachments
                            ref="attachments"
                            :card-id="cardId"
                            @change="updateAttachmentsCount"
                        />

                        <card-todo
                            ref="todos"
                            :card-id="cardId"
                        />
                    </div>
                </div>

                <aside class="col-span-3 pb-2">
                    <app-heading as="h4">
                        Add to card
                    </app-heading>

                    <div class="space-y-2 mt-2 flex flex-col items-stretch">
                        <card-labels-dropdown
                            :card-id="card?.id"
                            :board-id="column?.board_id"
                            @labelAdded="onLabelAdded"
                        />

                        <card-attachments-dropdown
                            :card-id="cardId"
                            @attachmentAdded="onAttachmentAdded"
                        />

                        <app-button @click.stop="addTodo" variant="info" class="w-full">
                            Add Todo
                        </app-button>
                    </div>
                </aside>
            </div>
        </template>
    </dialog-modal>

    <confirmation-modal
        ref="deleteConfirmModal"
        @closed="open(false)"
    >
        <template #title>
            <app-heading>
                Confirm delete
            </app-heading>
        </template>

        <template #footer>
            <app-button
                variant="info"
                @click="onCancelDelete"
            >
                Cancel
            </app-button>

            <app-button
                variant="success"
                class="ms-3"
                @click="onConfirmDelete"
            >
                Confirm
            </app-button>
        </template>
    </confirmation-modal>
</template>
