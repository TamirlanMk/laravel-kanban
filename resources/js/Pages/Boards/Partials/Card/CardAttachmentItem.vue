<script>
import AppButton from "@/Components/Button/AppButton.vue";
import AppHeading from "@/Components/Heading/AppHeading.vue";
import {FileTextIcon} from "lucide-vue-next";
import FadeInTransition from "@/Components/Transitions/FadeInTransition.vue";

export default {
    components: {FadeInTransition, FileTextIcon, AppHeading, AppButton},

    emits: {
        delete: null
    },

    props: {
        attachment: {
            type: Object,
            required: true
        }
    },

    computed: {
        path() {
            return `/storage/${this.attachment.path}`;
        },
        isImage() {
            return ['png', 'jpg', 'jpeg', 'jpe'].some(type => type === this.attachment.extension)
        }
    }
}
</script>

<template>
    <div class="grid grid-cols-12 gap-x-6 p-3 rounded-md shadow-sm border dark:border-gray-700">
        <div class="col-span-3 rounded-md overflow-hidden flex flex-col items-center justify-center max-h-20">
            <img v-if="isImage" class="block object-cover w-full h-f" :src="path" :alt="attachment.caption">
            <file-text-icon v-else size="60"/>
        </div>

        <div class="col-span-9">
            <app-heading as="h4" class="w-full">
                {{ attachment.caption }}
            </app-heading>

            <div class="inline-flex gap-2 mt-6">
                <app-button as="a" :href="path" target="_blank" size="xs">
                    Open
                </app-button>
                <app-button as="a" :href="path" download="download" size="xs">
                    Download
                </app-button>
                <app-button size="xs" variant="danger" @click="$emit('delete', attachment)">
                    Delete
                </app-button>
            </div>
        </div>
    </div>
</template>

