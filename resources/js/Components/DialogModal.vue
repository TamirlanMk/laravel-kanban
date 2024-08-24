<script>
import Modal from "@/Components/Modal.vue";
import FadeTransition from "@/Components/Transitions/FadeTransition.vue";

export default {
    components: {
        Modal,
        FadeTransition
    },

    emits: {
        open: null,
        close: null,
    },

    data() {
        return {
            show: false
        }
    },

    props: {
        maxWidth: {
            type: String,
            default: '2xl',
        },
        minHeight: {
            type: String,
            default: '250',
        },
        closeable: {
            type: Boolean,
            default: true,
        }
    },

    methods: {
        open() {
            this.show = true;
        },

        close() {
            this.show = false;
        }
    }
}
</script>

<template>
    <teleport to="#modals">
        <Modal
            :show="show"
            :max-width="maxWidth"
            :min-heigth="minHeight"
            :closeable="closeable"
            @close="$emit('close')"
        >
            <div class="px-6 py-4">
                <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    <fade-transition mode="out-in">
                        <slot name="title"/>
                    </fade-transition>
                </div>

                <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                    <fade-transition mode="out-in">
                        <slot name="content"/>
                    </fade-transition>
                </div>
            </div>

            <div v-if="$slots.footer" class="flex flex-row justify-end px-6 py-4 bg-gray-100 dark:bg-gray-800 text-end">
                <slot name="footer"/>
            </div>
        </Modal>
    </teleport>
</template>
