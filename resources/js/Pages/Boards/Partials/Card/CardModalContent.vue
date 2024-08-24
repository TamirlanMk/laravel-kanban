<script>
import SkeletonText from "@/Components/Skeleton/SkeletonText.vue";
import FadeOutTransition from "@/Components/Transitions/FadeOutTransition.vue";
import FadeInTransition from "@/Components/Transitions/FadeInTransition.vue";
import CardAttachments from "@/Pages/Boards/Partials/Card/CardAttachments.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import CardDescription from "@/Pages/Boards/Partials/Card/CardDescription.vue";
import AppHeading from "@/Components/Heading/AppHeading.vue";

export default {
    components: {
        AppHeading,
        CardDescription,
        AppButton,
        CardAttachments,
        FadeInTransition,
        FadeOutTransition,
        SkeletonText
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
        },
        isLoading: {
            type: Boolean
        }
    },
}
</script>

<template>
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-9 space-y-10">
            <fade-out-transition>
                <skeleton-text class="absolute top-16" v-if="isLoading"/>
            </fade-out-transition>

            <fade-in-transition>
                <template v-if="!isLoading">
                    <card-description
                        :card="card"
                        @update="update"
                    />
                </template>
            </fade-in-transition>

            <fade-out-transition>
                <skeleton-text class="absolute top-16" v-if="isLoading"/>
            </fade-out-transition>

            <fade-in-transition :is-group="true">
                <template v-if="!isLoading && card.attachments.length > 0">
                    <card-attachments :attachments="card.attachments"/>
                </template>
            </fade-in-transition>
        </div>

        <aside class="col-span-3 pb-2">
            <app-heading as="h4">
                Add to card
            </app-heading>

            <div class="space-y-2 mt-2 flex flex-col items-stretch">
                <app-button @click="addAttachment" variant="info" class="w-full">
                    Add Attachment
                </app-button>

                <app-button variant="info">
                    Add Todo
                </app-button>
            </div>
        </aside>
    </div>
</template>

<style scoped>

</style>
