<script>
export default {
    props: {
        value: {
            type: String || Number
        },
        default: {
            type: Boolean
        }
    },

    data() {
        return {
            active: this.default ?? false
        }
    }
}
</script>

<template>
    <a class="px-4 py-4 text-lg font-medium text-gray-900 dark:text-gray-100 block rounded-bl-lg transition"
       :class="active ? 'bg-white' : ''">
        <slot/>
    </a>
</template>
