<script>
import {AppWindowIcon, ArchiveIcon, TrashIcon} from "lucide-vue-next";
import FadeOutTransition from "@/Components/Transitions/FadeOutTransition.vue";
import FadeInTransition from "@/Components/Transitions/FadeInTransition.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import AppHeading from "@/Components/Heading/AppHeading.vue";
import SkeletonHeading from "@/Components/Skeleton/SkeletonHeading.vue";
import AppText from "@/Components/Typography/AppText.vue";
import CardHeaderLabels from "@/Components/Labels/CardHeaderLabels.vue";

export default {
    components: {
        CardHeaderLabels,
        AppText,
        AppHeading,
        AppButton,
        FadeInTransition,
        FadeOutTransition,
        TrashIcon,
        ArchiveIcon,
        AppWindowIcon,
        SkeletonHeading
    },

    emits: {
        deleteCard: null,
        archiveCard: null,
    },

    props: {
        card: {
            type: Object
        },
        column: {
            type: Object
        }
    },

    methods: {
        deleteCard() {
            this.$emit('deleteCard')
        }
    }
}
</script>

<template>
    <div class="flex gap-2 items-center">
        <app-heading as="h3" class="flex items-start">
            <app-window-icon class="text-gray-800 dark:text-gray-200 inline-block mr-2"/>
            {{ card?.title }}
        </app-heading>

        <div class="card-actions ml-auto space-x-2">
            <app-button variant="info" size="md" class="!px-2">
                <archive-icon :size="16"/>
            </app-button>

            <app-button @click="deleteCard" variant="danger" size="md" class="!px-2">
                <trash-icon :size="16" class=""/>
            </app-button>
        </div>
    </div>

    <app-text size="sm" class="mt-2">In Column: {{ column?.name }}</app-text>
</template>
