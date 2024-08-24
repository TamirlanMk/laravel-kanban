<script>
import draggable from 'vuedraggable'
import {router} from "@inertiajs/vue3";

import AppLayout from "@/Layouts/AppLayout.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import AppHeading from "@/Components/Heading/AppHeading.vue";
import CreateColumnModal from "@/Pages/Boards/Partials/Modals/CreateColumnModal.vue";
import EditColumnModal from "@/Pages/Boards/Partials/Modals/EditColumnModal.vue";
import ConfirmDeleteModal from "@/Pages/Boards/Partials/Modals/ConfirmDeleteModal.vue";
import CardModal from "@/Pages/Boards/Partials/Card/CardModal.vue";
import ColumnItem from "@/Pages/Boards/Partials/ColumnItem.vue";
import {route} from "../../../../vendor/tightenco/ziggy/src/js/index.js";

export default {
    components: {
        ColumnItem,
        AppLayout,
        AppHeading,
        AppButton,
        draggable,
        CardModal,
        EditColumnModal,
        CreateColumnModal,
        ConfirmDeleteModal
    },

    props: {
        board: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            columns: [...this.board?.columns],
            currentCard: null,
            editingColumn: null,
            deletingColumn: null
        };
    },

    mounted() {
        console.log(this.board);
    },

    computed: {
        reorderedColumns() {
            const columns = [...this.columns];

            columns.forEach((item, index) => {
                item.position = index + 1;
            });

            return columns;
        },

        columnsData() {
            return this.reorderedColumns?.map(column => ({id: column.id, position: column.position}))
        }
    },

    watch: {
        board(value) {
            this.columns = [...value?.columns];
        }
    },

    methods: {
        openCard(card) {
            this.currentCard = card;

            this.$refs.cardModal.open();
        },

        createColumn() {
            this.$refs.createColumnModal.open();
        },

        editColumn(column) {
            this.editingColumn = column;

            this.$refs.editColumnModal.open();
        },

        deleteColumn(column) {
            this.deletingColumn = column;

            this.$refs.deleteColumnModal.open();
        },

        async onReorderedColumns() {
            router.put(route('columns.sorting', {
                board: this.board.id
            }), {
                columns: this.columnsData
            });
        },

        handleCardUpdated(updatedCard) {
            if (!updatedCard) {
                return;
            }

            const columnWithCard = this.columns.find(column => column.id === updatedCard.board_column_id);

            if (columnWithCard) {
                const card = columnWithCard?.cards?.find(card => card.id === updatedCard.id);

                if (card) {
                    Object.assign(card, updatedCard)
                }
            }
        }
    }
}

</script>

<template>
    <app-layout
        :title="board.name"
        :overflow="true"
    >
        <template #header>
            <div class="flex flex-row justify-between items-center">
                <app-heading>{{ board.name }}</app-heading>
                <app-button @click="createColumn">Create column</app-button>
            </div>
        </template>

        <div class="px-4 sm:px-6 lg:px-8">
            <draggable
                v-model="columns"
                :animation="250"
                item-key="id"
                group="columns"
                @end="onReorderedColumns"
                class="flex flex-row items-start justify-start min-h-[80svh] gap-10 sm:gap-5"
            >
                <template #item="{ element }">
                    <column-item
                        :column="element"
                        :key="element.id"
                        @open-card="openCard"
                        @edit-column="editColumn"
                        @delete-column="deleteColumn"
                        @card-updated="handleCardUpdated"
                    />
                </template>
            </draggable>
        </div>

        <card-modal
            ref="cardModal"
            :card-id="currentCard?.id"
            :column="currentCard ? columns.find(item => item.id === currentCard?.board_column_id) : null"
            @card-updated="handleCardUpdated"
        />

        <create-column-modal
            ref="createColumnModal"
            :board-id="board.id"
        />

        <edit-column-modal
            ref="editColumnModal"
            :column="editingColumn"
        />

        <confirm-delete-modal
            ref="deleteColumnModal"
            :column="deletingColumn"
            :confirm-text="deletingColumn?.name"
        />
    </app-layout>
</template>
