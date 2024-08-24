<script>
import {XIcon} from "lucide-vue-next";

import AppLabel from "@/Components/Labels/AppLabel.vue";
import LabelList from "@/Components/Labels/LabelList.vue";
import AppHeading from "@/Components/Heading/AppHeading.vue";

export default {
    components: {AppHeading, XIcon, LabelList, AppLabel},

    emits: {
        labelRemoved: null
    },

    props: {
        labels: {
            type: Array,
            required: true
        }
    },

    methods: {
        removeLabel(label) {
            this.$emit('labelRemoved', label)
        }
    }
}
</script>

<template>
    <div class="flex items start gap-4">
        <app-heading as="h5" class="mt-3 w-14">Labels:</app-heading>

        <label-list class="mt-2 w-full">
            <app-label
                v-for="label in this?.labels"
                :key="label.id"
                :color="label.color"
            >
                <template #default>
                    {{ label.name }}
                </template>

                <template #actions>
                    <div class="flex flex-row ml-2">
                        <button
                            class="p-0 border-none"
                            @click.stop="removeLabel(label)"
                        >
                            <x-icon size="12"/>
                        </button>
                    </div>
                </template>
            </app-label>
        </label-list>
    </div>
</template>
