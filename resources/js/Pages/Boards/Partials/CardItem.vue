<script>
import AppHeading from "@/Components/Heading/AppHeading.vue";
import LabelList from "@/Components/Labels/LabelList.vue";
import AppCard from "@/Components/Card/AppCard.vue";
import AppLabel from "@/Components/Labels/AppLabel.vue";

import {ListTodoIcon, PaperclipIcon, PencilIcon, SquareCheckIcon} from 'lucide-vue-next';
import {useForm} from "@inertiajs/vue3";
import {updateCard} from "@/Api/card/card.js";

export default {
    components: {
        PencilIcon,
        PaperclipIcon,
        SquareCheckIcon,
        ListTodoIcon,

        AppCard,
        AppLabel,
        LabelList,
        AppHeading
    },

    emits: {
        open: null,
        update: null
    },

    props: {
        card: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            isEditing: false,
            form: useForm({
                title: ''
            })
        };
    },

    computed: {
        hasTodos() {
            return this.card?.todos_count > 0;
        },

        hasAttachments() {
            return this.card?.attachments_count > 0;
        },

        hasComments() {
            return this.card?.comments_count > 0;
        },

        hasCounts() {
            return this.hasTodos ?? this.hasAttachments ?? this.hasComments
        },
    },

    methods: {
        async editCard() {
            this.isEditing = true;
            this.form.title = this.card.title;

            await this.$nextTick();

            this.$refs.title.focus();
        },

        closeEdit() {
            this.isEditing = false;
        },

        async saveCard() {
            if (this.card.title === this.form.title) {
                this.closeEdit();
                return;
            }

            await updateCard(this.card.id, this.form.data())
                .then(card => {
                    this.$emit('update', card);
                })

            this.closeEdit()
        }
    }
}
</script>

<template>
    <app-card
        @click="!isEditing ? $emit('open', card) : ''"
        :class="{ '!p-2': isEditing, 'pb-1': hasCounts}"
        class="cursor-pointer relative group"
    >

        <template
            v-if="!isEditing"
        >
            <button
                @click.stop="editCard"
                :class="{'hidden': isEditing}"
                class="absolute right-2 top-2 text-gray-700 dark:text-gray-300 transition"
            >
                <pencil-icon class="opacity-0 group-hover:opacity-100" size="12"/>
            </button>

            <label-list v-if="card?.labels?.length">
                <app-label v-for="label in card?.labels" :color="label.color">{{ label.name }}</app-label>
            </label-list>

            <app-heading
                as="h5"
                :cols="4"
                :class="{'mt-4': card.labels?.length}"
            >
                {{ card.title }}
            </app-heading>

            <div v-if="hasCounts"
                 class="inline-flex gap-x-2 mt-2 text-gray-600 dark:text-gray-300">
                <div v-if="hasAttachments" class="text-xs flex items-center">
                    <span class="sr-only">
                        Attachments
                    </span>

                    <paperclip-icon size="11" class="inline-block mr-1"/>

                    <span>{{ card.attachments_count }}</span>
                </div>

                <div v-if="hasTodos" class="text-xs flex items-center">
                    <span class="sr-only">
                        Attachments
                    </span>

                    <list-todo-icon size="12" class="inline-block mr-1"/>

                    <span>{{ card.todos_count }}</span>
                </div>
            </div>
        </template>

        <template v-else>
            <textarea
                v-model="form.title"
                ref="title"
                name="card-title"
                class="form-textarea text-sm resize-none w-full rounded-[10px] border border-gray-200 bg-transparent text-gray-800 dark:text-gray-200 leading-tight font-semibold"
                maxlength="255"
                @blur="saveCard"
                @keydown.ctrl.enter="saveCard"
            ></textarea>
        </template>
    </app-card>
</template>
