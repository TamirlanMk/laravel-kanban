<script>
import {FileTextIcon, ListMinusIcon, PaperclipIcon} from "lucide-vue-next";
import AppHeading from "@/Components/Heading/AppHeading.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import CardAttachmentItem from "@/Pages/Boards/Partials/Card/CardAttachmentItem.vue";
import FadeOutTransition from "@/Components/Transitions/FadeOutTransition.vue";
import FadeInTransition from "@/Components/Transitions/FadeInTransition.vue";
import FadeTransition from "@/Components/Transitions/FadeTransition.vue";
import HeightTransition from "@/Components/Transitions/HeightTransition.vue";
import {deleteCardAttachment, getCardAttachments} from "@/Api/card/attachment.js";

export default {
    components: {
        FileTextIcon,
        ListMinusIcon,
        PaperclipIcon,

        CardAttachmentItem,

        InputLabel,
        AppButton,
        AppHeading,

        FadeTransition,
        HeightTransition,
        FadeInTransition,
        FadeOutTransition
    },

    emits: {
        change: null
    },

    props: {
        cardId: {
            type: Number
        }
    },

    data() {
        return {
            isLoading: true,
            showItems: true,
            attachments: null
        }
    },

    mounted() {
        this.loadAttachments();
    },

    watch: {
        attachments(value) {
            this.$emit('change', value);
        }
    },

    methods: {
        loadAttachments() {
            this.isLoading = true;

            getCardAttachments(this.cardId)
                .then(data => {
                    this.attachments = data;
                    this.isLoading = false;
                });
        },

        toggleShow() {
            this.showItems = !this.showItems;
        },

        deleteAttachment(attachment) {
            if (this.attachments) {
                this.attachments = [...this.attachments.filter(item => item.id !== attachment.id)]
            }

            deleteCardAttachment(attachment.id).catch((e) => {
                console.error(e);
            });
        }
    }
}
</script>

<template>
    <fade-in-transition :is-group="true">
        <template v-if="!isLoading && attachments?.length > 0">
            <div class="mt-3">
                <div class="flex items-center gap-4">
                    <input-label class="font-semibold !text-[18px] text-gray-800 dark:text-gray-200  flex items-start">
                        <paperclip-icon class="inline-block mr-2"/>

                        Attachments: <span class="inline-block ms-2"> {{ attachments.length }} items </span>
                    </input-label>

                    <app-button
                        size="sm"
                        variant="info"
                        @click="toggleShow"
                        v-text="showItems ? 'Hide' : 'Show'"
                    >
                    </app-button>
                </div>

                <height-transition>
                    <div v-show="showItems" class="flex flex-col gap-2 mt-5">
                        <card-attachment-item
                            v-for="attachment in attachments"
                            :key="attachment.id"
                            :attachment="attachment"
                            @delete="deleteAttachment"
                        />
                    </div>
                </height-transition>
            </div>
        </template>
    </fade-in-transition>
</template>

<style scoped>
.enter-active {
    transition-property: max-height, color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}
</style>
