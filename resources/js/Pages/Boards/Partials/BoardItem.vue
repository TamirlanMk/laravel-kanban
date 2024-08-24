<script>
import AppCard from "@/Components/Card/AppCard.vue";
import AppHeading from "@/Components/Heading/AppHeading.vue";
import AppButton from "@/Components/Button/AppButton.vue";

export default {
    name: "BoardCard",
    components: {AppButton, AppHeading, AppCard},

    props: {
        board: {
            type: Object,
            required: true
        }
    }
}
</script>

<template>
    <app-card class="col-span-12 sm:col-span-6 md:col-span-4 w-full">
        <app-heading as="h3">
            {{ board.name }}
        </app-heading>

        <app-button
            as="link"
            class="mt-5"
            variant="primary"
            :href="route('boards.show', {board: board.id})"
        >
            Open
        </app-button>
    </app-card>
</template>
