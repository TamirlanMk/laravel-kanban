<script>
import draggable from 'vuedraggable'

import {router} from "@inertiajs/vue3";
import AppHeading from "@/Components/Heading/AppHeading.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import CreateCardForm from "@/Pages/Boards/Partials/CreateCardForm.vue";
import CardItem from "@/Pages/Boards/Partials/CardItem.vue";

export default {
    components: {CreateCardForm, CardItem, DropdownLink, Dropdown, AppHeading, draggable},

    emits: {
        openCard: null,
        cardUpdated: null,

        editColumn: null,
        deleteColumn: null
    },

    props: {
        column: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            cards: [...this.column?.cards]
        }
    },

    watch: {
        column(value) {
            this.cards = [...value?.cards];
        }
    },

    computed: {
        reorderedCards() {
            const cards = [...this.cards];

            cards.forEach((item, index) => {
                item.board_column_id = this.column?.id
                item.position = index + 1;
            });

            return cards;
        },

        cardsData() {
            return this.reorderedCards.map(card => ({
                id: card.id,
                position: card.position,
                column_id: card.board_column_id
            }))
        },
    },

    methods: {
        openCard(card) {
            this.$emit('openCard', card);
        },

        cardUpdated(card) {
            this.$emit('cardUpdated', card);
        },

        editColumn() {
            this.$emit('editColumn', this.column);
        },

        deleteColumn() {
            this.$emit('deleteColumn', this.column);
        },

        saveReorderedCards(e) {
            if (!e?.removed) {
                router.put(route('cards.sorting'), {
                    cards: this.cardsData
                })
            }
        }
    }
}
</script>

<template>
    <div class="w-8/12 sm:w-72 flex-shrink-0 space-y-5 last:pe-5">
        <div class="flex items-center justify-between">
            <app-heading as="h4">
                {{ column.name }}
            </app-heading>

            <dropdown>
                <template #trigger>
                    <div class="text-gray-500 hover:text-gray-700 cursor-pointer px-2 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-ellipsis">
                            <circle cx="12" cy="12" r="1"/>
                            <circle cx="19" cy="12" r="1"/>
                            <circle cx="5" cy="12" r="1"/>
                        </svg>
                    </div>
                </template>

                <template #content>
                    <dropdown-link as="button" @click.prevent="editColumn">
                        Edit
                    </dropdown-link>
                    <dropdown-link as="button" @click.prevent="deleteColumn">
                        Delete
                    </dropdown-link>
                </template>
            </dropdown>
        </div>

        <draggable
            v-model="cards"
            :animation="250"
            group="cards"
            tag="ul"
            item-key="id"
            class="space-y-5"
            @change="saveReorderedCards"
            :class="{
                'min-h-[50px] border-2 border-dashed bg-white rounded-lg': cards.length === 10000
            }"
        >
            <template v-if="cards.length === 1000" #header>
                <div class="relative">
                    <span
                        class="absolute top-2 translate-y-1/2 left-1/2 -translate-x-1/2 text-gray-500 uppercase text-xs">Dropzone</span>
                </div>
            </template>
            <template #item="{ element }">
                <li class="select-none">
                    <card-item
                        :card="element"
                        :key="element.id"
                        @open="openCard"
                        @update="cardUpdated"
                    />
                </li>
            </template>
        </draggable>

        <create-card-form :column-id="column.id"/>
    </div>
</template>
