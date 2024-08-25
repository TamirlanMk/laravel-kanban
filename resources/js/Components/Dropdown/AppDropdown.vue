<script>
export default {
    emits: {
        opened: null,
        closed: null
    },

    props: {
        align: {
            type: String,
            default: 'left'
        },

        width: {
            type: String,
            default: '60'
        }
    },

    data() {
        return {
            isOpen: false
        }
    },

    computed: {
        alignmentClasses() {
            if (this.align === 'left') {
                return 'ltr:origin-top-left rtl:origin-top-right start-0';
            }

            if (this.align === 'right') {
                return 'ltr:origin-top-right rtl:origin-top-left end-0';
            }

            return 'origin-top';
        },

        contentClasses() {
            return {
                'w-80': this.width === '80',
                'w-60': this.width === '60',
                'w-48': this.width === '48'
            };
        }
    },

    methods: {
        open() {
            this.isOpen = true;
            this.$emit('opened');
        },

        close() {
            this.isOpen = false;
            this.$emit('closed');
        }
    }
}
</script>

<template>
    <div class="relative">
        <div @click="open">
            <slot name="trigger"/>
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="isOpen" class="fixed inset-0 z-40" @click="close"/>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <div
                v-show="isOpen"
                class="absolute z-50 mt-2 rounded-md shadow-lg right-0 bg-white dark:bg-gray-700 p-2 ring-1 ring-black ring-opacity-5 pb-5"
                :class="[alignmentClasses, contentClasses]"
            >
                <slot name="content"/>
            </div>
        </transition>
    </div>
</template>
