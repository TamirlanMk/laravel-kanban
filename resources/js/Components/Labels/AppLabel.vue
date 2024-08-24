<script>

import {hexToHSL} from "@/utils/helpers.js";

export default {
    props: {
        color: {
            type: String,
            default: '#1445bd'
        }
    },

    computed: {
        hsl() {
            return hexToHSL(this.color)
        }
    }
}
</script>

<template>
    <div
        :class="{
            'text-gray-200': hsl.l > 1 && hsl.l < 40 || hsl.l === 0,
            'text-gray-900': hsl.l < 1 && hsl.l !== 0 || hsl.l > 40,
            'inline-flex flex-row items-center': this.$slots?.actions
        }"
        class="text-xs px-3 py-1 rounded-2xl inline-block !font-black tracking-wide"
        :style="`background: ${color}`"
    >
        <slot/>

        <div v-if="this.$slots?.actions">
            <slot name="actions"/>
        </div>
    </div>
</template>

