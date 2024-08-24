<script>
import SkeletonWrapper from "@/Components/Skeleton/SkeletonWrapper.vue";

export default {
    components: {
        SkeletonWrapper
    },

    props: {
        size: {
            type: String,
            default: 'h2'
        }
    },

    computed: {
        sizeClass() {
            return {
                'h2': 'h-5',
                'h3': 'h-4',
                'h4': 'h-3'
            }[this.size]
        }
    }
}
</script>

<template>
    <skeleton-wrapper>
        <div
            :class="sizeClass"
            class="bg-gray-200 rounded-full dark:bg-gray-700 max-w-[420px] mb-6"
        />
    </skeleton-wrapper>
</template>
