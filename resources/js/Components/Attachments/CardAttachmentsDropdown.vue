<script>
import AppHeading from "@/Components/Heading/AppHeading.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import AppDropdown from "@/Components/Dropdown/AppDropdown.vue";
import {PlusIcon, TrashIcon} from "lucide-vue-next";
import FadeTransition from "@/Components/Transitions/FadeTransition.vue";
import AppLabel from "@/Components/Labels/AppLabel.vue";
import CardLabelForm from "@/Components/Labels/CardLabelForm.vue";
import LabelList from "@/Components/Labels/LabelList.vue";
import AttachmentForm from "@/Components/Attachments/CardAttachmentForm.vue";

export default {
    components: {
        PlusIcon,
        TrashIcon,

        AppLabel,
        LabelList,
        AppButton,
        AppHeading,
        AppDropdown,
        CardLabelForm,
        AttachmentForm,
        FadeTransition
    },

    emits: {
        attachmentAdded: null
    },

    props: {
        cardId: {
            type: Number
        }
    },

    methods: {
        onCreate(attachment) {
            this.$emit('attachmentAdded', attachment)

            this.onCancel()
        },

        onCancel() {
            this.$refs.dropdown.close()
        }
    }
}
</script>

<template>
    <app-dropdown
        class="z-40"
        width="80"
        align="right"
        ref="dropdown"
    >
        <template #trigger>
            <app-button variant="info" class="w-full">
                Add Attachment
            </app-button>
        </template>
        <template #content>
            <div class="px-2 py-1">
                <attachment-form
                    :card-id="cardId"
                    @create="onCreate"
                    @close="onCancel"
                />
            </div>
        </template>
    </app-dropdown>
</template>
