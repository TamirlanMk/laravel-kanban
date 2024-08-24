<script>
import AppCard from "@/Components/Card/AppCard.vue";
import AppButton from "@/Components/Button/AppButton.vue";
import {useForm} from "@inertiajs/vue3";

export default {
    components: {AppButton, AppCard},

    emits: {
        create: null
    },

    props: {
        columnId: {
            type: Number,
            required: true
        }
    },

    data() {
        return {
            isShow: false,
            form: useForm({
                title: ''
            })
        }
    },

    methods: {
        async showForm() {
            this.isShow = true;
            await this.$nextTick()
            this.$refs.title.focus()
        },

        hideForm() {
            this.isShow = false;
            this.form.reset('title');
        },

        createCard() {
            this.form.post(route('columns.cards.store', {
                board_column: this.columnId
            }), {
                onSuccess: () => {
                    this.hideForm()
                },
                onError: () => {
                    this.hideForm()
                },
            })
        }
    }
}
</script>

<template>
    <app-card
        @click.stop="!isShow ? showForm() : ''"
        :class="{
                '!px-0 mt-5 cursor-pointer': !isShow,
                '!px-2 !py-2 mt-5': isShow,
            }"
    >
        <template v-if="!isShow">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="lucide lucide-plus mx-auto text-gray-800 dark:text-gray-100">
                <path d="M5 12h14"/>
                <path d="M12 5v14"/>
            </svg>
        </template>

        <template v-if="isShow">
                <textarea
                    v-model="form.title"
                    ref="title"
                    name="card-title"
                    class="mb-1 form-textarea text-sm resize-none w-full rounded-[10px] border border-gray-200 bg-transparent text-gray-800 dark:text-gray-200 leading-tight font-semibold"
                    maxlength="255"
                    @keydown.ctrl.enter="createCard"
                ></textarea>
        </template>

        <template #footer v-if="isShow">
            <app-button
                size="xs"
                variant="info"
                @click.stop="hideForm"
            >
                Cancel
            </app-button>

            <app-button
                size="xs"
                variant="success"
                class="ms-2"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click.stop="createCard"
            >
                Create
            </app-button>
        </template>
    </app-card>
</template>

