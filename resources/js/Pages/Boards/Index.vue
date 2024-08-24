<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import AppCard from "@/Components/Card/AppCard.vue";
import InputError from "@/Components/InputError.vue";
import DialogModal from "@/Components/DialogModal.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import AppHeading from "@/Components/Heading/AppHeading.vue";
import CreateBoardModal from "@/Pages/Boards/Partials/Modals/CreateBoardModal.vue";
import BoardItem from "@/Pages/Boards/Partials/BoardItem.vue";

export default {
    components: {
        BoardItem,
        AppLayout,
        AppCard,
        AppHeading,
        AppButton,
        TextInput,
        InputError,
        DialogModal,
        CreateBoardModal
    },

    props: {
        boards: {
            type: Array,
            required: true
        }
    },

    methods: {
        openModal() {
            this.$refs.boardModal.open();
        }
    }
}
</script>

<template>
    <app-layout title="Boards">

        <template #header>
            <div class="flex flex-row justify-between items-center">
                <app-heading>Boards</app-heading>

                <app-button @click="openModal">Create board</app-button>
            </div>
        </template>

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6">
                <board-item v-for="board in boards" :board="board"/>
            </div>
        </div>

        <create-board-modal ref="boardModal"/>
    </app-layout>
</template>
